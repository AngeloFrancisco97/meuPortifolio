<template>
    <modal-component id="modalProjeto" titulo="Adicionar Projeto">
            <template v-slot:conteudo>
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
                        <input type="text" class="form-control" id="novoDescricaoCompleta" v-model="descricaoCompletaProjeto" aria-describedby="novoDescricaoCompletaHelp" placeholder="Descricao completa do projeto">
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
        </modal-component>
</template>

<script>
export default {

}
</script>

<style>

</style>