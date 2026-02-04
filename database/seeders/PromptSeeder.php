<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prompt;

class PromptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prompts = [
            // Video Prompts
            [
                'title' => 'The Problem/Solution Hook',
                'type' => 'video',
                'is_preset' => true,
                'content' => 'Create a UGC ad script that starts with a relatable problem, introduces the product as the ultimate solution, shows a demo, and ends with a strong CTA.',
            ],
            [
                'title' => 'TikTok Trending Style',
                'type' => 'video',
                'is_preset' => true,
                'content' => 'Fast-paced editing style with text-on-screen, trending audio vibes (described), and high energy. Focus on aesthetic appeal and quick transitions.',
            ],
            [
                'title' => 'Unboxing & First Impression',
                'type' => 'video',
                'is_preset' => true,
                'content' => 'Start with the package delivery, show the excitement of opening, highlight the texture/quality, and give an honest "wow" reaction.',
            ],
            [
                'title' => '3 Reasons Why You Need This',
                'type' => 'video',
                'is_preset' => true,
                'content' => 'Enumerate three unique selling points clearly with visual proof for each. Best for educational or utility products.',
            ],
            [
                'title' => 'ASMR Product Experience',
                'type' => 'video',
                'is_preset' => true,
                'content' => 'Focus on the sounds and close-up visuals of the product. Tapping, clicking, pouring, or using the product with minimal voiceover.',
            ],
            [
                'title' => 'Day in the Life Integration',
                'type' => 'video',
                'is_preset' => true,
                'content' => 'Seamlessly integrate the product into a daily routine. Show how it saves time or improves the user\'s lifestyle.',
            ],
            [
                'title' => 'Comparison: Before vs After',
                'type' => 'video',
                'is_preset' => true,
                'content' => 'Split screen or sequential "before" and "after" using the product. Dramatic visual difference to show effectiveness.',
            ],
            [
                'title' => 'Testimonial/Storytelling',
                'type' => 'video',
                'is_preset' => true,
                'content' => 'A personal story about how the product helped the creator. Emotional connection and trust-building.',
            ],
            [
                'title' => 'Direct Response Sell',
                'type' => 'video',
                'is_preset' => true,
                'content' => 'Hard-hitting sales script focusing on a limited-time offer, scarcity, and immediate benefits.',
            ],
            [
                'title' => 'Behind the Scenes',
                'type' => 'video',
                'is_preset' => true,
                'content' => 'Show the craftsmanship or the brand story behind the product to build authenticity.',
            ],

            // Image Prompts
            [
                'title' => 'Minimalist Studio Shot',
                'type' => 'image',
                'is_preset' => true,
                'content' => 'Clean, high-end studio photography with soft shadows and a neutral background. Focus on product detail.',
            ],
            [
                'title' => 'Outdoor Lifestyle',
                'type' => 'image',
                'is_preset' => true,
                'content' => 'Product placed in a natural outdoor setting with golden hour lighting. Authentic and fresh vibe.',
            ],
            [
                'title' => 'Cyberpunk/Neon Aesthetic',
                'type' => 'image',
                'is_preset' => true,
                'content' => 'Futuristic lighting with neon pink and blue accents. Sharp edges and high contrast.',
            ],
            [
                'title' => 'Cozy Home Vibe',
                'type' => 'image',
                'is_preset' => true,
                'content' => 'Warm, indoor lighting with plants, coffee, and soft textures in the background. Relatable and comfy.',
            ],
            [
                'title' => 'Professional E-commerce',
                'type' => 'image',
                'is_preset' => true,
                'content' => 'Bright, sharp, white background with professional lighting. Perfect for Shopify or Amazon listings.',
            ],
        ];

        foreach ($prompts as $prompt) {
            Prompt::create($prompt);
        }
    }
}
