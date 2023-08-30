@php
    $id = Auth::user()->id;
    $userid = App\Models\User::find($id);
    $status = $userid->status;
@endphp


<div class="left-side-menu">

<div class="h-100" data-simplebar>

@php 
    $hideMenu = ($status == 'active') ? false: true;
@endphp

    <!-- User box -->

    <!--- Sidemenu -->
    <div id="sidebar-menu">

        <ul id="side-menu">

            <li class="menu-title">Navigation</li>

            <li>
                <a href="{{ route('admin.dashboard') }}">
                <i class="mdi mdi-view-dashboard-outline"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="menu-title mt-2">Menu</li>


@if($hideMenu)
@else
            <li>
                <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                    <i class="mdi mdi-cart-outline"></i>
                    <span> Category </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce">
                    <ul class="nav-second-level">
                        <li>
                            <a href="{{ route('all.category')}}">All Category</a>
                        </li>
                        <li>
                            <a href="{{ route('add.category')}}">Add Category</a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- ><li>
                <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                    <i class="mdi mdi-cart-outline"></i>
                    <span> SunCategory </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce">
                    <ul class="nav-second-level">
                        <li>
                            <a href="{{ route('all.subcategory')}}">All SubCategory</a>
                        </li>
                        <li>
                            <a href="{{ route('add.subcategory')}}">Add SubCategory</a>
                        </li>
                    </ul>
                </div>
            </li>
            < -->
@endif

            <li>
                <a href="#newspost" data-bs-toggle="collapse">
                    <i class="mdi mdi-cart-outline"></i>
                    <span> News Post Setting </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="newspost">
                    <ul class="nav-second-level">
@if($hideMenu)
                        <li>
                            <a href="{{ route('add.news.post')}}">Add News Post</a>
                        </li>
@else
                        <li>
                            <a href="{{ route('all.news.post')}}">All News Post</a>
                        </li>
                        <li>
                            <a href="{{ route('add.news.post')}}">Add News Post</a>
                        </li>
@endif
                    </ul>
                </div>
            </li>

            <li>
                <a href="#banner" data-bs-toggle="collapse">
                    <i class="mdi mdi-cart-outline"></i>
                    <span> Banner Setting </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="banner">
                    <ul class="nav-second-level">
@if($hideMenu)
@else
                        <li>
                            <a href="{{ route('all.banners')}}">All Banner</a>
                        </li>
@endif
                    </ul>
                </div>
            </li>


            <li>
                <a href="#sidebarEmail" data-bs-toggle="collapse">
                    <i class="mdi mdi-email-multiple-outline"></i>
                    <span> Photo Setting </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEmail">
                    <ul class="nav-second-level">
                        <li>
                            <a href="{{ route('all.photo.gallery')}}">Photo Gallery</a>
                        </li>
                    </ul>
                </div>
            </li>

@if($hideMenu)
@else
            <li class="menu-title mt-2">Setting</li>

            <li>
                <a href="#sidebarAuth" data-bs-toggle="collapse">
                    <i class="mdi mdi-account-circle-outline"></i>
                    <span> Setting Admin User </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarAuth">
                    <ul class="nav-second-level">
                        <li>
                            <a href="{{ route('all.admin')}}">All Admin</a>
                        </li>
                        <li>
                            <a href="{{ route('add.admin')}}">Add Admin</a>
                        </li>
     
                    </ul>
                </div>
            </li>
@endif
            <li>
                <a href="#sidebarExpages" data-bs-toggle="collapse">
                    <i class="mdi mdi-text-box-multiple-outline"></i>
                    <span> 設定中 </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarExpages">
                    <ul class="nav-second-level">
                        <li>
                            <a href="pages-starter.html">Starter</a>
                        </li>
                        <li>
                            <a href="pages-timeline.html">Timeline</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="menu-title mt-2">Components</li>

            <li>
                <a href="#sidebarIcons" data-bs-toggle="collapse">
                    <i class="mdi mdi-bullseye"></i>
                    <span> 設定中 </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarIcons">
                    <ul class="nav-second-level">
                        <li>
                            <a href="icons-material-symbols.html">Material Symbols Icons</a>
                        </li>
                        <li>
                            <a href="icons-two-tone.html">Two Tone Icons</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <a href="#sidebarForms" data-bs-toggle="collapse">
                    <i class="mdi mdi-bookmark-multiple-outline"></i>
                    <span> 設定中 </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarForms">
                    <ul class="nav-second-level">
                        <li>
                            <a href="forms-elements.html">General Elements</a>
                        </li>
                        <li>
                            <a href="forms-advanced.html">Advanced</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>