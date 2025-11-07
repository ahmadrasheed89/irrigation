<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $scheme->name }} Detail
        </h2>
    </x-slot>
    <br> --}}
<div class="content">
<ul class="list-group">
    <li class="list-group-item"><strong>Cost:</strong> {{ $scheme->sub_work_t_s_cost }}</li>
    <li class="list-group-item"><strong>ADP Code:</strong> {{ $scheme->adp_code }}</li>
    <li class="list-group-item"><strong>Contractor:</strong> {{ $scheme->contractor->constractor_name ?? '—' }}</li>
    <li class="list-group-item"><strong>Contractor Premium:</strong> {{ $scheme->contractor_premium }}</li>
    <li class="list-group-item"><strong>Expenditure:</strong> {{ $scheme->expenditure }}</li>
    <li class="list-group-item"><strong>Liability:</strong> {{ $scheme->liability }}</li>
    <li class="list-group-item"><strong>Physical Progress:</strong> {{ $scheme->physical_progress }}</li>
    <li class="list-group-item"><strong>Financial Progress:</strong> {{ $scheme->financial_progress }}</li>
    <li class="list-group-item"><strong>Bid Cost:</strong> {{ $scheme->bid_cost }}</li>
</ul>

<a href="{{ route('schemes.index') }}" class="btn btn-large btn-secondary mt-3">Back</a>
</div>
</x-app-layout>
