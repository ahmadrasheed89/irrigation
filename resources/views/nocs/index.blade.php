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
        <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="form-control" placeholder="Search Nocs...">
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary">Search</button>
    </div>
    <div class="col-md-2 text-end">
        @can('create', App\Models\Noc::class)
            <a href="{{ route('nocs.create') }}" class="btn btn-success">Add Noc</a>
        @endcan</div>
</form>
<!-- Column groups -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Nocs</h5>
                <a href="{{ route('nocs.create') }}" class="btn btn-primary float-end" style="margin-top: -30px;">Add Noc</a>
            </div>


            {{-- <div class="card-body">
                When working with column
            </div> --}}

            <table class="table  datatable-basic">
        <thead>
            <tr>
                <th>Issue Number</th>
                <th>Department</th>
                <th>Noc Subject</th>
                <th>Nature Of NOC</th>
                <th>Issue Date</th>
                <th>NOC Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($nocs as $noc)
            <tr>
                <td>{{ $noc->issue_no ?? '-' }}</td>
                <td>{{ $noc->department ?? '-' }}</td>
                <td>{{ $noc->noc_subject ?? '-' }}</td>
                <td>{{ $noc->nature_of_noc ?? '-' }}</td>
                <td>{{ $noc->issued_date->format('Y-m-d')?? '-' }}</td>
                 <td>{{--<form method="POST" action="{{ route('nocs.updateStatus', $noc) }}">
                        @csrf

													<div class="form-check form-switch mb-2">
														<input type="radio" value="1" class="form-check-input form-check-input-warning" name="radio-switch-colors-{{ $noc->id }}" id="sr_r_secondary" {{ $noc->nocstatus == 1 ? 'checked' : ''}}>
														<label class="form-check-label" for="sr_r_secondary">Pending</label>
													</div>

													<div class="form-check form-switch mb-2">
														<input type="radio" value="3" class="form-check-input form-check-input-danger" name="radio-switch-colors-{{ $noc->id }}" id="sr_r_danger" {{ $noc->nocstatus == 3 ? 'checked' : ''}}>
														<label class="form-check-label" for="sr_r_danger">Rejected</label>
													</div>

													<div class="form-check form-switch mb-2">
														<input type="radio" value="2"  class="form-check-input form-check-input-success" name="radio-switch-colors-{{ $noc->id }}" id="sr_r_success" {{ $noc->nocstatus == 2 ? 'checked' : '' }}>
														<label class="form-check-label" for="sr_r_success">Approved</label>
													</div>
                                                    </form> --}}
                                                    @if ($noc->nocstatus == 2)
                        <span class=" rounded-pill">Approved</span>
                    @elseif ($noc->nocstatus == 3)
                        <span class="badge bg-danger rounded-pill">Rejected</span>
                    @else
                        <span class="badge bg-warning rounded-pill">Pending</span>
                    @endif
                </td>
                <td>
                    <form method="POST" action="{{ route('nocs.updateStatus', $noc) }}">
                        @csrf
                        <select name="nocstatus" onchange="this.form.submit()">
                            <option value="1" {{ $noc->nocstatus == 1 ? 'selected' : '' }} class="badge bg-warning text-dark">Pending</option>
                            <option value="2" {{ $noc->nocstatus == 2 ? 'selected' : '' }} class="badge bg-success">Approved</option>
                            <option value="3" {{ $noc->nocstatus == 3 ? 'selected' : '' }} class="badge bg-danger">Rejected</option>
                        </select>
                    </form>
                </td>
                <td>
                    <a href="{{ route('nocs.upload', $noc) }}" class="text-teal"><i class="ph-upload"></i></a>
                    <a href="{{ route('nocs.show', $noc) }}" class="text-teal"><i class="ph-eye"></i></a>
                    <a href="{{ route('nocs.edit', $noc) }}" class="text-primary"><i class="ph-pen"></i></a>
                    <form action="{{ route('nocs.destroy', $noc) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="text-danger mx-2" onclick="return confirm('Delete?')"><i class="ph-trash"></i></button>
                    </form>
                </td>
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
<div class="mt-3">{{ $nocs->links() }}</div>
</x-app-layout>
