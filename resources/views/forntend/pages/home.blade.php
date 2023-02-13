@extends('forntend.layout.master')

@section('frontend_title')
    Home Page
@endsection

@section('frontend_content')

    @include('forntend.pages.widgets.slider')

    @include('forntend.pages.widgets.feature')

    @include('forntend.pages.widgets.countdown')

    @include('forntend.pages.widgets.best-seller')

    @include('forntend.pages.widgets.latest-product')

    @include('forntend.pages.widgets.testimonial')
    
@endsection
