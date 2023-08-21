@php
$cdate = new DateTime();
@endphp

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<header class="themesbazar_header">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5">

                <div class="row">
                    <div class="col-md-6">
                        <div class="date">
                            <i class="lar la-calendar"></i>
                            {{ $cdate->format('l d-m-Y')}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <select name="" id="" class="form-select changeLang">
                            <option disabled selected value="ja">Select Language</option>
                            <option value="ja"{{ session()->get('locale') == 'ja' ? 'selected' : '' }}>日本語</option>
                            <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                            <option value="pt" {{ session()->get('locale') == 'pt' ? 'selected' : '' }}>Portuguese</option>
                            <option value="es" {{ session()->get('locale') == 'es' ? 'selected' : '' }}>Spanish</option>
                        </select>
                    </div>
                </div>
            </div>



            <div class="col-lg-3 col-md-3">
                <form class="header-search" action=" " method="post">
                    <input type="text" value="" name="s" placeholder=" Search Here " required="">
                    <button type="submit" value="Search"> <i class="las la-search"></i> </button>
                </form>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="header-social">
                    <ul>
                        <li> <a href="https://www.facebook.com/" target="_blank" title="facebook"><i class="lab la-facebook-f"></i> </a> </li>
                        <li><a href="https://twitter.com/" target="_blank" title="twitter"><i class="lab la-twitter"> </i> </a></li>

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
  
</header>

<div class="menu_section sticky" id="myHeader">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
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
                                {{ GoogleTranslate::trans($category->category_name, app()->getLocale()) }}
                            </a>
                        </li>
                        @endforeach

                        <li id="menu-item-292" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-292">
                            <a href=" ">ARCRIVE</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var url = "{{ route('changeLang') }}";
    $(".changeLang").change(function(){
        window.location.href = url + "?lang=" + $(this).val();
    });
</script>