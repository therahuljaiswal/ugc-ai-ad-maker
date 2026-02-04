<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ai-primary leading-tight">
            {{ __('System Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-deep-black/50 border border-dark-green p-6 rounded-lg">
                <form action="{{ route('admin.settings.save') }}" method="POST">
                    @csrf
                    <h3 class="text-lg font-bold text-ai-primary mb-4">Gemini AI Configuration</h3>
                    <div class="mb-8">
                        <label class="block text-gray-400 text-sm font-bold mb-2">Gemini API Key</label>
                        <input type="password" name="gemini_api_key" value="{{ $gemini_api_key }}" class="w-full bg-black/30 border border-dark-green rounded-lg text-white">
                        <p class="text-xs text-gray-500 mt-1">Get your key from Google AI Studio.</p>
                    </div>

                    <h3 class="text-lg font-bold text-ai-primary mb-4">Razorpay Configuration</h3>
                    <div class="mb-4">
                        <label class="block text-gray-400 text-sm font-bold mb-2">Razorpay Key ID</label>
                        <input type="text" name="razorpay_key" value="{{ $razorpay_key }}" class="w-full bg-black/30 border border-dark-green rounded-lg text-white">
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-400 text-sm font-bold mb-2">Razorpay Key Secret</label>
                        <input type="password" name="razorpay_secret" value="{{ $razorpay_secret }}" class="w-full bg-black/30 border border-dark-green rounded-lg text-white">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-ai-primary text-black font-bold rounded-lg hover:bg-ai-secondary transition">Save Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
