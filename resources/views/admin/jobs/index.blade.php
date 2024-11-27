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
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600">Created At</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600">Actions</th>
                </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                @foreach ($jobs as $job)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4">{{ $job->id }}</td>
                        <td class="py-2 px-4">{{ $job->title }}</td>
                        <td class="py-2 px-4">{{ $job->salary }}</td>
                        <td class="py-2 px-4">{{ $job->location }}</td>
                        <td class="py-2 px-4">{{ $job->created_at->format('Y-m-d') }}</td>
                        <td class="py-1 px-4">
                            <!-- Dropdown button -->
                            <div class="relative inline-block text-left">
                                <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="options-menu-{{ $job->id }}" aria-expanded="true" aria-haspopup="true">
                                    ....
                                </button>

                                <!-- Dropdown Menu -->
                                <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" id="dropdown-{{ $job->id }}">
                                    <div class="py-1">
                                        <a href="{{ route('admin.job.show', $job) }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">View</a>
                                        <a href="{{ route('admin.job.edit', $job) }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">Edit</a>
                                        <div type="button" onclick="openModal({{ $job->id }})" class="text-red-600 block px-4 py-2 text-sm hover:bg-gray-100 hover:cursor-pointer">Delete</div>
                                        <!-- Add Activate/Deactivate Links -->
{{--                                        @if ($user->status === 'active')--}}
{{--                                            <a href="" class="text-red-500 block px-4 py-2 text-sm hover:bg-gray-100">Deactivate</a>--}}
{{--                                        @else--}}
{{--                                            <a href="" class="text-green-500 block px-4 py-2 text-sm hover:bg-gray-100">Activate</a>--}}
{{--                                        @endif--}}
                                    </div>
                                </div>
                            </div>
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
<script>
    // Function to toggle dropdown visibility
    document.querySelectorAll('[id^="options-menu-"]').forEach(button => {
        button.addEventListener('click', function (event) {
            const userId = this.id.split('-').pop();
            const dropdown = document.getElementById('dropdown-' + userId);

            // Close all dropdowns
            document.querySelectorAll('[id^="dropdown-"]').forEach(drop => {
                if (drop !== dropdown) {
                    drop.classList.add('hidden');
                }
            });

            // Toggle the current dropdown
            dropdown.classList.toggle('hidden');

            // Prevent event propagation to avoid immediate closing after clicking the button
            event.stopPropagation();
        });
    });

    // Close dropdowns if clicked outside
    document.addEventListener('click', function (event) {
        if (!event.target.closest('[id^="options-menu-"]')) {
            // Close all dropdowns
            document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }
    });
</script>
