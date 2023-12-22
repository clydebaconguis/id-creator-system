<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrganizationController extends Controller
{
    public function organizations()
    {
        return DB::table('organization')->get();
    }

    public function get_org(Request $request)
    {
        $data = DB::table('organization')->where('id', $request->id)->get();
        Session::put('orgid', $data[0]->id);
        return view('mainpage', ['data' => $data]);
    }
}
