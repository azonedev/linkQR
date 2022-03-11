<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class AntiSpamController extends Controller
{
    public function index()
    {
        $links = Link::where('user_id',Session('user_id'))->get();

        return view('antispam',compact('links'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        
        try {
            Link::where('id',$id)->update($data);
            Toastr::success('Updated');
            return redirect()->back();
        } catch (\Exception $ex) {
            Toastr::warning('Fails to update, please try again');
            return redirect()->back();
        }
    }
}
