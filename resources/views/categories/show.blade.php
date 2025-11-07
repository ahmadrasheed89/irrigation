<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $category->name }} Detail
        </h2>
    </x-slot> --}}
<div class="content">
<ul class="list-group">
    <li class="list-group-item"><strong>Name:</strong> {{ $category->name }}</li>
    <li class="list-group-item"><strong>Description:</strong> {{ $category->description }}</li>
</ul>

<a href="{{ route('categories.index') }}" class="btn btn-large btn-secondary mt-3">Back</a>
</div>
</x-app-layout>
