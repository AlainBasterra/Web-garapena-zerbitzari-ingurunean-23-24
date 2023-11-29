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

    public function show($id){
        $atasa = Atasa::find($id);
        return view('atasak.show', ['atasa'=>$atasa]);
    }

    public function update(Request $request, $id){

        $atasa = Atasa::find($id);
        $atasa->izena=$request->izena;
        $atasa->save();

        return redirect()->route('atasak')->with('success','Atasa ondo eguneratu da');
    }

    public function destroy($id){
        $atasa = Atasa::find($id);
        $atasa->delete();

        return redirect()->route('atasak')->with('success','Atasa ondo ezabatu da');
    }

}