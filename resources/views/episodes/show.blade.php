@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="page-header">
            <h3>{{ $episode->name }}</h3>
            <h5><a href="{{ url('/show/' . $episode->show_id) }}">{{ $episode->getShow($episode->show_id) }}</a> | S{{ $episode->season }} x E{{ $episode->number }} | <i class="fa fa-star"></i> {{ $episode->average() }}</h5>
        </div>
    </div>
    <div class="row episodeDetail">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 np">
            <img src={{ $episode->image }}>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
            <p>{{ $episode->synopsis }}</p>
            @if (Auth::check())
            <p><strong>Your actions:</strong>
                <watched
                    :episode={{ $episode->id }}
                    :user={{ Auth::user()->id }}
                ></watched>
            </p>
            @endif
        </div>
    </div>
    @if (Auth::user()->admin)
        <episode-manage :episode_id={{ $episode->id }} :show_id={{ $episode->show_id }}></episode-manage>
    @endif
    <discussion
        :episode_id="{{ $episode->id }}"
        :user="{{ Auth::user() }}" />
</div>
@endsection