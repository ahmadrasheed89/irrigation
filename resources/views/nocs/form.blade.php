@if ($noc->issue_no)
<h3><label class="form-label">Issue Number : {{ $noc->issue_no }}</label></h3>
@else
<div class="mb-3">
    <label class="form-label">Issue Number</label>
    <input type="text" name="issue_no" class="form-control" required value="{{ old('issue_no', $noc->issue_no ?? '') }}">
    <x-input-error :messages="$errors->get('issue_no')" class="mt-2"  />
    </div>
@endif
<div class="mb-3">
    <label class="form-label">Department</label>
    <input type="text" name="department" class="form-control" required value="{{ old('department', $noc->department ?? '') }}">
    <x-input-error :messages="$errors->get('department')" class="mt-2"  />
</div>
<div class="mb-3">
    <label class="form-label">NOC Subject</label>
    <input type="text" name="noc_subject" class="form-control" required value="{{ old('noc_subject', $noc->noc_subject ?? '') }}">
    <x-input-error :messages="$errors->get('noc_subject')" class="mt-2"  />
</div>
<div class="mb-3">
    <label class="form-label">Nature  of NOC</label>
    <input type="text" name="nature_of_noc" class="form-control" required value="{{ old('nature_of_noc', $noc->nature_of_noc ?? '') }}">
    <x-input-error :messages="$errors->get('nature_of_noc')" class="mt-2"  />
</div>
<div class="mb-3">
    <label class="form-label">Remarks</label>
    <textarea name="remarks" class="form-control" required> {{ old('remarks', $noc->remarks ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('remarks')" class="mt-2"  />
</div>
<div class="mb-3">
    <label class="form-label">Issue Date</label>
    <input type="date" name="issued_date" class="form-control" required value="{{ old('issued_date', (isset($noc)) ? $noc->issued_date->format('Y-m-d') : '') }}">
    <x-input-error :messages="$errors->get('issued_date')" class="mt-2"  />
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
