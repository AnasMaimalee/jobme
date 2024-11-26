<x-layout>
    <x-page-heading>Register</x-page-heading>
    <x-forms.form method="POST" action="/register" enctype="multipart/form-data">
        <x-forms.input label="Name" name="name" />
        <x-forms.input label="Email" name="email" type="email" />
        <x-forms.input label="Password" name="password" type="password" />
        <x-forms.input label="Password Confirmation" name="password_confirmation" type="password" />

        <x-forms.divider />

        <!-- Button to toggle Employer section -->
        <button type="button" onclick="toggleEmployer()" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Employer?</button>

        <!-- Employer section, hidden by default -->
        <div id="employer-section" style="display: none;">
            <x-forms.input label="Employer Name" name="employer" />
            <x-forms.input label="Employer Logo" name="logo" type="file" />
        </div>

        <x-forms.button>Create Button</x-forms.button>
    </x-forms.form>
</x-layout>

<script>
    function toggleEmployer() {
        var employerSection = document.getElementById('employer-section');
        if (employerSection.style.display === 'none') {
            employerSection.style.display = 'block';
        } else {
            employerSection.style.display = 'none';
        }
    }
</script>
