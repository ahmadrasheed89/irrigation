<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tenders') }}
        </h2>
    </x-slot> --}}

    <!-- Content area -->
    <div class="content">
        <!-- Column groups -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">ADPs</h5>
                <a href="{{ route('adps.create') }}" class="btn btn-primary float-end" style="margin-top: -30px;">Add ADP</a>
            </div>


            {{-- <div class="card-body">
                When working with column
            </div> --}}

            <table class="table  datatable-basic">
                <thead>
                    <tr>
                        <th style="width: 10%">ADP Code</th>
                        <th style="width: 15%">Allocation</th>
                        <th style="width: 15%">T.S</th>
                        <th style="width: 15%">T/Expenditure</th>
                        <th style="width: 15%">A/Liability</th>
                        <th style="width: 20%">Created Date</th>
                        <th style="width: 10%" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                   @forelse($adps as $adp)
                <tr>
                    <td><a href="{{ route('adps.schemedetail', $adp) }}" class="btn btn-secondary btn-sm">{{ $adp->adp_code ?? '-' }}</a></td>
                    <td>{{ $adp->allocation ?? '-' }}</td>
                    <td>{{ $adp->adp_t_s_cost ?? '-' }}</td>
                    <td>{{ $adp->total_expenditure ?? '-' }}</td>
                    <td>{{ $adp->accured_liability ?? '-' }}</td>
                    <td>{{ $adp->created_at->format('Y-m-d') ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('adps.show', $adp) }}" class="text-teal"><i class="ph-eye"></i></a>
                        <a href="{{ route('adps.edit', $adp) }}" class="text-primary"><i class="ph-pen"></i></a>
                        <form action="{{ route('adps.destroy', $adp) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-danger mx-2"><i class="ph-trash"></i></button>
                        </form>
                    </td>

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
<div class="mt-3">{{ $adps->links() }}</div>

</x-app-layout>
