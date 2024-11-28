<x-layout-admin>
    <div class="container-md  mx-auto p-6">
        <!-- Page Title -->
        <div class="mb-6">
            <h2 class="text-3xl font-semibold text-gray-800">Register User</h2>
        </div>

        <!-- Registration Form -->
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf

                <!-- Name Input -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Enter your name"
                        value="{{ old('name') }}"
                        required
                    >
                    @error('name')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Enter your email"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Enter your password"
                        required
                    >
                    @error('password')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Confirmation Input -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Confirm your password"
                        required
                    >
                    @error('password_confirmation')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="border border-b border-gray-100 my-4">

                </div>

                <!-- Employer Name Input -->
                <div class="mb-4">
                    <label for="employer" class="block text-sm font-medium text-gray-700">Employer Name</label>
                    <input
                        type="text"
                        name="employer"
                        id="employer"
                        class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Enter your employer name"
                        value="{{ old('employer') }}"
                        required
                    >
                    @error('employer')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Employer Logo Input -->
                <div class="mb-6">
                    <label for="logo" class="block text-sm font-medium text-gray-700">Employer Logo</label>
                    <input
                        type="file"
                        name="logo"
                        id="logo"
                        class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >
                    @error('logo')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-md text-lg hover:bg-indigo-700 transition duration-200">
                    Register
                </button>
            </form>
        </div>
    </div>
</x-layout-admin>
