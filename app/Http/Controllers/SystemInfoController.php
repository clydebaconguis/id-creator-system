<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SystemInfoController extends Controller
{
    public function store(Request $request)
    {
        DB::table('systeminfos')->insert([
            'organization' => $request->organization,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
        ]);

        return array(
            (object) [
                'status' => 200,
                'statusCode' => "success",
                'message' => 'Added Successfully!',
            ]
        );
    }
}
