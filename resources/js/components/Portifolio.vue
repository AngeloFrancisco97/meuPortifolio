<template>
    <div>
        <background-menu-component class="background-portifolio">
            <h1>PROJETOS REALIZADOS</h1>
            <h4>Alguns projetos realizados por mim (a fins de treinamento ou profissional)</h4>
            <hr class="linha">
        </background-menu-component>
        <card-portifolio-component :dados="projetos" class="background-maneiro">
        </card-portifolio-component>
    </div>
    
    
</template>

<script>
export default {
    data() {
        return {
            urlBase: 'http://angelofrancisco.site/api/projeto',
            projetos: [],
        }
    },
    methods: {
        carregarProjetos() {
            axios.get(this.urlBase)
                .then(response => {
                    this.projetos = response.data
                })
                .catch(errors => {
                    console.log(errors)
                })
        }
    },
    mounted() {
        this.carregarProjetos()
    }
}
</script>

<style>
    .background-portifolio{
        background-image: url(/storage/imagens/portifolioBackground.jpg);
    }
    .linha{
        border: 2px solid darkorange;
        width: 10%;
    }
    .modal-dialog{
        max-width: 90% !important;
    }
</style>