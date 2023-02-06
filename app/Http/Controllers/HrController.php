<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Leave_list;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HrController extends Controller
{
    public function profile(){
        $role= Auth::user()->role;
        if($role=='0'){
            $rolename= "พนักงาน";
        }elseif($role=='1'){
            $rolename="HR";
        }else{
            $rolename="หัวหน้า";
        }
        return view('hr.profile')->with('rolename',$rolename);
    }

    public function officer_table(){
        $item=User::orderby('id','DESC')->get();
        return view('hr.office.officer_table',compact('item'));
    }
    public function officer_form(){
        return view('hr.office.officer_form');
    }
    public function store(Request $req){
        $req->validate([
            'name'=>'required',
            'lastname'=>'required',
            'nickname'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|min:8',
            'department'=>'required',
            'phone_num'=>'required|numeric|digits:10',
            'birthdate'=>'required',
            'startdate'=>'required',
            'role'=>'required'
        ],
        [
            'name.required'=>"กรุณากรอกชื่อ",
            'lastname.required'=>"กรุณากรอกนามสกุล",
            'nickname.required'=>"กรุณากรอกชื่อเล่น",
            'email.required'=>"กรุณากรอกอีเมล",
            'email.unique'=>"อีเมลนี้มีอยู่แล้ว",
            'password.required'=>"กรุณากรอกรหัสผ่าน",
            'phone_num.required'=>"กรุณากรอกเบอร์โทรศัพท์",
            'phone_num.numeric'=>"เบอร์โทรศัพท์ต้องเป็นตัวเลข",
            'birthdate.required'=>"กรุณากรอกวันเกิด",
            'startdate.required'=>"กรุณากรอกวันที่เริ่มงาน",
            'role.required'=>"กรุณากรอกตำแหน่ง",
            'department.required'=>"กรุณากรอกแผนก",

        ]
            );

        $item = new User;
        $item->name = $req->name;
        $item->lastname = $req->lastname;
        $item->nickname = $req->nickname;
        $item->email = $req->email;
        $item->password = Hash::make($req->password);
        $item->role = $req->role;
        $item->department = $req->department;
        $item->phone_num = $req->phone_num;

        $item->birthdate = date("Y-m-d", strtotime($req->birthdate));
        $item->startdate = date("Y-m-d", strtotime($req->startdate));
        //เช็ควันผ่านโปร ต้องหลังเริ่มงานสามเดือน
        $date1 = date("Y-m-d", strtotime("$req->startdate+3 month"));
        $item->prodate = $date1;

        $ts1 = strtotime($date1);
        $ts2 = strtotime("now");

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
        if($diff<=0){
            $cal=0;
            $item->annual_leave = $cal;


        }elseif($diff>12){
            $cal=6;
            $item->annual_leave = $cal;

        }
        else{
            $cal = $diff/2;
            $item->annual_leave = $cal;

        }

        $item->sick_leave = $req->sick_leave;
        $item->business_leave = $req->business_leave;
        $item->save();

        return redirect('/hr/officer_table');
    }
    public function officer_form_edit($id){

        $items = User::find($id);
        return view('hr.office.officer_form_edit',compact('items'));
    }
    public function update(Request $req,$id){
        $req->validate([
            'name'=>'required',
            'lastname'=>'required',
            'nickname'=>'required',
            'email'=>'required',
            'password'=>'required|min:8',
            'department'=>'required',
            'phone_num'=>'required|numeric|digits:10',
            'birthdate'=>'required',
            'startdate'=>'required',
            'role'=>'required'
            ],
            [
                'name.required'=>"กรุณากรอกชื่อ",
                'lastname.required'=>"กรุณากรอกนามสกุล",
                'nickname.required'=>"กรุณากรอกชื่อเล่น",
                'email.required'=>"กรุณากรอกอีเมล",
                'password.required'=>"กรุณากรอกรหัสผ่าน",
                'phone_num.required'=>"กรุณากรอกเบอร์โทรศัพท์",
                'phone_num.numeric'=>"เบอร์โทรศัพท์ต้องเป็นตัวเลข",
                'birthdate.required'=>"กรุณากรอกวันเกิด",
                'startdate.required'=>"กรุณากรอกวันที่เริ่มงาน",
                'role.required'=>"กรุณากรอกตำแหน่ง",
                'department.required'=>"กรุณากรอกแผนก",
            ]
            );

        $item = User::find($id);
        $item->name = $req->name;
        $item->lastname = $req->lastname;
        $item->nickname = $req->nickname;
        $item->email = $req->email;
        $item->password = Hash::make($req->password);
        $item->role = $req->role;
        $item->department = $req->department;
        $item->phone_num = $req->phone_num;
        $item->birthdate = $req->birthdate;
        $item->startdate = $req->startdate;
        $item->prodate = $req->prodate;
        $item->annual_leave = $req->annual_leave;
        $item->sick_leave = $req->sick_leave;
        $item->business_leave = $req->business_leave;
        $item->save();
        return redirect('/hr/officer_table');
    }
    public function delete($id){
        $delete=User::find($id)->forceDelete();
        $deletedata = Leave_list::where('user_id',$id)->forceDelete();
        return redirect('/hr/officer_table');

    }

    public function main(){
        return view('hr.main');
    }

    public function sick_form(){
        $id = Auth::user()->id;
        $department = Auth::user()->department;
        $items = User::where('department',$department)->whereNotIn('id', [$id])->get();
        return view('hr.leave.sick_form',compact('items'));
    }
    public function sick_form_store(Request $req){

        $req->validate([
            'title'=>'required',
            'detail'=>'required',
            'start_date'=>'required',
            'end_date'=>'required|date|after_or_equal:start_date',
            'phone_num'=>'required|numeric|digits:10',
            'leader_status'=>'required',
            'type_id'=>'required',
            'user_id'=>'required',
            ],
            [
                'title.required'=>"กรุณากรอกหัวข้อ",
                'detail.required'=>"กรุณากรอกรายละเอียด",
                'start_date.required'=>"กรุณาใส่วันที่เริ่มลา",
                'end_date.required'=>"กรุณาใส่วันที่สิ้นสุด",
                'phone_num.required'=>"กรุณาเบอร์โทรศัพท์",
                'end_date.after_or_equal'=>"วันที่สิ้นสุดต้องเป็นวันเดียวกันหรือหลังวันที่เริ่มลา",
            ]
            );
            $item = new Leave_list;
            $attachment;
            if($attachment=$req->file('attachment')){
                $attachment=$req->file('attachment');
                $attachment_gen=hexdec(uniqid()); //แปลง
                $attachment_ext=strtolower($attachment->getClientOriginalExtension()); //นามสกุลไฟล์
                $attachment_name=$attachment_gen.'.'.$attachment_ext;
                $upload_location='public/attachment/';
                $attachment->move($upload_location,$attachment_name);
                $full_path=$upload_location.$attachment_name;
                $item->attachment = $full_path;
            }elseif($attachment == null){
                    //
            }

            $item->title = $req->title;
            $item->detail = $req->detail;
            $item->start_date =date("Y-m-d", strtotime($req->start_date));
            $item->end_date = date("Y-m-d", strtotime($req->end_date));
            $datestart = $req->start_date;
            $dateend = $req->end_date;
            $item->phone_num = $req->phone_num;
            $item->contract_person = $req->contract_person;
            $item->leader_status = $req->leader_status;
            $item->type_id = $req->type_id;
            $item->user_id = $req->user_id;
            $item->department = $req->department;

            //คำนวนวันลา ตัดเสา-อา
            $strStartDate = $req->start_date;
            $strEndDate = $req->end_date;

            $intWorkDay = 0;
            $intHoliday = 0;
            $intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate))/  ( 60 * 60 * 24 )) + 1;

               while (strtotime($strStartDate) <= strtotime($strEndDate)) {

                   $DayOfWeek = date("w", strtotime($strStartDate));
                   if($DayOfWeek == 0 or $DayOfWeek ==6)  // 0 = Sunday, 6 = Saturday;
                   {
                       $intHoliday++;
                   }
                   else
                   {
                       $intWorkDay++;
                   }
                   $strStartDate = date ("Y-m-d", strtotime("+1 day", strtotime($strStartDate)));
               }
             $date1 = Auth::user()->sick_leave;
             if($req->has('halfday')){
                $totaldate=$intWorkDay-0.5;
             }else{
                $totaldate=$intWorkDay;
             }
            if($date1 < $totaldate ){
                return redirect()->back()->withInput()->with('error', 'จำนวนวันที่แจ้งลามากกว่าวันลาคงเหลือ');
            }else{

                    $item->totaldate = $totaldate;
                    $item->save();
                    return redirect('/hr/my_leave_table');
             }


    }
    public function sick_form_edit($id){

        $items1 = Leave_list::find($id);
        $id = Auth::user()->id;
        $department = Auth::user()->department;
        $items2 = User::where('department',$department)->whereNotIn('id', [$id])->get();
        return view('hr.leave.sick_form_edit',compact('items1','items2'));
    }
    public function sick_form_update(Request $req,$id){

        $req->validate([
            'title'=>'required',
            'detail'=>'required',
            'start_date'=>'required',
            'end_date'=>'required|date|after_or_equal:start_date',
            'phone_num'=>'required|numeric|digits:10',
            'leader_status'=>'required',
            'type_id'=>'required',
            'user_id'=>'required',
            ],
            [
                'title.required'=>"กรุณากรอกหัวข้อ",
                'detail.required'=>"กรุณากรอกรายละเอียด",
                'start_date.required'=>"กรุณาใส่วันที่เริ่มลา",
                'end_date.required'=>"กรุณาใส่วันที่สิ้นสุด",
                'phone_num.required'=>"กรุณาเบอร์โทรศัพท์",
                'end_date.after_or_equal'=>"วันที่สิ้นสุดต้องเป็นวันเดียวกันหรือหลังวันที่เริ่มลา",
            ]
            );
            $item = Leave_list::find($id);;
            $attachment;
            if($attachment=$req->file('attachment')){
                $attachment=$req->file('attachment');
                $attachment_gen=hexdec(uniqid()); //แปลง
                $attachment_ext=strtolower($attachment->getClientOriginalExtension()); //นามสกุลไฟล์
                $attachment_name=$attachment_gen.'.'.$attachment_ext;
                $upload_location='public/attachment/';
                $attachment->move($upload_location,$attachment_name);
                $full_path=$upload_location.$attachment_name;
                $item->attachment = $full_path;
            }elseif($attachment == null){

            }

            $item->title = $req->title;
            $item->detail = $req->detail;
            $item->phone_num = $req->phone_num;
            $item->contract_person = $req->contract_person;
            $item->leader_status = $req->leader_status;
            $item->type_id = $req->type_id;
            $item->user_id = $req->user_id;
            $item->department = $req->department;
            $item->start_date =date("Y-m-d", strtotime($req->start_date));
            $item->end_date = date("Y-m-d", strtotime($req->end_date));

            //คำนวนวันลา ตัดเสา-อา
            $strStartDate = $req->start_date;
            $strEndDate = $req->end_date;

            $intWorkDay = 0;
            $intHoliday = 0;
            $intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate))/  ( 60 * 60 * 24 )) + 1;

               while (strtotime($strStartDate) <= strtotime($strEndDate)) {

                   $DayOfWeek = date("w", strtotime($strStartDate));
                   if($DayOfWeek == 0 or $DayOfWeek ==6)  // 0 = Sunday, 6 = Saturday;
                   {
                       $intHoliday++;
                   }
                   else
                   {
                       $intWorkDay++;
                   }
                   $strStartDate = date ("Y-m-d", strtotime("+1 day", strtotime($strStartDate)));
               }
             $date1 = Auth::user()->sick_leave;
             if($req->has('halfday')){
                $totaldate=$intWorkDay-0.5;
             }else{
                $totaldate=$intWorkDay;
             }
            if($date1 < $totaldate ){
                return redirect()->back()->withInput()->with('error', 'จำนวนวันที่แจ้งลามากกว่าวันลาคงเหลือ');
            }else{

                    $item->totaldate = $totaldate;
                    $item->save();
                    return redirect('/hr/my_leave_table');
             }
    }
    public function sick_form_delete($id){
        $delete=Leave_list::find($id)->forceDelete();
        return redirect('/hr/my_leave_table');
    }


    public function business_form(){
        $id = Auth::user()->id;
        $department = Auth::user()->department;
        $items = User::where('department',$department)->whereNotIn('id', [$id])->get();
        return view('hr.leave.business_form',compact('items'));
    }
    public function business_form_store(Request $req){

        $req->validate([
            'title'=>'required',
            'detail'=>'required',
            'start_date'=>'required',
            'end_date'=>'required|date|after_or_equal:start_date',
            'phone_num'=>'required|numeric|digits:10',
            'leader_status'=>'required',
            'type_id'=>'required',
            'user_id'=>'required',
            ],
            [
                'title.required'=>"กรุณากรอกหัวข้อ",
                'detail.required'=>"กรุณากรอกรายละเอียด",
                'start_date.required'=>"กรุณาใส่วันที่เริ่มลา",
                'end_date.required'=>"กรุณาใส่วันที่สิ้นสุด",
                'phone_num.required'=>"กรุณาเบอร์โทรศัพท์",
                'end_date.after_or_equal'=>"วันที่สิ้นสุดต้องเป็นวันเดียวกันหรือหลังวันที่เริ่มลา",
            ]
            );
            $item = new Leave_list;
            $attachment;
            if($attachment=$req->file('attachment')){
                $attachment=$req->file('attachment');
                $attachment_gen=hexdec(uniqid()); //แปลง
                $attachment_ext=strtolower($attachment->getClientOriginalExtension()); //นามสกุลไฟล์
                $attachment_name=$attachment_gen.'.'.$attachment_ext;
                $upload_location='public/attachment/';
                $attachment->move($upload_location,$attachment_name);
                $full_path=$upload_location.$attachment_name;
                $item->attachment = $full_path;
            }elseif($attachment == null){

            }

            $item->title = $req->title;
            $item->detail = $req->detail;
            $item->start_date =date("Y-m-d", strtotime($req->start_date));
            $item->end_date = date("Y-m-d", strtotime($req->end_date));
            $item->phone_num = $req->phone_num;
            $item->contract_person = $req->contract_person;
            $item->leader_status = $req->leader_status;
            $item->type_id = $req->type_id;
            $item->user_id = $req->user_id;
            $item->department = $req->department;

            //คำนวนวันลา ตัดเสา-อา
            $strStartDate = $req->start_date;
            $strEndDate = $req->end_date;

            $intWorkDay = 0;
            $intHoliday = 0;
            $intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate))/  ( 60 * 60 * 24 )) + 1;

               while (strtotime($strStartDate) <= strtotime($strEndDate)) {

                   $DayOfWeek = date("w", strtotime($strStartDate));
                   if($DayOfWeek == 0 or $DayOfWeek ==6)  // 0 = Sunday, 6 = Saturday;
                   {
                       $intHoliday++;
                   }
                   else
                   {
                       $intWorkDay++;
                   }
                   $strStartDate = date ("Y-m-d", strtotime("+1 day", strtotime($strStartDate)));
               }
             $date1 = Auth::user()->business_leave;
             if($req->has('halfday')){
                $totaldate=$intWorkDay-0.5;
             }else{
                $totaldate=$intWorkDay;
             }
            if($date1 < $totaldate ){
                return redirect()->back()->withInput()->with('error', 'จำนวนวันที่แจ้งลามากกว่าวันลาคงเหลือ');
            }else{

                    $item->totaldate = $totaldate;
                    $item->save();
                    return redirect('/hr/my_leave_table');
             }
    }
    public function business_form_edit($id){
        $items1 = Leave_list::find($id);
        $id = Auth::user()->id;
        $department = Auth::user()->department;
        $items2 = User::where('department',$department)->whereNotIn('id', [$id])->get();
        return view('hr.leave.business_form_edit',compact('items1','items2'));
    }
    public function business_form_update(Request $req,$id){

        $req->validate([
            'title'=>'required',
            'detail'=>'required',
            'start_date'=>'required',
            'end_date'=>'required|date|after_or_equal:start_date',
            'phone_num'=>'required|numeric|digits:10',
            'leader_status'=>'required',
            'type_id'=>'required',
            'user_id'=>'required',
            ],
            [
                'title.required'=>"กรุณากรอกหัวข้อ",
                'detail.required'=>"กรุณากรอกรายละเอียด",
                'start_date.required'=>"กรุณาใส่วันที่เริ่มลา",
                'end_date.required'=>"กรุณาใส่วันที่สิ้นสุด",
                'phone_num.required'=>"กรุณาเบอร์โทรศัพท์",
                'end_date.after_or_equal'=>"วันที่สิ้นสุดต้องเป็นวันเดียวกันหรือหลังวันที่เริ่มลา",
            ]
            );
            $item = Leave_list::find($id);;
            $attachment;
            if($attachment=$req->file('attachment')){
                $attachment=$req->file('attachment');
                $attachment_gen=hexdec(uniqid()); //แปลง
                $attachment_ext=strtolower($attachment->getClientOriginalExtension()); //นามสกุลไฟล์
                $attachment_name=$attachment_gen.'.'.$attachment_ext;
                $upload_location='public/attachment/';
                $attachment->move($upload_location,$attachment_name);
                $full_path=$upload_location.$attachment_name;
                $item->attachment = $full_path;
            }elseif($attachment == null){

            }

            $item->title = $req->title;
            $item->detail = $req->detail;
            $item->start_date =date("Y-m-d", strtotime($req->start_date));
            $item->end_date = date("Y-m-d", strtotime($req->end_date));
            $item->phone_num = $req->phone_num;
            $item->contract_person = $req->contract_person;
            $item->leader_status = $req->leader_status;
            $item->type_id = $req->type_id;
            $item->user_id = $req->user_id;
            $item->department = $req->department;
            $strStartDate = $req->start_date;
            $strEndDate = $req->end_date;

            $intWorkDay = 0;
            $intHoliday = 0;
            $intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate))/  ( 60 * 60 * 24 )) + 1;

            while (strtotime($strStartDate) <= strtotime($strEndDate)) {

                $DayOfWeek = date("w", strtotime($strStartDate));
                if($DayOfWeek == 0 or $DayOfWeek ==6)  // 0 = Sunday, 6 = Saturday;
                {
                    $intHoliday++;
                }
                else
                {
                    $intWorkDay++;
                }
                $strStartDate = date ("Y-m-d", strtotime("+1 day", strtotime($strStartDate)));
            }
            $date1 = Auth::user()->business_leave;
            if($req->has('halfday')){
                $totaldate=$intWorkDay-0.5;
             }else{
                $totaldate=$intWorkDay;
             }
            if($date1 < $totaldate ){
                return redirect()->back()->withInput()->with('error', 'จำนวนวันที่แจ้งลามากกว่าวันลาคงเหลือ');
            }else{

                    $item->totaldate = $totaldate;
                    $item->save();
                    return redirect('/hr/my_leave_table');
             }

    }
    public function business_form_delete($id){
        $delete=Leave_list::find($id)->forceDelete();
        return redirect('/hr/my_leave_table');
    }

    public function annual_form(){
        $id = Auth::user()->id;
        $department = Auth::user()->department;
        $items = User::where('department',$department)->whereNotIn('id', [$id])->get();
        return view('hr.leave.annual_form',compact('items'));
    }
    public function annual_form_store(Request $req){

        $req->validate([
            'title'=>'required',
            'detail'=>'required',
            'start_date'=>'required|date|after:tomorrow',
            'end_date'=>'required|date|after_or_equal:start_date',
            'phone_num'=>'required',
            'leader_status'=>'required',
            'type_id'=>'required',
            'user_id'=>'required',
            ],
            [
                'title.required'=>"กรุณากรอกหัวข้อ",
                'detail.required'=>"กรุณากรอกรายละเอียด",
                'start_date.required'=>"กรุณาใส่วันที่เริ่มลา",
                'end_date.required'=>"กรุณาใส่วันที่สิ้นสุด",
                'phone_num.required'=>"กรุณาเบอร์โทรศัพท์",
                'start_date.after'=>"ต้องลาล่วงหน้าสามวัน",
                'end_date.after_or_equal'=>"วันที่สิ้นสุดต้องเป็นวันเดียวกันหรือหลังวันที่เริ่มลา",
            ]
            );

            $item = new Leave_list;
            $item->title = $req->title;
            $item->detail = $req->detail;
            $item->start_date =date("Y-m-d", strtotime($req->start_date));
            $item->end_date = date("Y-m-d", strtotime($req->end_date));
            $item->phone_num = $req->phone_num;
            $item->contract_person = $req->contract_person;
            $item->leader_status = $req->leader_status;
            $item->type_id = $req->type_id;
            $item->user_id = $req->user_id;
            $item->department = $req->department;

            //คำนวนวันลา ตัดเสา-อา
            $strStartDate = $req->start_date;
            $strEndDate = $req->end_date;

            $intWorkDay = 0;
            $intHoliday = 0;
            $intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate))/  ( 60 * 60 * 24 )) + 1;

               while (strtotime($strStartDate) <= strtotime($strEndDate)) {

                   $DayOfWeek = date("w", strtotime($strStartDate));
                   if($DayOfWeek == 0 or $DayOfWeek ==6)  // 0 = Sunday, 6 = Saturday;
                   {
                       $intHoliday++;
                   }
                   else
                   {
                       $intWorkDay++;
                   }
                   $strStartDate = date ("Y-m-d", strtotime("+1 day", strtotime($strStartDate)));
               }
             $date1 = Auth::user()->annual_leave;
             if($req->has('halfday')){
                $totaldate=$intWorkDay-0.5;
             }else{
                $totaldate=$intWorkDay;
             }
            if($date1 < $totaldate ){
                return redirect()->back()->withInput()->with('error', 'จำนวนวันที่แจ้งลามากกว่าวันลาคงเหลือ');
            }else{

                    $item->totaldate = $totaldate;
                    $item->save();
                    return redirect('/hr/my_leave_table');
             }
        }

    public function annual_form_edit($id){
        $items1 = Leave_list::find($id);
        $id = Auth::user()->id;
        $department = Auth::user()->department;
        $items2 = User::where('department',$department)->whereNotIn('id', [$id])->get();
        return view('hr.leave.annual_form_edit',compact('items1','items2'));
    }
    public function annual_form_update(Request $req,$id){

        $req->validate([
            'title'=>'required',
            'detail'=>'required',
            'start_date'=>'required|date|after:tomorrow',
            'end_date'=>'required|date|after_or_equal:start_date',
            'phone_num'=>'required',
            'leader_status'=>'required',
            'type_id'=>'required',
            'user_id'=>'required',
            ],
            [
                'title.required'=>"กรุณากรอกหัวข้อ",
                'detail.required'=>"กรุณากรอกรายละเอียด",
                'start_date.required'=>"กรุณาใส่วันที่เริ่มลา",
                'end_date.required'=>"กรุณาใส่วันที่สิ้นสุด",
                'phone_num.required'=>"กรุณาเบอร์โทรศัพท์",
                'start_date.after'=>"ต้องลาล่วงหน้าสามวัน",
                'end_date.after_or_equal'=>"วันที่สิ้นสุดต้องเป็นวันเดียวกันหรือหลังวันที่เริ่มลา",
            ]
            );

            $item = Leave_list::find($id);
            $item->title = $req->title;
            $item->detail = $req->detail;
            $item->start_date =date("Y-m-d", strtotime($req->start_date));
            $item->end_date = date("Y-m-d", strtotime($req->end_date));
            $item->phone_num = $req->phone_num;
            $item->contract_person = $req->contract_person;
            $item->leader_status = $req->leader_status;
            $item->type_id = $req->type_id;
            $item->user_id = $req->user_id;
            $item->department = $req->department;
            $strStartDate = $req->start_date;
            $strEndDate = $req->end_date;

            $intWorkDay = 0;
            $intHoliday = 0;
            $intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate))/  ( 60 * 60 * 24 )) + 1;

               while (strtotime($strStartDate) <= strtotime($strEndDate)) {

                   $DayOfWeek = date("w", strtotime($strStartDate));
                   if($DayOfWeek == 0 or $DayOfWeek ==6)  // 0 = Sunday, 6 = Saturday;
                   {
                       $intHoliday++;
                   }
                   else
                   {
                       $intWorkDay++;
                   }
                   $strStartDate = date ("Y-m-d", strtotime("+1 day", strtotime($strStartDate)));
               }
             $date1 = Auth::user()->annual_leave;
             if($req->has('halfday')){
                $totaldate=$intWorkDay-0.5;
             }else{
                $totaldate=$intWorkDay;
             }
            if($date1 < $totaldate ){
                return redirect()->back()->withInput()->with('error', 'จำนวนวันที่แจ้งลามากกว่าวันลาคงเหลือ');
            }else{

                    $item->totaldate = $totaldate;
                    $item->save();
                    return redirect('/hr/my_leave_table');
             }
    }
    public function annual_form_delete($id){
        $delete=Leave_list::find($id)->forceDelete();
        return redirect('/hr/my_leave_table');
    }


    public function leave_table(){
        $items1 = Leave_list::where('type_id','1')->paginate(5);
        $items2 = Leave_list::where('type_id','2')->paginate(5);
        $items3 = Leave_list::where('type_id','3')->paginate(5);

        return view('hr.leave.leave_table',compact('items1','items2','items3'));
    }


    public function my_leave_table(){
        $id = Auth::user()->id;
        $items1 = Leave_list::where('user_id',$id)->where('leader_status','0')->where('type_id','1')->paginate(5);
        $items2 = Leave_list::where('user_id',$id)->where('leader_status','0')->where('type_id','2')->paginate(5);
        $items3 = Leave_list::where('user_id',$id)->where('leader_status','0')->where('type_id','3')->paginate(5);
        return view('hr.leave.my_leave_table',compact('items1','items2','items3'));
    }
    public function my_leave_table_approve(){
        $id = Auth::user()->id;
        $items1 = Leave_list::where('user_id',$id)->where('leader_status','1')->where('type_id','1')->paginate(5);
        $items2 = Leave_list::where('user_id',$id)->where('leader_status','1')->where('type_id','2')->paginate(5);
        $items3 = Leave_list::where('user_id',$id)->where('leader_status','1')->where('type_id','3')->paginate(5);

        return view('hr.leave.my_leave_tb_app',compact('items1','items2','items3'));
    }
    public function my_leave_table_disapprove(){
        $id = Auth::user()->id;
        $items1 = Leave_list::where('user_id',$id)->where('leader_status','2')->where('type_id','1')->paginate(5);
        $items2 = Leave_list::where('user_id',$id)->where('leader_status','2')->where('type_id','2')->paginate(5);
        $items3 = Leave_list::where('user_id',$id)->where('leader_status','2')->where('type_id','3')->paginate(5);
        return view('hr.leave.my_leave_tb_dis',compact('items1','items2','items3'));
    }







}
