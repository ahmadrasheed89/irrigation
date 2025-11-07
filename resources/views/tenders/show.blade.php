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
                <h5 class="mb-0">Scheme: {{ $schemeName }}</h5>
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
                <th>Status</th>
                <th>Date</th>
                <th>Attached Files:</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($allCategories as $category)
                @php
                    // Check if there's a tender for this category under this scheme
                                    $tender = $tenders->firstWhere('category_id', $category->id);
                @endphp

                <div class="mb-2">
                    <strong>{{ $category->name }}</strong> —

                    @if ($tender)
                        <a href="{{ route('schemes.show', $tender->id) }}" class="btn btn-success btn-sm">
                            View
                        </a>
                    @else
                        <a href="{{ route('schemes.edit', [$schemeId, $category->id]) }}" class="btn btn-primary btn-sm">
                            Upload File
                        </a>
                    @endif
                </div>
            @endforeach --}}
            @forelse ($allCategories as $category)
                @php
                    // Check if there's a tender for this category under this scheme
                    $tender = $tenders->firstWhere('category_id', $category->id);
                @endphp
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    {!! $tender
                        ? "<span class='badge bg-success'>Uploaded</span>"
                        : "<span class='badge bg-danger'>Pending</span>"
                    !!}
                </td>
                <td>{{ $tender ? $tender->date->format('Y-m-d') : '-' }}</td>
                {{-- <td>
                    <span class="badge {{ $tender->category->status->labelAndBadge()['badge'] }}">
                        {{ $tender->category->status->labelAndBadge()['label'] }}
                    </span></td>
                    // Example: Update the status from a form input
                        $validated = $request->validate(['status' => 'required']);

                        $order->status = OrderStatus::from($validated['status']);
                        $order->save();
                    --}}
                @if ($tender)
                    <td>
                        <ul>
                            @foreach($tender->attached_files ?? [] as $file)
                                <a href="{{ asset('storage/'.$file) }}" target="_blank" class="btn btn-success">view</a>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                         <form action="{{ route('tenders.destroy', $tender) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="text-danger mx-2" onclick="return confirm('Delete?')"><i class="ph-trash"></i></button>
                        </form>
                    </td>
                @else
                    <td>
                        <button class="btn btn-sm btn-primary uploadBtn"
                            data-category-id="{{ $category->id }}"
                            data-scheme-id="{{ $schemeId}}">
                            <i class="bi bi-upload"></i> Upload
                        </button>

                        {{-- <form action="{{ route('tenders.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="attached_files[]" class="form-control form-control-sm" style="width:22%" multiple>
                        </form> --}}
                    </td>
                @endif
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

<!-- Bootstrap Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form {{--id="uploadForm" --}} action="{{ route('tenders.store') }}" method="POST" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            @csrf
            <input type="hidden" name="category_id" id="category_id">
            <input type="hidden" name="scheme_id" id="scheme_id">
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control"></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2"  />
            </div>
            <div class="mb-3">
                <label class="form-label">Created Date</label>
                <input type="date" name="date" class="form-control" required>
                <x-input-error :messages="$errors->get('date')" class="mt-2"  />
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Choose File</label>
                <input type="file" name="attached_files[]" id="file" class="form-control"  multiple required>
            </div>
            <div id="uploadAlert"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function() {
    let uploadModal = new bootstrap.Modal(document.getElementById('uploadModal'));

    // open modal and set IDs
    $('.uploadBtn').click(function() {
        let categoryId = $(this).data('category-id');
        let schemeId = $(this).data('scheme-id');
        $('#category_id').val(categoryId);
        $('#scheme_id').val(schemeId);
        $('#uploadAlert').html('');
        $('#file').val('');
        uploadModal.show();
    });

    // handle upload via AJAX
    $('#uploadForm').submit(function(e) {
        e.preventDefault();
        let orderId = $('#order_id').val();
        let formData = new FormData(this);

        $.ajax({
            url: `/orders/${orderId}/upload`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#uploadAlert').html('<div class="text-info">Uploading...</div>');
            },
            success: function(res) {
                if (res.success) {
                    $('#uploadAlert').html('<div class="alert alert-success">'+res.message+'</div>');
                    uploadModal.hide();

                    // Update UI instantly
                    $(`#order-${orderId} td:nth-child(3)`).html(
                        `<a href="${res.file_path}" target="_blank">View File</a>`
                    );
                }
            },
            error: function(xhr) {
                $('#uploadAlert').html('<div class="alert alert-danger">Upload failed. Try again.</div>');
            }
        });
    });
});
</script>

</x-app-layout>

