<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\ProductosModel;

class ProductosController extends Controller
{
    public function obtain(){
       $productos = ProductosModel::all();
        return response($productos);
    }
    public function create(Request $request)
    {
        //$datos = $request->all();
        $datos = $request->validate([
            'nombre' => 'required|string',
            'precio' => 'required|numeric',
            'cantidad' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $productos = ProductosModel::create($datos);
        return response([
            'message' => 'se creo con exito el producto'
        ], 201);
    }

    public function modify($id,Request $request){
        $productos = ProductosModel::find($id);
        if(!$productos){
            return response([
                'message' => 'Error, no se encontro el producto con el id ' . $id
            ], 201);

        }

        $datos = $request->validate([
            'nombre' => 'required|string',
            'precio' => 'required|numeric',
            'cantidad' => 'required|numeric',
            'description' => 'required|string',
        ]);


        $productos->update($datos);
        return response([
            'message' => 'Se modifico con exito el producto'
        ]);

}

public function delete($id)
{
    //validar si existe
    $productos =  productosModel::find($id);
    //VALIDAR SI EXISTE USUARIO
    if(!$productos){

        return response([
            'message' =>'Error, no se encontro el producto con el id' . $id
        ], 201);
    }
    //todo bien si existe el usuario
    $productos->delete();
    return response([
        'message'=>'se elimino con exito el producto'
    ]);
}



    }


