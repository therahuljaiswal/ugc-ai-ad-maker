<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ai-primary leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-deep-black/50 border border-dark-green p-6 rounded-2xl shadow-lg">
                    <div class="text-gray-400 text-sm mb-1">Your Credits</div>
                    <div class="text-3xl font-bold text-ai-primary">{{ Auth::user()->credits }}</div>
                    <a href="{{ route('payments.buy-credits') }}" class="text-xs text-ai-secondary hover:underline mt-2 inline-block">Buy more credits →</a>
                </div>
                <div class="bg-deep-black/50 border border-dark-green p-6 rounded-2xl shadow-lg">
                    <div class="text-gray-400 text-sm mb-1">Ads Created</div>
                    <div class="text-3xl font-bold text-white">{{ Auth::user()->ads()->where('type', 'video')->count() }}</div>
                </div>
                <div class="bg-deep-black/50 border border-dark-green p-6 rounded-2xl shadow-lg">
                    <div class="text-gray-400 text-sm mb-1">Images Generated</div>
                    <div class="text-3xl font-bold text-white">{{ Auth::user()->ads()->where('type', 'image')->count() }}</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-deep-black/50 border border-dark-green rounded-2xl p-8 shadow-xl mb-8">
                <h3 class="text-xl font-bold text-white mb-6">Quick AI Tools</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <a href="{{ route('ads.create') }}" class="group p-6 bg-white/5 border border-white/10 rounded-2xl hover:border-ai-primary transition flex items-center space-x-6">
                        <div class="w-16 h-16 bg-ai-primary/20 rounded-xl flex items-center justify-center text-ai-primary group-hover:bg-ai-primary group-hover:text-black transition">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <div class="text-lg font-bold text-white">Create UGC Video Ad</div>
                            <div class="text-sm text-gray-500">Generate high-converting scripts and visual scenes.</div>
                        </div>
                    </a>
                    <a href="{{ route('images.create') }}" class="group p-6 bg-white/5 border border-white/10 rounded-2xl hover:border-ai-primary transition flex items-center space-x-6">
                        <div class="w-16 h-16 bg-ai-secondary/20 rounded-xl flex items-center justify-center text-ai-secondary group-hover:bg-ai-secondary group-hover:text-black transition">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <div class="text-lg font-bold text-white">AI Product Photography</div>
                            <div class="text-sm text-gray-500">Render studio-quality images for your products.</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Work -->
            <div class="bg-deep-black/50 border border-dark-green rounded-2xl p-8 shadow-xl">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-white">Recent Creations</h3>
                    <a href="{{ route('ads.index') }}" class="text-ai-primary hover:underline text-sm">View all gallery →</a>
                </div>

                @php $recentAds = Auth::user()->ads()->latest()->take(4)->get(); @endphp

                @if($recentAds->isEmpty())
                    <p class="text-gray-500 italic">No creations yet. Use the tools above to start!</p>
                @else
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($recentAds as $ad)
                            <a href="{{ route('ads.show', $ad) }}" class="block group">
                                <div class="aspect-square bg-black/40 rounded-lg border border-white/5 overflow-hidden group-hover:border-ai-primary transition">
                                    @if($ad->type == 'image')
                                        <img src="{{ $ad->content['image_url'] ?? '' }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-xs text-gray-600">VIDEO</div>
                                    @endif
                                </div>
                                <div class="mt-2 text-xs text-gray-400 truncate">{{ $ad->title }}</div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
