<x-layout-admin>
    <div class="container mx-auto p-6">
        <div class="mb-6">
            <h2 class="text-3xl font-semibold text-gray-800">Users List</h2>
        </div>

        <!-- Users Table -->
        <div class="overflow-x-auto bg-white p-6 rounded-lg shadow-lg">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600">Name</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600">Email</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600">Created At</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600">Actions</th>
                </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                @foreach ($users as $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $user->name }}</td>
                        <td class="py-3 px-4">{{ $user->email }}</td>
                        <td class="py-3 px-4">{{ $user->created_at->format('Y-m-d') }}</td>
                        <td class="py-3 px-4">
                            <a href="{{ route('admin.user.show', $user) }}" class="text-blue-500 hover:text-blue-700">View</a>
                            <a href="{{ route('admin.user.edit', $user) }}" class="ml-2 text-yellow-500 hover:text-yellow-700">Edit</a>
                            <form action="{{ route('admin.user.destroy', $user) }}" method="POST" class="inline ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $users->links('pagination::tailwind') }} <!-- Tailwind pagination style -->
            </div>
        </div>
    </div>
</x-layout-admin>
