<style>
    body{
        background:#f4f3ef;
    }

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
    .font1{
            font-family: 'Mitr', sans-serif;
    }
    @import url('https://fonts.googleapis.com/css2?family=Mitr&display=swap');
    </style>
<x-app-layout>
    <script>
    $(function(){
        $(".btn-toggle-menu").click(function() {
            $("#wrapper").toggleClass("toggled");
        });
    })
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
       <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
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
                        <a href="{{ url('/redirects')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{ url('/lead/profile')}}">โปรไฟล์</a>
                    </li>
                    <li>
                        <a href="{{ url('/lead/officer_table')}}">ข้อมูลพนักงาน</a>
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
                <h1 class="font1">
                    ระบบแจ้งลา
                </h1>
                <img src="https://1.bp.blogspot.com/-pekuU4dRkQI/V81nsELixeI/AAAAAAAA9ik/KNPV8OLpRj0-JSRCsM-O7NtOY_i5OpaHwCLcB/s450/business_crowdsourcing.png" alt="">

            </div>
        </div>

    </x-app-layout>
