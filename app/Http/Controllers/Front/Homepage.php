<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Article;
use App\Models\Config;
use App\Models\Page;
use App\Models\Contact;
use Illuminate\Http\Request;
use Mail;
use Illuminate\View\View;
use Validator;
use function foo\func;

class Homepage extends Controller
{
    public function __construct()
    {
        if (Config::find(1)->active==0){
            return redirect()->to('site-bakimda')->send();
        }
        view()->share('pages', Page::where('status',1)->orderBy('order', 'ASC')->get());
        view()->share('categories', $data['categories'] = Category::where('status',1)->inRandomOrder()->get());
    }

    public function index()
    {
        $data['articles'] = Article::with('getCategory')->where('status',1)->whereHas('getCategory',function($query){
        $query->where('status',1);
    })->orderBy('created_at', 'DESC')->paginate(5);
        $data['articles']->withPath(url('sayfa'));

        return view('front.homepage', $data);

    }

    public function single($category, $slug)
    {
        $category = Category::whereSlug($category)->first() ?? abort(403, 'Böyle bişey yok');
        $article = Article::where('slug', $slug)->whereCategoryId($category->id)->first() ?? abort(404, "Yok böyle bişey");
        $article->increment('hit');
        $data['article'] = $article;
        return view('front.single', $data);
    }

    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first() ?? abort(403, 'Böyle bişey yok');
        $data['category'] = $category;

        $data['articles'] = Article::where('category_id', $category->id)->where('status',1)->orderBy('created_at', 'DESC')->paginate(1);
        return view('front.category', $data);
    }

    public function page($slug)
    {

        $page = Page::whereSlug($slug)->first() ?? abort(403, 'yokki');
        $data['page'] = $page;
        return view('front.page', $data);
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function contactpost(Request $request)
    {
        $rules = [
            'name' => 'required|min:2',
            'name' => 'required|email',
            'name' => 'required',
            'name' => 'required|min:10',
        ];
        $validate = Validator::make($request->post(), $rules);
        if ($validate->fails()) {
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }
        Mail::send([],[], function ($message) use ($request) {
            $message->from('keremkaratas420@gmail.com', 'Kerem Karataş');
            $message->to('keremkaratas420@gmail.com', 'Kerem Karataş');
            $message->setBody('Mesajı gönderen ' . $request->name . '<br>
        Mesajı Gönderen Mail:' . $request->email . '<br>
            Mesaj Konusu: ' . $request->topic . '<br>
            Mesaj : ' . $request->message . '<br><br>
            Mesaj Gönderilme Tarihi:' .now().'','text/html');

        });
//        $contact = new Contact;
//        $contact->name = $request->name;
//        $contact->email = $request->email;
//        $contact->topic = $request->topic;
//        $contact->message = $request->message;
//        $contact->save();
        return redirect()->route('contact')->with('success', 'Mesajınız bize iletildi');

    }
}
