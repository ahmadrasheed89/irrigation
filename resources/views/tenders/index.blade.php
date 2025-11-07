<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tenders') }}
        </h2>
    </x-slot>
    <br> --}}
    <div class="content">
<form method="GET" class="row g-2 mb-3">
    <div class="col-md-4">
        <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="form-control" placeholder="Search tenders...">
    </div>
    <div class="col-md-2">
        <select name="scheme_id" class="form-control">
            <option value="">All schemes</option>
            @foreach($schemes as $id=>$name)
            <option value="{{ $id }}" {{ (isset($filters['scheme_id']) && $filters['scheme_id']==$id)?'selected':''}}>
                {{ $name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <select name="category_id" class="form-control">
            <option value="">All categories</option>
            @foreach($categories as $id=>$name)
            <option value="{{ $id }}" {{ (isset($filters['category_id']) && $filters['category_id']==$id)?'selected':''}}>
                {{ $name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary">Search</button>
    </div>
    <div class="col-md-2 text-end">
        @can('create', App\Models\Tender::class)
            <a href="{{ route('tenders.create') }}" class="btn btn-success">Add Tender</a>
        @endcan</div>
</form>
<!-- Column groups -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Tenders</h5>
                {{-- <a href="{{ route('tenders.create') }}" class="btn btn-primary float-end" style="margin-top: -30px;">Add Tender</a> --}}
            </div>


            {{-- <div class="card-body">
                When working with column
            </div> --}}

            <table class="table  datatable-basic">
        <thead>
            <tr>
                <th>Scheme</th>
                <th>Cost</th>
                <th>Date</th>
                <th>Upload A Files</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($schemesList as $scheme)
            <tr>
                <td>{{ $scheme->name ?? '-' }}</td>
                <td>{{ $scheme->sub_work_t_s_cost ?? '-' }}</td>
                <td>{{ $scheme->created_at->format('Y-m-d') }}</td>
               <!-- <td><a href="{{ route('tenders.show',$scheme) }}" class="btn btn-sm btn-outline-secondary">View</a></td>!-->
                <td>
                    <a href="{{ route('tenders.show', $scheme) }}" class="text-teal"><i class="ph-upload"></i></a>
                </td>
                {{-- <td></td> --}}
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
<div class="mt-3">{{ $schemesList->links() }}</div>
</x-app-layout>
