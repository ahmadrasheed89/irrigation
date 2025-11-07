<div class="mb-3">
    <label class="form-label">Full Name</label>
    <input type="text" name="name" class="form-control" required value="{{ old('name', $portfolio->name ?? '') }}">
</div>
<x-input-error :messages="$errors->get('name')" class="mt-2"  />
<div class="mb-3">
    <label class="form-label">Designation</label>
    <input type="text" name="designation" class="form-control" required value="{{ old('designation', $portfolio->designation ?? '') }}">
</div>
<x-input-error :messages="$errors->get('designation')" class="mt-2"  />
<div class="mb-3">
    <label class="form-label">Persona` No</label>
    <input type="text" name="personal_no" class="form-control" required value="{{ old('personal_no', $portfolio->personal_no ?? '') }}">
</div>
<x-input-error :messages="$errors->get('personal_no')" class="mt-2"  />
<div class="mb-3">
    <label class="form-label">CNIC</label>
    <input type="text" name="cnic" class="form-control" required value="{{ old('cnic', $portfolio->cnic ?? '') }}">
</div>
<x-input-error :messages="$errors->get('cnic')" class="mt-2"  />
<div class="mb-3">
    <label class="form-label">Duty Station</label>
    <input type="text" name="duty_station" class="form-control" required value="{{ old('duty_station', $portfolio->duty_station ?? '') }}">
</div>
<x-input-error :messages="$errors->get('duty_station')" class="mt-2"  />
<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $portfolio->description ?? '') }}</textarea>
</div>
<x-input-error :messages="$errors->get('description')" class="mt-2"  />
<div class="mb-3">
    <label class="form-label">Attach Files</label>
    <input type="file" name="file_path[]" class="form-control" multiple value="{{ old('file_path', $portfolio->file_path[0] ?? '') }}">
</div>
<x-input-error :messages="$errors->get('file_path')" class="mt-2"  />
<div class="text-end">
        <button type="submit" class="btn btn-primary">Submit form <i class="ph-paper-plane-tilt ms-2"></i></button>
    </div>
