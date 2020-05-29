@extends('front.layouts.master')
@section('title','blog sitesi')
@section('content')

        @include('front.widgets.articleList')
        @include('front.widgets.categoryWidgets')
@endsection
