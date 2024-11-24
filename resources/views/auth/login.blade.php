<x-layout>
    <x-page-heading>Register</x-page-heading>
    <x-forms.form method="POST" action="/login" enctype="multipart/form-data">
        <x-forms.input  label="Email" name="email" type="email" />
        <x-forms.input  label="Password" name="password" type="password" />


        <x-forms.divider />

        <x-forms.button>Login</x-forms.button>

    </x-forms.form>
</x-layout>
