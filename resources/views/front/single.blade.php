@extends('front.layouts.master')
@section('title',$article->title)
@section('content')
@section('bg',$article->image)
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <span style="color: #4e555b">Okunma Sayısı <b>{{$article->hit}}</b></span>
                    <br>
                    </a>
                   {!!$article->content!!}
                </div>
                    @include('front.widgets.categoryWidgets')
            </div>
        </div>


@endsection


