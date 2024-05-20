@include('layouts/adminheader')

@include('layouts/adminleftsidebar')


<!--Start Pannel Section-->
<section>
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 col-md-9 ms-auto">
                <div class="row pt-4 mt-5">
                    <div class="col-md-12">

                        @yield('content')

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--End Pannel Section-->

@include('layouts/adminfooter')
