<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ai-primary leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-deep-black/50 border border-dark-green p-6 rounded-xl">
                    <div class="text-gray-400 text-sm mb-2">Total Users</div>
                    <div class="text-3xl font-bold text-ai-primary">{{ $total_users }}</div>
                </div>
                <div class="bg-deep-black/50 border border-dark-green p-6 rounded-xl">
                    <div class="text-gray-400 text-sm mb-2">Total Credits Circulating</div>
                    <div class="text-3xl font-bold text-ai-primary">{{ $total_credits }}</div>
                </div>
            </div>

            <div class="bg-deep-black/50 border border-dark-green overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-200">
                    <h3 class="text-lg font-bold mb-4">Quick Links</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{ route('admin.users.index') }}" class="p-4 bg-white/5 border border-white/10 rounded-lg hover:border-ai-primary transition text-center">
                            Manage Users
                        </a>
                        <a href="{{ route('admin.prompts.index') }}" class="p-4 bg-white/5 border border-white/10 rounded-lg hover:border-ai-primary transition text-center">
                            Manage Prompts
                        </a>
                        <a href="{{ route('admin.settings') }}" class="p-4 bg-white/5 border border-white/10 rounded-lg hover:border-ai-primary transition text-center">
                            System Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
