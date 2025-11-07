<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Portfolios') }}
        </h2>
    </x-slot> --}}
 <div class="content">
    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="form-control" placeholder="Search Portfolios...">
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary">Search</button>
        </div>
        <div class="col-md-2 text-end">
            @can('create', App\Models\Portfolio::class)
                <a href="{{ route('portfolios.create') }}" class="btn btn-success">Add Portfolio</a>
            @endcan</div>
    </form>
        <!-- Column groups -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Portfolios</h5>
                <a href="{{ route('portfolios.create') }}" class="btn btn-primary float-end" style="margin-top: -30px;">Add Portfolio</a>
            </div>


            {{-- <div class="card-body">
                When working with column
            </div> --}}

            <table class="table  datatable-basic">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($portfolios as $portfolio)
            <tr>
                <td>{{ $portfolio->id ?? '-' }}</td>
                <td>{{ $portfolio->name ?? '-' }}</td>
                <td>{{ Str::limit($portfolio->description,60) }}</td>
               <td>
                @if($portfolio->file_path)
                    <a href="{{ asset('storage/'.$portfolio->file_path[0]) }}" target="_blank">View File</a>
                @else
                    —
                @endif
            </td>
            <td>
                <a href="{{ route('portfolios.show', $portfolio) }}" class="text-teal"><i class="ph-eye"></i></a>
                <a href="{{ route('portfolios.edit', $portfolio) }}" class="text-primary"><i class="ph-pen"></i></a>
                <form action="{{ route('portfolios.destroy', $portfolio) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="text-danger mx-2"onclick="return confirm('Delete?')"><i class="ph-trash"></i></button>
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
<div class="mt-3">{{ $portfolios->links() }}</div>
</x-app-layout>
