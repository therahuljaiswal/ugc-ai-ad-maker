<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ai-primary leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-deep-black/50 border border-dark-green overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-200">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-dark-green text-ai-primary">
                                <th class="py-3 px-4">Name</th>
                                <th class="py-3 px-4">Email</th>
                                <th class="py-3 px-4">Credits</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr class="border-b border-white/5 hover:bg-white/5 transition">
                                    <td class="py-3 px-4">{{ $user->name }} @if($user->is_admin) <span class="text-xs bg-ai-primary text-black px-1 rounded">Admin</span> @endif</td>
                                    <td class="py-3 px-4">{{ $user->email }}</td>
                                    <td class="py-3 px-4 text-ai-primary font-bold">{{ $user->credits }}</td>
                                    <td class="py-3 px-4">
                                        @if($user->is_blocked)
                                            <span class="text-red-500">Blocked</span>
                                        @else
                                            <span class="text-green-500">Active</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-right">
                                        <form action="{{ route('admin.users.give-credits', $user) }}" method="POST" class="inline-flex mr-2">
                                            @csrf
                                            <input type="number" name="amount" value="50" class="w-16 bg-black/30 border-dark-green rounded text-xs text-white p-1">
                                            <button type="submit" class="ml-1 text-xs bg-ai-primary text-black px-2 py-1 rounded">Gift</button>
                                        </form>
                                        <form action="{{ route('admin.users.toggle-block', $user) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-sm px-3 py-1 rounded {{ $user->is_blocked ? 'bg-green-600 text-white' : 'bg-red-600 text-white' }}">
                                                {{ $user->is_blocked ? 'Unblock' : 'Block' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
