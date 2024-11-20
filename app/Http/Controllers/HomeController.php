<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function students()
    {
        $data = DB::table('students')->get();
        return response()->json(['data' => $data]);
    }

    public function saveStudent(Request $request)
    {
        try {
            $status = true;
            DB::table('students')->insert([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'class' => $request->angi,
            ]);
        } catch (\Exception $ex) {
            $stutus = false;
        }
        return response()->json(['status' => $status]);
    }

    public function delete($id)
    {
        DB::table('students')->where('id', $id)->delete();
        return response()->json(['status' => true]);
    }
}
