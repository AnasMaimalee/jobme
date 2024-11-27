<x-layout-admin>
    <div class="container mx-auto p-6">
        <!-- Display Flash Success Message -->
        <x-flash-message type="success" /> <!-- Success Message -->
        <x-flash-message type="error" />
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Job List Page</h2>
        </div>

        <div class="overflow-x-auto bg-white p-6 rounded-lg shadow-lg">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600">ID</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600">Title</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600">Salary</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600">Location</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600">Logo</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600">URL</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600">Created At</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600">Actions</th>
                </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                @foreach ($jobs as $job)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $job->id }}</td>
                        <td class="py-3 px-4">{{ $job->title }}</td>
                        <td class="py-3 px-4">{{ $job->salary }}</td>
                        <td class="py-3 px-4">{{ $job->location }}</td>
                        <td class="py-3 px-4 text-blue-500">
                            <a href="{{ $job->url }}"> {{ $job->url }}</a>
                        </td>
                        <td class="py-3 px-4">
                            <img src="{{ URL::asset('storage/'.$job->employer->logo) }}" class="rounded-xl" style="width:20px" alt="Employer Logo">
                        </td>
                        <td class="py-3 px-4">{{ $job->created_at->format('Y-m-d') }}</td>
                        <td class="py-3 px-4">
                            <a href="{{ route('admin.job.show', $job) }}" class="text-blue-500 hover:text-blue-700">View</a>
                            <a href="{{ route('admin.job.edit', $job) }}" class="ml-2 text-yellow-500 hover:text-yellow-700">Edit</a>

                            <!-- Delete Button -->
                            <button type="button" onclick="openModal({{ $job->id }})" class="ml-2 text-red-500 hover:text-red-700 focus:outline-none">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $jobs->links('pagination::tailwind') }}
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    @foreach ($jobs as $job)
        <x-delete-confirmation
            :action="route('admin.job.destroy', $job)"
            message="Are you sure you want to delete this Job?"
            title="Confirm Deletion"
            :id="$job->id"
        />
    @endforeach

</x-layout-admin>
