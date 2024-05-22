
{{--sweet alert--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--    jquery js1-->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" type="text/javascript"></script>
<!--    bootstrap css1 js1-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

{{--fontawesome css1 js1--}}
<script src="{{asset('assets/libs/fontawesomepro/js/all.min.js')}}"></script>
<!-- js-->
<script src="{{asset('assets/js/app.js')}}" type="text/javascript"></script>
{{--custom js--}}
@yield('js')

</body>
@yield('modal')
</html>
