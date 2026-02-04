<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-ai-primary leading-tight">
                {{ __('My Created Ads') }}
            </h2>
            <a href="{{ route('ads.create') }}" class="px-4 py-2 bg-ai-primary text-black rounded-lg font-bold">Create New Ad</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($ads->isEmpty())
                <div class="text-center py-20 bg-deep-black/30 border border-dark-green rounded-2xl">
                    <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <h3 class="text-xl font-bold text-gray-400">No ads generated yet.</h3>
                    <p class="text-gray-500 mb-6">Start creating your first AI-powered UGC ad today!</p>
                    <a href="{{ route('ads.create') }}" class="px-6 py-2 bg-ai-primary text-black rounded-full font-bold">Get Started</a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($ads as $ad)
                        <div class="bg-deep-black/50 border border-dark-green rounded-xl overflow-hidden hover:border-ai-primary transition group">
                            <div class="aspect-[{{ str_replace(':', '/', $ad->size) }}] bg-gray-900 flex items-center justify-center relative">
                                @if($ad->type == 'image')
                                    <img src="{{ $ad->content['image_url'] ?? '' }}" class="w-full h-full object-cover">
                                @else
                                    <div class="text-ai-primary font-bold uppercase text-xs">Video Ad ({{ $ad->size }})</div>
                                @endif
                                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex items-center justify-center space-x-4">
                                    <a href="{{ route('ads.show', $ad) }}" class="p-2 bg-ai-primary text-black rounded-full">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <form action="{{ route('ads.destroy', $ad) }}" method="POST" onsubmit="return confirm('Delete this ad?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-600 text-white rounded-full">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="text-sm font-bold truncate">{{ $ad->title }}</div>
                                <div class="text-xs text-gray-500 mt-1 uppercase">{{ $ad->type }} • {{ $ad->size }}</div>
                                <div class="text-xs text-gray-600 mt-2">{{ $ad->created_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $ads->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
