<template>
    <div class="page-content" style="padding-top: 70px;" id="content">
            <slot></slot>

        <div class="p-5" >
            <!-- Toggle button -->
            <button id="sidebarCollapse" @click="collapse()" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Menu</small></button>
            <button type="Button" data-toggle="modal" data-target="#modalHabilidade" @click="acao = 'adcionar', tituloModal = 'Adicionar nova Habilidade'" class="btn btn-primary btn-sm float-right">Adicionar</button>
            <card-component class="" @acaoExcluir="excluirHabilidade" @acaoEditar="selecionarHabilidade" admin="true" :dados="habilidades">
            </card-component>
            <!-- Demo content -->

            <modal-component id="modalHabilidade" :titulo="tituloModal">
            <template v-slot:alertas>
                <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Cadastro realizado com sucesso" v-if="transacaoStatus == 'adicionado'"></alert-component>
                <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar cadastrar a projeto" v-if="transacaoStatus == 'erro'"></alert-component>
            </template>
            <template v-slot:conteudo >
                <div v-if="acao == 'adcionar'">
                    <input-container-component titulo="Titulo da Habilidade" id="titulo" id-help="tituloHelp" texto-ajuda="Titulo da habilidade">
                            <input type="text" class="form-control" id="titulo" v-model="titulo" aria-describedby="tituloHelp" placeholder="Titulo">
                    </input-container-component>
                    <input-container-component titulo="Imagem" id="imagem" id-help="imagemHelp" texto-ajuda="Selecione uma imagem">
                        <input type="file" class="form-control-file" id="imagem" @change="carregarImagem($event)" aria-describedby="imagemHelp" placeholder="Selecione uma imagem">
                    </input-container-component>
                    <input-container-component titulo="Descrição da Habilidade" id="descricaoHabilidade" id-help="descricaoInformacaoHelp" texto-ajuda="Informe a descricao da Habilidade">
                            <textarea class="form-control" id="descricaoHabilidade" v-model="descricao" aria-describedby="descricaoHabilidadeHelp" placeholder="Descrição da Habilidade"></textarea>
                    </input-container-component>
                    <input-container-component titulo="Cursos" id="cursos" id-help="cursosHelp" texto-ajuda="Informe os cursos feito">
                            <input type="text" class="form-control" id="cursos" v-model="cursos" aria-describedby="cursosHelp" placeholder="Cursos">
                    </input-container-component>
                    <button type="button" class="btn btn-primary" @click="salvar()">Salvar</button>
                    <hr style="border: 1px solid white">
                </div>
                <div v-else-if="acao == 'editar'">
                    <input-container-component titulo="Titulo da Habilidade" id="titulo" id-help="tituloHelp" texto-ajuda="Titulo da habilidade">
                            <input type="text" class="form-control" id="titulo" v-model="habilidade.titulo" aria-describedby="tituloHelp" placeholder="Titulo">
                    </input-container-component>
                    <input-container-component titulo="Imagem" id="imagem" id-help="imagemHelp" texto-ajuda="Selecione uma imagem">
                        <input type="file" class="form-control-file" id="imagem" @change="carregarImagem($event)" aria-describedby="imagemHelp" placeholder="Selecione uma imagem">
                    </input-container-component>
                    <input-container-component titulo="Descrição da Habilidade" id="descricaoHabilidade" id-help="descricaoInformacaoHelp" texto-ajuda="Informe a descricao da Habilidade">
                            <input type="text" class="form-control" id="descricaoHabilidade" v-model="habilidade.descricao" aria-describedby="descricaoHabilidadeHelp" placeholder="Descrição da Habilidade">
                    </input-container-component>
                    <input-container-component titulo="Cursos" id="cursos" id-help="cursosHelp" texto-ajuda="Informe os cursos feito">
                            <textarea class="form-control" id="cursos" v-model="habilidade.cursos" aria-describedby="cursosHelp" placeholder="Cursos"></textarea>
                    </input-container-component>
                    <button type="button" class="btn btn-primary" @click="editarHabilidade()">Salvar Informações</button>
                    <hr style="border: 1px solid white">
                </div>
            </template>
        </modal-component>

        </div>
        
    </div>
</template>

<script>
export default {
    data() {
        return {
            urlBase: 'http://angelofrancisco.site/api/habilidade',
            transacaoStatus: '',
            transacaoDetalhes: {},
            acao: '',
            tituloModal: '',
            titulo: '',
            imagem: [],
            descricao: '',
            cursos: '',
            habilidades: [],
            habilidade: {}
        }
    },
    computed: {
        },
    methods: {
        
        collapse(){
            $('#sidebar, #content').toggleClass('active');
        },
        carregarImagem(e){
            this.imagem = e.target.files
        },
        carregarHabilidades() {
            axios.get(this.urlBase)
                .then(response => {
                    this.habilidades = response.data
                })
                .catch(errors => {
                })
        },
        salvar(){
            let formData = new FormData()
            formData.append('titulo', this.titulo)
            formData.append('imagem', this.imagem[0])
            formData.append('descricao', this.descricao)
            formData.append('cursos', this.cursos)

            let config = {
                headers: {
                    'Content-type': 'multipart/form-data',
                    'Accept': 'application/json'
                }
            }
            if (confirm('Deseja adicionar nova habilidade?')){
                axios.post(this.urlBase, formData, config)
                .then(response => {
                    this.transacaoStatus = 'Adicionado'
                    this.transacaoDetalhes = {
                        mensagem: 'ID do registro: ' + response.data.id
                    }
                    this.carregarHabilidades()
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
        selecionarHabilidade(habilidade){
            this.acao = 'editar'
            this.habilidade = habilidade.habilidade
        },
        editarHabilidade(){
            let formData = new FormData()
                formData.append('titulo', this.habilidade.titulo)
                formData.append('imagem', this.imagem[0])
                formData.append('descricao', this.habilidade.descricao)
                formData.append('cursos', this.habilidade.cursos)
                formData.append('_method', 'put')
            let config = {
                headers: {
                    'Content-type': 'multipart/form-data',
                    'Accept': 'application/json'
                }
            }
            if (confirm('Deseja editar habilidade?')){
                axios.post(this.urlBase+'/'+this.habilidade.id, formData, config)
                    .then(response => {
                        this.transacaoStatus = 'editado'
                        this.transacaoDetalhes = {
                            mensagem: 'ID do registro: ' + response.data.id
                        }
                        this.carregarHabilidades()
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
        excluirHabilidade(id){
            if (confirm('Deseja excluir habilidade?')){

                axios.delete(this.urlBase+'/'+id.habilidadeId)
                .then(response => {
                    this.transacaoStatus = 'deletado'
                    this.transacaoDetalhes = {
                        mensagem: 'ID do registro: ' + response.data.id
                    }
                    this.carregarHabilidades()
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
        }
    },
    mounted() {
        this.carregarHabilidades()
        
    }
}
</script>

<style>

</style>