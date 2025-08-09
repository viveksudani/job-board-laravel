<x-layout>
    <x-slot:heading>
        Jobs Listing
    </x-slot:heading>

    <ul>
        @foreach ($jobs as $job)
        <li class="py-2">
            <a href="/job/{{ $job['id'] }}" class="block px-4 py-4 border border-gray-200 rounded">
                <div class="font-bold text-blue-800">
                    {{ $job->employer->name }}
                </div>
                <b>  {{ $job['title']}} </b> : Pays {{ $job['salary'] }} per year.
            </a>
        </li>
        @endforeach
    </ul>
</x-layout>