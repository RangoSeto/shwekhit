
<!--    Start Left Navbar-->

<nav class="navbar navbar-expand-md navbar-light ">
    <button type="button" class="navbar-toggler ms-auto bg-light" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div id="navbarNav" class="navbar-collapse collapse">
        <div class="container-fluid">
            <div class="row">

                <!--                    Start Left Sidebar-->
                <div class="col-lg-2 col-md-3 fixed-top overflow-auto sidebars">

                    <ul class="navbar-nav flex-column">

                        <div class="w-100 text-center">
                            <li class="brandname mt-2 pb-2">Shwe Khit</li>
                        </div>

                        <a href="{{route('items.index')}}" class="nav-item nav-link text-white py-2 px-3 mt-3 sidebarlinks current"><i class="far fa-box-full"></i> Items</a>
                        <a href="{{route('statuses.index')}}" class="nav-item nav-link text-white py-2 px-3 mt-2 sidebarlinks ">Statuses</a>
                        <a href="{{route('types.index')}}" class="nav-item nav-link text-white py-2 px-3 mt-2 sidebarlinks ">Types</a>
                        <a href="{{route('stockins.index')}}" class="nav-item nav-link text-white py-2 px-3 mt-2 sidebarlinks ">Stock In</a>
                        <a href="#" class="nav-item nav-link text-white py-2 px-3 mt-2 sidebarlinks">Transitions</a>

                        <li class="mt-2 pb-2 footerprofcons">
                            <p class="small text-center">&copy; copyright <span id="getyear"></span></p>
                            <div class="profilecons">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQFcaKmEWp9HygDkzP-Auoi2B4FGB9xu_otnAgk6Qw3vw&s" alt="image" class="me-2 profileimgs" />
                                <span>Admin</span>
                            </div>
                        </li>

                    </ul>

                </div>

                <!--                    End Left Sidebar-->

                <!--                    Start Top Sidebar-->
                <div class="col-lg-10 col-md-9 ms-auto fixed-top" style="background: #fff;">
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

