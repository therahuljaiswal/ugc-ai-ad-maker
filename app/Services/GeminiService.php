<?php

namespace App\Services;

use Gemini;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected $client;

    public function __construct()
    {
        $apiKey = Setting::get('gemini_api_key');
        if ($apiKey) {
            $this->client = Gemini::client($apiKey);
        }
    }

    public function generateContent(string $prompt, ?string $imagePath = null)
    {
        if (!$this->client) {
            return "Gemini API key not configured.";
        }

        try {
            if ($imagePath && file_exists(storage_path('app/public/' . $imagePath))) {
                $fullPath = storage_path('app/public/' . $imagePath);
                $mimeType = mime_content_type($fullPath);
                $data = base64_encode(file_get_contents($fullPath));

                // Use gemini-1.5-flash as it is multimodal and fast
                $result = $this->client->geminiFlash()->generateContent([
                    $prompt,
                    new \Gemini\Data\Blob(
                        mimeType: $mimeType,
                        data: $data,
                    )
                ]);
            } else {
                // gemini-pro is being deprecated or causing issues in some regions/API versions
                // Use geminiFlash() for standard text generation as well
                $result = $this->client->geminiFlash()->generateContent($prompt);
            }
            return $result->text();
        } catch (\Exception $e) {
            Log::error('Gemini API Error: ' . $e->getMessage());
            return "Error generating content: " . $e->getMessage();
        }
    }

    public function generateImage(string $prompt)
    {
        // Note: Image generation might require specific model (Imagen)
        // For now, we'll return a placeholder or use the multimodal model if available.
        // As of now, Gemini Pro Vision/Flash can handle images, but Imagen 3 is often separate.
        // We'll simulate image prompt generation if full Imagen API is not in the wrapper yet.

        return "https://via.placeholder.com/1024x1024.png?text=AI+Generated+Product+Image";
    }

    public function generateAdScript(string $productName, string $description, string $size, string $instructions)
    {
        $prompt = "Generate a high-converting UGC video ad script for a product named '$productName'.
        Description: $description.
        Target Size/Format: $size.
        Additional Instructions: $instructions.
        Return the script with scene descriptions and dialogue/text-on-screen.";

        return $this->generateContent($prompt);
    }
}
