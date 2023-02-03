<?php

namespace App\Http\Controllers\Admin\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{   
    //後臺首頁(顯示所有商品)
    public function owner_index(){

        $row = DB::table('goods')->get();

        return view('web.owner.owner_index',compact('row'));
    }

    //後臺PO商品頁面
    public function owner_po_goods(){

        return view('web.owner.owner_po_goods');
    }
}
