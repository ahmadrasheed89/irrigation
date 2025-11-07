<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            ADP Details —{{ __($adp->adp_code) }}
        </h2>
    </x-slot> --}}
<!-- Content area -->
    <div class="content">
        <!-- Column groups -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">ADPs ({{ __($adp->adp_code) }}) Summary Report</h5>
                <a href="{{ url()->previous() }}" class="btn btn-secondary float-end" style="margin-top: -30px;">← Back to Dashboard</a>
            </div>

                <div class="card-body">
                    <p><strong>Allocation:</strong> {{ number_format($adp->allocation, 2) }}</p>
                    <p><strong>Total Expenditure (from Schemes):</strong> {{ number_format($totals['expenditure'], 2) }}</p>
                </div>

    <table class="table table-striped ">
        <thead class="table-light fw-bold">
            <tr>
                <td colspan="3" class="text-end">Total / Average:</td>
                <td>{{ number_format($totals['sub_work_t_s_cost'], 2) }}</td>
                <td>{{ number_format($totals['expenditure'], 2) }}</td>
                <td>{{ number_format($totals['liability'], 2) }}</td>
                <td>{{ number_format($totals['physical_progress'], 2) }}%</td>
                <td>{{ number_format($totals['financial_progress'], 2) }}%</td>
            </tr>
        </thead>
        <thead >
            <tr>
                <th>#</th>
                <th>Scheme Name</th>
                <td>Bid Cost</td>
                <th>T.S Cost</th>
                <th>Expenditure</th>
                <th>Liability</th>
                <th>Physical Progress (%)</th>
                <th>Financial Progress (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adp->schemes as $index => $scheme)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $scheme->name }}</td>
                    <td>{{ number_format($scheme->bid_cost, 2)}}</td>
                    <td>{{ number_format($scheme->sub_work_t_s_cost, 2) }}</td>
                    <td>{{ number_format($scheme->expenditure, 2) }}</td>
                    <td>{{ number_format($scheme->liability, 2) }}</td>
                    <td>
                        <div  class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar-striped  bg-warning" role="progressbar"
                                style="width: {{ $scheme->physical_progress }}%">
                                {{ $scheme->physical_progress }}%
                            </div>
                        </div>
                    </td>
                    <td>
                        <div  class="progress" role="progressbar" aria-label="Info example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar-striped  bg-info" role="progressbar"
                                style="width: {{ $scheme->financial_progress }}%">
                                {{ $scheme->financial_progress }}%
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="table-light fw-bold">
            <tr>
                <td colspan="3" class="text-end">Total / Average:</td>
                <td>{{ number_format($totals['sub_work_t_s_cost'], 2) }}</td>
                <td>{{ number_format($totals['expenditure'], 2) }}</td>
                <td>{{ number_format($totals['liability'], 2) }}</td>
                <td>{{ number_format($totals['physical_progress'], 2) }}%</td>
                <td>{{ number_format($totals['financial_progress'], 2) }}%</td>
            </tr>
        </tfoot>
    </table>
</div>
</div>
</x-app-layout>
