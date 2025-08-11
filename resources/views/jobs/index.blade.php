<x-layout>
    <x-slot:heading>
        Jobs Listing
    </x-slot:heading>

    <div class="space-y-4">
        @foreach ($jobs as $job)
            <a href="/jobs/{{ $job['id'] }}" class="block px-4 py-4 border border-gray-200 rounded">
                <div class="font-bold text-blue-800">
                    {{ $job->employer->name }}
                </div>
                <b>  {{ $job['title']}} </b> : Pays {{ $job['salary'] }} per year.
            </a>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $jobs->links() }}
    </div>

</x-layout>