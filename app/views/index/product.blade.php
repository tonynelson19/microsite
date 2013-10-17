@extends('layouts.master')

@section('content')

    <div class="header">
        <div class="logo">
            <a class="back" href="{{ URL::route('index.section', array('id' => $product->category->section->id)) }}"><img src="{{ URL::asset('img/arrow-icon.png') }}" /></a>
            <a class="home" href="{{ URL::route('index.index') }}"><img src="{{ URL::asset('img/QA1-Logo.png') }}" /></a>
            <a class="menu" href="#menu"><img src="{{ URL::asset('img/menu-icon.png') }}" /></a>
            <div class="menu-options">
                <ul style="display: none;">
                    @foreach ($products as $menu)
                        <li><a href="{{ URL::route('index.product', array('id' => $menu->id)) }}">{{ Util::clean($menu->name) }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container product">
            <div class="row">
                <div class="col-md-4">
                    <div id="carousel" class="carousel slide">
                        @if (count($images))
                            <ol class="carousel-indicators">
                                @foreach ($images as $index => $image)
                                    <li data-target="#carousel" data-slide-to="{{ $index }}" @if ($index === 0)class="active"@endif></li>
                                @endforeach
                            </ol>
                        @endif
                        <div class="carousel-inner">
                            @foreach ($images as $index => $image)
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
                        @if (count($images))
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
                    <h1>{{ Util::clean($product->name) }}</h1>
                    @if ($product->madeInUsa)
                        <span class="made-in-usa"><img src="http://placekitten.com/30/30" alt="Made in USA" /></span>
                    @endif
                    @if (count($product->videos))
                        <a class="video" data-toggle="modal" data-target="#video" href="#video"><img src="{{ URL::asset('img/video-icon.png') }}" /></a>
                    @endif
                    <div class="description">
                        {{ $product->description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (count($product->videos))
        <div class="modal fade" id="video" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <iframe width="560" height="415" src="{{ Video::getYouTubeEmbedUrl($product->videos[0]->videoUrl) }}?wmode=transparent&html5=1" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="footer">
    </div>

@stop