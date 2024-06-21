<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;

class DashboarController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        $links = Link::with('user')->get();
        return view('dashboard' , compact(['users' , 'links']));
    }
}
