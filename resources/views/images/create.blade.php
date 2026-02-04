<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ai-primary leading-tight">
            {{ __('AI Product Image Generator') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-deep-black/50 border border-dark-green p-8 rounded-2xl shadow-2xl">
                <form id="image-creation-form" action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-8" x-data="{ promptType: 'preset' }">
                        <label class="block text-ai-primary font-bold mb-4 text-lg">1. Choose Image Style</label>
                        <div class="flex space-x-4 mb-4">
                            <button type="button" @click="promptType = 'preset'" :class="promptType === 'preset' ? 'bg-ai-primary text-black' : 'bg-white/5 text-gray-400'" class="px-4 py-2 rounded-lg font-bold transition">Style Presets</button>
                            <button type="button" @click="promptType = 'custom'" :class="promptType === 'custom' ? 'bg-ai-primary text-black' : 'bg-white/5 text-gray-400'" class="px-4 py-2 rounded-lg font-bold transition">Custom Description</button>
                        </div>

                        <div x-show="promptType === 'preset'">
                            <select name="preset_prompt_id" class="w-full bg-black/30 border border-dark-green rounded-xl text-white p-3">
                                <option value="">Select a photographic style...</option>
                                @foreach(\App\Models\Prompt::where('is_preset', true)->where('type', 'image')->get() as $prompt)
                                    <option value="{{ $prompt->id }}">{{ $prompt->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div x-show="promptType === 'custom'">
                            <textarea name="custom_prompt" rows="4" class="w-full bg-black/30 border border-dark-green rounded-xl text-white p-3" placeholder="Describe the scene, lighting, and environment for your product..."></textarea>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-ai-primary font-bold mb-4 text-lg">2. Upload Reference (Optional)</label>
                        <div class="border-2 border-dashed border-dark-green rounded-2xl p-8 text-center bg-black/20 hover:bg-black/40 transition cursor-pointer relative">
                            <input type="file" name="reference_image" class="absolute inset-0 opacity-0 cursor-pointer" id="image-upload">
                            <svg class="w-12 h-12 text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-gray-400">Upload your product photo to use as reference</p>
                            <div id="file-list" class="mt-4 text-sm text-ai-primary font-medium"></div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-white/10">
                        <button type="submit" class="w-full py-4 bg-ai-primary text-black font-bold text-xl rounded-xl hover:shadow-[0_0_30px_rgba(16,185,129,0.3)] transition-all flex justify-center items-center">
                            <span>Generate AI Image</span>
                            <span class="ml-2 text-sm font-normal text-black/70">(5 Credits)</span>
                        </button>
                    </div>
                </form>

                <!-- Progress Overlay -->
                <div id="progress-overlay" class="hidden fixed inset-0 bg-black/90 z-50 flex items-center justify-center flex-col">
                    <div class="w-24 h-24 border-4 border-ai-primary border-t-transparent rounded-full animate-spin mb-8"></div>
                    <h3 class="text-2xl font-bold text-white mb-2">Generating AI Vision...</h3>
                    <p class="text-gray-400">Gemini is rendering your product in high quality...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('image-upload').addEventListener('change', function(e) {
            document.getElementById('file-list').innerText = e.target.files[0].name;
        });

        document.getElementById('image-creation-form').addEventListener('submit', function() {
            document.getElementById('progress-overlay').classList.remove('hidden');
        });
    </script>
</x-app-layout>
