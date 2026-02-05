<x-guest-layout>
    <div class="py-12 bg-deep-black min-h-screen text-gray-200">
        <div class="max-w-4xl mx-auto px-6">
            <h1 class="text-4xl font-bold text-ai-primary mb-8">Contact Us</h1>
            <div class="bg-white/5 border border-white/10 p-8 rounded-3xl">
                <p class="mb-8 text-gray-400">Have questions or need support? Fill out the form below and we'll get back to you as soon as possible.</p>

                <form action="#" method="POST" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300">Name</label>
                        <input type="text" class="mt-1 block w-full bg-black/50 border border-gray-700 rounded-lg text-white px-4 py-2 focus:border-ai-primary focus:ring-ai-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300">Email</label>
                        <input type="email" class="mt-1 block w-full bg-black/50 border border-gray-700 rounded-lg text-white px-4 py-2 focus:border-ai-primary focus:ring-ai-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300">Message</label>
                        <textarea rows="4" class="mt-1 block w-full bg-black/50 border border-gray-700 rounded-lg text-white px-4 py-2 focus:border-ai-primary focus:ring-ai-primary"></textarea>
                    </div>
                    <button type="button" class="w-full py-3 bg-ai-primary text-black font-bold rounded-lg hover:bg-ai-secondary transition">Send Message</button>
                </form>
            </div>
            <div class="mt-12">
                <a href="/" class="text-ai-primary hover:underline">← Back to Home</a>
            </div>
        </div>
    </div>
</x-guest-layout>
