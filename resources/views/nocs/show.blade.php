<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($tenders[0]->scheme->scheme_name ) }} Details
        </h2>
    </x-slot> --}}
<div class="content">
        <!-- Column groups -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Schemes</h5>
                <a href="{{ route('tenders.index') }}" class="btn btn-primary float-end" style="margin-top: -30px;">Back</a>
            </div>


            {{-- <div class="card-body">
                When working with column
            </div> --}}

            <table class="table  datatable-basic">
        <thead>
            <tr>
                <th>Category</th>
                <th>Description</th>
                <th>Date</th>
                <th>Attached Files:</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tenders as $tender)
            <tr>
                <td>{{ $tender->category->name }}</td>
                <td>{{ $tender->category->description }}</td>
                <td>{{ $tender->date->format('Y-m-d') }}</td>
                {{-- <td>
                    <span class="badge {{ $tender->category->status->labelAndBadge()['badge'] }}">
                        {{ $tender->category->status->labelAndBadge()['label'] }}
                    </span></td>
                    // Example: Update the status from a form input
                        $validated = $request->validate(['status' => 'required']);

                        $order->status = OrderStatus::from($validated['status']);
                        $order->save();
                    --}}
                <td>
                    <ul>
                        @foreach($tender->attached_files ?? [] as $file)
                            <li><a href="{{ asset('storage/'.$file) }}" target="_blank">{{ basename($file) }}</a></li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <form action="{{ route('tenders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="attached_files[]" class="form-control form-control-sm" style="width:22%" multiple>
                    </form>
                    <form action="{{ route('schemes.destroy', $tender) }}" method="POST" class="d-inline">
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
</x-app-layout>
