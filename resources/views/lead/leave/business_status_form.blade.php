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
    <h1 class="mb-2 text-primary">แจ้งวันลากิจ</h1>
    <br>
    <a href="{{ url('/lead/leave_table') }}" class="btn btn-secondary">Back</a>

</div>
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
<form action="{{url('/lead/business_status_update/'.$items1->id.$items1->user_id)}}" method="POST" enctype="multipart/form-data">
@csrf
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="form-group">
            <label for="title">หัวข้อ:</label><br>
            {{$items1->title}}
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="form-group">
            <br>
            <label for="detail">รายละเอียด:</label><br>
            {{$items1->detail}}
            <br>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="form-group">
            <label for="user_id">ผู้ลา:</label><br>
            {{$items1->user->name}} {{$items1->user->lastname}}
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="form-group">
            <label for="phone_num">เบอร์โทร:</label><br>
            {{$items1->phone_num}}
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="form-group">
                    <label for="contract_person">ผู้ติดต่อ:</label><br>
                    {{$items1->contract_person}}
                    <br>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="form-group">
            <label for="start_date">วันที่เริ่มลา:</label><br>
            {{$items1->start_date}}

        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="form-group">
            <label for="end_date">วันที่สิ้นสุด:</label><br>
            {{$items1->end_date}}
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="form-group">
            <label for="totaldate"> จำนวนวันลา:</label><br>
            {{$items1->totaldate}}
            <input type="hidden" name="totaldate" id="totaldate" value="{{$items1->totaldate}}">
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="form-group">
            <label for="created_at"> วันที่แจ้งลา:</label><br>
            {{$items1->created_at}}
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="form-group">
            <label for="attachment">เอกสารแนบ:</label>
            @if($items1->attachment== null)
                ---
            @else
                <a href="{{asset($items1->attachment)}}">เอกสารแนบ</a>
            @endif
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="form-group">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                    <br>
                    <label for="leader_status">ความเห็นจากหัวหน้า:</label><br>
                            <select class="form-select" aria-label="leader_status" id="leader_status" name="leader_status">
                                <option selected value="1" >อนุมัติ</option>
                                <option value="2">ไม่อนุมัติ</option>
                            </select>
                    <br>
                </div>
            </div>
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


