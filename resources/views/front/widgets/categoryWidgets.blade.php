@if($categories)
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Kategoriler
            </div>
            <div class="list-group">
                @foreach($categories as $category)
                    <a href="{{route('category',$category->slug)}}" class="list-group-item ">{{ucfirst($category->name)}}
                        <span class="badge badge-primary float-right">{{$category->articleCount()}}</span></a>
                @endforeach
            </div>
        </div>
    </div>
@endif
