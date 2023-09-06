@extends('frontend.home_dashboard')
@section('home')

@section('title')
Reporter News Page
@endsection

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <div class="row">

            @foreach($news as $item)
                <div class="custom-col-6">
                    <div class="author-wrpp">
                        <div class="authorNews-image">
                            <a href="{{ url('news/details/'.$item->id.'/'.$item->news_title_slug)}}"><img class="lazyload" src="{{ asset($item->image) }}" ></a>
                        </div>
                        <div class="authorPage-content">
                            <h2 class="authorPage-title">
                                <a href="{{ url('news/details/'.$item->id.'/'.$item->news_title_slug)}}">{{ $item->news_title }}</a>
                            </h2>
                            <div class="author-date">
                                <a href=" "> {{ $item->user->name}} </a> 
                                <span> <i class="las la-clock"></i>
                                    {{ $item->created_at->format('1 M d Y')}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="pagination">
                    {{ $news->links()}}
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="fixd-sitebar" style="position: sticky; top: 0;">
                        <div class="authorPage-content" style="background:
                            #fbf7f7; border: 2px solid
                            #e1dfdf; border-radius: 5px;">
                            <figure class="authorPage-image">
                            <img alt="" src="{{ (!empty($reporter->photo)) ? url('upload/admin_images/' . $reporter->photo): url('upload/no_image.jpg') }}" class="avatar avatar-96 photo" height="96" width="96" loading="lazy"> </figure>
                            <h1 class="authorPage-name">
                                <a href=" "> {{$reporter->name}} </a>
                            </h1>
                            <div class="author-social">
                                <a href="{{$reporter->facebook_url}}" target="_black" title="Facebook"><i class="lab la-facebook-f"></i></a>
                                <a href="{{ $reporter->insta_url}}" target="_black" title="Instagram"><i class="lab la-instagram"></i></a>
                            </div>
                            <div class="author-details" style="text-align:justify">
                            </div>
                        </div>
                        <div class="authorPopular_item">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection