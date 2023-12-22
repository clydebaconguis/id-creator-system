<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemplateController extends Controller
{

    public function templates(Request $request)
    {
        $templates = DB::table('templates')->where('type', 'front')->get();
        if ($templates) {
            return response()->json(['templates' => $templates]);
        }
    }
    public function saveTemplate(Request $request)
    {
        $hasmatch = DB::table('templates')->where('name', $request->name)->first();
        if ($hasmatch) {
            return response()->json([
                'status' => 400,
                'statusCode' => 'error',
                'message' => 'Template\'s name already exist.',
            ]);
        }

        $templates = $request->input('templates');
        // Ensure the 'templates' array is not empty
        if (!empty($templates) && is_array($templates)) {
            foreach ($templates as $template) {
                DB::table('templates')->insert([
                    'orgid' => $request->orgid,
                    'name' => $request->name,
                    'template' => $template['template'],
                    'image' => $template['image'],
                    'type' => $template['type'],
                ]);
            }

            return response()->json([
                'status' => 200,
                'statusCode' => 'success',
                'message' => 'Templates added successfully.',
            ]);
        }

        return response()->json([
            'status' => 400,
            'statusCode' => 'error',
            'message' => 'No templates provided.',
        ]);
    }

    public function get_template(Request $request)
    {
        return DB::table('templates')->where('id', $request->id)->get();
    }

    public function edit_template(Request $request)
    {
        $data = DB::table('templates')->where('id', $request->id)->first();
        $result = DB::table('templates')->where('name', $data->name)->get();
        // \Session::put('currentTemplate', $result);
        return view('edittemplate', ['data' => $result]);
    }

    public function destroy(Request $request)
    {
        DB::table('templates')->where('name', $request->name)->delete();

        return array((object) [
            'status' => 200,
            'statusCode' => 'success',
            'message' => 'Deleted Template!',
        ]);
    }
}
