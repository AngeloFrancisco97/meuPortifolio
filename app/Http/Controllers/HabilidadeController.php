<?php

namespace App\Http\Controllers;

use App\Models\Habilidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HabilidadeController extends Controller
{
    public function __construct(Habilidade $habilidade) {
        $this->middleware('jwt.auth')->only('store', 'update', 'destroy');
        $this->habilidade = $habilidade;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resposta = $this->habilidade->all();
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
        $request->validate($this->habilidade->rules());
        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens_habilidade', 'public');

        $habilidade = $this->habilidade->fill($request->all());
        $habilidade->imagem = $imagem_urn;
        $habilidade->save();

        return response()->json($habilidade, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Habilidade  $habilidade
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $habilidade = $this->habilidade->find($id);
        if($habilidade === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404); //json
        }
            return response()->json($habilidade,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Habilidade  $habilidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Habilidade $habilidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Habilidade  $habilidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $habilidade = $this->habilidade->find($id);

        if($habilidade === null){
            return response()->json(['erro' => 'Impossível realizaar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($habilidade->rules() as $input => $regra){

                //coletar apenas as  regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas);
        }else {
            $request->validate($habilidade->rules());
        }

        if($request->file('imagem')) {
            Storage::disk('public')->delete($habilidade->imagem);
            $imagem = $request->file('imagem');
            $imagem_urn = $imagem->store('imagens_habilidade', 'public');
        }
        

        //preencher o objeto 4marca com os dados do request
        $habilidade->fill($request->all());
        $habilidade->imagem = $imagem_urn;
        $habilidade->save();

        return response()->json($habilidade, 200) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Habilidade  $habilidade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $habilidade = $this->habilidade->find($id);

        if($habilidade === null){
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'],404);
        }

        //Remove o arquivo antigo caso um novo arquivo tenha sido enviado no request
        Storage::disk('public')->delete($habilidade->imagem);

        $habilidade->delete();
        return response()->json(['msg' => 'A tela foi deletada com sucesso!'], 200);
    }
}
