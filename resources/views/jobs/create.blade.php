<x-layout>
    <x-page-heading>Post A Job</x-page-heading>
    <x-forms.form method="POST" action="/jobs" enctype="multipart/form-data">
        <x-forms.input  label="Title" name="title" />
        <x-forms.input  label="Salary" name="salary" placeholder="$90,200 USD" />
        <x-forms.input  label="Location" name="location" placeholder="Zoo Road Kano" />

        <x-forms.select label="Schedule" name="schedule">
            <option value="Part Time">Part Time</option>
            <option value="Full Time">Full Time</option>
        </x-forms.select>

        <x-forms.input  label="URL" name="url" />
        <x-forms.checkbox label="Feature (Cost Extra $)" name="featured" placeholder="Feature (Cost Extra $)"/>

        <x-forms.divider />
        <x-forms.input  label="Tags (comma separated)" name="tags" placeholder="Laracast, Video, Education" />

        <x-forms.button>Publish</x-forms.button>

    </x-forms.form>
</x-layout>
