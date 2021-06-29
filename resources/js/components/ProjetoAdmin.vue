<template>
    <div class="page-content" style="padding-top: 70px;" id="content">
            <slot></slot>

        <div class="p-5" >
            <!-- Toggle button -->
            <button id="sidebarCollapse" @click="collapse()" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Menu</small></button>
            <button type="Button" data-toggle="modal" data-target="#modalProjeto" @click="acao = 'adcionar'" class="btn btn-primary btn-sm float-right">Adicionar</button>
            <card-portifolio-component @refresh="carregarProjetos" @editarProjeto="editarProjeto" :dados="projetos" admin="true" class="background-maneiro">
            </card-portifolio-component>
            <!-- Demo content -->

        </div>
        <modal-component id="modalProjeto" titulo="Adicionar Projeto">
            <template v-slot:alertas>
                <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Cadastro realizado com sucesso" v-if="transacaoStatus == 'adicionado'"></alert-component>
                <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar cadastrar a projeto" v-if="transacaoStatus == 'erro'"></alert-component>
            </template>
            <template v-if="acao == 'adcionar'" v-slot:conteudo>
                <div class="form-group">
                    <input-container-component titulo="Nome do projeto" id="novoNome" id-help="novoNomeHelp" texto-ajuda="Informe o nome da projeto">
                        <input type="text" class="form-control" id="novoNome" v-model="nomeProjeto" aria-describedby="novoNomeHelp" placeholder="Nome da projeto">
                    </input-container-component>
                </div>
                <div class="form-group">
                    <input-container-component titulo="Capa do projeto" id="novoImagem" id-help="novoImagemHelp" texto-ajuda="Selecione uma imagem no formato PNG">
                        <input type="file" class="form-control-file" id="novoImagem" @change="carregarImagem($event)" aria-describedby="novoImagemHelp" placeholder="Selecione uma imagem">
                    </input-container-component>
                </div>
                <div class="form-group">
                    <input-container-component titulo="Descricao do projeto" id="novoDescricao" id-help="novoDescricaoHelp" texto-ajuda="Informe a descricao do Projeto">
                        <input type="text" class="form-control" id="novoDescricao" v-model="descricaoProjeto" aria-describedby="novoDescricaoHelp" placeholder="Descricao do projeto">
                    </input-container-component>
                </div>
                <div class="form-group">
                    <input-container-component titulo="Descricao completa do projeto" id="novoDescricaoCompleta" id-help="novoDescricaoCompletaHelp" texto-ajuda="Informe a descricao completa projeto">
                        <textarea class="form-control" id="novoDescricaoCompleta" v-model="descricaoCompletaProjeto" aria-describedby="novoDescricaoCompletaHelp" placeholder="Descricao completa do projeto"> </textarea>
                    </input-container-component>
                </div>
                <div class="form-group">
                    <input-container-component titulo="Ferramentas utilizadas no projeto" id="novoFerramentas" id-help="novoFerramentasHelp" texto-ajuda="Informe as ferramentas utilizadas no projeto">
                        <input type="text" class="form-control" id="novoFerramentas" v-model="ferramentas" aria-describedby="novoFerramentasHelp" placeholder="Ferramentas utilizadas no projeto">
                    </input-container-component>
                </div>
                <div class="form-group">
                    <input-container-component titulo="Repositorio do projeto" id="novoRepositorio" id-help="novoRepositorioHelp" texto-ajuda="Informe o repositorio projeto">
                        <input type="text" class="form-control" id="novoRepositorio" v-model="repositorio" aria-describedby="novoRepositorioHelp" placeholder="Repositorio projeto">
                    </input-container-component>
                </div>
            </template>
            <template v-else-if="acao == 'editar'" v-slot:conteudo>
                <div class="form-group">
                    <input-container-component titulo="Nome do projeto" id="novoNome" id-help="novoNomeHelp" texto-ajuda="Informe o nome da projeto">
                        <input type="text" class="form-control" id="novoNome" v-model="dadosProjeto.nome" aria-describedby="novoNomeHelp" placeholder="Nome da projeto">
                    </input-container-component>
                </div>
                <div class="form-group">
                    <input-container-component titulo="Capa do projeto" id="novoImagem" id-help="novoImagemHelp" texto-ajuda="Selecione uma imagem no formato PNG">
                        <input type="file" class="form-control-file" id="novoImagem" @change="carregarImagem($event)" aria-describedby="novoImagemHelp" placeholder="Selecione uma imagem">
                    </input-container-component>
                </div>
                <div class="form-group">
                    <input-container-component titulo="Descricao do projeto" id="novoDescricao" id-help="novoDescricaoHelp" texto-ajuda="Informe a descricao do Projeto">
                        <input type="text" class="form-control" id="novoDescricao" v-model="dadosProjeto.descricao" aria-describedby="novoDescricaoHelp" placeholder="Descricao do projeto">
                    </input-container-component>
                </div>
                <div class="form-group">
                    <input-container-component titulo="Descricao completa do projeto" id="novoDescricaoCompleta" id-help="novoDescricaoCompletaHelp" texto-ajuda="Informe a descricao completa projeto">
                        <textarea class="form-control" id="novoDescricaoCompleta" v-model="dadosProjeto.descricao_completa" aria-describedby="novoDescricaoCompletaHelp" placeholder="Descricao completa do projeto"> </textarea>
                    </input-container-component>
                </div>
                <div class="form-group">
                    <input-container-component titulo="Ferramentas utilizadas no projeto" id="novoFerramentas" id-help="novoFerramentasHelp" texto-ajuda="Informe as ferramentas utilizadas no projeto">
                        <input type="text" class="form-control" id="novoFerramentas" v-model="dadosProjeto.ferramentas" aria-describedby="novoFerramentasHelp" placeholder="Ferramentas utilizadas no projeto">
                    </input-container-component>
                </div>
                <div class="form-group">
                    <input-container-component titulo="Repositorio do projeto" id="novoRepositorio" id-help="novoRepositorioHelp" texto-ajuda="Informe o repositorio projeto">
                        <input type="text" class="form-control" id="novoRepositorio" v-model="dadosProjeto.repositorio" aria-describedby="novoRepositorioHelp" placeholder="Repositorio projeto">
                    </input-container-component>
                </div>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button v-if="acao == 'adcionar'" type="button" class="btn btn-primary" data-dismiss="modal" @click="salvar()">Salvar</button>
                <button v-else-if="acao == 'editar'" type="button" class="btn btn-primary" @click="editar()">Editar</button>
            </template>
        </modal-component>
    </div>
</template>

<script>
export default {
    data() {
        return {
            urlBase: 'http://angelofrancisco.site/api/projeto',
            projetos: [],
            nomeProjeto: '',
            capaProjeto: '',
            descricaoProjeto: '',
            descricaoCompletaProjeto: '',
            ferramentas: '',
            repositorio: '',
            transacaoStatus: '',
            transacaoDetalhes: {},
            acao: '',
            dadosProjeto: {}
        }
    },
    methods: {
        collapse(){
            $('#sidebar, #content').toggleClass('active');
        },
        carregarProjetos() {
            axios.get(this.urlBase)
                .then(response => {
                    this.projetos = response.data
                })
                .catch(errors => {
                    console.log(errors)
                })
        },
        carregarImagem(e){
              this.capaProjeto = e.target.files  
        },

        salvar(){
            let formData = new FormData()
            formData.append('nome', this.nomeProjeto)
            formData.append('capa_projeto', this.capaProjeto[0])
            formData.append('descricao', this.descricaoProjeto)
            formData.append('descricao_completa', this.descricaoCompletaProjeto)
            formData.append('ferramentas', this.ferramentas)
            formData.append('repositorio', this.repositorio)

            let config = {
                headers: {
                    'Content-type': 'multipart/form-data',
                    'Accept': 'application/json'
                }
            }
            if (confirm('Deseja adicionar novo projeto?')){
                axios.post(this.urlBase, formData, config)
                    .then(response => {
                        this.transacaoStatus = 'adicionado'
                        this.transacaoDetalhes = {
                            mensagem: 'ID do registro: ' + response.data.id
                        }
                        this.carregarProjetos()
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
        editar(){
            let formData = new FormData()
            formData.append('nome', this.dadosProjeto.nome)
            formData.append('capa_projeto', this.capaProjeto[0])
            formData.append('descricao', this.dadosProjeto.descricao)
            formData.append('descricao_completa', this.dadosProjeto.descricao_completa)
            formData.append('ferramentas', this.dadosProjeto.ferramentas)
            formData.append('repositorio', this.dadosProjeto.repositorio)
            formData.append('_method', 'put')


            let config = {
                headers: {
                    'Content-type': 'multipart/form-data',
                    'Accept': 'application/json'
                }
            }

            if (confirm('Deseja atualizar projeto?')){
                axios.post(this.urlBase+'/'+this.dadosProjeto.id, formData, config)
                    .then(response => {
                        this.transacaoStatus = 'Atualizado'
                        this.transacaoDetalhes = {
                            mensagem: 'ID do registro: ' + response.data.id
                        }
                        this.carregarProjetos()
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
        editarProjeto(projeto){
            this.acao = 'editar'
            this.dadosProjeto = projeto.dados
        },
        
        editarTela(detalhe){
            this.$emit('editar', {dados: detalhe})
        }
    },
    mounted() {
        this.carregarProjetos()
    }
}
</script>

<style>

</style>