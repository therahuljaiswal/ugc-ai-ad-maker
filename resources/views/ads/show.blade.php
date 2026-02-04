<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-ai-primary leading-tight">
                {{ $ad->title }}
            </h2>
            <a href="{{ route('ads.index') }}" class="text-gray-400 hover:text-white">← Back to Gallery</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Preview Section -->
                <div class="w-full lg:w-1/3 flex justify-center">
                    <div id="video-preview-container" class="relative bg-black rounded-2xl shadow-2xl border-4 border-dark-green overflow-hidden"
                         style="width: 320px; aspect-ratio: {{ str_replace(':', '/', $ad->size) }};">

                        @if($ad->type == 'image')
                            <img src="{{ $ad->content['image_url'] ?? '' }}" class="w-full h-full object-cover">
                        @else
                            <div id="slideshow-container" class="w-full h-full relative">
                                @foreach($ad->content['scenes'] as $index => $scene)
                                    <div class="absolute inset-0 opacity-0 transition-opacity duration-1000 slideshow-scene" id="scene-{{ $index }}">
                                        <img src="{{ $scene['image'] }}" class="w-full h-full object-cover">
                                        <div class="absolute bottom-10 left-0 right-0 p-6 bg-black/60 text-white text-center font-bold text-lg backdrop-blur-sm">
                                            {{ $scene['text'] }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Controls -->
                            <div class="absolute bottom-2 right-2 flex space-x-2">
                                <button onclick="playSlideshow()" class="p-2 bg-ai-primary text-black rounded-full shadow-lg">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M4.5 3.5a1 1 0 00-1 1v11a1 1 0 001 1h1a1 1 0 001-1v-11a1 1 0 00-1-1h-1zM11.5 3.5a1 1 0 00-1 1v11a1 1 0 001 1h1a1 1 0 001-1v-11a1 1 0 00-1-1h-1z"></path></svg>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Info Section -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-deep-black/50 border border-dark-green p-8 rounded-2xl shadow-xl h-full">
                        <div class="mb-6">
                            <h3 class="text-ai-primary font-bold text-lg uppercase mb-2">AI Generated Ad Script</h3>
                            <div class="bg-black/30 p-6 rounded-xl text-gray-300 whitespace-pre-line leading-relaxed border border-white/5">
                                {!! nl2br(e($ad->content['script'] ?? '')) !!}
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mt-8">
                            <button class="py-3 bg-ai-primary text-black font-bold rounded-xl hover:bg-ai-secondary transition shadow-lg">Download Script (PDF)</button>
                            <button class="py-3 border border-ai-primary text-ai-primary font-bold rounded-xl hover:bg-ai-primary hover:text-black transition">Regenerate Scenes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($ad->type == 'video')
    <script>
        let currentScene = 0;
        const scenes = document.querySelectorAll('.slideshow-scene');

        function showScene(index) {
            scenes.forEach(s => s.style.opacity = '0');
            scenes[index].style.opacity = '1';
        }

        function playSlideshow() {
            showScene(currentScene);
            currentScene = (currentScene + 1) % scenes.length;
        }

        // Auto play
        showScene(0);
        setInterval(playSlideshow, 3000);
    </script>
    @endif
</x-app-layout>
