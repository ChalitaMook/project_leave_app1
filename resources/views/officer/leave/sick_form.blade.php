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
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <h1 class="mb-2 text-primary">ฟอร์มแจ้งวันลาป่วย</h1>
            <br>
            <a href="{{ url('/officer/leave_main') }}" class="btn btn-secondary">กลับ</a>

        </div>
    <div class="card h-200">
    <div class="card-body">
        @if (Auth::user()->sick_leave =='0')
            <div class="alert alert-danger" role="alert">
                วันลาคงเหลือ 0 วัน ไม่สามารถลาได้
            </div>
            <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
                <fieldset disabled>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="title">หัวข้อ</label><br>
                                <input type="text" id="title" name="title" class="form-control"><br>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="detail">รายละเอียด:</label><br>
                                <textarea name="detail" id="detail" cols="30" rows="3" class="form-control" ></textarea>
                                <br>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="phone_num">เบอร์โทร:</label><br>
                                <input type="text" id="phone_num" name="phone_num" class="form-control" value="{{Auth::user()->phone_num}}"><br>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">ผู้ติดต่อ:</label><br>
                                        <select class="form-select" aria-label="" id="" name="">
                                            <option selected>-</option>
                                        </select>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="start_date">วันที่เริ่มลา:</label><br>
                                <input type="text" name="start_date" value="{{old('start_date')}}" class="form-control" />
                                <script>
                                $(function() {
                                $('input[name="start_date"]').daterangepicker({
                                    singleDatePicker: true,
                                    isInvalidDate: function(date) {
                                    if (date.day() == 0 || date.day() == 6)
                                    return true;
                                    return false;
                                }
                                },);
                                });
                                </script>
                            </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="end_date">วันที่สิ้นสุด:</label><br>
                                <input type="text" name="end_date" value="{{old('end_date')}}" class="form-control" />
                                <script>
                                    $(function() {
                                    $('input[name="end_date"]').daterangepicker({
                                        singleDatePicker: true,
                                        isInvalidDate: function(date) {
                                        if (date.day() == 0 || date.day() == 6)
                                        return true;
                                        return false;
                                    }
                                    },);
                                    });
                                    </script>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <br>
                                        <input class="form-check-input" type="checkbox" value="check" id="flexCheckDefault" name="halfday">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            ลาครึ่งวัน
                                        </label>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="attachment">อัพโหลดเอกสาร:</label><br>
                                <input type="file" id="attachment" name="attachment" class="form-control" ><br>
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
                </fieldset disabled>
        @else
            <div class="alert alert-success" role="alert">
                วันลาคงเหลือ {{Auth::user()->sick_leave}} วัน
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
        @endif
                    <form action="{{url('/officer/sick_form/store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row gutters">
                        <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}" >
                        <input type="hidden" id="department" name="department" value="{{Auth::user()->department}}" >
                        <input type="hidden" id="type_id" name="type_id" value="2" >{{-- ประเภทลา --}}
                        <input type="hidden" id="leader_status" name="leader_status" value="0" > {{-- ความเห็นหัวหน้า --}}
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label for="title">หัวข้อ:</label><br>
                        <input type="text" id="title" name="title" class="form-control" value="{{old('title')}}"><br>
                    </div>
                    </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                    <label for="detail">รายละเอียด:</label><br>
                    <textarea name="detail" id="detail" cols="30" rows="3" class="form-control" >{{old('detail')}}</textarea>
                    <br>
                </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="phone_num">เบอร์โทร:</label><br>
                    <input type="text" maxlength="10" id="phone_num" name="phone_num" class="form-control" value="{{Auth::user()->phone_num}}"><br>
                </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">ผู้ติดต่อ:</label><br>
                            <select class="form-select" aria-label="contract_person" id="contract_person" name="contract_person">
                                <option selected>-</option>
                                @foreach ($items as $item)
                                    <option value="{{$item->name}} {{$item->lastname}}">{{$item->name}} {{$item->lastname}}</option>
                                @endforeach
                            </select>
                            <br>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="start_date">วันที่เริ่มลา:</label><br>
                    <input type="text" name="start_date" value="{{old('start_date')}}" class="form-control" />
                    <script>
                    $(function() {
                    $('input[name="start_date"]').daterangepicker({
                        singleDatePicker: true,
                        isInvalidDate: function(date) {
                        if (date.day() == 0 || date.day() == 6)
                        return true;
                        return false;
                    }
                    },);
                    });
                    </script>
                </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="end_date">วันที่สิ้นสุด:</label><br>
                    <input type="text" name="end_date" value="{{old('end_date')}}" class="form-control" />
                    <script>
                        $(function() {
                        $('input[name="end_date"]').daterangepicker({
                            singleDatePicker: true,
                            isInvalidDate: function(date) {
                            if (date.day() == 0 || date.day() == 6)
                            return true;
                            return false;
                        }
                        },);
                        });
                        </script>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <div class="form-check">
                            <br>
                            <input class="form-check-input" type="checkbox" value="check" id="flexCheckDefault" name="halfday">
                            <label class="form-check-label" for="flexCheckDefault">
                                ลาครึ่งวัน
                            </label>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="attachment">อัพโหลดเอกสาร:</label><br>
                    <input type="file" id="attachment" name="attachment" class="form-control" ><br>
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
        @endif

</div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>


