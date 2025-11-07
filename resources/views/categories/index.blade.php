<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot> --}}
    <div class="content">
{{-- <form method="GET" class="row g-2 mb-3"><div class="col-md-6"><input name="q" class="form-control" value="{{ $filters['q'] ?? '' }}" placeholder="Search categories..."></div><div class="col-md-2"><button class="btn btn-primary">Search</button></div></form> --}}
<!-- Column groups -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Schemes</h5>
                <a href="{{ route('categories.create') }}" class="btn btn-primary float-end" style="margin-top: -30px;">Add Category</a>
            </div>


            {{-- <div class="card-body">
                When working with column
            </div> --}}

            <table class="table  datatable-basic">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
            @foreach($categories as $c)
            <tr>
                <td>{{ $c->name }}</td>
                <td>{{ Str::limit($c->description,60) }}</td>
                <td>
                    <a href="{{ route('categories.show', $c) }}" class="text-teal"><i class="ph-eye"></i></a>
                    <a href="{{ route('categories.edit', $c) }}" class="text-primary"><i class="ph-pen"></i></a>
                    <form action="{{ route('categories.destroy', $c) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="text-danger mx-2"  onclick="return confirm('Delete?')"><i class="ph-trash"></i></button>
                    </form>
                </td>

            </tr>
            @endforeach
            </tbody>
            </table>
        </div>
        <!-- /column groups -->
    </div> <!-- Content area -->
<div class="mt-3">{{ $categories->links() }}</div>
</x-app-layout>
