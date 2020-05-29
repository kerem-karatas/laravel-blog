@extends('back.layouts.master')
@section('title','Makakle Oluştur.')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        @endif
                    </div>
                        <form method="post" action="{{route('admin.page.create.post')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">sayfa Baslığı</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">sayfa Resmi</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">sayfa İçeriği</label>
                            <textarea type="file" name="contentt" rows="8" class="form-control" id="editor"
                                      required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-info  btn-block">Sayfayı oluştur</button>
                        </div>

                    </form>
            </div>
        </div>

        @endsection
        @section('css')
            <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    @endsection
    @section('js')
        <!-- include summernote css/js -->
            <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
            <script>
                $(document).ready(function () {

                    $('#editor').summernote({
                        'height': 300,
                    });
                });
            </script>
@endsection
