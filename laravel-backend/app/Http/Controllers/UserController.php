<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function obtain(){
        //todos los usuarios
        $usuarios = Usuario::all();


        //todos los usuarios pagimados
        //$usuarios = Usuario::paginate(10);

        //Cuenta los usuarios en la base de datos
        //$usuarios = Usuario::count();

        //Solo toma los usuarios que le indico
        //$usuarios = usuario::all()->take(12);

        //Toma los usuarios pero solo los campos que le indico
        //$usuarios = Usuario::select('id','nombre','email')
        //->get()
        //->take(5);

        //obtener de la BD con condiciones, estas deben llevar siempre get
        //$usuarios = Usuario::where('peso','>=',100)->get();
        //get() cuando son muchos datos y first() cuando solo se necesita un dato

        //obtener un usuario por su id
        //$usuarios = Usuario::where('id','=',10)->first();

        //dos condiciones
        // $usuarios = Usuario::where('id','>',15)
        //                     ->where('peso','>',85)
        //                     ->get();

        //or
        // $usuarios = Usuario::where('id','>',15)
        //                     ->orwhere('peso','>',85)
        //                     ->get();

        //orderby
        //$usuarios = Usuario::orderBy('peso','asc')->get();
        return $usuarios;
    }


    public function create(Request $request)
    {
        //$datos = $request->all();
      $datos =  $request->validate([
            'nombre'  => 'required |string',
            'email' => 'required|string|email',
            'password' => 'required|min:6',
            'peso' => 'required|numeric',


        ]);


        $usuario = Usuario::create($datos);
        return response([
            'message' => 'se creo con exito el usuario ',
            'id' => $usuario['id']
        ], 201);
        //return 'se creo otro usuario';
    }

    public function modify($id, Request $request)
    {
        $usuario =  Usuario::find($id);
        //VALIDAR SI EXISTE USUARIO
        if(!$usuario){

            return response([
                'message' =>'Error, no se encontro el usuario con el id' . $id
            ], 404);
        }

        //TODO BIEN
        $datos = $request->validate($this->validationRequest());
        $datos =  $request->validate([
            'nombre'  => 'required |string',
            'email' => 'required|string|email',
            'password' => 'required|min:6',
            'peso' => 'required|numeric',
            'codigo_verificacion' => 'required|string'

        ]);

        $usuario->update($datos);
        return response([
            'message' => 'Se modifico con exito el usuario'
        ]);
    }

    public function delete($id)
    {
        //validar si existe
        $usuario =  Usuario::find($id);
        //VALIDAR SI EXISTE USUARIO
        if(!$usuario){

            return response([
                'message' =>'Error, no se encontro el usuario con el id' . $id
            ], 404);
        }
        //todo bien si existe el usuario
        $usuario->delete();
        return response([
            'message'=>'se elimino con exito el usuario'
        ]);
    }
    //examen
    public function update($id, Request $request)
    {
        $usuario = Usuario::find($id);
        if(!$usuario){
            return response([
                'message' => 'no se encontro el usuario' . $id
            ], 404);
        }else if(!$usuario["codigo_verificacion"]){
            return response (["message" => 'no se puede cambiar los datos'], 200);
        }else if($request["codigo_verificacion"] == $usuario["codigo_verificacion"]){
            $usuario -> update(["password" =>$request["password"],"codigo_verificacion"]);
            return response([
                'message'=> "Contraseña actualizada"
            ]);
        }
        return response([
            'message' => "Codigo invalido"
        ]);
    }
 public function examen($id, Request $request){
    $usuario = Usuario::find($id);
    if(!$usuario){
        return response([
            'message' => "No se encontro el usuario" . $id
        ], 404);
    }
    $code = Str::random(10);
    $usuario ->update(["codigo_verificacion" => $code]);
    return response([
        'message' => "Tu codigo es  " . $code
    ]);
 }
//examen


    private function validationRequest(){
    return[
    'nombre'  => 'required |string',
    'email' => 'required|string|email',
    'password' => 'required|min:6',
    'peso' => 'required|numeric',

    ];

   }


}
