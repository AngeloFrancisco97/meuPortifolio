<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjetoController extends Controller
{
    public function __construct(Projeto $projeto) {
        $this->middleware('jwt.auth')->only('store', 'update', 'destroy');
        $this->projeto = $projeto;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resposta = $this->projeto->orderBy('id', 'desc')->get();
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
        
        $request->validate($this->projeto->rules());
        $capa = $request->file('capa_projeto');
        $capa_urn = $capa->store('imagem_capa', 'public');

        $projeto = $this->projeto->create([
            'nome' => $request->nome,
            'capa_projeto' => $capa_urn,
            'descricao' => $request->descricao,
            'descricao_completa' => $request->descricao_completa,
            'ferramentas' => $request->ferramentas,
            'repositorio' => $request->repositorio,
        ]);
        

        return response()->json($projeto, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projeto  $projeto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projeto = $this->projeto->with('imagensProjeto')->find($id);
        if($projeto === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404); //json
        }
            return response()->json($projeto,200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Projeto  $projeto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $projeto = $this->projeto->find($id);

        if($projeto === null){
            return response()->json(['erro' => 'Impossível realizaar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($projeto->rules() as $input => $regra){

                //coletar apenas as  regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas);
        }else {
            $request->validate($projeto->rules());
        }
        if($request->file('capa_projeto')) {
            Storage::disk('public')->delete($projeto->capa_projeto);
        }

        $capa = $request->file('capa_projeto');
        $capa_urn = $capa->store('imagem_capa', 'public');

        //preencher o objeto 4marca com os dados do request
        $projeto->fill($request->all());
        $projeto->capa_projeto = $capa_urn;
        $projeto->save();

        return response()->json($projeto, 200) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projeto  $projeto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projeto = $this->projeto->with('imagensProjeto')->find($id);

        if($projeto === null){
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'],404);
        }
        foreach ($projeto->getRelations() as $key => $value) {
            foreach ($value as $key => $value2) {
                Storage::disk('public')->delete($value2->imagens_projeto);
            }
        } 
        //Remove o arquivo antigo caso um novo arquivo tenha sido enviado no request
        Storage::disk('public')->delete($projeto->capa_projeto);

        $projeto->delete();
        return response()->json([$projeto], 200);
    }
}
