<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $user;


    public function index()
    {
        if (Auth::user()->role == 2){
        return redirect('/admin/index');
        } else {
        return redirect('/adminSekolah/index');
        }
    }
}
