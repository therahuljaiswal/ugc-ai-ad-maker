<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UGC AI Ads Maker - Modern Ad Creation</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-deep-black text-gray-200 selection:bg-ai-primary selection:text-white">
    <div class="relative min-h-screen bg-gradient-ai overflow-hidden">
        <!-- Header -->
        <nav class="flex justify-between items-center py-6 px-8 max-w-7xl mx-auto relative z-10">
            <div class="text-2xl font-bold text-ai-primary">UGC<span class="text-white">AI</span></div>
            <div class="hidden md:flex space-x-8 items-center">
                <a href="#features" class="hover:text-ai-primary transition">Features</a>
                <a href="#pricing" class="hover:text-ai-primary transition">Pricing</a>
                <a href="#reviews" class="hover:text-ai-primary transition">Reviews</a>
                @if (Route::has('login'))
                    <div class="flex space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-6 py-2 bg-ai-primary text-black font-bold rounded-full hover:bg-ai-secondary transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2 border border-ai-primary text-ai-primary rounded-full hover:bg-ai-primary hover:text-black transition">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-6 py-2 bg-ai-primary text-black font-bold rounded-full hover:bg-ai-secondary transition">Start Free</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative pt-20 pb-32 px-8 max-w-7xl mx-auto flex flex-col items-center text-center z-10">
            <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight">
                Create High-Converting <br>
                <span class="text-ai-primary">UGC Ads</span> in Seconds.
            </h1>
            <p class="text-xl text-gray-400 max-w-2xl mb-10">
                Leverage the power of Gemini AI to generate professional video ads and product images. Perfect for TikTok, Reels, and YouTube Shorts.
            </p>
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="{{ route('register') }}" class="px-10 py-4 bg-ai-primary text-black text-lg font-bold rounded-full hover:shadow-[0_0_20px_rgba(16,185,129,0.5)] transition-all">Create My First Ad</a>
                <a href="#demo" class="px-10 py-4 border border-gray-600 rounded-full text-lg hover:border-ai-primary transition">Watch Demo</a>
            </div>

            <!-- Floating Elements -->
            <div class="absolute -top-10 -left-10 w-64 h-64 bg-ai-primary/10 rounded-full blur-3xl"></div>
            <div class="absolute top-40 -right-20 w-80 h-80 bg-ai-secondary/10 rounded-full blur-3xl"></div>
        </div>

        <!-- Demo Section (9:16 size) -->
        <section id="demo" class="py-20 bg-black/50">
            <div class="max-w-7xl mx-auto px-8 text-center">
                <h2 class="text-3xl font-bold mb-12">See it in Action</h2>
                <div class="flex flex-wrap justify-center gap-8">
                    <div class="w-64 h-[450px] bg-gray-900 rounded-2xl border-4 border-dark-green flex items-center justify-center text-gray-500 overflow-hidden relative group">
                        <span class="z-10">Product Ad Demo 1</span>
                        <div class="absolute inset-0 bg-gradient-to-t from-ai-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition"></div>
                    </div>
                    <div class="w-64 h-[450px] bg-gray-900 rounded-2xl border-4 border-dark-green flex items-center justify-center text-gray-500 overflow-hidden relative group">
                        <span class="z-10">Product Ad Demo 2</span>
                        <div class="absolute inset-0 bg-gradient-to-t from-ai-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section id="features" class="py-24 max-w-7xl mx-auto px-8">
            <div class="grid md:grid-cols-3 gap-12">
                <div class="p-8 bg-white/5 rounded-3xl border border-white/10 hover:border-ai-primary/50 transition">
                    <div class="w-12 h-12 bg-ai-primary rounded-xl mb-6 flex items-center justify-center text-black font-bold">1</div>
                    <h3 class="text-xl font-bold mb-4">Gemini AI Powered</h3>
                    <p class="text-gray-400">Advanced AI logic to understand your product and generate the perfect selling script.</p>
                </div>
                <div class="p-8 bg-white/5 rounded-3xl border border-white/10 hover:border-ai-primary/50 transition">
                    <div class="w-12 h-12 bg-ai-primary rounded-xl mb-6 flex items-center justify-center text-black font-bold">2</div>
                    <h3 class="text-xl font-bold mb-4">Multi-Size Support</h3>
                    <p class="text-gray-400">Export ads in 9:16 (TikTok), 16:9 (YouTube), and 1:1 (Instagram) instantly.</p>
                </div>
                <div class="p-8 bg-white/5 rounded-3xl border border-white/10 hover:border-ai-primary/50 transition">
                    <div class="w-12 h-12 bg-ai-primary rounded-xl mb-6 flex items-center justify-center text-black font-bold">3</div>
                    <h3 class="text-xl font-bold mb-4">Product Photography</h3>
                    <p class="text-gray-400">Generate studio-quality product images from simple prompts or uploads.</p>
                </div>
            </div>
        </section>

        <!-- Why Use It -->
        <section class="py-20 bg-dark-green/10">
            <div class="max-w-4xl mx-auto px-8 text-center">
                <h2 class="text-4xl font-bold mb-8">Why choice UGC AI?</h2>
                <p class="text-lg text-gray-300 mb-8">Traditional ad production costs thousands and takes weeks. With our AI, you get professional results in minutes for the cost of a coffee.</p>
                <ul class="text-left space-y-4 max-w-md mx-auto">
                    <li class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-ai-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>90% Lower Production Costs</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-ai-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Unlimited Preset Prompts</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-ai-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Direct Download & Share</span>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Pricing -->
        <section id="pricing" class="py-24 max-w-7xl mx-auto px-8">
            <h2 class="text-4xl font-bold text-center mb-16">Simple Credit Pricing</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-10 bg-white/5 rounded-3xl border border-white/10 text-center">
                    <h3 class="text-xl font-bold mb-4">Starter</h3>
                    <div class="text-4xl font-bold mb-6">$9 <span class="text-lg font-normal text-gray-400">/ 50 Credits</span></div>
                    <ul class="mb-10 space-y-3 text-gray-400">
                        <li>5 Video Ads</li>
                        <li>10 Product Images</li>
                        <li>Basic Support</li>
                    </ul>
                    <a href="{{ route('register') }}" class="block w-full py-3 border border-ai-primary text-ai-primary rounded-xl hover:bg-ai-primary hover:text-black transition">Get Started</a>
                </div>
                <div class="p-10 bg-ai-primary/10 rounded-3xl border-2 border-ai-primary text-center relative scale-105 shadow-2xl">
                    <span class="absolute -top-4 left-1/2 -translate-x-1/2 bg-ai-primary text-black px-4 py-1 rounded-full text-sm font-bold uppercase">Popular</span>
                    <h3 class="text-xl font-bold mb-4">Pro</h3>
                    <div class="text-4xl font-bold mb-6">$29 <span class="text-lg font-normal text-gray-400">/ 200 Credits</span></div>
                    <ul class="mb-10 space-y-3 text-gray-300">
                        <li>25 Video Ads</li>
                        <li>50 Product Images</li>
                        <li>Priority Generation</li>
                    </ul>
                    <a href="{{ route('register') }}" class="block w-full py-3 bg-ai-primary text-black font-bold rounded-xl hover:bg-ai-secondary transition">Choose Pro</a>
                </div>
                <div class="p-10 bg-white/5 rounded-3xl border border-white/10 text-center">
                    <h3 class="text-xl font-bold mb-4">Expert</h3>
                    <div class="text-4xl font-bold mb-6">$99 <span class="text-lg font-normal text-gray-400">/ 1000 Credits</span></div>
                    <ul class="mb-10 space-y-3 text-gray-400">
                        <li>150 Video Ads</li>
                        <li>300 Product Images</li>
                        <li>Custom Preset Prompts</li>
                    </ul>
                    <a href="{{ route('register') }}" class="block w-full py-3 border border-ai-primary text-ai-primary rounded-xl hover:bg-ai-primary hover:text-black transition">Go Expert</a>
                </div>
            </div>
        </section>

        <!-- Reviews -->
        <section id="reviews" class="py-20 bg-black/30">
            <div class="max-w-7xl mx-auto px-8">
                <h2 class="text-3xl font-bold text-center mb-12">Loved by creators</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach([['name'=>'Alex J.', 'text'=>'Changed my dropshipping game completely.'], ['name'=>'Sarah K.', 'text'=>'The video scripts are surprisingly high conversion.'], ['name'=>'Mike D.', 'text'=>'Best AI tool for UGC ads I have found.']] as $review)
                    <div class="p-6 bg-white/5 rounded-2xl border border-white/5">
                        <div class="flex text-yellow-500 mb-4">
                            @for($i=0; $i<5; $i++) ★ @endfor
                        </div>
                        <p class="text-gray-300 mb-4 italic">"{{ $review['text'] }}"</p>
                        <div class="font-bold">- {{ $review['name'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-12 border-t border-white/10 px-8">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center">
                <div class="text-2xl font-bold text-ai-primary mb-6 md:mb-0">UGC<span class="text-white">AI</span></div>
                <div class="flex space-x-8 text-gray-400 text-sm">
                    <a href="/" class="hover:text-white transition">Home</a>
                    <a href="#" class="hover:text-white transition">About</a>
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Contact Us</a>
                </div>
                <div class="mt-8 md:mt-0 text-gray-500 text-sm">
                    © 2026 UGCAI. All rights reserved.
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
