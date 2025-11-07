
<!-- Content area -->

								<div class="mb-3">
									<label class="form-label">Enter ADP Code:</label>
                                    <input type="text" class="form-control" placeholder="Enter ADP Code" name="adp_code"  value="{{ old('adp_code', $adp->adp_code ?? '') }}" required>
                                    <x-input-error :messages="$errors->get('adp_code')" class="mt-2" />
								</div>

								<div class="mb-3">
									<label class="form-label">Enter Allocation:</label>
                                    <input type="number" step="0.01" name="allocation" class="form-control" value="{{ old('allocation', $adp->allocation ?? 0) }}" required placeholder="Enter Allocation">
                                    <x-input-error :messages="$errors->get('allocation')" class="mt-2" />
								</div>
                                <div class="mb-3">
									<label class="form-label">Enter ADP T/S Cost:</label>
                                    <input type="number" step="0.01" name="adp_t_s_cost" class="form-control" value="{{ old('adp_t_s_cost', $adp->adp_t_s_cost ?? 0) }}" required placeholder="Enter ADP T/S Cost">
                                    <x-input-error :messages="$errors->get('adp_t_s_cost')" class="mt-2" />
								</div>
                                <div class="mb-3">
									<label class="form-label">Enter Expenditure:</label>
                                    <input type="number" step="0.01" name="expenditure" class="form-control" value="{{ old('expenditure', $adp->expenditure ?? 0) }}" required placeholder="Enter Expenditure">
                                    <x-input-error :messages="$errors->get('expenditure')" class="mt-2" />
								</div>
                                <div class="mb-3">
									<label class="form-label">Enter Accrued Liability:</label>
                                   <input type="number" step="0.01" name="accrued_liability" class="form-control" value="{{ old('accrued_liability', $adp->accrued_liability ?? 0) }}" required placeholder="Enter Accrued Liability">
                                   <x-input-error :messages="$errors->get('accrued_liability')" class="mt-2" />
								</div>



								<div class="mb-3">
									<label class="form-label">Your File:</label>
                                    <input type="file" name="attached_files" class="form-control">
                                        @if(!empty($adp->attached_files))
                                            <a href="{{ Storage::url($adp->attached_files) }}" target="_blank">View File</a>
                                        @endif
									<div class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</div>
                                    <x-input-error :messages="$errors->get('attached_files')" class="mt-2" />
								</div>

								<div class="mb-3">
									<label class="form-label">Remarks:</label>
									<textarea rows="5" cols="5" name="remarks" class="form-control" placeholder="Enter Remarks here"></textarea>
								</div>

								<div class="text-end">
									<button type="submit" class="btn btn-primary">Submit form <i class="ph-paper-plane-tilt ms-2"></i></button>
								</div>



