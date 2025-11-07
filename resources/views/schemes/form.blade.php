 <div class="mb-3">
        <label class="form-label">ADPs</label>
        <select name="adp_id" class="form-control">
            <option value="">Select ADP</option>
            @foreach($adps as $adp)
                <option value="{{ $adp->id }}" {{  (isset($scheme)) && $scheme->adp_id == $adp->id ? 'selected' : '' }}>{{ $adp->adp_code }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('adp_id')" class="mt-2"  />
    </div>
    <div class="mb-3">
        <label class="form-label">Scheme Name</label>
        <input type="text" name="name" class="form-control" required value="{{ old('name', $scheme->name ?? '') }}" >
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div class="mb-3">
        <label class="form-label">Expenditure</label>
        <input type="number" step="0.01" name="expenditure" class="form-control" required value="{{ old('expenditure', $scheme->expenditure ?? '') }}">
        <x-input-error :messages="$errors->get('expenditure')" class="mt-2" />
    </div>
    <div class="mb-3">
        <label class="form-label">ADP Code</label>
        <input type="text" name="adp_code" class="form-control" required value="{{ old('adp_code', $scheme->adp_code ?? '') }}">
        <x-input-error :messages="$errors->get('adp_code')" class="mt-2" />
    </div>
    <div class="mb-3">
        <label class="form-label">Contractor</label>
        <select name="contractor_id" class="form-control">
            <option value="">Select Contractor</option>
            @foreach($contractors as $contractor)
                <option value="{{ $contractor->id }}" {{ (isset($scheme)) && $scheme->contractor_id == $contractor->id ? 'selected' : '' }}>{{ $contractor->constractor_name }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('contractor_id')" class="mt-2" />
    </div>
    <div class="mb-3">
        <label class="form-label">Contractor Premium</label>
        <input type="number" step="0.01" name="contractor_premium" class="form-control" value="{{ old('contractor_premium', $scheme->contractor_premium ?? '') }}">
        <x-input-error :messages="$errors->get('contractor_premium')" class="mt-2" />
    </div>
    <div class="mb-3">
        <label class="form-label">Bid Cost</label>
        <input type="number" step="0.01" name="bid_cost" class="form-control" value="{{ old('bid_cost', $scheme->bid_cost ?? '') }}">
        <x-input-error :messages="$errors->get('bid_cost')" class="mt-2" />
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary">Submit form <i class="ph-paper-plane-tilt ms-2"></i></button>
    </div>

