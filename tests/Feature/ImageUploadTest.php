<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Prompt;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_ad_with_images()
    {
        Storage::fake('public');
        $user = User::factory()->create(['credits' => 100]);
        $this->actingAs($user);

        $file1 = UploadedFile::fake()->image('ad1.jpg');
        $file2 = UploadedFile::fake()->image('ad2.jpg');

        $response = $this->post(route('ads.store'), [
            'size' => '9:16',
            'custom_prompt' => 'Test Ad',
            'images' => [$file1, $file2],
        ]);

        $response->assertRedirect();
        Storage::disk('public')->assertExists('ads/reference/' . $file1->hashName());
        Storage::disk('public')->assertExists('ads/reference/' . $file2->hashName());

        $ad = $user->ads()->first();
        $this->assertCount(2, $ad->content['reference_images']);
    }

    public function test_user_can_create_product_image_with_reference()
    {
        Storage::fake('public');
        $user = User::factory()->create(['credits' => 100]);
        $this->actingAs($user);

        $file = UploadedFile::fake()->image('product.jpg');

        $response = $this->post(route('images.store'), [
            'custom_prompt' => 'Test Product',
            'reference_image' => $file,
        ]);

        $response->assertRedirect();
        Storage::disk('public')->assertExists('products/reference/' . $file->hashName());

        $ad = $user->ads()->where('type', 'image')->first();
        $this->assertNotNull($ad->content['reference_image']);
    }
}
