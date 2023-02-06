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
        color: #fff;
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

    .main-box.no-header {
    padding-top: 20px;
    }
        .main-box {
            background: #FFFFFF;
            -webkit-box-shadow: 1px 1px 2px 0 #CCCCCC;
            -moz-box-shadow: 1px 1px 2px 0 #CCCCCC;
            -o-box-shadow: 1px 1px 2px 0 #CCCCCC;
            -ms-box-shadow: 1px 1px 2px 0 #CCCCCC;
            box-shadow: 1px 1px 2px 0 #CCCCCC;
            margin-bottom: 16px;
            -webikt-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }
        .table a.table-link.danger {
            color: #e74c3c;
        }
        .label {
            border-radius: 3px;
            font-size: 0.875em;
            font-weight: 600;
        }
        .user-list tbody td .user-subhead {
            font-size: 0.875em;
            font-style: italic;
        }
        .user-list tbody td .user-link {
            display: block;
            font-size: 1.25em;
            padding-top: 3px;
            margin-left: 60px;
        }
        a {
            color: #3498db;
            outline: none!important;
        }
        .user-list tbody td>img {
            position: relative;
            max-width: 50px;
            float: left;
            margin-right: 15px;
        }

        .table thead tr th {
            text-transform: uppercase;
            font-size: 0.875em;
        }
        .table thead tr th {
            border-bottom: 2px solid #e7ebee;
        }
        .table tbody tr td:first-child {
            font-size: 0.875em;
            font-weight: 300;
        }
        .table tbody tr td {
            font-size: 0.875em;
            vertical-align: middle;
            border-top: 1px solid #e7ebee;
            padding: 12px 8px;
        }
        a:hover{
        text-decoration:none;
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<br><br>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

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
        ตารางข้อมูลพนักงาน
    </h1>

<div>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<hr>
<div class="container bootstrap snippets bootdey">
<div class="row">
<div class="col-lg-12">
<div class="main-box no-header clearfix">
    <div class="main-box-body clearfix">
        <div class="table-responsive">
            <table class="table user-list">
                <thead>
                    <tr class="table-primary">
                    <th><span>ชื่อ</span></th>
                    <th><span>นามสกุล</span></th>
                    <th><span>ชื่อเล่น</span></th>
                    <th><span>อีเมล</span></th>
                    <th><span>เบอร์โทร</span></th>
                    <th><span>วันเกิด</span></th>
                    <th><span>ตำแหน่ง</span></th>
                    <th><span>แผนก</span></th>
                    <th><span>วันที่เริ่มงาน</span></th>
                    <th><span>วันที่ผ่านโปร</span></th>
                    <th><span>วันลากิจ</span></th>
                    <th><span>วันลาป่วย</span></th>
                    <th><span>วันลาพักร้อน</span></th>
                    <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($item as $item )
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->lastname}}</td>
                        <td >{{$item->nickname}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone_num}}</td>
                        <td> {{$item->birthdate->format('d/m/Y')}}</td>
                        @if ($item->role=='0')
                            <td>พนักงาน</td>
                        @elseif($item->role=='1')
                            <td>HR</td>
                        @else
                            <td>หัวหน้า</td>
                        @endif
                            </td>
                        <td>{{$item->department}}</td>
                        <td>{{$item->startdate->format('d/m/Y')}}</td>
                        <td>{{$item->prodate->format('d/m/Y')}}</td>
                        <td>{{$item->business_leave}}</td>
                        <td>{{$item->sick_leave}}</td>
                        <td>{{$item->annual_leave}}</td>
                    </tr>
                    @empty
                        <tr>
                        <td>no data</td>
                        </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>

</x-app-layout>

