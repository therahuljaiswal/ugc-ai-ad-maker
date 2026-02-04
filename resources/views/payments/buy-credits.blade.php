<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ai-primary leading-tight">
            {{ __('Buy Credits') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-white mb-4">Choose Your Plan</h3>
                <p class="text-gray-400">Credits never expire. Use them whenever you need to create magic.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach([
                    ['name' => 'Starter', 'credits' => 50, 'price' => 9, 'id' => 'starter'],
                    ['name' => 'Pro', 'credits' => 200, 'price' => 29, 'id' => 'pro', 'popular' => true],
                    ['name' => 'Expert', 'credits' => 1000, 'price' => 99, 'id' => 'expert'],
                ] as $plan)
                <div class="p-8 bg-deep-black/50 border {{ isset($plan['popular']) ? 'border-ai-primary border-2 scale-105' : 'border-dark-green' }} rounded-2xl relative shadow-2xl">
                    @if(isset($plan['popular']))
                        <span class="absolute -top-4 left-1/2 -translate-x-1/2 bg-ai-primary text-black px-4 py-1 rounded-full text-xs font-bold uppercase">Best Value</span>
                    @endif
                    <h4 class="text-2xl font-bold mb-4">{{ $plan['name'] }}</h4>
                    <div class="text-4xl font-bold text-ai-primary mb-6">${{ $plan['price'] }}</div>
                    <div class="text-gray-300 font-bold mb-8">{{ $plan['credits'] }} Credits</div>

                    <form action="{{ route('payments.create-order') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan_id" value="{{ $plan['id'] }}">
                        <button type="submit" class="w-full py-3 {{ isset($plan['popular']) ? 'bg-ai-primary text-black' : 'border border-ai-primary text-ai-primary' }} rounded-xl font-bold hover:bg-ai-secondary hover:text-black transition">
                            Buy Now
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
