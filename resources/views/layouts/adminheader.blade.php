<!DOCTYPE html>
<html lang="en">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8">
<head>

    <title>Shwe Khit</title>
    <!--    bootstrap css1 js1-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!--    fontawesome css1-->
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />--}}
    <link rel="stylesheet" href="{{asset('assets/libs/fontawesomepro/css/all.min.css')}}">

    <!-- css-->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />

{{--    custom css--}}
    <style type="text/css">
        @yield('css')
    </style>
</head>
<body>
