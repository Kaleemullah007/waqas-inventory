{{-- <div class="col-lg-4 col-md-6 col-12 mt-2 d-flex">
    <label for="search" class="form-label mt-1"><i class="bi bi-search fs-4"></i></label>
    <input type="text" class="form-control bg-grey form-control-css border-secondary ms-3 rounded"
        placeholder="{{__('en.Search this table...')}}" id="search">
</div> --}}
<div class="d-flex">
    {{-- <label for="search" class="form-label mt-1"><i class="bi bi-search fs-4"></i></label> --}}
    <select class="form-select bg-grey border-dark me-2" name="Group" id="Group" autocomplete="Group" required>
        <option value="1">{{__('en.Today')}}</option>
        <option value="2">{{__('en.Last Day')}}</option>
        <option value="3">{{__('en.This Week')}}</option>
        <option value="4">{{__('en.Last Week')}}</option>
        <option value="5">{{__('en.This Month')}}</option>
        <option value="6">{{__('en.Last Month')}}</option>
        <option value="7">{{__('en.This Year')}}</option>
        <option value="8">{{__('en.Last Year')}}</option>
        <option value="9">{{__('en.Custom')}}</option>
    </select>
    <h6 class="mt-2">From</h6>
    <input type="text" name="daterange" value="01/01/2018 - 01/15/2018" class="form-control bg-grey border-secondary ms-2 rounded"
        id="search">
    {{-- <h6 class="mt-2 ms-2">To</h6>
    <input type="date" class="form-control bg-grey border-secondary ms-2 rounded"
        id="search"> --}}
</div>
