@props(['job'])
<x-panel>
        <div>
            <img src="{{ URL::asset('storage/'.$job->employer->logo) }}" class="rounded-xl" style="width:60px" alt="Employer Logo">

        </div>
        <div class="flex-1 flex flex-col">
            <a class="self-start text-sm text-gray-500   font-bold" href="{{ $job->url }}">Direct Apply at: <span class="text-blue-500">{{ $job->employer->name }}</span></a>

            <h3 class="text-xl mt-3 group-hover:text-blue-600 font-bold">{{ $job->title }}</h3>
            <p class="text-sm text-gray-400 mt-auto">{{ $job->schedule }} - From {{ $job->salary }} </p>
        </div>
        <div>
            @foreach($job->tags as $tag)
                <x-tag :$tag >Manager</x-tag>
            @endforeach
        </div>

</x-panel>

