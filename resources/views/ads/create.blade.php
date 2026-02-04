<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ai-primary leading-tight">
            {{ __('Create AI Ad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-deep-black/50 border border-dark-green p-8 rounded-2xl shadow-2xl">
                <form id="ad-creation-form" action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Ad Size Selection -->
                    <div class="mb-8">
                        <label class="block text-ai-primary font-bold mb-4 text-lg">1. Select Ad Size</label>
                        <div class="grid grid-cols-3 gap-4">
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="size" value="9:16" class="peer hidden" checked>
                                <div class="p-4 border-2 border-white/10 rounded-xl bg-black/30 text-center peer-checked:border-ai-primary peer-checked:bg-ai-primary/10 group-hover:border-ai-primary/50 transition">
                                    <div class="w-8 h-12 bg-gray-600 mx-auto mb-2 rounded"></div>
                                    <div class="font-bold">9:16</div>
                                    <div class="text-xs text-gray-500">TikTok/Reels</div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="size" value="16:9" class="peer hidden">
                                <div class="p-4 border-2 border-white/10 rounded-xl bg-black/30 text-center peer-checked:border-ai-primary peer-checked:bg-ai-primary/10 group-hover:border-ai-primary/50 transition">
                                    <div class="w-12 h-8 bg-gray-600 mx-auto mb-2 rounded"></div>
                                    <div class="font-bold">16:9</div>
                                    <div class="text-xs text-gray-500">YouTube</div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="size" value="1:1" class="peer hidden">
                                <div class="p-4 border-2 border-white/10 rounded-xl bg-black/30 text-center peer-checked:border-ai-primary peer-checked:bg-ai-primary/10 group-hover:border-ai-primary/50 transition">
                                    <div class="w-10 h-10 bg-gray-600 mx-auto mb-2 rounded"></div>
                                    <div class="font-bold">1:1</div>
                                    <div class="text-xs text-gray-500">Instagram</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Prompt Selection -->
                    <div class="mb-8" x-data="{ promptType: 'preset' }">
                        <label class="block text-ai-primary font-bold mb-4 text-lg">2. Choose Prompt Style</label>
                        <div class="flex space-x-4 mb-4">
                            <button type="button" @click="promptType = 'preset'" :class="promptType === 'preset' ? 'bg-ai-primary text-black' : 'bg-white/5 text-gray-400'" class="px-4 py-2 rounded-lg font-bold transition">Preset Prompts</button>
                            <button type="button" @click="promptType = 'custom'" :class="promptType === 'custom' ? 'bg-ai-primary text-black' : 'bg-white/5 text-gray-400'" class="px-4 py-2 rounded-lg font-bold transition">Custom Prompt</button>
                        </div>

                        <div x-show="promptType === 'preset'">
                            <select name="preset_prompt_id" class="w-full bg-black/30 border border-dark-green rounded-xl text-white p-3">
                                <option value="">Select a ready-to-use prompt...</option>
                                @foreach(\App\Models\Prompt::where('is_preset', true)->where('type', 'video')->get() as $prompt)
                                    <option value="{{ $prompt->id }}">{{ $prompt->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div x-show="promptType === 'custom'">
                            <textarea name="custom_prompt" rows="4" class="w-full bg-black/30 border border-dark-green rounded-xl text-white p-3" placeholder="Describe your product and the kind of ad you want..."></textarea>
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-8">
                        <label class="block text-ai-primary font-bold mb-4 text-lg">3. Upload Product Images (Optional)</label>
                        <div class="border-2 border-dashed border-dark-green rounded-2xl p-8 text-center bg-black/20 hover:bg-black/40 transition cursor-pointer relative">
                            <input type="file" name="images[]" multiple class="absolute inset-0 opacity-0 cursor-pointer" id="image-upload">
                            <svg class="w-12 h-12 text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-gray-400">Click to upload or drag and drop</p>
                            <p class="text-xs text-gray-600 mt-2">PNG, JPG up to 10MB each</p>
                            <div id="file-list" class="mt-4 text-sm text-ai-primary font-medium"></div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="pt-6 border-t border-white/10">
                        <button type="submit" id="submit-btn" class="w-full py-4 bg-ai-primary text-black font-bold text-xl rounded-xl hover:shadow-[0_0_30px_rgba(16,185,129,0.3)] transition-all flex justify-center items-center">
                            <span>Generate AI Ad</span>
                            <span class="ml-2 text-sm font-normal text-black/70">(10 Credits)</span>
                        </button>
                    </div>
                </form>

                <!-- Progress Overlay -->
                <div id="progress-overlay" class="hidden fixed inset-0 bg-black/90 z-50 flex items-center justify-center flex-col">
                    <div class="w-24 h-24 border-4 border-ai-primary border-t-transparent rounded-full animate-spin mb-8"></div>
                    <h3 class="text-2xl font-bold text-white mb-2">Creating your masterpiece...</h3>
                    <p class="text-gray-400" id="progress-status">Gemini AI is analyzing your product...</p>
                    <div class="w-64 bg-white/10 h-2 rounded-full mt-6 overflow-hidden">
                        <div id="progress-bar" class="bg-ai-primary h-full transition-all duration-500" style="width: 0%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('image-upload').addEventListener('change', function(e) {
            const list = document.getElementById('file-list');
            list.innerHTML = '';
            for (let i = 0; i < e.target.files.length; i++) {
                list.innerHTML += `<div>${e.target.files[i].name}</div>`;
            }
        });

        document.getElementById('ad-creation-form').addEventListener('submit', function() {
            document.getElementById('progress-overlay').classList.remove('hidden');
            let progress = 0;
            const bar = document.getElementById('progress-bar');
            const status = document.getElementById('progress-status');
            const interval = setInterval(() => {
                progress += 1;
                bar.style.width = progress + '%';
                if (progress === 20) status.innerText = 'Crafting persuasive ad script...';
                if (progress === 40) status.innerText = 'Generating visual storyboards...';
                if (progress === 60) status.innerText = 'Optimizing for ' + document.querySelector('input[name="size"]:checked').value + ' size...';
                if (progress === 80) status.innerText = 'Polishing final results...';
                if (progress >= 95) clearInterval(interval);
            }, 200);
        });
    </script>
</x-app-layout>
