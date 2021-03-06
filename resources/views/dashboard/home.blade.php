@extends('layouts.app')
@section('content')
<div class="page-wrap">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <h3>Hey, {{ Auth::user()->name }}! <i class="fa fa-hand-peace-o"></i> Here's your dashboard.</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <h4>Your favorite shows</h4>
            <dash-favorites :user={{ Auth::user()->id }}></dash-favorites>
        </div>
    </div>
    <div class="row friendships">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 full-width-mobile followers">
            <h4>Your followers</h4>
            <followers :user={{ Auth::user()->id }}>
            </followers>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 full-width-mobile following">
            <h4>People you follow</h4>
            <following :user={{ Auth::user()->id }}>
            </following>
        </div>
    </div>
    <div class="row mt-20">
        <div class="col-md-12">
            <h4>You might also like</h4>
            <user-suggestions :user={{ Auth::user()->id }} />
        </div>
    </div>
</div>
@endsection