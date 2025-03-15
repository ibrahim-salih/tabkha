@if($currentStep != 3)
<div style="display: none;" class="row setup-content" id="setp-3">
@endif
<fieldset>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="country">المحافظة :</label>
                    <select class="c-select form-control" id="country" name="country">
                        <option value="">اختر المحافظة</option>
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="state">المدينة :</label>
                    <select class="c-select form-control" id="state" name="state">
                        <option value="">اختر المدينة</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">العنوان :</label>
                    <input type="text" class="form-control" id="address" name="address">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <button type="button" class="btn btn-danger btn-sm nextBtn btn-lg pull-right" wire:click="back(2)">السابق</button>
            <button type="button" class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="threeStepSubmit">التالى</button>
        </div>
    </fieldset>

</div>