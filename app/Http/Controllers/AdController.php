<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Prompt;
use App\Services\GeminiService;
use App\Services\CreditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdController extends Controller
{
    public function index()
    {
        return view('ads.index', [
            'ads' => auth()->user()->ads()->latest()->paginate(12),
        ]);
    }

    public function create()
    {
        return view('ads.create');
    }

    public function store(Request $request, GeminiService $gemini, CreditService $credits)
    {
        $user = auth()->user();
        if (!$credits->hasCredits($user, CreditService::VIDEO_COST)) {
            return back()->with('error', 'Insufficient credits. Please buy more.');
        }

        $request->validate([
            'size' => 'required|in:9:16,16:9,1:1',
            'preset_prompt_id' => 'nullable|exists:prompts,id',
            'custom_prompt' => 'nullable|string',
            'images.*' => 'nullable|image|max:5120',
        ]);

        $referenceImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $referenceImages[] = $image->store('ads/reference', 'public');
            }
        }

        $promptContent = $request->custom_prompt;
        if ($request->preset_prompt_id) {
            $promptContent = Prompt::find($request->preset_prompt_id)->content;
        }

        $aiPrompt = "You are a UGC Ad expert. Generate a high-converting video ad script and visual storyboard.
        Format: JSON.
        Fields:
        - script: full text script.
        - scenes: array of objects with 'text' (on-screen text) and 'image_prompt' (description for an AI image generator).

        Ad Size: {$request->size}
        Instructions: {$promptContent}

        Provide only valid JSON.";

        $firstImage = !empty($referenceImages) ? $referenceImages[0] : null;
        $response = $gemini->generateContent($aiPrompt, $firstImage);
        $jsonStr = preg_replace('/^```json\s*|\s*```$/i', '', trim($response));
        $data = json_decode($jsonStr, true);

        if (!$data || !isset($data['scenes'])) {
            $data = [
                'script' => $response,
                'scenes' => [
                    ['text' => 'AI Generated Hook', 'image_prompt' => 'A professional product shot'],
                    ['text' => 'Product in Action', 'image_prompt' => 'Using the product in a lifestyle setting'],
                    ['text' => 'Limited Time Offer', 'image_prompt' => 'Close up of the product with glowing light'],
                ]
            ];
        }

        $scenes = [];
        foreach ($data['scenes'] as $index => $scene) {
            $scenes[] = [
                'text' => $scene['text'],
                'image' => "https://via.placeholder.com/1024x1024.png?text=AI+Scene+" . ($index + 1)
            ];
        }

        $ad = Ad::create([
            'user_id' => $user->id,
            'title' => 'UGC Ad - ' . now()->format('Y-m-d H:i'),
            'type' => 'video',
            'size' => $request->size,
            'content' => [
                'script' => $data['script'],
                'scenes' => $scenes,
                'reference_images' => $referenceImages,
            ],
            'status' => 'completed',
        ]);

        $credits->deductCredits($user, CreditService::VIDEO_COST);

        return redirect()->route('ads.show', $ad)->with('success', 'Ad generated successfully!');
    }

    public function show(Ad $ad)
    {
        if (auth()->id() !== $ad->user_id && !auth()->user()->is_admin) {
            abort(403);
        }
        return view('ads.show', compact('ad'));
    }

    public function destroy(Ad $ad)
    {
        if (auth()->id() !== $ad->user_id && !auth()->user()->is_admin) {
            abort(403);
        }
        $ad->delete();
        return redirect()->route('ads.index')->with('success', 'Ad deleted.');
    }
}
