<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Leave_list;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OfficerController extends Controller
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
        return view('officer.profile')->with('rolename',$rolename);
    }

    public function main(){
        return view('officer.main');
    }

    public function sick_form(){
        $id = Auth::user()->id;
        $department = Auth::user()->department;
        $items = User::where('department',$department)->whereNotIn('id', [$id])->get();
        return view('officer.leave.sick_form',compact('items'));
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
                    return redirect('/officer/my_leave_table');
             }
    }
    public function sick_form_edit($id){

        $items1 = Leave_list::find($id);
        $id = Auth::user()->id;
        $department = Auth::user()->department;
        $items2 = User::where('department',$department)->whereNotIn('id', [$id])->get();
        return view('officer.leave.sick_form_edit',compact('items1','items2'));
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
                    return redirect('/officer/my_leave_table');
             }
    }
    public function sick_form_delete($id){
        $delete=Leave_list::find($id)->forceDelete();
        return redirect('/officer/my_leave_table');
    }



    public function business_form(){
        $id = Auth::user()->id;
        $department = Auth::user()->department;
        $items = User::where('department',$department)->whereNotIn('id', [$id])->get();
        return view('officer.leave.business_form',compact('items'));
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
                    return redirect('/officer/my_leave_table');
             }
    }
    public function business_form_edit($id){
            $items1 = Leave_list::find($id);
            $id = Auth::user()->id;
            $department = Auth::user()->department;
            $items2 = User::where('department',$department)->whereNotIn('id', [$id])->get();
            return view('officer.leave.business_form_edit',compact('items1','items2'));
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
                    return redirect('/officer/my_leave_table');
             }
    }
    public function business_form_delete($id){
        $delete=Leave_list::find($id)->forceDelete();
        return redirect('/officer/my_leave_table');
    }


    public function annual_form(){
        $id = Auth::user()->id;
        $department = Auth::user()->department;
        $items = User::where('department',$department)->whereNotIn('id', [$id])->get();
        return view('officer.leave.annual_form',compact('items'));
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
                    return redirect('/officer/my_leave_table');
             }
    }
    public function annual_form_edit($id){
        $items1 = Leave_list::find($id);
        $id = Auth::user()->id;
        $department = Auth::user()->department;
        $items2 = User::where('department',$department)->whereNotIn('id', [$id])->get();
        return view('officer.leave.annual_form_edit',compact('items1','items2'));
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
                    return redirect('/officer/my_leave_table');
             }

    }
    public function annual_form_delete($id){
        $delete=Leave_list::find($id)->forceDelete();
        return redirect('/officer/my_leave_table');
    }



    ///////////
    public function my_leave_table(){
        $id = Auth::user()->id;
        $items1 = Leave_list::where('user_id',$id)->where('leader_status','0')->where('type_id','1')->get();
        $items2 = Leave_list::where('user_id',$id)->where('leader_status','0')->where('type_id','2')->get();
        $items3 = Leave_list::where('user_id',$id)->where('leader_status','0')->where('type_id','3')->get();

        return view('officer.leave.my_leave_table',compact('items1','items2','items3'));
    }
    public function my_leave_table_approve(){
        $id = Auth::user()->id;
        $items1 = Leave_list::where('user_id',$id)->where('leader_status','1')->where('type_id','1')->get();
        $items2 = Leave_list::where('user_id',$id)->where('leader_status','1')->where('type_id','2')->get();
        $items3 = Leave_list::where('user_id',$id)->where('leader_status','1')->where('type_id','3')->get();

        return view('officer.leave.my_leave_tb_app',compact('items1','items2','items3'));
    }
    public function my_leave_table_disapprove(){
        $id = Auth::user()->id;
        $items1 = Leave_list::where('user_id',$id)->where('leader_status','2')->where('type_id','1')->get();
        $items2 = Leave_list::where('user_id',$id)->where('leader_status','2')->where('type_id','2')->get();
        $items3 = Leave_list::where('user_id',$id)->where('leader_status','2')->where('type_id','3')->get();
        return view('officer.leave.my_leave_tb_dis',compact('items1','items2','items3'));
    }







}
