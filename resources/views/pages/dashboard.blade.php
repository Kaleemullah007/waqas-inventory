@extends('layouts.master')

@section('title')
Dashboard
@endsection

@section('content')
        <div class="sm-chart-sec my-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 my-2">
                        <div class="revinue revinue-one_hybrid">
                            <div class="revinue-hedding">
                                <div class="w-title">
                                    <div class="w-icon">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <div class="sm-chart-text">
                                        <p class="w-value">{{$result['total_sales']}}</p>
                                        <h5>{{__('en.Sales')}}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="revinue-content">
                                <div id="hybrid-followers"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 my-2">
                        <div class="revinue page-one_hybrid">
                            <div class="revinue-hedding">
                                <div class="w-title">
                                    <div class="w-icon">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <div class="sm-chart-text">
                                        <p class="w-value">{{$result['total_purchases']}}</p>
                                        <h5>{{__('en.Purchases')}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 my-2">
                        <div class="revinue bounce-one_hybrid">
                            <div class="revinue-hedding">
                                <div class="w-title">
                                    <div class="w-icon">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <div class="sm-chart-text">
                                        <p class="w-value">{{$result['expenses']}}</p>
                                        <h5>{{__('en.Expenses')}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 my-2">
                        <div class="revinue rv-status-one_hybrid">
                            <div class="revinue-hedding">
                                <div class="w-title">
                                    <div class="w-icon">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <div class="sm-chart-text">
                                        <p class="w-value">{{$result['net_profits']}}</p>
                                        <h5>{{__('en.Net Profit')}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Admin and order status table -->
        <div class="all-admin my-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="admin-list">
                            <p class="admin-ac-title">{{__('en.Products')}}</p>
                            <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet consequuntur sint eveniet architecto sunt quidem nemo temporibus, ratione dolore, saepe excepturi atque rem delectus corporis ad earum. Ullam, possimus aliquam earum sed odit, illum vel, corrupti saepe quaerat sit commodi hic. Iusto, delectus? Fugit, doloribus pariatur! Eveniet illo modi nihil.</h5>
                            {{-- <ul class="admin-ul">
                                <li class="admin-li">
                                    <img src="/assets/images/user1.png" alt="Image" class="admin-image">
                                    <div class="admin-ac-details">
                                        <div>
                                            <a href="#" class="admin-name">Kaleem Ullah</a>
                                            <p class="activity-text">Active Now</p>
                                        </div>
                                        <div class="status bg-success"></div>
                                    </div>
                                </li>
                                <li class="admin-li">
                                    <img src="/assets/images/user2.png" alt="Image" class="admin-image">
                                    <div class="admin-ac-details">
                                        <div>
                                            <a href="#" class="admin-name">Muhammad Uzair</a>
                                            <p class="activity-text">Active 15 min ago</p>
                                        </div>
                                        <div class="status bg-primary"></div>
                                    </div>
                                </li>
                                <li class="admin-li">
                                    <img src="/assets/images/user3.png" alt="Image" class="admin-image">
                                    <div class="admin-ac-details">
                                        <div>
                                            <a href="#" class="admin-name">Ali Khan</a>
                                            <p class="activity-text">Active 30 min ago</p>
                                        </div>
                                        <div class="status bg-warning"></div>
                                    </div>
                                </li>
                                <li class="admin-li">
                                    <img src="/assets/images/user4.png" alt="Image" class="admin-image">
                                    <div class="admin-ac-details">
                                        <div>
                                            <a href="#" class="admin-name">Ahmad Khan</a>
                                            <p class="activity-text">Active 2 days ago</p>
                                        </div>
                                        <div class="status bg-danger"></div>
                                    </div>
                                </li>
                                <li class="admin-li">
                                    <img src="/assets/images/user5.png" alt="Image" class="admin-image">
                                    <div class="admin-ac-details">
                                        <div>
                                            <a href="#" class="admin-name">Shan Khan</a>
                                            <p class="activity-text">Active Now</p>
                                        </div>
                                        <div class="status bg-success"></div>
                                    </div>
                                </li>
                            </ul> --}}
                        </div>
                    </div>

                    {{-- <div class="col-md-8 col-sm-7">
                        <div class="order-list">
                            <p class="order-ac-title">{{__('en.Order Status')}}</p>
                            <div class="data-table-section table-responsive">
                                <table id="order-table" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>{{__('en.Name')}}</th>
                                            <th>{{__('en.Position')}}</th>
                                            <th>{{__('en.Office')}}</th>
                                            <th>{{__('en.Age')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="order-view-tb">
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>
                                                <a href="#" class="status-tb-btn bg-cla">Success</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Garrett Winters</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>
                                                <a href="#" class="status-tb-btn bg-clb">Open</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ashton Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>
                                                <a href="#" class="status-tb-btn bg-clc">On Hold</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cedric Kelly</td>
                                            <td>Senior Javascript Developer</td>
                                            <td>Edinburgh</td>
                                            <td>
                                                <a href="#" class="status-tb-btn bg-cld">Checked</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cedric Kelly</td>
                                            <td>Senior Javascript Developer</td>
                                            <td>Edinburgh</td>
                                            <td>
                                                <a href="#" class="status-tb-btn bg-cla">Process</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cedric Kelly</td>
                                            <td>Senior Javascript Developer</td>
                                            <td>Edinburgh</td>
                                            <td>
                                                <a href="#" class="status-tb-btn bg-clb">Open</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
@endsection
