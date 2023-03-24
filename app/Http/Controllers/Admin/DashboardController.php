<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;


class DashboardController extends Controller
{
    public function index($status = 'Todos'){
        abort_if(!Auth::check(), redirect()->route("login.page"));

        if($status != 'Todos'){
            $tableData = User::where('status', $status)->get();
        }else{ 
            $tableData = User::all();
        }
        return view('dashboard.index')->with(compact("tableData", "status"));
    }
}
