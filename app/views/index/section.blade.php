@extends('layouts.master')

@section('content')

    <div class="header">
        <div class="logo">
            <a class="back" href="{{ URL::route('index.index') }}"><img src="{{ URL::asset('img/arrow-icon.png') }}" /></a>
            <a class="home" href="{{ URL::route('index.index') }}"><img src="{{ URL::asset('img/QA1_Logo.png') }}" /></a>
            <a class="menu" href="#menu"><img src="{{ URL::asset('img/menu-icon.png') }}" /></a>
            <div class="menu-options">
                <ul style="display: none;">
                    @foreach ($sections as $menu)
                        <li><a href="{{ URL::route('index.section', array('id' => $menu->id)) }}">{{ $menu->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container section">
            <ul class="categories">
                @foreach ($categories as $category)
                    <li>
                        <h2>{{ $category->name }}</h2>
                        <ul>
                            @foreach ($products[$category->id] as $product)
                                <li>
                                    <a href="{{ URL::route('index.product', array('id' => $product->id)) }}">
                                        <span class="image">
                                            <img src="{{ $product->imageUrl }}" />
                                        </span>
                                        <span class="name">{{ $product->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@stop