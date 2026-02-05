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

        $referenceImagePath = null;
        if ($request->hasFile('reference_image')) {
            $referenceImagePath = $request->file('reference_image')->store('products/reference', 'public');
        }

        $promptContent = $request->custom_prompt;
        if ($request->preset_prompt_id) {
            $promptContent = Prompt::find($request->preset_prompt_id)->content;
        }

        $aiPrompt = "Describe a high-quality product image for: {$promptContent}.
        Focus on professional lighting, studio quality, and commercial aesthetic.
        If an image is provided, describe how to enhance it or place it in a new premium setting.";

        // Use generateContent to get a better description of what the image *should* look like
        $description = $gemini->generateContent($aiPrompt, $referenceImagePath);

        $imageUrl = $gemini->generateImage($description);

        // Simulate storing the "generated" image locally for demonstration
        // In a real app, you'd download the AI generated image and store it
        $generatedPath = 'products/generated/' . uniqid() . '.png';
        // For simulation, we'll just record the URL or the path.
        // But to make it work with Storage::url(), let's just keep the URL if it's external,
        // or a path if it's internal.

        $ad = Ad::create([
            'user_id' => $user->id,
            'title' => 'Product Image - ' . now()->format('Y-m-d H:i'),
            'type' => 'image',
            'size' => '1:1',
            'content' => [
                'prompt' => $promptContent,
                'image_url' => $imageUrl,
                'reference_image' => $referenceImagePath,
            ],
            'status' => 'completed',
        ]);

        $credits->deductCredits($user, CreditService::IMAGE_COST);

        return redirect()->route('ads.show', $ad)->with('success', 'Product image generated successfully!');
    }
}
