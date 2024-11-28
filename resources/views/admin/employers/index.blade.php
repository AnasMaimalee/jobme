<x-layout-admin>
    <div class="container mx-auto p-3">
        <!-- Display Flash Success Message -->
        <x-flash-message type="success" /> <!-- Success Message -->
        <x-flash-message type="error" />

        <div class="mb-6">
            <h2 class="text-3xl font-semibold text-gray-800">Employers List</h2>
        </div>

        <!-- Floating Action Button (FAB) -->
        <div class="flex justify-end mb-5">
            <a href="{{ route('admin.employer.create') }}" class="bg-gray-800 text-white rounded-md p-2 shadow-md hover:bg-blue-600">
                Create New Employer
            </a>
        </div>

        <div class="overflow-x-auto bg-white p-3 rounded-lg shadow-lg">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">ID</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Name</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Created At</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Actions</th>
                </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                @foreach ($employers as $employer)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-1 px-4">{{ $employer->id }}</td>
                        <td class="py-1 px-4">{{ $employer->name }}</td>
                        <td class="py-1 px-4">{{ $employer->created_at->format('Y-m-d') }}</td>
                        <td class="py-1 px-4">
                            <!-- Dropdown button -->
                            <div class="relative inline-block text-left">
                                <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="options-menu-{{ $employer->id }}" aria-expanded="true" aria-haspopup="true">
                                    ....
                                </button>

                                <!-- Dropdown Menu -->
                                <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" id="dropdown-{{ $employer->id }}">
                                    <div class="py-1">
                                        <a href="{{ route('admin.employer.show', $employer) }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 hover:cursor-pointer">View</a>
                                        <a href="{{ route('admin.employer.edit', $employer) }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 hover:cursor-pointer">Edit</a>
{{--                                        <div type="button" onclick="openDeleteModal({{ $employer->id }})" class="text-red-600 block px-4 py-2 text-sm hover:bg-gray-100 hover:cursor-pointer">Delete</div>--}}
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
                {{ $employers->links('pagination::tailwind') }}
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    @foreach ($employers as $employer)
        <x-delete-confirmation
            :action="route('admin.employer.destroy', $employer)"
            message="Are you sure you want to delete this Employer?"
            title="Confirm Deletion"
            :id="$employer->id"
        />
    @endforeach
</x-layout-admin>

<!-- Add a little JavaScript to handle dropdown toggle -->
<script>
    // Function to toggle dropdown visibility
    document.querySelectorAll('[id^="options-menu-"]').forEach(button => {
        button.addEventListener('click', function (event) {
            const employerId = this.id.split('-').pop();
            const dropdown = document.getElementById('dropdown-' + employerId);

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

    // Open the delete confirmation modal
    function openDeleteModal(employerId) {
        document.getElementById('delete-modal-' + employerId).classList.remove('hidden');
    }

    // Open the activate/deactivate confirmation modal
    function openActivateDeactivateModal(employerId, actionType) {
        document.getElementById('activate-deactivate-modal-' + employerId).classList.remove('hidden');
        // Optionally set the action type (activate/deactivate) in the modal if needed
        const modal = document.getElementById('activate-deactivate-modal-' + employerId);
        modal.querySelector('.action-type').textContent = actionType;
    }

    // Close the delete modal
    function closeDeleteModal(employerId) {
        document.getElementById('delete-modal-' + employerId).classList.add('hidden');
    }

    // Close the activate/deactivate modal
    function closeActivateDeactivateModal(employerId) {
        document.getElementById('activate-deactivate-modal-' + employerId).classList.add('hidden');
    }
</script>
