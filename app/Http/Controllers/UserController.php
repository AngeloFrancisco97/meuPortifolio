<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function __construct(User $user) {
        $this->middleware('jwt.auth')->only('store', 'update', 'destroy');
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resposta = $this->user->with('informacoes')->get();
        return response()->json($resposta, 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->user->rules());

        $imagem_usuario_perfil = $request->file('foto_perfil');
        $imagem_usuario_perfil_urn = $imagem_usuario_perfil->store('usuario', 'public');

        $imagem_descricao_perfil_usuario = $request->file('fodo_descricao');
        $imagem_descricao_perfil_usuario_urn = $imagem_descricao_perfil_usuario->store('usuario', 'public');
        
        $curriculo_perfil_usuario = $request->file('curriculo');
        $curriculo_perfil_usuario_urn = $curriculo_perfil_usuario->store('usuario', 'public');

        $usuario = $this->projeto->fill($request->all());
        $usuario->foto_perfil = $imagem_usuario_perfil_urn;
        $usuario->foto_descricao = $imagem_descricao_perfil_usuario_urn;
        $usuario->curriculo = $curriculo_perfil_usuario_urn;
        $usuario->save();

        return response()->json($usuario, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->with('informacoes')->find($id);
        if($user === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404); //json
        }
            return response()->json($user,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->user->find($id);

        if($user === null){
            return response()->json(['erro' => 'Impossível realizaar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($user->rules() as $input => $regra){

                //coletar apenas as  regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas);
        }else {
            $request->validate($user->rules());
        }

        if($request->file('foto_perfil')) {
            Storage::disk('public')->delete($user->foto_perfil);
            $imagem_usuario_perfil = $request->file('foto_perfil');
            $imagem_usuario_perfil_urn = $imagem_usuario_perfil->store('usuario', 'public');
        }
        if($request->file('foto_descricao')) {
            Storage::disk('public')->delete($user->foto_descricao);
            $imagem_descricao_perfil_usuario = $request->file('foto_descricao');
            $imagem_descricao_perfil_usuario_urn = $imagem_descricao_perfil_usuario->store('usuario', 'public');
        }
        if($request->file('foto_descricao')) {
            Storage::disk('public')->delete($user->curriculo);
            $curriculo_perfil_usuario = $request->file('curriculo');
            $curriculo_perfil_usuario_urn = $curriculo_perfil_usuario->store('usuario', 'public');
        }
        
        

        //preencher o objeto 4marca com os dados do request
        $user->fill($request->all());
        if($request->file('foto_perfil')) {
            $user->foto_perfil = $imagem_usuario_perfil_urn;
        }
        if($request->file('foto_descricao')) {
            $user->foto_descricao = $imagem_descricao_perfil_usuario_urn;
        }
        if($request->file('curriculo')) {
            $user->curriculo = $curriculo_perfil_usuario_urn;
        }
        $user->save();

        return response()->json($user, 200) ;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
