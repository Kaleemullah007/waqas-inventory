<div class="row mt-4">
    <hr class=" border-secondary ">
    <div class="col-12 ms-4 pb-3">
        <button type="submit" id="save-form-id" class="btn btn-success btn-md text-white"><i class="bi bi-save me-2"></i> {{__('en.Save')}}</button>
        @if(isset($link))
        <a href="{{route($link)}}" class="btn btn-secondary btn-md ms-2"><i class="bi bi-x-circle me-2"></i> {{__('en.Cancel')}}</a>
        @endif

    </div>
</div>
