<div class="mb-3">
    <label class="form-label">Scheme</label>
    <select name="scheme_id" class="form-control" required>
        @foreach($schemes as $scheme)
            <option value="{{ $scheme->id }}" {{  (isset($tender)) && $scheme->id == $tender->scheme_id ? 'selected' : '' }}>{{ $scheme->name }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('scheme_id')" class="mt-2"  />
</div>
<div class="mb-3">
    <label class="form-label">Category</label>
    <select name="category_id" class="form-control" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{  (isset($tender)) && $category->id == $tender->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('category_id')" class="mt-2"  />
</div>
<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" required> {{ old('description', $tender->description ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-2"  />
</div>
<div class="mb-3">
    <label class="form-label">Created Date</label>
    <input type="date" name="date" class="form-control" required value="{{ old('date', (isset($tender)) ? $tender->date->format('Y-m-d') : '') }}">
    <x-input-error :messages="$errors->get('date')" class="mt-2"  />
</div>
<div class="mb-3">
    <label class="form-label">Attach Files</label>
    <input type="file" name="attached_files[]" class="form-control" multiple required value="{{ old('attached_files', $tender->attached_files[0] ?? '') }}">
    <x-input-error :messages="$errors->get('attached_files')" class="mt-2"  />
</div>
<div class="text-end">
        <button type="submit" class="btn btn-primary">Submit form <i class="ph-paper-plane-tilt ms-2"></i></button>
    </div>

    <script>
          $(document).ready(function(){
        $('#myDatepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true
        });

        // Set an initial date
        $('#myDatepicker').datepicker('update', '01/01/2025');
    });
    </script>
