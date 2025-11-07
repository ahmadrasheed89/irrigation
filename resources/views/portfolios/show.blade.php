<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($tender->scheme->scheme_name ) }} Details
        </h2>
    </x-slot>
<ul class="list-group">
    <li class="list-group-item"><strong>Scheme:</strong> {{ $tender->scheme->scheme_name }}</li>
    <li class="list-group-item"><strong>Category:</strong> {{ $tender->category->name }}</li>
    <li class="list-group-item"><strong>Description:</strong> {{ $tender->description }}</li>
    <li class="list-group-item"><strong>Date:</strong> {{ $tender->date->format('Y-m-d') }}</li>
    <li class="list-group-item">
        <strong>Attached Files:</strong>
        <ul>
        @foreach($tender->attached_files ?? [] as $file)
            <li><a href="{{ asset('storage/'.$file) }}" target="_blank">{{ basename($file) }}</a></li>
        @endforeach
        </ul>
    </li>
</ul>

<a href="{{ route('tenders.index') }}" class="btn btn-secondary mt-3">Back</a>
</x-app-layout>
