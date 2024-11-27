<x-layout-admin>
    <div class="container mx-auto p-6">
        <!-- Page Title -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800">User Info Page</h2>
        </div>

        <!-- Go Back Button -->
        <div class="flex items-center mb-6">
            <a href="javascript:history.back()" class="text-gray-500 hover:text-gray-700 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5M12 5l-7 7 7 7" />
                </svg>
                <span class="text-lg">Go Back</span>
            </a>
        </div>

        <!-- User Profile Information -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <!-- User Header (Name, Email, Date Created) -->
            <div class="flex items-center space-x-6">
                <div>
                    <h3 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h3>
                    <p class="text-lg text-gray-600">{{ $user->email }}</p>
                    <p class="text-sm text-gray-500">Member since: {{ $user->created_at->format('M d, Y') }}</p>
                </div>
            </div>

            <div class="mt-6">
                <!-- Employer Information (if available) -->
                <h3 class="text-xl font-semibold text-gray-700">Employer Information</h3>
                @if($user->employer)
                    <p class="text-lg text-gray-600">Employer Name: {{ $user->employer->name }}</p>
                    <p class="text-lg text-gray-600">Total Jobs Posted: {{ $user->employer->jobs->count() }}</p>
                @else
                    <p class="text-gray-600">This user is not associated with any employer yet.</p>
                @endif
            </div>

            <!-- Actions -->
            <div class="mt-6 flex space-x-4">
                <a href="{{ route('admin.user.edit', $user) }}" class="bg-yellow-500 text-white py-2 px-4 rounded-lg hover:bg-yellow-600">Edit</a>
                <!-- Trigger Modal with Delete Confirmation -->
                <button type="button" onclick="openModal('{{ route('admin.user.destroy', $user) }}')" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600">Delete</button>
            </div>
        </div>
    </div>

    <!-- Use the Delete Confirmation Component -->
    <x-delete-confirmation
        :action="route('admin.user.destroy', $user)"
        title="Are you sure?"
        message="This action cannot be undone."
        :id="$user->id"
    />
</x-layout-admin>
