<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsPost;
use App\Models\Category;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use App;

class IndexController extends Controller
{
    public function Index(){
        $newnewspost = NewsPost::orderBy('id','DESC')->limit(8)->get();
        $newspopular = NewsPost::orderBy('view_count','DESC')->limit(8)->get();
        return view('frontend.index',compact('newnewspost','newspopular'));
    }

    public function NewsDetails($id,$slug){
        $news = NewsPost::findOrFail($id);
        $tags = $news->tags;
        $tags_all = explode(',',$tags);

        $cat_id = $news->category_id;
        $relatedNews = NewsPost::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(6)->get();

        $newsKey = 'blog' . $news->id;
        if(!Session::has($newsKey)){
            $news->increment('view_count');
            Session::put($newsKey,1);
        }

        $newnewspost = NewsPost::orderBy('id','DESC')->limit(8)->get();
        $newspopular = NewsPost::orderBy('view_count','DESC')->limit(8)->get();

        return view('frontend.news.news_details',compact('news','tags_all','relatedNews','newnewspost','newspopular'));
    }

    public function CatWiseNews($id,$slug){

        $news = NewsPost::where('status',1)->where('category_id',$id)->orderBy('id','DESC')->get();

        $breadcat = Category::where('id',$id)->first();

        $newstwo = NewsPost::where('status',1)->where('category_id',$id)->orderBy('id','DESC')->limit(2)->get();

        $newnewspost = NewsPost::orderBy('id','DESC')->limit(8)->get();
        $newspopular = NewsPost::orderBy('view_count','DESC')->limit(8)->get();

        return view('frontend.news.category_news',compact('news','breadcat','newstwo','newnewspost','newspopular'));
    }

    public function Change(Request $request){
        $selectedLang = $request->lang;
    
        if ($selectedLang === 'es' || $selectedLang === 'en' || $selectedLang === 'ja' || $selectedLang === 'pt') {
            App::setLocale($selectedLang);
            session()->put('locale', $selectedLang);
        } else {
            // デフォルトの言語を設定
            App::setLocale('ja');
            session()->put('locale', 'ja');
        }
    
        return redirect()->back();
    }
}
