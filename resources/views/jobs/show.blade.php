<x-layout>
    <div class="space-y-10">
        <section class="text-white pt-10">
            <div class=" mt-6">
                <x-job-show :$job />
            </div>
        </section>
    </div>
    @can('edit', $job)

    <div class="flex space-x-4 justify-end mt-3">
        <!-- Delete Button -->
        <form action="/jobs/{{ $job->id }}" method="POST" class="">
            @csrf
            @method('DELETE') <!-- This is important to indicate that the request is DELETE -->
            <x-forms.button-danger>Delete</x-forms.button-danger>
        </form>
        <a href="/jobs/{{$job->id}}/edit">
            <x-forms.button>Update</x-forms.button>
        </a>
        @endcan
    </div>
</x-layout>
