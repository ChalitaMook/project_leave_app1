<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave_type extends Model
{
    use HasFactory;

    public function leave_lists()
    {
        return $this->hasMany(Leave_list::class);
    }
}
