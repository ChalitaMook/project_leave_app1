<style>
            body{
            background:#f4f3ef;
        }
        .font1{
            font-family: 'Mitr', sans-serif;
    }
    @import url('https://fonts.googleapis.com/css2?family=Mitr&display=swap');


        #wrapper {
            padding-left: 0;
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        #wrapper.toggled {
            padding-left: 250px;
        }

        #sidebar-wrapper {
            z-index: 1000;
            position: fixed;
            left: 250px;
            width: 0;
            height: 100%;
            margin-left: -250px;
            overflow-y: auto;
            background:rgb(25, 24, 24);
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        #sidebar-wrapper {
            box-shadow: inset -1px 0px 0px 0px #DDDDDD;
        }

        #wrapper.toggled #sidebar-wrapper {
            width: 250px;
        }

        #page-content-wrapper {
            width: 100%;
            position: absolute;
            padding: 15px;
        }

        #wrapper.toggled #page-content-wrapper {
            position: absolute;
            margin-right: -250px;
        }

        /* Sidebar Styles */

        .sidebar-nav {
            position: absolute;
            top: 0;
            width: 250px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .sidebar-nav li {
            text-indent: 20px;
            line-height: 40px;
        }

        .sidebar-nav li a {
            display: block;
            text-decoration: none;
            color: #ffffff;
        }

        .sidebar-nav li a:hover {
            color: #479dff;
            text-decoration: none;
        }

        .sidebar-nav li a:active,
        .sidebar-nav li a:focus {
            text-decoration: none;
        }

        .sidebar-nav > .sidebar-brand {
            height: 65px;
            font-size: 18px;
            line-height: 60px;
        }

        .sidebar-nav > .sidebar-brand a {
            color: #2787f6;
        }

        .sidebar-nav > .sidebar-brand a:hover {
            color: rgb(255, 255, 255);
            background: none;
        }

        @media(min-width:768px) {
            #wrapper {
                padding-left: 250px;
            }

            #wrapper.toggled {
                padding-left: 0;
            }

            #sidebar-wrapper {
                width: 250px;
            }

            #wrapper.toggled #sidebar-wrapper {
                width: 0;
            }

            #page-content-wrapper {
                padding: 20px;
                position: relative;
            }

            #wrapper.toggled #page-content-wrapper {
                position: relative;
                margin-right: 0;
            }
        }

        #sidebar-wrapper li.active > a:after {
            border-right: 17px solid #f4f3ef;
            border-top: 17px solid transparent;
            border-bottom: 17px solid transparent;
            content: "";
            display: inline-block;
            position: absolute;
            right: -1px;
        }

        .sidebar-brand {
            border-bottom: 1px solid rgba(102, 97, 91, 0.3);
        }

        .sidebar-brand {
            padding: 18px 0px;
            margin: 0 20px;
        }

        .navbar .navbar-nav > li > a p {
            display: inline-block;
            margin: 0;
        }
        p {
            font-size: 16px;
            line-height: 1.4em;
        }

        .navbar-default {
            background-color: #f4f3ef;
            border:0px;
            border-bottom: 1px solid #DDDDDD;
        }

        btn-menu {
            border-radius: 3px;
            padding: 4px 12px;
            margin: 14px 5px 5px 20px;
            font-size: 14px;
            float: left;
        }
        .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        }

        @media (min-width: 768px) {
        .bd-placeholder-img-lg {
        font-size: 3.5rem;
        }
        }

        .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
        }

        .bi {
        vertical-align: -.125em;
        fill: currentColor;
        }

        .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
        }

        .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
        }
</style>

<x-app-layout>
<script>
$(function(){
$(".btn-toggle-menu").click(function() {
$("#wrapper").toggleClass("toggled");
});
})
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<meta name="description" content="">
<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
<meta name="generator" content="Hugo 0.104.2">
<title>Album example · Bootstrap v5.2</title>
<link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/album/">
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<br><br>
<div id="wrapper" class="wrapper-content">
<div id="sidebar-wrapper">
<ul class="sidebar-nav font1">
    <li class="sidebar-brand">
        <a href="#">
            Welcome:
            {{Auth::user()->name}}

        </a>
    </li>
    <li>
        <a href="{{ url('/redirects') }}">Home</a>
    </li>
    <li>
        <a href="{{ url('/lead/profile') }}">โปรไฟล์</a>
    </li>
    <li>
        <a href="{{ url('/lead/officer_table') }}">ข้อมูลพนักงาน</a>
    </li>
    <li>
        <a href="{{ url('/lead/leave_main') }}">แจ้งวันลา</a>
    </li>
    <li>
        <a href="{{ url('/lead/leave_table')}}">อนุมัติวันลา</a>
    </li>
    <li>
        <a href="{{ url('/lead/my_leave_table')}}">ดูรายการวันลาของตัวเอง</a>
    </li>

</ul>
</div>

<div id="page-content-wrapper">
<br><br><br>
<main>
    <div class="album py-5 bg-light font1">
      <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

          <div class="col">
            <div class="card shadow-sm">
                <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="../images/business_eigyou_man.png" alt="">
              <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ url('/lead/business_form') }}" class="stretched-link btn btn-primary btn-lg" >ลากิจ</a>                            </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card shadow-sm">
                <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="../images/sick_guai_warui_man.png" alt="">
              <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ url('/lead/sick_form') }}" class="stretched-link btn btn-primary btn-lg">ลาป่วย</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card shadow-sm">
                <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="../images/family_airplane_travel.png" alt="">
              <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ url('/lead/annual_form') }}" class="stretched-link btn btn-primary btn-lg">ลาพักร้อน</a>
                    </div>
                </div>
              </div>
            </div>
        </div>

  </main>
      <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

</div>
</div>

</x-app-layout>



