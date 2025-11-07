<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($adp->adp_code ) }} Details
        </h2>
    </x-slot> --}}
<div class="content">
    <h3>ADP Details</h3>
    <table class="table table-striped">
        <tr><th>ADP Code</th><td>{{ $adp->adp_code }}</td></tr>
        <tr><th>Allocation</th><td>{{ $adp->allocation }}</td></tr>
        <tr><th>ADP T/S Cost</th><td>{{ $adp->adp_t_s_cost }}</td></tr>
        <tr><th>Total Expenditure</th><td>{{ $adp->total_expenditure }}</td></tr>
        <tr><th>Accrued Liability</th><td>{{ $adp->accured_liability }}</td></tr>
        <tr><th>Created By</th><td>{{ $adp->user->name }}</td></tr>
        <tr><th>File</th>
            <td>
                @if($adp->attached_files)
                    <a href="{{ Storage::url($adp->attached_files) }}" target="_blank">Download</a>
                @else
                    N/A
                @endif
            </td>
        </tr>
    </table>
    <a href="{{ route('adps.index') }}" class="btn btn-secondary">Back</a>
</div>
</x-app-layout>
