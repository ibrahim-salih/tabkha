@if($currentStep != 1)
<div style="display: none;" class="row setup-content" id="setp-1">
@endif
<fieldset>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="firstName2">الاسم :</label>
                <input type="text" class="form-control" wire:model="firstName" >
                @error('firstName')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="lastName2">اللقب :</label>
                <input type="text" class="form-control" wire:model="lastName" id="lastName" >
                @error('lastName')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="phoneNumber2">رقم الموبايل :</label>
                <input type="tel" class="form-control" wire:model="phone" id="phone" >
                @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="date2">تاريخ الميلاد :</label>
                <input type="date" class="form-control" wire:model="pirthdate" id="pirthdate" >
                @error('pirthdate')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <button type="button" class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit">التالى</button>
        </div>
    </div>
</fieldset>
</div>