<template>
    <div>
        <div class="container pt-5">
            <div class="">
                <h4 class="" ><span style="text-align: left; border-bottom: 1px solid red; color: white">Projetos Realizados</span></h4>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col" v-for="projeto, chave in dados" :key="chave">
                        <div class="card h-100 card-habilidades"> 
                            <img :src="'/storage/'+projeto.capa_projeto" class="card-img-top " alt="teste">
                            <div class="card-body">
                                <h4 class="card-title">{{projeto.nome}}</h4>
                                <p class="card-text">{{projeto.descricao}}</p>
                                <h5 class="card-title"> Ferramentas utilizadas </h5>
                                <p class="card-text">{{projeto.ferramentas}}</p>
                                <p class="card-text link" v-html="projeto.repositorio">teste</p>
                            </div>
                            <div class="card-footer d-flex justify-content-around">
                                <button v-if="admin" type="Button" data-toggle="modal" data-target="#modalProjeto" @click="editarProjeto(projeto)" class="btn btn-secondary btn-sm ">Editar</button>
                                <button type="Button" data-toggle="modal" data-target="#modalDetalhes" @click="carregarProjetoDetalhes(projeto.id)" class="btn btn-primary btn-sm ">Visualizar</button>
                                <button v-if="admin" type="Button"  @click="excluirProjeto(projeto.id)" class="btn btn-danger btn-sm ">Deletar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <modal-component id="modalDetalhes" :titulo="projetoDetalhes.nome">
            <template v-slot:botoes>
                <button v-if="admin" type="button" class="btn btn-primary ml-5" @click="acao = 'adcionar'">Adicionar</button>
            </template>
            <template v-slot:alertas>
                <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Cadastro realizado com sucesso" v-if="transacaoStatus == 'adicionado'"></alert-component>
                <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar cadastrar a projeto" v-if="transacaoStatus == 'erro'"></alert-component>
            </template>
            <template v-slot:conteudo>
                <div v-if="admin && acao == 'editar'" style="z-index: 1; position:relative" class="animate__animated animate__slideInUp background-maneiro">
                    <input-container-component titulo="Projeto ID" id="novoProjetoId" id-help="novoProjetoIdHelp" texto-ajuda="Informe o ID do projeto">
                            <input type="text" class="form-control" disabled id="novoProjetoId" v-model="detalhesEdit.id" aria-describedby="novoProjetoIdHelp" placeholder="ID do projeto">
                    </input-container-component>
                    <input-container-component titulo="Nome do titulo da tela" id="novoTituloTela" id-help="novoTituloTelaHelp" texto-ajuda="Informe o titulo da tela">
                            <input type="text" class="form-control" id="novoTituloTela" v-model="detalhesEdit.titulo" aria-describedby="novoTituloTelaHelp" placeholder="Nome do titulo da tela">
                    </input-container-component>
                    <input-container-component titulo="Descricao" id="novoDescricaoTela" id-help="novoDescricaoHelp" texto-ajuda="Informe a Descricao da tela">
                            <input type="text" class="form-control" id="novoDescricaoTela" v-model="detalhesEdit.descricao" aria-describedby="novoDescricaoHelp" placeholder="Descricao da tela">
                    </input-container-component>
                    <input-container-component titulo="Imagem da Tela" id="novoImagem" id-help="novoImagemHelp" texto-ajuda="Selecione uma imagem no formato PNG">
                        <input type="file" class="form-control-file" id="novoImagem" @change="carregarImagem($event)" aria-describedby="novoImagemHelp" placeholder="Selecione uma imagem">
                    </input-container-component>
                    <button type="button" class="btn btn-primary" @click="salvarEdicao()">Editar</button>
                    <hr style="border: 1px solid white">
                </div>
                <div v-else-if="admin && acao == 'adcionar'" class="animate__animated animate__slideInDown background-maneiro">
                    <input-container-component titulo="Projeto ID" id="novoProjetoId" id-help="novoProjetoIdHelp" texto-ajuda="Informe o ID do projeto">
                            <input type="text" class="form-control" disabled id="novoProjetoId" v-model="projetoDetalhes.id" aria-describedby="novoProjetoIdHelp" placeholder="ID do projeto">
                    </input-container-component>
                    <input-container-component titulo="Nome do titulo da tela" id="novoTituloTela" id-help="novoTituloTelaHelp" texto-ajuda="Informe o titulo da tela">
                            <input type="text" class="form-control" id="novoTituloTela" v-model="tituloTela" aria-describedby="novoTituloTelaHelp" placeholder="Nome do titulo da tela">
                    </input-container-component>
                    <input-container-component titulo="Descricao" id="novoDescricaoTela" id-help="novoDescricaoHelp" texto-ajuda="Informe a Descricao da tela">
                            <input type="text" class="form-control" id="novoDescricaoTela" v-model="descricao" aria-describedby="novoDescricaoHelp" placeholder="Descricao da tela">
                    </input-container-component>
                    <input-container-component titulo="Imagem da Tela" id="novoImagem" id-help="novoImagemHelp" texto-ajuda="Selecione uma imagem no formato PNG">
                        <input type="file" class="form-control-file" id="novoImagem" @change="carregarImagem($event)" aria-describedby="novoImagemHelp" placeholder="Selecione uma imagem">
                    </input-container-component>
                    <button v-if="acao == 'adcionar'" type="button" class="btn btn-primary" @click="salvar()">Salvar</button>
                    <hr style="border: 1px solid white">
                </div>
                <card-detalhes-projeto-component v-if="admin" @editar="editarDetalhes" admin="true" @refresh="carregarProjetoDetalhes(projetoDetalhes.id)" :descricao="projetoDetalhes.descricao_completa" :titulo="projetoDetalhes.nome" :dados="projetoDetalhes.imagens_projeto"></card-detalhes-projeto-component>
                <card-detalhes-projeto-component v-else @refresh="carregarProjetoDetalhes(projetoDetalhes.id)" :descricao="projetoDetalhes.descricao_completa" :titulo="projetoDetalhes.nome" :dados="projetoDetalhes.imagens_projeto"></card-detalhes-projeto-component>
            </template>
        </modal-component>
    </div>
</template>

<script>
export default {
    props: ['dados', 'admin', 'carregar'],
    data() {
        return {
            urlProjeto: 'http://angelofrancisco.site/api/projeto',
            urlBase: 'http://angelofrancisco.site/api/projeto_imagem',
            detalhesProjeto: [],
            projetoId: '',
            tituloTela: '',
            descricao: '',
            imagemTitulo: [],
            transacaoStatus: '',
            transacaoDetalhes: {},
            projetoDetalhes: {},
            idProjeto: '',
            acao: '',
            detalhesEdit: {}
        }
    },
    methods: {

        editarDetalhes(dados){
            this.detalhesEdit = dados.dados
            this.acao = 'editar'
        },
        editarProjeto(detalhe){
            this.$emit('editarProjeto', {dados: detalhe})
        },
        detalheProjeto(projeto) {
            this.detalhesEdit = projeto
        },
        carregarImagem(e){
              this.imagemTitulo = e.target.files  
        },
        carregarProjetoDetalhes(id) {
            axios.get(this.urlProjeto+'/'+id)
                .then(response => {
                    this.projetoDetalhes = response.data
                    this.idProjeto = id
                })
                .catch(errors => {
                })
        },
        salvar(){
            let formData = new FormData()
            formData.append('projeto_id', this.projetoDetalhes.id)
            formData.append('titulo', this.tituloTela)
            formData.append('descricao', this.descricao)
            formData.append('imagens_projeto', this.imagemTitulo[0])
            let config = {
                headers: {
                    'Content-type': 'multipart/form-data',
                    'Accept': 'application/json'
                }
            }
            if (confirm('Deseja adicionar nova tela do projeto?')){
                axios.post(this.urlBase, formData, config)
                    .then(response => {
                        this.transacaoStatus = 'adicionado'
                        this.transacaoDetalhes = {
                            mensagem: 'ID do registro: ' + response.data.id
                        }
                        this.carregarProjetoDetalhes(this.projetoDetalhes.id)
                    })
                    .catch(errors => {
                        this.transacaoStatus = 'erro'
                        this.transacaoDetalhes = {
                            mensagem: errors.response.data.message,
                            dados: errors.response.data.errors
                        }
                        //errors.response.data.message
                    })
            }
        },
        salvarEdicao(){
            let formData = new FormData()
                formData.append('projeto_id', this.projetoDetalhes.id)
                formData.append('titulo', this.detalhesEdit.titulo)
                formData.append('descricao', this.detalhesEdit.descricao)
                formData.append('imagens_projeto', this.imagemTitulo[0])
                formData.append('_method', 'put')
            let config = {
                headers: {
                    'Content-type': 'multipart/form-data',
                    'Accept': 'application/json'
                }
            }
            if (confirm('Deseja atualizar tela do projeto?')){
                axios.post(this.urlBase+'/'+this.detalhesEdit.id, formData, config)
                    .then(response => {
                        this.transacaoStatus = 'adicionado'
                        this.transacaoDetalhes = {
                            mensagem: 'ID do registro: ' + response.data.id
                        }
                        this.carregarProjetoDetalhes(this.projetoDetalhes.id)
                        this.acao = ''
                    })
                    .catch(errors => {
                        this.transacaoStatus = 'erro'
                        this.transacaoDetalhes = {
                            mensagem: errors.response.data.message,
                            dados: errors.response.data.errors
                        }
                        //errors.response.data.message
                    })
            }
        },
        excluirProjeto(projeto){
            if (confirm('Deseja excluir o projeto??')){
            axios.delete(this.urlProjeto+'/'+projeto)
                .then(response => {
                    this.transacaoStatus = 'deletado'
                    this.transacaoDetalhes = {
                        mensagem: 'ID do registro: ' + response.data.id
                    }
                    this.$emit('refresh', {})
                })
                .catch(errors => {
                    this.transacaoStatus = 'erro'
                    this.transacaoDetalhes = {
                        mensagem: errors.response.data.message,
                        dados: errors.response.data.errors
                    }
                    //errors.response.data.message
                })
            }
        },
    },
}
</script>

<style>
    .link a{
        color: rgb(0, 204, 255) !important;
    }
    .card-img-top{
        width: 100%;
    }
    .card-habilidades{
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.7);
        color: white;
    }
    .col{
        padding: 10px 5px;
    }
    ::-webkit-input-placeholder {
        color: rgba(255,255,255,0.7) !important;
    }
    :-moz-placeholder {
        color: red;
    }
     
    ::-moz-placeholder {
        color: red;
    }
     
    :-ms-input-placeholder {
        color: red;
    }
    .form-control {
        background-color: transparent;
        color: white;
    }
    .modal-content {
        color: white;
    }
    .close{
        color: white
    }
</style>