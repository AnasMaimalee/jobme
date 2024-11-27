<x-layout-admin>
    <div class="w-full bg-gray-100 text-gray-800 p-8">
        <!-- Admin Dashboard Header -->
        <div class="text-3xl font-semibold mb-6 text-center">Admin Dashboard</div>

        <!-- Statistics Cards Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Users Card -->
            <a href="{{ route('admin.users') }}">
                <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="bg-blue-500 text-white p-4 rounded-full mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17c0 1.104-.896 2-2 2H7a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h6c1.104 0 2 .896 2 2v10z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium">Total Users</h3>
                            <p class="text-2xl font-bold">{{ $totalUsers }}</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Employees Card -->
            <a href="{{ route('admin.users') }}">
                <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="bg-green-500 text-white p-4 rounded-full mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 14h2a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2zM8 14H6a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2zM12 3a7 7 0 1 0 0 14 7 7 0 0 0 0-14z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium">Total Employees</h3>
                            <p class="text-2xl font-bold">{{$totalEmployers}}</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Jobs Posted Card -->
            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div class="flex items-center">
                    <div class="bg-yellow-500 text-white p-4 rounded-full mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 11h18M3 15h18M3 19h18"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium">Total Jobs Posted</h3>
                        <p class="text-2xl font-bold">{{ $totalJobPosted }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Content Section (optional) -->
        <div class="mt-8">
            <div class="text-2xl font-semibold mb-4">Recent Activities</div>
            <!-- Example of recent activity (like recently added users or jobs) -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <p class="text-lg">Example of recent activity or more detailed reports can go here.</p>
            </div>
        </div>
    </div>
</x-layout-admin>
