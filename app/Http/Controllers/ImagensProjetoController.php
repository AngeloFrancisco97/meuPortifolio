<?php

namespace App\Http\Controllers;

use App\Models\ImagensProjeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagensProjetoController extends Controller
{
    public function __construct(ImagensProjeto $imagensProjeto) {
        $this->middleware('jwt.auth')->only('store', 'update', 'delete');
        $this->imagensProjeto = $imagensProjeto;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth');
        $resposta = $this->imagensProjeto->with('projeto')->get();
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
        $request->validate($this->imagensProjeto->rules());
        $imagem = $request->file('imagens_projeto');
        $imagem_urn = $imagem->store('imagens_projeto', 'public');

        $imagensProjeto = $this->imagensProjeto->create([
            'projeto_id' => $request->projeto_id,
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'imagens_projeto' => $imagem_urn,
        ]);
        

        return response()->json($imagensProjeto, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImagensProjeto  $imagensProjeto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->middleware('auth');
        $imagensProjeto = $this->imagensProjeto->with('projeto')->find($id);
        if($imagensProjeto === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404); //json
        }
            return response()->json($imagensProjeto,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImagensProjeto  $imagensProjeto
     * @return \Illuminate\Http\Response
     */
    public function edit(ImagensProjeto $imagensProjeto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ImagensProjeto  $imagensProjeto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $imagensProjeto = $this->imagensProjeto->find($id);

        if($imagensProjeto === null){
            return response()->json(['erro' => 'Impossível realizaar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($imagensProjeto->rules() as $input => $regra){

                //coletar apenas as  regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas);
        }else {
            $request->validate($imagensProjeto->rules());
        }

        if($request->file('imagens_projeto')) {
            Storage::disk('public')->delete($imagensProjeto->imagens_projeto);
            $imagem = $request->file('imagens_projeto');
            $imagem_urn = $imagem->store('imagens_projeto', 'public');
        }


        //preencher o objeto 4marca com os dados do request
        $imagensProjeto->fill($request->all());
        $imagensProjeto->imagens_projeto = $imagem_urn;
        $imagensProjeto->save();

        return response()->json($imagensProjeto, 200) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImagensProjeto  $imagensProjeto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagensProjeto = $this->imagensProjeto->find($id);

        if($imagensProjeto === null){
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'],404);
        }

        //Remove o arquivo antigo caso um novo arquivo tenha sido enviado no request
        Storage::disk('public')->delete($imagensProjeto->imagens_projeto);

        $imagensProjeto->delete();
        return response()->json(['msg' => 'A tela foi deletada com sucesso!'], 200);
    }
}
