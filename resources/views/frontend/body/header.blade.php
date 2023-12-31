@php
$cdate = new DateTime();
@endphp

<header class="themesbazar_header">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="date">
                    <i class="lar la-calendar"></i>
                    {{ $cdate->format('l d-m-Y')}}
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <form class="header-search" action="{{route('news.search')}}" method="post">
                    @csrf
                    <input type="text" name="search" placeholder=" Search Here " required="">
                    <button type="submit" value="Search"> <i class="las la-search"></i> </button>
                </form>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="header-social">
                    <ul>
                        <li> <a href="https://www.facebook.com/profile.php?id=61550691343308" target="_blank" title="facebook"><i class="lab la-facebook-f"></i> </a> </li>
                        <li><a href="https://www.instagram.com/nakazatosyo/" target="_blank" title="instagram"><i class="lab la-instagram"> </i> </a></li>

                        @auth 
                        <li><a href="{{ route('user.logout')}}"><b> Logout </b></a> </li>
                        @else
                        <li><a href="{{ route('login')}}"><b> Login </b></a> </li>
                        <li> <a href="{{ route('register')}}"> <b>Register</b> </a> </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-F6S14E9D32"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-F6S14E9D32');
</script>

<!-- lite youtube embed -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/lite-yt-embed.css')}}">
<script defer src="{{ asset('frontend/assets/js/lite-yt-embed.js')}}"></script>


</header>

<div class="menu_section sticky" id="myHeader">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                {{--
                <div class="mobileLogo">
                    <a href=" " title="NewsFlash">
                        <img src="" alt="Logo" title="Logo" >
                    </a>
                </div>
                --}}
                <div class="stellarnav dark desktop">
                    <a href="" class="menu-toggle full">
                        <span class="bars"><span></span><span></span><span></span></span>
                    </a>
                    <ul id="menu-main-menu" class="menu">
                        <li id="menu-item-89" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-89">
                            <a href="{{ url('/') }}" aria-current="page">
                                <i class="fa-solid fa-house-user"></i>HOME
                            </a>
                        </li>

                        @php 
                        $categories = App\Models\Category::orderBy('category_name','ASC')->limit(7)->get();
                        @endphp

                        @foreach($categories as $category)
                        <li id="menu-item-291" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-291 has-sub">
                            <a href="{{ url('news/category/'.$category->id.'/'.$category->category_slug) }}">
                                {{ $category->category_name }}
                            </a>
                            {{--
                            @php
                            $subcategories = App\Models\Subcategory::where('category_id',$category->id)->orderBy('subcategory_name','ASC')->get();
                            @endphp
                            <ul class="sub-menu">
                                @foreach($subcategories as $subcategory)
                                <li id="menu-item-294" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-294">
                                    <a href="">{{ $subcategory->subcategory_name }}</a>
                                </li>
                                @endforeach
                            </ul>
                            --}}
                            <a class="dd-toggle" href=" "><span class="icon-plus"></span></a>
                        </li>
                        @endforeach

                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
