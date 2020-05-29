<?php

namespace App\Http\Controllers\Back;

use    App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;
use mysql_xdevapi\Exception;

class ArticleController extends Controller
{
    public function index()
    {

        $articles = Article::orderBy('created_at', 'ASC')->get();

        return view('back.articles.index', compact('articles'));
    }


    public function create()
    {

        $categories = Category::all();
        return view('back.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => "min:3",
            'image' => 'required | image | max:2048'
        ]);

        $article = new Article;
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->contentt;
        $article->slug = str_slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = str_slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $article->image = asset('uploads/') . '/' . $imageName;



        }
        echo asset('uploads/') . '/' . $imageName .'<br>';
        echo $imageName ;
die();
$article->save();
        toastr()->success('Başarılı', 'Makale Başarıyla Oluşturuldu.');
        return redirect()->route('admin.makaleler.index');
    }

    public function show($id)
    {
    }


    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();
        return view('back.articles.update', compact('categories', 'article'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => "min:3",
            'image' => ' image | max:2048'
        ]);

        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->contentt;
        $article->slug = str_slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = str_slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $article->image = asset('uploads/') . '/' . $imageName;
        }
        $article->save();
        toastr()->success('Başarılı', 'Makale Başarıyla Güncellendi .');
        return redirect()->route('admin.makaleler.index');
    }


    public function delete($id)
    {
        Article::find($id)->delete();
        toastSuccess("Makale Geri Dönüşüm Kutusuna Atıldı");
        return redirect()->route('admin.makaleler.index');
    }

    public function hardDelete($id)
    {

        $article = Article::onlyTrashed()->find($id);
        echo $article->image. ' <hr>';
        $split = explode('/',$article->image);
        print_r($split);
        $image = $split[3].'/'.$split[4];
        echo  $image;
        File::delete($image);
        $article->forceDelete();
        toastSuccess('Başarıyla silindi.');
        return redirect()->route('admin.makaleler.index');
    }

    public function swich(Request $request)
    {

        $article = Article::findOrFail($request->id);
        $article->status = $request->status == "true" ? 1 : 0;
        $article->save();
    }

    public function trashed()
    {
        $articles = Article::onlyTrashed()->orderBy('deleted_at', 'DESC')->get();
        return view('back.articles.trashed', compact('articles'));
    }

    public function recover($id)
    {

        Article::onlyTrashed()->find($id)->restore();
        toastSuccess("Makale silinme işlemi geri alındı.");
        return redirect()->back();
    }
}
