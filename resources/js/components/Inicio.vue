<template>
    <div>
        <background-menu-component class="background-inicio">
                <div class="circulo mb-3" v-if="user.foto_perfil" :style="'background-image: url(/storage/'+user.foto_perfil+')'"></div>
                <h1>{{user.name}}</h1>
                <h4>{{user.profissao}}</h4>
        </background-menu-component>
        <div class="background-maneiro2">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="card mb-3 card-habilidades" style="max-width: 100%; border:none">
                        <div class="row g-0 m-0">
                            <div class="col-md-4 p-0">
                                <img v-if="user.foto_descricao" :src="'/storage/'+user.foto_descricao" width="100%" alt="Imagem Angelo Francisco">
                                <div class="d-flex justify-content-center">
                                <a :href="'/storage/'+user.curriculo" target="_blank" class="mt-4 mb-3 btn btn-primary btn-lg">Ver Curriculo</a>
                                </div>
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title" ><span style="border-bottom: 1px solid red">Sobre mim</span></h5>
                                <p class="card-text" v-html="user.descricao_perfil"></p>
                                <h5 class="card-title"><span style="border-bottom: 1px solid red">Mais informações</span></h5>
                                <div>
                                    <div class="row informacoes p-2">
                                        <div class="col-6">
                                            <p><strong>Nome:</strong> {{user.name}}</p>
                                        </div>
                                        <div class="col-6">
                                            <p><strong>Idade:</strong> {{user.idade}}</p>
                                        </div>
                                        <div class="col-6">
                                            <p><strong>Celular:</strong> {{user.celular}} </p>
                                        </div>
                                        <div class="col-6">
                                            <p><strong>Email:</strong> {{user.email}}</p>
                                        </div>
                                        <div class="col-6">
                                            <p><strong>Endereco:</strong> {{user.endereco}}</p>
                                        </div>
                                        <div class="col-6" v-for="informacao, chave in user.informacoes" :key="chave">
                                            <p><strong v-html="informacao.tipo"></strong> <span class="link" v-html="informacao.descricao"></span> </p>
                                        </div>

                                    </div>
                                    
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <card-component :dados="habilidades" class="background-maneiro"></card-component>
        <div class="d-flex justify-content-center">
            <a :href="portifolio"  class="mb-5 mt-3 btn btn-secondary btn-lg">Ver Projetos</a>
        </div>
        
    </div>
</template>

<script>
export default {
    props: ['portifolio'],
    data() {
        return {
            urlBase: 'http://angelofrancisco.site/api/user',
            urlHabilidade:'http://angelofrancisco.site/api/habilidade',
            user: [],
            habilidades: [],
        }
    },
    methods: {
        carregarAngelo() {
            axios.get(this.urlBase+'/1')
                .then(response => {
                    this.user = response.data
                })
                .catch(errors => {
                    console.log(errors)
                })
        },
        carregarHabilidades() {
            axios.get(this.urlHabilidade)
                .then(response => {
                    this.habilidades = response.data
                })
                .catch(errors => {
                    console.log(errors)
                })
        },
    },
    mounted() {
        this.carregarAngelo()
        this.carregarHabilidades()
    }
}
</script>

<style>
    .background-inicio{
        background-image: url(/storage/imagens/backgroundProgramador.jpg);
    }
    .circulo {
        width: 150px;
        height: 150px;
        background-position: center center;
        background-size: contain;
        background-size: cover;
        border-radius: 50%;
        border: 1px solid white;
    }
    .background-maneiro{
        background: rgb(0,0,0);
        background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(87,87,87,1) 0%, rgba(104,104,105,1) 100%);
    }
    .informacoes{
        border: 1px solid white;
    }
    .background-maneiro2{
        background: rgb(0,0,0);
        background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(18,18,18,1) 0%, rgba(74,74,74,1) 0%);
    }
    body{
        background: rgb(0,0,0);
        background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(87,87,87,1) 0%, rgba(104,104,105,1) 100%);
    }
    
</style>