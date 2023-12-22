<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class StudentController extends Controller
{
    public function students()
    {
        return DB::table('studinfo')
            // ->join('templates', 'students.template', '=', 'templates.id')
            ->leftJoin('students', 'studinfo.id', '=', 'students.studid')
            ->leftJoin('templates', 'students.template', '=', 'templates.id')
            // ->where('templates.orgid', Session::get('orgid'))
            ->select(
                'studinfo.*',
                DB::raw('templates.name AS template'),
                // DB::raw('students.template AS tempname'),
                // DB::raw('CONCAT(students.firstname, " ", students.lastname) AS name')
            )->get();

        // return DB::table('studinfo')->get();
        // ->join('templates', 'students.template', '=', 'templates.id')
        // ->where('templates.orgid', Session::get('orgid'))
        // ->select(
        //     'studinfo.*',
        //     // DB::raw('templates.name AS tempname'),
        //     DB::raw('CONCAT(students.firstname, " ", students.lastname) AS name')
        // )->get();
    }

    public function get_student(Request $request)
    {
        $stud = DB::table('studinfo')
            ->leftJoin('students', 'studinfo.id', '=', 'students.studid')
            ->select(
                'studinfo.*', 'students.template',
                DB::raw('CONCAT(studinfo.firstname, " ", studinfo.middlename, " ", studinfo.lastname) AS name'),
                DB::raw('CONCAT(studinfo.lastname, " ", studinfo.firstname, " ", studinfo.middlename) AS name2'),
            )
            ->where('studinfo.id', $request->id)
            ->first();

        // $hastemplate = DB::table('students')->where('id', $request->id)->first();
        // if ($hastemplate) {
        //     $stud['template'] = $hastemplate->template;
        // } else {
        //     $stud['template'] = 'Not Assigned';
        // }

        return response()->json([
            'stud' => $stud
        ]);

        // $stud = DB::table('students')
        //     ->select(
        //         'students.*',
        //         DB::raw('CONCAT(students.firstname, " ", students.lastname) AS name')
        //     )
        //     ->where('id', $request->id)
        //     ->first();

        // $temp = DB::table('templates')->where('id', $stud->template)->first();

        // $templates = DB::table('templates')->where('name', $temp->name)->get();

        // return response()->json([
        //     'templates' => $templates,
        //     'studinfo' => $stud,
        // ]);

    }

    public function update_student(Request $request)
    {
        $hastemp = DB::table('students')->where('studid', $request->id)->first();
        if ($hastemp) {
            DB::table('students')->where('studid', $request->id)->update([
                'template' => $request->template,
                'studid' => $request->id,
            ]);

            return array(
                (object) [
                    'status' => 200,
                    'statusCode' => "success",
                    'message' => 'Updated Successfully!',
                ]
            );

        } else {
            DB::table('students')->insert([
                'template' => $request->template,
                'studid' => $request->id,
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

    public function store(Request $request)
    {
        DB::table('students')->insert([
            'idnumber' => $request->idnumber,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'level' => $request->level,
            'birthdate' => $request->birthdate,
            'address' => $request->address,
            'picurl' => $request->picurl,
            'template' => $request->template,
        ]);

        return array(
            (object) [
                'status' => 200,
                'statusCode' => "success",
                'message' => 'Added Successfully!',
            ]
        );
    }

    public function destroy(Request $request)
    {
        DB::table('studinfo')->where('id', $request->id)->delete();

        return array(
            (object) [
                'status' => 200,
                'statusCode' => "success",
                'message' => 'Deleted Successfully!',
            ]
        );
    }

    function generate_pdf(Request $request)
    {
        // $result = DB::table('students')->where('id', $request->id)->first();
        // $org = DB::table('systeminfos')->first();

        // $pdf = PDF::loadView('document', ['data' => $result, 'org' => $org]);
        $pdf = PDF::loadView('document', []);
        return $pdf->stream('document.pdf');
    }
}
