@extends('front.layouts.master')
@section('title',$category->name . ' Kategorisi | '.count($articles). ' Yazı' )
@section('content')

    @if(count($articles)>0)
              @include('front.widgets.articleList')
    @endif

@endsection
