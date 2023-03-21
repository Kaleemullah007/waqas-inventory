<div class="d-flex ">
    <input type="text" name="daterange" value="{{date('m/01/Y')}} - {{date('m/d/Y')}}" onChange="{{isset($functionName)?$functionName.'()':''}}" class="form-control form-control-css getSales bg-grey border-secondary ms-2 rounded"
        id="daterange" >
</div>
