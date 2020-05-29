<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use function GuzzleHttp\Psr7\str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('back.categories.index', compact('categories'));
    }

    public function swich(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->status == "true" ? 1 : 0;
        $category->save();
    }

    public function getData(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return response()->json($category);

    }

    public function create(Request $request)
    {
        $isExist = Category::whereSlug(str_slug($request->category))->first();
        if ($isExist) {
            toastError($request->category . " Adında Kategori var.");
            return redirect()->back();
        } else {
            $category = new Category;
            $category->name = $request->category;
            $category->slug = str_slug($request->category);
            $category->save();
            toastSuccess('Kategori Başarıyla Oluşturuldu');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $isSlug = Category::whereSlug(str_slug($request->slug))->whereNotIn('id', [$request->category_id])->first();
        $isName = Category::whereName($request->category_id)->first();
        if ($isName) {
            toastr()->error($request->category . ' adında bir kategori zaten mevcut!');
            return redirect()->back();
        }
        if ($isSlug) {
            toastr()->error($request->slug . ' adında bir slug zaten mevcut!');
            return redirect()->back();
        }

        $category = Category::find($request->category_id);
        $category->name = $request->category;
        $category->slug = str_slug($request->slug);
        $category->save();
        toastr()->success('Kategori Başarıyla Güncellendi');
        return redirect()->back();
    }

    public function delete(Request $request){
        $category = Category::findOrFail($request->id);
        $defaultCategory = Category::find(1);
        if($category->id==1){
            toastr()->error('Bu kategori silinemez.');
            return redirect()->back();
        }
        $allArticle = Article::withTrashed()->where('category_id',$category->id);
        $allArticles = Article::withTrashed()->where('category_id',$category->id)->get();
        $count = $category->articleCount();
        $message = '';
        if($count > 0 ){
            $allArticle->update(['category_id'=>1]);
            $message = 'Silinen kategoriye ait '.$count.' yazı '.$defaultCategory->name.' kategorisine taşındı.';
        }elseif ($count==0 and count($allArticles)>0) {
            $allArticle->update(['category_id'=>1]);
        }
        $category->delete();
        toastr()->success( 'Kategori başarıyla silindi', ['timeOut' => 4000]);
        return redirect()->back();
    }
}
