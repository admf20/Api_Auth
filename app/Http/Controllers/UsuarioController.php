<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Usuario[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    //GET Listar Usuarios
    public function index(Request $request)
    {
         if($request->has('parms'))
         {
            $usuarios = Usuario::where('password', 'like', '%'. $request->parms .'%')
            ->get();
        }
        else{
            $usuarios = Usuario::all();
        }

        return $usuarios;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateUsuarioRequest $request)
    {

        $Data = $request->json()->all();
        $Data['password'] = Hash::make($request->password); //encriptamos la contraseña al crear un nuevo usuario

        Usuario::create($Data);

        return response()->json([
            'res' => true,
            'message' => 'Usuario Registrado'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        return  $usuario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUsuarioRequest $request, $id)
    {
        $Data = $request->json()->all();
        Usuario::where('id', $id)->update($Data);

        return response()->json([
            'res' => true,
            'message' => 'Usuario Actualizado'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Usuario::destroy($id);

        return response()->json([
            'res' => true,
            'message' => 'Usuario Eliminado'
        ], 200);
    }

    public function login(Request $request)
    {
        $user = Usuario::whereEmail($request->email)->first();

        if(!is_null($user) && Hash::check($request->password, $user->password))
        {
            $user->api_token = Str::random(100);
            $user->save();

            return response()->json([
                'res' => true,
                'token' => $user->api_token,
                'message' => 'Bienvenidos al Sistema'
            ], 200);
        }else{
            return response()->json([
                'res' => true,
                'message' => 'Contraseña o password incorrectos'
            ], 400);
        }
    }
}
