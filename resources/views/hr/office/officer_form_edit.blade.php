<style>
            body {
            margin: 0;
            padding-top: 40px;
            color: #2e323c;
            background: #f5f6fa;
            position: relative;
            height: 100%;
        }
        .account-settings .user-profile {
            margin: 0 0 1rem 0;
            padding-bottom: 1rem;
            text-align: center;
        }
        .account-settings .user-profile .user-avatar {
            margin: 0 0 1rem 0;
        }
        .account-settings .user-profile .user-avatar img {
            width: 90px;
            height: 90px;
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;
        }
        .account-settings .user-profile h5.user-name {
            margin: 0 0 0.5rem 0;
        }
        .account-settings .user-profile h6.user-email {
            margin: 0;
            font-size: 0.8rem;
            font-weight: 400;
            color: #9fa8b9;
        }
        .account-settings .about {
            margin: 2rem 0 0 0;
            text-align: center;
        }
        .account-settings .about h5 {
            margin: 0 0 15px 0;
            color: #007ae1;
        }
        .account-settings .about p {
            font-size: 0.825rem;
        }
        .form-control {
            border: 1px solid #cfd1d8;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            font-size: .825rem;
            background: #ffffff;
            color: #2e323c;
        }

        .card {
            background: #ffffff;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 0;
            margin-bottom: 1rem;
        }
</style>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">


<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap demo</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<div class="container" >
<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
<div class="card h-200">
<div class="card-body">
    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
    @endif
    <form action="{{url('/hr/officer_form_edit/update/'.$items->id)}}" method="POST">
        @csrf
                <div class="row gutters">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h2 class="mb-2 text-primary">แก้ไขข้อมูลพนักงาน</h2>
                                <a href="{{ url('/hr/officer_table') }}" class="btn btn-secondary">Back</a>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name">ชื่อ:</label><br>
                                    <input type="text" id="name" name="name" class="form-control" value="{{$items->name}}"><br>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="lastname">นามสกุล:</label><br>
                                    <input type="text" id="lastname" name="lastname" class="form-control" value="{{$items->lastname}}"><br>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="nickname">ชื่อเล่น:</label><br>
                                    <input type="text" id="nickname" name="nickname" class="form-control" value="{{$items->nickname}}"><br>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone_num">เบอร์โทรศัพท์:</label><br>
                                    <input type="text" minlength="10" maxlength="10" id="phone_num" name="phone_num" class="form-control" value="{{$items->phone_num}}"><br>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email">อีเมล:</label><br>
                                    <input type="text" id="email" name="email" class="form-control" value="{{$items->email}}" ><br>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password">รหัสผ่าน:</label><br>
                                    <input type="password" id="password" name="password" class="form-control"><br>
                                </div>
                            </div>
                            <i class="far fa-eye" id="togglePassword" style="margin-top:-50px; margin-left:780px; cursor: pointer;"></i>
                            <script>
                                const togglePassword = document.querySelector('#togglePassword');
                                const password = document.querySelector('#password');

                                togglePassword.addEventListener('click', function (e) {
                                    // toggle the type attribute
                                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                                    password.setAttribute('type', type);
                                    // toggle the eye slash icon
                                    this.classList.toggle('fa-eye-slash');
                                });
                            </script>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="role">ตำแหน่ง:</label><br>
                                    <select class="form-select" aria-label="role" id="role" name="role">
                                        <option value="{{$items->role}}"></option>
                                        <option value="0">พนักงาน</option>
                                        <option value="1">Hr</option>
                                        <option value="2">หัวหน้า</option>
                                    </select>
                                    <br>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="department">แผนก:</label>
                                    <select class="form-select " aria-label="department" id="department" name="department">
                                        <option value="{{$items->department}}"></option>
                                        <option value="operation">operation</option>
                                        <option value="dev">dev</option>
                                        <option value="product">product</option>
                                        <option value="HR">HR</option>
                                    </select>
                                    <br>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="birthdate">วันเกิด:</label><br>
                                    <input type="text" name="birthdate" value="{{ $items->birthdate->format('m/d/Y') }}" class="form-control" />
                                    <script>
                                    $(function() {
                                    $('input[name="birthdate"]').daterangepicker({
                                        singleDatePicker: true,
                                    },);
                                    });
                                    </script>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">

                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <br>
                                    <label for="startdate">วันที่เริ่มงาน:</label><br>
                                    <input type="text" name="startdate" value="{{ $items->startdate->format('m/d/Y') }}" class="form-control" />
                                    <script>
                                    $(function() {
                                    $('input[name="startdate"]').daterangepicker({
                                        singleDatePicker: true,
                                    },);
                                    });
                                    </script>
                                    <br>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <br>
                                    <label for="prodate">วันที่ผ่านโปร:</label><br>
                                    <input type="text" name="prodate" value="{{ $items->prodate->format('m/d/Y') }}" class="form-control" />
                                    <script>
                                    $(function() {
                                    $('input[name="birthdate"]').daterangepicker({
                                        singleDatePicker: true,
                                    },);
                                    });
                                    </script>
                                </div>
                            </div>
                </div>
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h6 class="mt-3 mb-2 text-primary">วันลา</h6>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="annual_leave">วันลาพักร้อน:</label><br>
                            <input type="text" id="annual_leave" name="annual_leave" class="form-control" value="{{$items->annual_leave}}" ><br>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="sick_leave">วันลาป่วย:</label><br>
                            <input type="text" id="sick_leave" name="sick_leave" class="form-control" value="{{$items->sick_leave}}"><br>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="business_leave">วันลากิจ:</label><br>
                            <input type="text" id="business_leave" name="business_leave" class="form-control" value="{{$items->business_leave}}"><br>
                        </div>
                    </div>
                </div>
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="text-right">
                            <br>
                            <input type="submit" value="บันทึก" class="btn btn-primary">
                        </div>
                    </div>
                </div>
    </form>
</div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
