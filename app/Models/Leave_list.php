<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave_list extends Model
{
    use HasFactory;

    public function leave_type(){
        return $this->belongsTo(Leave_type::class,'type_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    protected $dates = ['start_date','end_date'];






}
