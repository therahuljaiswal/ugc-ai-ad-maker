<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Prompt;
use App\Services\GeminiService;
use App\Services\CreditService;

class ProductImageController extends Controller
{
    public function create()
    {
        return view('images.create');
    }

    public function store(Request $request, GeminiService $gemini, CreditService $credits)
    {
        $user = auth()->user();
        if (!$credits->hasCredits($user, CreditService::IMAGE_COST)) {
            return back()->with('error', 'Insufficient credits. Please buy more.');
        }

        $request->validate([
            'preset_prompt_id' => 'nullable|exists:prompts,id',
            'custom_prompt' => 'nullable|string',
            'reference_image' => 'nullable|image|max:10240',
        ]);

        $promptContent = $request->custom_prompt;
        if ($request->preset_prompt_id) {
            $promptContent = Prompt::find($request->preset_prompt_id)->content;
        }

        $aiPrompt = "Describe a high-quality product image for: {$promptContent}.
        Focus on professional lighting, studio quality, and commercial aesthetic.";

        $imageUrl = $gemini->generateImage($aiPrompt);

        $ad = Ad::create([
            'user_id' => $user->id,
            'title' => 'Product Image - ' . now()->format('Y-m-d H:i'),
            'type' => 'image',
            'size' => '1:1',
            'content' => [
                'prompt' => $promptContent,
                'image_url' => $imageUrl
            ],
            'status' => 'completed',
        ]);

        $credits->deductCredits($user, CreditService::IMAGE_COST);

        return redirect()->route('ads.show', $ad)->with('success', 'Product image generated successfully!');
    }
}
