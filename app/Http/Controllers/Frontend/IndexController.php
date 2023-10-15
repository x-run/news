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
use DateTime;
use App\Models\User;
use Illuminate\Pagination\Paginator;

class IndexController extends Controller
{
    public function Index(){
        $newnewspost = NewsPost::orderBy('id','DESC')->limit(8)->get();
        $newspopular = NewsPost::orderBy('view_count','DESC')->limit(8)->get();

        $skip_cat_0 = Category::skip(0)->first();
        $skip_news_0 = NewsPost::where('status',1)->where('category_id',$skip_cat_0->id)->orderBy('id','DESC')->inRandomOrder()->limit(5)->get();

        $skip_cat_1 = Category::skip(1)->first();
        $skip_news_1 = NewsPost::where('status',1)->where('category_id',$skip_cat_1->id)->orderBy('id','DESC') ->inRandomOrder()->limit(6)->get();

        $skip_cat_2 = Category::skip(2)->first();
        $skip_news_2 = NewsPost::where('status',1)->where('category_id',$skip_cat_2->id)->orderBy('id','DESC')->inRandomOrder()->limit(3)->get();

        $skip_cat_3 = Category::skip(3)->first();
        $skip_news_3 = NewsPost::where('status',1)->where('category_id',$skip_cat_3->id)->orderBy('id','DESC') ->inRandomOrder()->limit(5)->get();

        $skip_cat_4 = Category::skip(4)->first();
        $skip_news_4 = NewsPost::where('status',1)->where('category_id',$skip_cat_4->id)->orderBy('id','DESC') ->inRandomOrder()->limit(3)->get();

        $skip_cat_4 = Category::skip(4)->first();
        $skip_news_4 = NewsPost::where('status',1)->where('category_id',$skip_cat_4->id)->orderBy('id','DESC') ->inRandomOrder()->limit(3)->get();

        $skip_cat_5 = Category::skip(15)->first();
        $skip_news_5 = NewsPost::where('status',1)->where('category_id',$skip_cat_5->id)->orderBy('id','DESC') ->inRandomOrder()->limit(3)->get();

        return view('frontend.index',compact('newnewspost','newspopular','skip_cat_0','skip_news_0','skip_cat_1','skip_news_1','skip_cat_2','skip_news_2','skip_cat_3','skip_news_3','skip_cat_4','skip_news_4'));
    }//End Method

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
    }//End Method

    public function CatWiseNews($id,$slug){

        $news = NewsPost::where('status',1)->where('category_id',$id)->orderBy('id','DESC')->paginate(10);
        Paginator::useBootstrap();

        $breadcat = Category::where('id',$id)->first();

        $newstwo = NewsPost::where('status',1)->where('category_id',$id)->orderBy('id','DESC')->limit(2)->get();

        $newnewspost = NewsPost::orderBy('id','DESC')->limit(8)->get();
        $newspopular = NewsPost::orderBy('view_count','DESC')->limit(8)->get();

        return view('frontend.news.category_news',compact('news','breadcat','newstwo','newnewspost','newspopular'));
    }//End Method

    public function Change(Request $request){
        $selectedLang = $request->lang;
    
        if ($selectedLang === 'ja' ||$selectedLang === 'es' || $selectedLang === 'en' || $selectedLang === 'pt') {
            App::setLocale($selectedLang);
            session()->put('locale', $selectedLang);
        } else {
            // デフォルトの言語を設定
            App::setLocale('ja');
            session()->put('locale', 'ja');
        }
    
        return redirect()->back();
    }//End Method

    public function SearchByDate(Request $request){

        $date = new DateTime($request->date);
        $formatDate = $date->format('d-m-Y');

        $newnewspost = NewsPost::orderBy('id','DESC')->limit(8)->get();
        $newspopular = NewsPost::orderBy('view_count','DESC')->limit(8)->get();

        $news = NewsPost::where('post_date',$formatDate)->latest()->paginate(9);
        Paginator::useBootstrap();
        
        return view('frontend.news.search_by_date',compact('news','formatDate','newnewspost','newspopular'));
    }//End Method

    public function NewsSearch(Request $request){

        $request->validate(['search' => "required"]);
        $item = $request->search;
        
        $news = NewsPost::where('news_title','LIKE',"%$item%")
        ->orWhere('news_details', 'LIKE', "%$item%")
        ->orWhere('tags', 'LIKE', "%$item%") // tags フィールドを追加
        ->orWhereHas('user', function ($query) use ($item) {
            $query->where('name', 'LIKE', "%$item%");
        })
        ->paginate(22);
        Paginator::useBootstrap();

        $newnewspost = NewsPost::orderBy('id','DESC')->limit(8)->get();
        $newspopular = NewsPost::orderBy('view_count','DESC')->limit(8)->get();

        return view('frontend.news.search',compact('news','newnewspost','newspopular','item'));
    }//End Method

    public function ReporterNews($id){
        $reporter = User::findOrFail($id);
        $news = NewsPost::where('user_id',$id)->paginate(8);
        Paginator::useBootstrap();

        return view('frontend.reporter.reporter_news_post',compact('reporter','news'));
    }//End Method
}
