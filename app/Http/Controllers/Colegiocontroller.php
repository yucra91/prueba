<?php

namespace App\Http\Controllers;

use App\Models\Colegio;
use Illuminate\Http\Request;

class Colegiocontroller extends Controller
{
    //

    public function index(Request $request)
    {
      

        $colegio = Colegio::all();
        
        return response()->json([
            'ok'=>true,
            'Colegio'=> $colegio,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_colegio'=>'required',
            'direccion'=>'required',
            'imagen' => 'required',
        ]);
        
        $image_path = $request->file('imagen')->store('imagen', 'public');
        // return $image_path;

        $colegio = new Colegio();
        $colegio->nombre_colegio =   $request->nombre_colegio;
        $colegio->direccion  =   $request->direccion;
        $colegio->telefono  =   $request->telefono;
        $colegio->celular  =   $request->celular;
        $colegio->imagen  =   $request->imagen;

         $colegio->save();
         return response()->json([
            'ok'=>true,
            'Colegio'=> $colegio,
        ]);
       
    }
    public function show(Colegio $colegio)
    {
        // return new AdminResource( Admin::with('users','personas')
        // ->where('id',$admin->id)->get());
       

    }

    public function update($id,Request $colegio)
    {   
   
        $update_colegio = Colegio::findOrFail($id)
                        ->get()->first();

        $update_colegio->nombre_colegio = $colegio->nombre_colegio;
        $update_colegio->direccion = $colegio->direccion;
        $update_colegio->telefono = $colegio->telefono;
        $update_colegio->celular = $colegio->celular;
        $update_colegio->imagen = $colegio->imagen;
        $update_colegio->save();      
        return $update_colegio;
        
    }

    public function destroy(Colegio $colegio)
    {
        $colegio ->delete();
        return response()->json([
            'ok'=>true,
            'Colegio'=> $colegio,
        ]);
    }
}
