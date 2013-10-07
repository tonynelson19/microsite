@extends('layouts.master')

@section('content')

    <div class="header">
        <div class="logo">
            <a class="back" href="{{ URL::route('index.section', array('id' => $product->category->section->id)) }}"><img src="{{ URL::asset('img/arrow-icon.png') }}" /></a>
            <a class="home" href="{{ URL::route('index.index') }}"><img src="{{ URL::asset('img/QA1_Logo.png') }}" /></a>
            <a class="menu" href="#"><img src="{{ URL::asset('img/menu-icon.png') }}" /></a>
        </div>
    </div>
    <div class="content">
        <div class="container product">
            <div class="row">
                <div class="col-md-4">
                    <div id="carousel" class="carousel slide">
                        @if (count($product->images()))
                            <ol class="carousel-indicators">
                                @foreach ($product->images() as $index => $image)
                                    <li data-target="#carousel" data-slide-to="{{ $index }}" @if ($index === 0)class="active"@endif></li>
                                @endforeach
                            </ol>
                        @endif
                        <div class="carousel-inner">
                            @foreach ($product->images() as $index => $image)
                                <div class="item @if ($index === 0) active @endif">
                                    <span class="image">
                                        <img src="{{ $image->imageUrl }}" />
                                    </span>
                                    @if ($image->caption)
                                        <div class="carousel-caption">
                                            <p>{{ $image->caption }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        @if (count($product->images()))
                            <a class="left carousel-control" href="#carousel" data-slide="prev">
                                <span class="icon-prev"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel" data-slide="next">
                                <span class="icon-next"></span>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <h1>{{ $product->name }}</h1>
                    <h2>{{ $product->category->name }}</h2>
                    <div class="description">
                        {{ $product->description }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop