<x-layout>
    <div class="space-y-10">
        <section class="text-white pt-10">
            <div class=" mt-6">
                <x-job-show :$job />
            </div>
        </section>
    </div>

    <div class="flex justify-end mt-3">
        <a href="/jobs/{{$job->id}}/edit">
            <x-forms.button>Update</x-forms.button>
        </a>
    </div>
</x-layout>
