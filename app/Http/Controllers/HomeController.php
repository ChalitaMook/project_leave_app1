<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $role = Auth::user()->role;
        if($role=='0'){
            return view('officer.index');
        }
        elseif($role=='1'){
            return view('hr.index');
        }
        else{
            return view('lead.index');
        }
    }
}
