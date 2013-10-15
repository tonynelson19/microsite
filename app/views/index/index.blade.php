@extends('layouts.master')

@section('content')

    <div class="header">
        <div class="logo">
            <a class="home" href="{{ URL::route('index.index') }}"><img src="{{ URL::asset('img/QA1-Logo.png') }}" /></a>
        </div>
    </div>
    <div class="content">
        <div class="container index">
            <h1>High performance suspension, driveshafts, rod ends &amp; more</h1>
            <ul class="sections">
                @foreach ($sections as $section)
                    <li>
                        <a href="{{ URL::route('index.section', array('id' => $section->id)) }}">
                            <div class="image">
                                <img src="{{ $section->imageUrl }}" />
                            </div>
                            <div class="name">
                                <span>{{ $section->name }}</span>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@stop