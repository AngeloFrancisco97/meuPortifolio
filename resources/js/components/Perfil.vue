<template>
    <div class="page-content" style="padding-top: 70px;" id="content">
            <slot></slot>

        <div class="p-5" >
            <!-- Toggle button -->
            <button id="sidebarCollapse" @click="collapse()" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Menu</small></button>

            <!-- Demo content -->
            <button type="Button" data-toggle="modal" data-target="#modalUsuario" @click="adicionarUsuario()" class="btn btn-primary btn-sm float-right">Adicionar</button>
            <div class="w-100 d-flex justify-content-center">

            <table class="table table-dark" style="width: 60%">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Foto</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(usuario, chave) in usuarios" :key="chave">
                        <td>{{usuario.id}}</td>
                        <td>{{usuario.name}}</td>
                        <td><img width="50px" :src="'/storage/'+usuario.foto_perfil" class=" " alt="teste"></td>
                        <td class="d-flex justify-content-end">
                            <button type="Button" data-toggle="modal" data-target="#modalUsuario" @click="carregarUsuario(usuario.id)" class="btn btn-secondary btn-sm mr-2">Editar</button>
                            <button type="Button" data-toggle="modal" data-target="#modalInformacoesUsuario" @click="carregarUsuario(usuario.id)" class="btn btn-primary btn-sm mr-2 ">Visualizar</button>
                            <!--button type="Button"  @click="excluirUsuario(projeto.id)" class="btn btn-danger btn-sm ">Deletar</button-->
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>

        </div>
        <modal-component id="modalUsuario" :titulo="titulo">

            <template v-slot:alertas>
                <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Cadastro realizado com sucesso" v-if="transacaoStatus == 'adicionado'"></alert-component>
                <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar cadastrar a projeto" v-if="transacaoStatus == 'erro'"></alert-component>
            </template>
            <template v-slot:conteudo>
                <div v-if="acao == 'adcionar'">
                    <input-container-component titulo="Nome" id="nome" id-help="nomeHelp" texto-ajuda="Informe o nome do usuario">
                            <input type="text" class="form-control" id="novoProjetoId" v-model="nome" aria-describedby="nomeHelp" placeholder="Nome">
                    </input-container-component>
                    <input-container-component titulo="Email" id="email" id-help="emailHelp" texto-ajuda="Informe o email">
                            <input type="text" class="form-control" id="email" v-model="email" aria-describedby="emailHelp" placeholder="Email">
                    </input-container-component>
                    <input-container-component titulo="Idade" id="idade" id-help="idadeHelp" texto-ajuda="Informe a idade">
                        <input type="number" class="form-control-file" id="idade" v-model="idade" aria-describedby="idadeHelp" placeholder="Idade">
                    </input-container-component>
                    <input-container-component titulo="Descricao" id="descricao" id-help="descricaoHelp" texto-ajuda="Informe a Descricao do usuario">
                            <input type="text" class="form-control" id="descricao" v-model="descricao_perfil" aria-describedby="descricaoHelp" placeholder="Descricao do usuario">
                    </input-container-component>
                    <input-container-component titulo="Imagem de Perfil" id="novoImagemPerfil" id-help="novoImagemHelp" texto-ajuda="Selecione uma imagem no formato PNG">
                        <input type="file" class="form-control-file" id="novoImagemPerfil" @change="carregarImagemPerfil($event)" aria-describedby="novoImagemPerfilHelp" placeholder="Selecione uma imagem">
                    </input-container-component>
                    <input-container-component titulo="Imagem de descrição" id="novoImagemDescricao" id-help="novoImagemDescricaoHelp" texto-ajuda="Selecione uma imagem no formato PNG">
                        <input type="file" class="form-control-file" id="novoImagemDescricao" @change="carregarImagemDescricao($event)" aria-describedby="novoImagemDescricaoHelp" placeholder="Selecione uma imagem">
                    </input-container-component>
                    <input-container-component titulo="Celular" id="celular" id-help="celularHelp" texto-ajuda="Informe o numero de celular do usuario">
                            <input type="text" class="form-control" id="celular" v-model="celular" aria-describedby="celularHelp" placeholder="Numero de celular do usuario">
                    </input-container-component>
                    <input-container-component titulo="Endereco" id="endereco" id-help="enderecoHelp" texto-ajuda="Informe o endereco do usuario">
                            <input type="text" class="form-control" id="endereco" v-model="endereco" aria-describedby="enderecoHelp" placeholder="Endereço do usuario">
                    </input-container-component>
                    <input-container-component titulo="Profissão" id="profissao" id-help="profissaoHelp" texto-ajuda="Informe a profissão do usuario">
                            <input type="text" class="form-control" id="profissao" v-model="profissao" aria-describedby="profissaoHelp" placeholder="Profissão do usuario">
                    </input-container-component>
                    <button type="button" class="btn btn-primary" @click="salvarEdicao()">Salvar</button>
                    <hr style="border: 1px solid white">
                </div>
                <div v-else-if="acao == 'editar'">
                    <input-container-component titulo="Nome" id="nome" id-help="nomeHelp" texto-ajuda="Informe o nome do usuario">
                            <input type="text" class="form-control" id="novoProjetoId" v-model="perfil.name" aria-describedby="nomeHelp" placeholder="Nome">
                    </input-container-component>
                    <input-container-component titulo="Email" id="email" id-help="emailHelp" texto-ajuda="Informe o email">
                            <input type="text" class="form-control" id="email" v-model="perfil.email" aria-describedby="emailHelp" placeholder="Email">
                    </input-container-component>
                    <input-container-component titulo="Idade" id="idade" id-help="idadeHelp" texto-ajuda="Informe a idade">
                        <input type="number" class="form-control-file" id="idade" v-model="perfil.idade" aria-describedby="idadeHelp" placeholder="Idade">
                    </input-container-component>
                    <input-container-component titulo="Descricao" id="descricao" id-help="descricaoHelp" texto-ajuda="Informe a Descricao do usuario">
                            <input type="text" class="form-control" id="descricao" v-model="perfil.descricao_perfil" aria-describedby="descricaoHelp" placeholder="Descricao do usuario">
                    </input-container-component>
                    <input-container-component titulo="Imagem de Perfil" id="novoImagemPerfil" id-help="novoImagemHelp" texto-ajuda="Selecione uma imagem no formato PNG">
                        <input type="file" class="form-control-file" id="novoImagemPerfil" @change="carregarImagemPerfil($event)" aria-describedby="novoImagemPerfilHelp" placeholder="Selecione uma imagem">
                    </input-container-component>
                    <input-container-component titulo="Imagem de descrição" id="novoImagemDescricao" id-help="novoImagemDescricaoHelp" texto-ajuda="Selecione uma imagem no formato PNG">
                        <input type="file" class="form-control-file" id="novoImagemDescricao" @change="carregarImagemDescricao($event)" aria-describedby="novoImagemDescricaoHelp" placeholder="Selecione uma imagem">
                    </input-container-component>
                    <input-container-component titulo="Curriculo" id="Curriculo" id-help="CurriculooHelp" texto-ajuda="Selecione um curriculo no formato PDF">
                        <input type="file" class="form-control-file" id="Curriculo" @change="carregarCurriculo($event)" aria-describedby="CurriculoHelp" placeholder="Selecione uma imagem">
                    </input-container-component>
                    <input-container-component titulo="Celular" id="celular" id-help="celularHelp" texto-ajuda="Informe o numero de celular do usuario">
                            <input type="text" class="form-control" id="celular" v-model="perfil.celular" aria-describedby="celularHelp" placeholder="Numero de celular do usuario">
                    </input-container-component>
                    <input-container-component titulo="Endereco" id="endereco" id-help="enderecoHelp" texto-ajuda="Informe o endereco do usuario">
                            <input type="text" class="form-control" id="endereco" v-model="perfil.endereco" aria-describedby="enderecoHelp" placeholder="Endereço do usuario">
                    </input-container-component>
                    <input-container-component titulo="Profissão" id="profissao" id-help="profissaoHelp" texto-ajuda="Informe a profissão do usuario">
                            <input type="text" class="form-control" id="profissao" v-model="perfil.profissao" aria-describedby="profissaoHelp" placeholder="Profissão do usuario">
                    </input-container-component>
                    <button type="button" class="btn btn-primary" @click="salvarEdicao()">Editar</button>
                    <hr style="border: 1px solid white">
                </div>
            </template>
        </modal-component>

        <modal-component id="modalInformacoesUsuario" :titulo="titulo">
            <template v-slot:botoes>
                <button type="button" class="btn btn-primary ml-5" @click="adcionarInformacao()">Adicionar</button>
            </template>
            <template v-slot:alertas>
                <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Cadastro realizado com sucesso" v-if="transacaoStatus == 'adicionado'"></alert-component>
                <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar cadastrar a projeto" v-if="transacaoStatus == 'erro'"></alert-component>
            </template>
            <template v-slot:conteudo>
                <div v-if="acao == 'adcionarInformacao'" class="animate__animated animate__slideInDown background-maneiro">
                    <input-container-component titulo="Id Usuario" id="idUsuario" id-help="idUsuarioHelp" texto-ajuda="ID do Usuario selecionado">
                            <input type="text" class="form-control" disabled id="idUsuario" v-model="perfil.id" aria-describedby="idUsuarioHelp" placeholder="Nome">
                    </input-container-component>
                    <input-container-component titulo="Tipo de informação" id="informacao" id-help="informacaoHelp" texto-ajuda="Informe o tipo de informacao">
                            <input type="text" class="form-control" id="informacao" v-model="tipoInformacao" aria-describedby="informacaoHelp" placeholder="Tipo da informacao">
                    </input-container-component>
                    <input-container-component titulo="Detalhe Informação" id="detalheInformacao" id-help="detalheInformacaoHelp" texto-ajuda="Informe o detalhe da Informação">
                            <input type="text" class="form-control" id="detalheInformacao" v-model="descricaoInformacao" aria-describedby="detalheInformacaoHelp" placeholder="Detalhe da informacao">
                    </input-container-component>
                    <button type="button" class="btn btn-primary" @click="salvarInformacao()">Salvar</button>
                    <hr style="border: 1px solid white">
                </div>
                <div v-else-if="acao == 'editarInformacao'" class="animate__animated animate__slideInUp background-maneiro">
                    <input-container-component titulo="Id Usuario" id="idUsuario" id-help="idUsuarioHelp" texto-ajuda="ID do Usuario selecionado">
                            <input type="text" class="form-control" disabled id="idUsuario" v-model="perfil.id" aria-describedby="idUsuarioHelp" placeholder="ID Informacao">
                    </input-container-component>
                    <input-container-component titulo="Id informacao" id="idInformacao" id-help="idInformacaoHelp" texto-ajuda="ID da informação selecionada">
                            <input type="text" class="form-control" disabled id="idInformacao" v-model="informacaoUsuario.id" aria-describedby="idInformacaoHelp" placeholder="ID Informacao">
                    </input-container-component>
                    <input-container-component titulo="Tipo de informação" id="informacao" id-help="informacaoHelp" texto-ajuda="Informe o tipo de informacao">
                            <input type="text" class="form-control" id="informacao" v-model="informacaoUsuario.tipo" aria-describedby="informacaoHelp" placeholder="Tipo da informacao">
                    </input-container-component>
                    <input-container-component titulo="Detalhe Informação" id="detalheInformacao" id-help="detalheInformacaoHelp" texto-ajuda="Informe o detalhe da Informação">
                            <input type="text" class="form-control" id="detalheInformacao" v-model="informacaoUsuario.descricao" aria-describedby="detalheInformacaoHelp" placeholder="Detalhe da informacao">
                    </input-container-component>
                    <button type="button" class="btn btn-primary" @click="salvarEdicaoInformacao()">Salvar Informações</button>
                    <hr style="border: 1px solid white">
                </div>
                <div v-else><hr></div>
                <table class="table table-dark" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Descricao</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(informacao, chave) in perfil.informacoes" :key="chave">
                            <td>{{informacao.id}}</td>
                            <td>{{informacao.tipo}}</td>
                            <td>{{informacao.descricao}}</td>
                            <td></td>
                            <td class="d-flex justify-content-end">
                                <button type="Button" @click="editarInformacaoUsuario(informacao)" class="btn btn-secondary btn-sm mr-2">Editar</button>
                                <button type="Button"  @click="excluirInformacaoUsuario(informacao.id)" class="btn btn-danger btn-sm ">Deletar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </template>
        </modal-component>
        
    </div>
</template>

<script>
export default {
    data() {
        return {
            urlBase: 'http://angelofrancisco.site/api/user',
            urlInformacao: 'http://angelofrancisco.site/api/informacao',
            usuarios: [],
            nome: '',
            email: '',
            idade: '',
            descricao_perfil: '',
            foto_perfil: [],
            foto_descricao: [],
            curriculo: [],
            celular: '',
            endereco: '',
            profissao: '',
            transacaoStatus: '',
            transacaoDetalhes: {},
            acao: '',
            perfil: [],
            titulo: '',
            tipoInformacao: '',
            descricaoInformacao: '',
            informacaoUsuario: []
        }
    },
    methods: {
        collapse(){
            $('#sidebar, #content').toggleClass('active');
        },
        carregarImagemPerfil(e){
              this.foto_perfil = e.target.files  
        },
        carregarImagemDescricao(e){
              this.foto_descricao = e.target.files  
        },
        carregarCurriculo(e){
              this.curriculo = e.target.files  
        },
        carregarUsuarios() {
            axios.get(this.urlBase)
                .then(response => {
                    this.usuarios = response.data
                })
                .catch(errors => {
                    console.log(errors)
                })
        },
        carregarUsuario(id) {
            this.acao = ''
            axios.get(this.urlBase+'/'+id)
                .then(response => {
                    this.perfil = response.data
                    this.titulo = 'Editar usuario: '+ this.perfil.name + ' - ID: '+this.perfil.id
                    this.acao = 'editar'
                })
                .catch(errors => {
                    console.log(errors)
                })
        },
        excluirInformacaoUsuario(id) {
            if (confirm('Deseja excluir essa informacao?')){
                axios.delete(this.urlInformacao+'/'+id)
                    .then(response => {
                        this.transacaoStatus = 'deletado'
                        this.transacaoDetalhes = {
                            mensagem: 'ID do registro: ' + response.data.id
                        }
                        this.carregarUsuario(this.perfil.id)
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
        adcionarInformacao(){
            this.acao = 'adcionarInformacao'
        },
        adicionarUsuario(){
            this.acao = 'adcionar'
            this.titulo = 'Adicionar novo usuário'
        },
        editarInformacaoUsuario(informacao){
            this.acao = ''
            console.log(this.acao)
            this.acao = 'editarInformacao'
            console.log(this.acao)
            this.informacaoUsuario = informacao
        },
        salvarEdicao(){
            let formData = new FormData()
            console.log(this.curriculo[0])
            formData.append('name', this.perfil.name)
            formData.append('email', this.perfil.email)
            formData.append('idade', this.perfil.idade)
            formData.append('descricao_perfil', this.perfil.descricao_perfil)
            formData.append('foto_perfil', this.foto_perfil[0])
            formData.append('foto_descricao', this.foto_descricao[0])
            formData.append('curriculo', this.curriculo[0])
            formData.append('celular', this.perfil.celular)
            formData.append('endereco', this.perfil.endereco)
            formData.append('profissao', this.perfil.profissao)
            formData.append('_method', 'patch')


            let config = {
                headers: {
                    'Content-type': 'multipart/form-data',
                    'Accept': 'application/json'
                }
            }
            
            if (confirm('Deseja atualizar dados do usuario?')){
                axios.post(this.urlBase+'/'+this.perfil.id, formData, config)
                    .then(response => {
                        this.transacaoStatus = 'Atualizado'
                        this.transacaoDetalhes = {
                            mensagem: 'ID do registro: ' + response.data.id
                        }
                        this.carregarUsuarios()
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
        salvarEdicaoInformacao(){
            let formData = new FormData()
            formData.append('user_id', this.informacaoUsuario.user_id)
            formData.append('tipo', this.informacaoUsuario.tipo)
            formData.append('descricao', this.informacaoUsuario.descricao)
            formData.append('_method', 'put')


            let config = {
                headers: {
                    'Content-type': 'multipart/form-data',
                    'Accept': 'application/json'
                }
            }
            if (confirm('Deseja atualiza informacao?')){
                axios.post(this.urlInformacao+'/'+this.informacaoUsuario.id, formData, config)
                    .then(response => {
                        this.transacaoStatus = 'Atualizado'
                        this.transacaoDetalhes = {
                            mensagem: 'ID do registro: ' + response.data.id
                        }
                        this.carregarUsuario(this.perfil.id)
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
        salvarInformacao(){
            let formData = new FormData()
            formData.append('user_id', this.perfil.id)
            formData.append('tipo', this.tipoInformacao)
            formData.append('descricao', this.descricaoInformacao)

            let config = {
                headers: {
                    'Content-type': 'multipart/form-data',
                    'Accept': 'application/json'
                }
            }
            if (confirm('Deseja adicionar nova informacao?')){
                axios.post(this.urlInformacao, formData, config)
                    .then(response => {
                        this.transacaoStatus = 'Atualizado'
                        this.transacaoDetalhes = {
                            mensagem: 'ID do registro: ' + response.data.id
                        }
                        this.carregarUsuario(this.perfil.id)
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
        
    },
    mounted() {
        this.carregarUsuarios()
    }
}
</script>
    
<style>
    .form-control:disabled, .form-control[readonly] {
        background-color: gray;
        opacity: 1;
    }
</style>