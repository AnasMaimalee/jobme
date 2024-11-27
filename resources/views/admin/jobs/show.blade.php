<x-layout-admin>
    <div class="container mx-auto p-6">
        <!-- Job Information -->
        <div class="bg-white p-8 rounded-lg shadow-lg space-y-8">

            <!-- Job Title and Information -->
            <div class="flex flex-col lg:flex-row items-center lg:items-start space-y-6 lg:space-y-0 lg:space-x-8">
                <div class="flex-1">
                    <h2 class="text-4xl font-semibold text-gray-800">{{ $job->title }}</h2>
                    <div class="mt-4 space-y-2 text-lg text-gray-600">
                        <p><strong>Salary:</strong> ${{ $job->salary }}</p>
                        <p><strong>Location:</strong> {{ $job->location }}</p>
                        <p class="text-sm text-gray-500">Posted on: {{ $job->created_at->format('M d, Y') }}</p>
                    </div>
                </div>

                <div class="lg:w-1/4">
                    @if($job->employer && $job->employer->logo)
                        <img src="{{ URL::asset('storage/'.$job->employer->logo) }}" style="width: 100px" alt="Employer Logo" class="rounded-lg shadow-md w-full object-cover">
                    @else
                        <div class="bg-gray-100 rounded-lg p-6 flex justify-center items-center">
                            <p class="text-gray-500">No logo available</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Job URL -->
            <div class="text-lg text-gray-600">
                <h3 class="text-2xl font-semibold text-gray-800">Job URL</h3>
                <a href="{{ $job->url }}" class="mt-4 text-blue-500 hover:text-blue-700 text-lg" target="_blank">{{ $job->url }}</a>
            </div>

            <!-- Employer Information -->
            <div class="text-lg text-gray-600">
                <h3 class="text-2xl font-semibold text-gray-800">Employer Information</h3>
                @if($job->employer)
                    <p class="mt-4"><strong>Employer Name:</strong> {{ $job->employer->name }}</p>
                    <p class="mt-2"><strong>Total Jobs Posted:</strong> {{ $job->employer->jobs->count() }}</p>

                    <div class="mt-4">
                        <strong>Employer Logo:</strong>
                        @if($job->employer->logo)
                            <img src="{{ URL::asset('storage/'.$job->employer->logo) }}" alt="Employer Logo" class="mt-2 w-32 h-32 rounded-lg shadow-md">
                        @else
                            <p class="text-gray-500">No employer logo available</p>
                        @endif
                    </div>
                @else
                    <p class="mt-4 text-gray-600">This job has no associated employer.</p>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-6 mt-8">
                <a href="{{ route('admin.job.edit', $job) }}" class="bg-yellow-500 text-white py-3 px-6 rounded-lg shadow-lg hover:bg-yellow-600 transition ease-in-out duration-300">
                    Edit Job
                </a>

                <button type="button" onclick="openModal('{{ route('admin.job.destroy', $job) }}')" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600">Delete</button>

            </div>
        </div>
    </div>
    <!-- Use the Delete Confirmation Component -->
    <!-- Use the Delete Confirmation Component -->
    <x-delete-confirmation
        :action="route('admin.user.destroy', $job)"
        title="Are you sure?"
        message="This action cannot be undone."
        :id="$job->id"
    />
</x-layout-admin>
