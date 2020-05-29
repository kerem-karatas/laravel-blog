@if(count($articles)>0)
    <div class="col-md-9 mx-auto">
        @foreach($articles as $article)
            <div class="post-preview">
                <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
                    <h2 class="post-title">
                        {{$article->title}}
                    </h2>
                    <img src="{{$article->image}}" style="max-width: 60%; height: auto ;margin-left: 15%"/>
                    <h3 class="post-subtitle">
                        {!!str_limit($article->content,50) !!}
                    </h3>
                </a>
                <p class="post-meta">Kategori: <a href="#">{{ucfirst($article->getCategory->name)}}</a>
                    <span class="float-right"> {{$article->created_at->diffForHumans()}}</span>
                </p>
            </div>
            @if(!$loop->last)
                <hr>
            @endif

        @endforeach
        {{$articles->links()}}

    </div>
    @if(!count($articles)>0)
        <div class="container">
            <div class="alert alert-danger">
                Bu kategoride yazı yok
            </div>
        </div>
    @endif

@endif
