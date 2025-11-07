<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ADP Dashboard') }}
        </h2>
    </x-slot> --}}
<div class="content">
        <!-- Column groups -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">All ADPs</h5>
                <a href="{{ route('adps.create') }}" class="btn btn-primary float-end" style="margin-top: -30px;">Add ADP</a>
            </div>


            {{-- <div class="card-body">
                When working with column
            </div> --}}

            <table class="table datatable-basic">
        <thead >
            <tr>
                <th>ADP Code</th>
                <th>Allocation</th>
                <th>Bid Cost</th>
                <th>ADP T.S Cost (from Schemes)</th>
                <th>Total Expenditure (from Schemes)</th>
                <th>Accured Liability (from Schemes)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($adps as $adp)
            <tr>
                <td><a href="{{ route('adps.schemedetail', $adp) }}" class="btn btn-secondary btn-sm">{{ $adp->adp_code ?? '-' }}</a></td>
                <td>{{ number_format($adp->allocation, 2) ?? '-' }}</td>
                <td>{{ number_format($adp->adp_t_s_cost, 2) ?? '-' }}</td>
                <td>{{ number_format($adp->schemes_sum_sub_work_t_s_cost, 2) ?? '-'}}</td>
                <td>{{ number_format($adp->schemes_sum_expenditure ?? 0, 2) ?? '-'}}</td>
                <td>{{ number_format($adp->schemes_sum_liability ?? 0, 2) ?? '-'}}</td>
                <td></td>
            </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No ADPs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
    <!-- /column groups -->
</div> <!-- Content area -->
{{-- <div class="mt-3">{{ $adps->links() }}</div> --}}
</x-app-layout>
