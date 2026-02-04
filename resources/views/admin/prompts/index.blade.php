<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-ai-primary leading-tight">
                {{ __('Prompt Management') }}
            </h2>
            <a href="{{ route('admin.prompts.create') }}" class="px-4 py-2 bg-ai-primary text-black rounded-lg font-bold">Add Prompt</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-deep-black/50 border border-dark-green overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-200">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-dark-green text-ai-primary">
                                <th class="py-3 px-4">Title</th>
                                <th class="py-3 px-4">Type</th>
                                <th class="py-3 px-4">Preset</th>
                                <th class="py-3 px-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prompts as $prompt)
                                <tr class="border-b border-white/5 hover:bg-white/5 transition">
                                    <td class="py-3 px-4">{{ $prompt->title }}</td>
                                    <td class="py-3 px-4 uppercase">{{ $prompt->type }}</td>
                                    <td class="py-3 px-4">
                                        {{ $prompt->is_preset ? 'Yes' : 'No' }}
                                    </td>
                                    <td class="py-3 px-4 text-right">
                                        <a href="{{ route('admin.prompts.edit', $prompt) }}" class="text-ai-primary mr-3">Edit</a>
                                        <form action="{{ route('admin.prompts.destroy', $prompt) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-6">
                        {{ $prompts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
