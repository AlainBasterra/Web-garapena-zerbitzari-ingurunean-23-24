<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atasa;

class AtasaController extends Controller
{



    public function store(Request $request)
    {
        $request->validate([
            'izena' => 'required|min:3'
        ]);

        $atasa = new Atasa;
        $atasa->izena=$request->izena;
        $atasa->save();

        return redirect()->route('atasak')->with('success','Atasa ondo gorde da');

    }



    public function index(request $request){
        $atasak = Atasa::all();
        return view('atasak.index', ['atasak'=>$atasak]);
    }



}