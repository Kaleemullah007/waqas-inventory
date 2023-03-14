@extends('layouts.master')

@section('title')
Create Group
@endsection

@section('content')
    <div class="container m-3  bg-light rounded">
        <div class="row">
            <div>
                <h4>{{__('en.Create Group')}}</h4>
            </div>
        </div>
        <hr>
        <form method="POST" action="">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <label for="Name" class="form-label fs-6">{{__('en.Name')}}</label>
                    <input type="text" class="form-control bg-grey border-secondary @error('Name') is-invalid @enderror" placeholder="{{__('en.Name')}}"
                        id="Name" name="Name"  value="{{ old('Name') }}" autocomplete="Name" required autofocus>
                    @error('Name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <label for="Description" class="form-label fs-6">{{__('en.Description')}}</label>
                    <input type="text" class="form-control bg-grey border-secondary @error('Description') is-invalid @enderror" placeholder="{{__('en.Description')}}"
                        id="Description" name="Description"  value="{{ old('Description') }}" autocomplete="Description" required>
                    @error('Description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <label for="Users" class="form-label fs-6">{{__('en.Users')}}</label>
                    <select class="form-select bg-grey mb-2 border-dark @error('Users') is-invalid @enderror" multiple name="Users" id="Users" autocomplete="Users" required>
                        <option>{{__('en.Choose')}}</option>
                        <option value="1" @if(old('Users') == 1) 'selected' @endif >{{__('en.User')}} 1</option>
                        <option value="2" @if(old('Users') == 2) 'selected' @endif >{{__('en.User')}} 2</option>
                    </select>
                    @error('Users')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <label for="Status" class="form-label fs-6">{{__('en.Status')}}</label>
                        <br>
                    <input type="checkbox" checked data-size="sm" data-toggle="toggle" data-on="Active"
                    data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                    @error('Status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="bg-css p-3 w-100">
                        <h4>{{__('en.User Management')}}</h4>
                    </div>
                    <?php $modeuleName = 'user_management'; ?>
                    <div class="overflow-css">
                        <div class="row d-flex p-2 ps-3">
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2"
                                        name="permissions[<?= $modeuleName ?>]['view']" type="checkbox"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.View')}}</label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['create']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox1">{{__('en.Create')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex p-2 ps-3">
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2"
                                        name="permissions[<?= $modeuleName ?>]['view']" type="checkbox"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.View')}}</label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['create']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox1">{{__('en.Create')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex p-2 ps-3">
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2"
                                        name="permissions[<?= $modeuleName ?>]['view']" type="checkbox"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.View')}}</label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['create']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox1">{{__('en.Create')}}</label>
                                </div>
                            </div>
                        </div>


                        <div class="row d-flex p-2 ps-3">
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2"
                                        name="permissions[<?= $modeuleName ?>]['view']" type="checkbox"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.View')}}</label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['create']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox1">{{__('en.Create')}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex p-2 ps-3">
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2"
                                        name="permissions[<?= $modeuleName ?>]['view']" type="checkbox"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.View')}}</label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['create']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox1">{{__('en.Create')}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex p-2 ps-3">
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2"
                                        name="permissions[<?= $modeuleName ?>]['view']" type="checkbox"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.View')}}</label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['create']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox1">{{__('en.Create')}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex p-2 ps-3">
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2"
                                        name="permissions[<?= $modeuleName ?>]['view']" type="checkbox"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.View')}}</label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['create']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox1">{{__('en.Create')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex p-2 ps-3">
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2"
                                        name="permissions[<?= $modeuleName ?>]['view']" type="checkbox"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.View')}}</label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['create']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox1">{{__('en.Create')}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex p-2 ps-3">
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2"
                                        name="permissions[<?= $modeuleName ?>]['view']" type="checkbox"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.View')}}</label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['create']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox1">{{__('en.Create')}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex p-2 ps-3">
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2"
                                        name="permissions[<?= $modeuleName ?>]['view']" type="checkbox"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.View')}}</label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['create']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox1">{{__('en.Create')}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex p-2 ps-3">
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2"
                                        name="permissions[<?= $modeuleName ?>]['view']" type="checkbox"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.View')}}</label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['create']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox1">{{__('en.Create')}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex p-2 ps-3">
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2"
                                        name="permissions[<?= $modeuleName ?>]['view']" type="checkbox"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.View')}}</label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['create']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox1">{{__('en.Create')}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex pb-2 ps-3">
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['edit']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.Edit')}}</label>
                                </div>
                            </div>
                            <div class="col-5 ps-2">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['delete']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox1">{{__('en.Delete')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex ps-3">
                            <div class="">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['view all']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.View all Records')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="bg-css p-3 w-100">
                        <h4>{{__('en.User Permissions')}}</h4>
                    </div>
                    <?php $modeuleName = 'user_permissions'; ?>
                    <div class="overflow-css">
                        <div class="row d-flex p-2 ps-3">
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['view']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.View')}}</label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['create']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox1">{{__('en.Create')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex pb-2 ps-3">
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['edit']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.Edit')}}</label>
                                </div>
                            </div>
                            <div class="col-5 ps-2">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['delete']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox1">{{__('en.Delete')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="bg-css p-3 w-100">
                        <h4>{{__('en.Products')}}</h4>
                    </div>
                    <?php $modeuleName = 'products'; ?>
                    <div class="overflow-css">
                        <div class="row d-flex p-2 ps-3">
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['view']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.View')}}</label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['create']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox1">{{__('en.Create')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex pb-2 ps-3">
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['edit']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.Edit')}}</label>
                                </div>
                            </div>
                            <div class="col-5 ps-2">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['delete']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox1">{{__('en.Delete')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex ps-3">
                            <div class="col-5">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['barcode']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox2">{{__('en.Barcode')}}</label>
                                </div>
                            </div>
                            <div class="col-7 ps-2">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input rounded-pill mt-2" type="checkbox"
                                        name="permissions[<?= $modeuleName ?>]['import']"
                                        id="<?= $modeuleName ?>flexSwitchCheckReverse">
                                    <label class="form-check-label" for="inlineCheckbox1">{{__('en.Import')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- save button row included below -->
            @include('pages.table-footer')
        </form>
    </div>
@endsection
