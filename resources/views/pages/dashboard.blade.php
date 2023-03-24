@extends('layouts.master')

@section('datefilter')
@include('pages.list-filter',['functionName'=>'getStatisticsForDashBoard'])
@endsection


@section('title')
Dashboard
@endsection

@section('content')
    <div id="searchable">
        @include('pages.ajax-dashboard')
    </div>


@endsection
