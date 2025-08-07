<x-layout>
    <x-slot:heading>
        Jobs Listing
    </x-slot:heading>

    <ul>
        @foreach ($jobs as $job)
        <li>
            <a href="/job/{{ $job['id'] }}" class="text-blue-900 hover:underline">
                <b>  {{ $job['title']}} </b> : Pays {{ $job['salary'] }} per year.
            </a>
        </li>
        @endforeach
    </ul>
</x-layout>