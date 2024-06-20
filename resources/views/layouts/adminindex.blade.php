@include('layouts/adminheader')

@include('layouts/adminleftsidebar')


<!--Start Pannel Section-->
<section class="fixed-top z-0" style="height: 100vh;overflow-y: scroll;background: #f4f4f4;">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 col-md-9 ms-auto">
                <div class="row pt-3 pannelcons ms-auto">

                    @yield('content')

                </div>
            </div>

        </div>
    </div>
</section>
<!--End Pannel Section-->

@include('layouts/adminfooter')
