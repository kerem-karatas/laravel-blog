<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Config;
use App\Models\Page;
use Illuminate\Http\Request;
use Psy\Util\Str;

class ConfigController extends Controller
{
    public function index()
    {
        $config = Config::find(1);
        return view('back.config.index', compact('config'));
    }

    public function update(Request $request)
    {
        $config = Config::find(1);
        $config->title = $request->title;
        $config->active = $request->active;
        $config->facebook = $request->facebook;
        $config->twitter = $request->twitter;
        $config->linkedin = $request->linkedin;
        $config->youtube = $request->youtube;
        $config->github = $request->github;
        $config->instagram = $request->instagram;


        if ($request->hasFile('logo')) {
            $logo = str_slug($request->title) . '-logo.' . $request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads'), $logo);
            $config->logo = asset('uploads/') . '/' . $logo;
        }

        if ($request->hasFile('favicon')) {
            $favicon = str_slug($request->title) . '-favicon.' . $request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('uploads'), $favicon);
            $config->favicon = asset('uploads/') . '/' . $favicon;
        }
        $config->save();
        toastr()->success('Ayarlar Güncellendi');
        return redirect()->back();
//        if ($request->hasFile('logo')){
//            $logo = Str::slug($request->title).$request->logo->getClientOriginalExtension();
//            $request->logo->move(public )
    }
}
