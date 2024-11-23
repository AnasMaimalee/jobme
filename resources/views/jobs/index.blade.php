<x-layout>
    <div class="space-y-10">
        <section class="text-center pt-10">
            <h1 class="font-bold  text-4xl"> Let's Find Your Next Job</h1>
            <form action="">
                <input type="text" placeholder="Web Developer..." class="rounded-xl bg-white/15 border-white/20 px-5 py-4 w-full mt-6 focus:border-white max-w-lg pl-10">
                <span class="absolute text-white mt-10" style="margin-left: -20px">
                        <x-section-heading>

                        </x-section-heading>
                    </span>
            </form>
        </section>
        <section class="text-white pt-10">
            <x-section-heading > Featured Jobs</x-section-heading>
            <div class="grid lg:grid-cols-3 gap-5 mt-6">
                @foreach($featuredJobs as $job)
                    <x-job-card :$job />
                @endforeach
            </div>
        </section>

        <section>
            <x-section-heading>Tags</x-section-heading>
            <div class="mt-6 space-x-1">
                @foreach($tags as $tag)
                    <x-tag :$tag />
                @endforeach
            </div>
        </section>

        <section>
            <x-section-heading>Recent Jobs</x-section-heading>
            <div class="mt-6 space-y-6">

                @foreach($jobs as $job)
                    <x-job-card-wide :$job />
                @endforeach
            </div>
        </section>


    </div>
</x-layout>
