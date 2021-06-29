<?php

namespace App\Http\Controllers;

use App\Models\Informacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformacaoController extends Controller
{

    public function __construct(Informacao $informacao) {
        $this->middleware('jwt.auth')->only('store', 'update', 'destroy');
        $this->informacao = $informacao;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resposta = $this->informacao->with('user')->get();
        return response()->json($resposta, 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->informacao->rules());

        $informacao = $this->informacao->create($request->all());

        return response()->json($informacao, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Informacao  $informacao
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $informacao = $this->informacao->with('user')->find($id);
        if($informacao === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404); //json
        }
            return response()->json($informacao,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Informacao  $informacao
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Informacao  $informacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $informacao = $this->informacao->find($id);

        if($informacao === null){
            return response()->json(['erro' => 'Impossível realizaar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($informacao->rules() as $input => $regra){

                //coletar apenas as  regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas);
        }else {
            $request->validate($informacao->rules());
        }
        

        //preencher o objeto 4marca com os dados do request
        $informacao->fill($request->all());
        $informacao->save();

        return response()->json($informacao, 200) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Informacao  $informacao
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $informacao = $this->informacao->find($id);

        if($informacao === null){
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'],404);
        }
        //Remove o arquivo antigo caso um novo arquivo tenha sido enviado no request
        $informacao->delete();
        return response()->json([$informacao], 200);
    }
}
