@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (Auth::check())
            <div class="page-header">
                <h3>{{ $user->name }}</h3>
            </div>
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    {{ $user->name }}
                </div>
                <div class="panel-body">
                    {{ $user->email }}
                        @if (Auth::user()->id != $user->id)
                        <follow
                            :user_id={{ $user->id }}
                            :following_id={{ $user->followed() ? 'true' : 'false' }}
                        ></follow>
                        @endif
                    <div class="row">
                        <div class="col-md-6">Followers
                            <followers :user={{ $user->id }}>
                            </followers>
                        </div>
                        <div class="col-md-6">Following
                            <following :user={{ $user->id }}>
                            </following>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="panel-heading">
                <i class="fa fa-hand-paper-o"></i> This page is only available for users of the <strong>SWorld</strong>!
            </div>
            @endif
         </div>
    </div>
</div>
@endsection