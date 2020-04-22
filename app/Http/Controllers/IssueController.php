<?php

namespace App\Http\Controllers;

use App\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect,Symfony\Component\HttpFoundation\Response,DB,Config;


class IssueController extends Controller
{
   public function index(){
        $data = DB::table ('issues')->get();
        error_log($data);
        return view('issues', ['data' =>$data]);
   } 
}
