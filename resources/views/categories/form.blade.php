<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control" required value="{{ old('name', $category->name ?? '') }}">
    <x-input-error :messages="$errors->get('name')" class="mt-2"  />
</div>
<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" required>{{ old('description', $category->description ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-2"  />
</div>
<div class="text-end">
        <button type="submit" class="btn btn-primary">Submit form <i class="ph-paper-plane-tilt ms-2"></i></button>
    </div>
