<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Daftar;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Validator, Redirect;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    public function checkScore(Request $request)
    {
        if (Daftar::where('user_id',Input::get('hasil'))->first()) {
            $tes = Daftar::where('user_id',Input::get('hasil'))->first();
            return view('hasilabsen',compact('tes'));
        }
        else {
            return redirect::to('/')->with('message', 'Surat Tidak Ditemukan atau Tidak Valid');
        }
           
         
   
         
        
      
    }
}
