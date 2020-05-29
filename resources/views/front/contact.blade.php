@extends('front.layouts.master')
@section('title','iletisim')
@section('bg','data:image/jpeg;base64,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')

@section('content')


    <div class="col-lg-8 col-md-10 mx-auto">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <p>Bizimle iletişime geçebilirsiniz!</p>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form method="post" action="{{route('contact.post')}}">
            @csrf
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Ad Soyad</label>
                    <input type="text" class="form-control" placeholder="Ad Soyad" value="{{old('name')}}" name="name">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Email Adresi</label>
                    <input type="text" class="form-control" placeholder="Email Adresi" value="{{old('email')}}"
                           name="email">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                    <label>Konu</label>
                    <select class="form-control" name="topic" id="">
                        <option @if(strtolower(old('topic'))=='bilgi') selected @endif>Bilgi</option>
                        <option @if(strtolower(old('topic'))=='destek') selected @endif>Destek</option>
                        <option @if(strtolower(old('topic'))=="genel") selected @endif>Genel</option>
                        <option @if(strtolower(old('topic'))=="diger") selected @endif>Diger</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Messajınız</label>
                    <textarea rows="5" class="form-control" placeholder="Mesaj" name="message" id="message" required
                              data-validation-required-message="Please enter a message.">{{trim(old('message'))}}
                    </textarea>
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <b>
                <div id="success"></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="sendMessageButton">Send</button>
                </div>
        </form>
    </div>
@endsection
