<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Schemes') }}
        </h2>
    </x-slot> --}}

<div class="content">
    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-6"><input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="form-control" placeholder="Search..."></div>
        <div class="col-md-2"><button class="btn btn-primary">Search</button></div>
        <div class="col-md-4 text-end">@can('create', App\Models\Scheme::class)<a href="{{ route('schemes.create') }}" class="btn btn-success">Add Scheme</a>@endcan</div>
    </form>
        <!-- Column groups -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Schemes</h5>
                <a href="{{ route('schemes.create') }}" class="btn btn-primary float-end" style="margin-top: -30px;">Add Scheme</a>
            </div>


            {{-- <div class="card-body">
                When working with column
            </div> --}}

            <table class="table  datatable-basic">
        <thead>
            <tr>
                <th>Name</th>
                <th>ADP</th>
                <th>Cost</th>
                <th>Contractor</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schemes as $s)
            <tr>
                <td>{{ $s->name }}</td>
                <td>{{ $s->adp_code }}</td>
                <td>{{ number_format($s->sub_work_t_s_cost,2) }}</td>
                <td>{{ $s->contractor->constractor_name ?? '-' }}</td>
                <td>
                    <a href="{{ route('schemes.show', $s) }}" class="text-teal"><i class="ph-eye"></i></a>
                    <a href="{{ route('schemes.edit', $s) }}" class="text-primary"><i class="ph-pen"></i></a>
                    <form action="{{ route('schemes.destroy', $s) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="text-danger mx-2" onclick="return confirm('Delete?')"><i class="ph-trash"></i></button>
                    </form>
                </td>
                <td></td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No records</td>
            </tr>
            @endforelse
        </tbody>
    </table>
        </div>
        <!-- /column groups -->
    </div> <!-- Content area -->
<div class="mt-3">{{ $schemes->links() }}</div>

</x-app-layout>
