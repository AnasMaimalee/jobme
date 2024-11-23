@props(['job'])
<div class="p-4 bg-white/10 rounded-xl flex flex-col text-center border border-transparent hover:border-blue-800 group transition-colors duration-300">
    <div class="self-start text-sm font-bold">{{ $job->employer->name }}</div>
    <div class="py-8 ">
        <h3 class="group-hover:text-blue-600 font-bold transition-colors duration-300">{{ $job->title }}</h3>
        <p class="text-sm mt-4">{{$job->schedule}} - From {{ $job->salary }} </p>
    </div>

    <div class="flex justify-between items-center mt-auto">
        <div>
            @foreach($job->tags as $tag)
                <x-tag :$tag size="small">Manager</x-tag>
            @endforeach
        </div>

        <x-employer-logo :width="42" />
    </div>
</div>
