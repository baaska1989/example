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

    public function delete($id)
    {
        DB::table('students')->where('id', $id)->delete();
        return response()->json(['status' => true]);
    }
}
