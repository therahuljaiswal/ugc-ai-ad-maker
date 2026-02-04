<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ai-primary leading-tight">
            {{ __('Edit Prompt') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-deep-black/50 border border-dark-green p-6 rounded-lg">
                <form action="{{ route('admin.prompts.update', $prompt) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-400 text-sm font-bold mb-2">Title</label>
                        <input type="text" name="title" value="{{ $prompt->title }}" class="w-full bg-black/30 border border-dark-green rounded-lg text-white" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-400 text-sm font-bold mb-2">Type</label>
                        <select name="type" class="w-full bg-black/30 border border-dark-green rounded-lg text-white">
                            <option value="video" {{ $prompt->type == 'video' ? 'selected' : '' }}>Video Ad</option>
                            <option value="image" {{ $prompt->type == 'image' ? 'selected' : '' }}>Product Image</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-400 text-sm font-bold mb-2">Content (AI Instructions)</label>
                        <textarea name="content" rows="6" class="w-full bg-black/30 border border-dark-green rounded-lg text-white" required>{{ $prompt->content }}</textarea>
                    </div>
                    <div class="mb-6">
                        <label class="inline-flex items-center">
                            <input type="hidden" name="is_preset" value="0">
                            <input type="checkbox" name="is_preset" value="1" {{ $prompt->is_preset ? 'checked' : '' }} class="bg-black/30 border-dark-green text-ai-primary rounded">
                            <span class="ml-2 text-gray-400">Mark as Preset Prompt</span>
                        </label>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-ai-primary text-black font-bold rounded-lg hover:bg-ai-secondary transition">Update Prompt</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
