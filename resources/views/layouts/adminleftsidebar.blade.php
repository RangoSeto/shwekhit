
<!--    Start Left Navbar-->

<nav class="navbar navbar-expand-md navbar-light ">

    <div class="container-fluid">
        <button type="button" class="navbar-toggler ms-auto bg-light" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navbarNav" class="navbar-collapse ">
                <div class="row">

                    <!--                    Start Left Sidebar-->
                    <div class="col-lg-2 col-md-3 fixed-top sidebars">

                        <ul class="navbar-nav flex-column">

                            <div class="w-100 text-center">
                                <li class="brandname mt-2 pb-2">Shwe Khit</li>
                            </div>

                            <li class="nav-item px-2 mt-3 "><a href="{{route('items.index')}}" class="nav-link text-white sidebarlinks {{ Str::startsWith(Route::currentRouteName(), 'items') ? 'current' : ''}}"><i class="far fa-box-full"></i> Items</a></li>

                            <li class="nav-item py-1 px-2 mt-2 "><a href="{{route('statuses.index')}}" class="nav-link text-white sidebarlinks {{ Str::startsWith(Route::currentRouteName(), 'statuses') ? 'current' : ''}}"><i class="far fa-tasks"></i> Statuses</a></li>
                            <li class="nav-item py-1 px-2 mt-2 "><a href="{{route('types.index')}}" class="nav-link text-white sidebarlinks {{ Str::startsWith(Route::currentRouteName(), 'types') ? 'current' : ''}}"><i class="fad fa-th-large"></i> Types</a></li>
                            <li class="nav-item py-1 px-2 mt-2 "><a href="{{route('paymenttypes.index')}}" class="nav-link text-white sidebarlinks {{ Str::startsWith(Route::currentRouteName(), 'paymenttypes') ? 'current' : ''}}"><i class="fas fa-money-check-edit-alt"></i> Payment Types</a></li>

                            <li class="nav-item py-1 px-2 mt-2 "><a href="{{route('stockins.index')}}" class="nav-link text-white sidebarlinks {{ Str::startsWith(Route::currentRouteName(), 'stockins') ? 'current' : ''}}"><i class="fas fa-industry-alt"></i> Stock In</a></li>
                            <li class="nav-item py-1 px-2 mt-2 "><a href="{{route('transitions.index')}}" class="nav-link text-white sidebarlinks {{ Str::startsWith(Route::currentRouteName(), 'transitions') ? 'current' : ''}}"><i class="fas fa-receipt"></i> Transitions</a></li>
                            <li class="nav-item py-1 px-2 mt-2 "><a href="{{route('monthlysales.index')}}" class="nav-link text-white sidebarlinks {{ Str::startsWith(Route::currentRouteName(), 'monthlysales') ? 'current' : ''}}"><i class="fas fa-calendar-check"></i> Monthly Sales</a></li>


                            <li class="mt-2 pb-2 sticky-bottom footerprofcons">
                                <p class="small text-center">&copy; copyright <span id="getyear"></span></p>
                                <div class="dropup">
                                    <div class="profilecons dropdown-toggle" data-bs-toggle="dropdown">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQFcaKmEWp9HygDkzP-Auoi2B4FGB9xu_otnAgk6Qw3vw&s" alt="image" class="me-2 profileimgs" />
                                        <span>Admin</span>
                                    </div>

                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item" onclick="document.getElementById('logoutform').submit();">Logout</li>
                                        <form action="{{route('logout')}}" method="POST" id="logoutform" >@csrf</form>
                                    </ul>
                                </div>
                            </li>

                        </ul>

                    </div>

                    <!--                    End Left Sidebar-->

                    <!--                    Start Top Sidebar-->
                    <div class="col-lg-10 col-md-9 ms-auto fixed-top topnavbar-cons" style="background: #fff;">
                        <div class="row">

                            <div class="col-md-12 topbars pt-3 pb-2">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{Request::root()}}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="{{url()->previous()}}">{{Str::title(preg_replace('/[[:punct:]]+[[:alnum:]]+/','',str_replace(\Request::root().'/','',url()->previous())))}}</a></li>
                                    <li class="breadcrumb-item active">{{ucfirst(Request::path())}}</li>
                                </ol>
                            </div>

                        </div>
                    </div>

                    <!--                    End Top Sidebar-->


            </div>
        </div>
    </div>
</nav>

<!--    End Left Navbar-->

