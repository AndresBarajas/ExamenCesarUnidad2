<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Venta;

class VentaController extends Controller
{
    public function obtain()
    {
        $ventas = Venta::join('usuarios','ventas.id_usuario','=','usuarios.id')
        ->join('producto', 'ventas.id_producto','=','producto.id')
        ->select(
            'ventas.*',
            'usuarios.nombre as nombre_usuario',
            'producto.nombre as nombre_producto'
        )->get();
        return response($ventas, 200);
    }


    public function create(Request $request){
        $datos = $request->validate($this->VentaSanctum());
        $ventas = Venta::create($datos);
        return response([
            'message' => 'venta creada',
            'informacion' => $ventas
        ]);
    }
    public function VentaSanctum(){
        return
        [
        'id_usuario' => 'required|numeric',
        'id_producto' => 'required|numeric',

    ];


    }
}
