<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function testpo (Request $req){
        return view('web.test.test');


    }
}