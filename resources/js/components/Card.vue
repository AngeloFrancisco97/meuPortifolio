<template>
    <div>
            <div class="container pt-5">
                <div class="">
                    <h4 class="mb-5"><span style="text-align: left; border-bottom: 1px solid red; color: white">Algumas habilidades</span></h4>
                    <div class="">
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <!--div class="col-4 card card-habilidades"> 
                                <img src="/storage/imagens/iconephp.png" class="card-img-top ml-3" style="width: 20%;" alt="teste">
                                <div class="card-body">
                                <h5 class="card-title">Backend</h5>
                                <p class="card-text">Tenho conhecimentos na linguagem PHP, e no framework Laravel.<br>
                                Adquiri esses conhecimentos através do estágio que eu fiz durante a faculdade e em cursos onlines.
                                </p>
                                <h5 class="card-title"> Cursos </h5>
                                <p class="card-text">Curso PHP Jedai - Danki Code.<br>
                                Desenvolvimento Web Avançado 2021 com PHP, Laravel e Vue.JS - Plataforma Udemy.</p>
                                </div>
                            </div>
                            <div class="col-4 card card-habilidades">
                                <img src="/storage/imagens/iconecss.png" class="card-img-top ml-3" style="width: 20%;"  alt="teste">
                                <div class="card-body">
                                <h5 class="card-title">Frontend</h5>
                                <p class="card-text">Tenho conhecimentos em HTML, CSS, JavaScript, Jquery, Bootstrap e VueJs.<br>
                                Adiquiri esses conhecimentos através do estágio que eu fiz durante a faculdade e em cursos onlines.
                                </p>
                                <h5 class="card-title"> Cursos </h5>
                                <p class="card-text">Curso prático - HTML 5, CSS 3, JS + Bootstrap 3.3 e JQuery - Plataforma Udemy.<br>
                                Aprenda Javascript, jQuery, Ajax e Json do Zero na Prática - Plataforma Udemy.<br>
                                Curso Vue JS 2 - O Guia Completo (incl. Vue Router & Vuex) - Plataforma Udemy.
                                </p>
                                </div>
                            </div>
                            <div class="col-4 card card-habilidades" >
                                <img src="/storage/imagens/iconebd.png" class="card-img-top ml-3" style="width: 20%;"  alt="teste">
                                <div class="card-body">
                                <h5 class="card-title">Banco de Dados</h5>
                                <p class="card-text">Tenho conhecimentos em PostgresSql e Mysql.<br>
                                Adiquiri esses conhecimentos principalmente na faculdade e no estágio que eu fiz durante a faculdade.</p>
                                <p class="card-text">Tenho capacidade de criar banco de dados com relacionamentos, realizar o CRUD, realizar pesquisas avançadas entre outros.</p>
                                </div>
                            </div-->
                            <div class="col" v-for="habilidade, chave in dados" :key="chave">
                                <div class="card h-100 card-habilidades">
                                    <img :src="'/storage/'+habilidade.imagem" class="card-img-top ml-3" style="width: 20%;"  alt="teste">
                                    <div class="card-body">
                                        <h5 class="card-title">{{habilidade.titulo}}</h5>
                                        <p class="card-text" v-html="habilidade.descricao"></p>
                                        <div v-if="habilidade.cursos !== null">
                                            <h5 class="card-title"> Cursos </h5>
                                            <p class="card-text" v-html="habilidade.cursos"></p>
                                        </div>
                                    </div>
                                    <div v-if="admin" class="card-footer d-flex justify-content-around">
                                        <button  type="Button" id="editar" data-toggle="modal" data-target="#modalHabilidade" @click="editar(habilidade)" class="btn btn-secondary btn-sm ">Editar</button>
                                        <button type="Button"  @click="excluirProjeto(habilidade.id)" class="btn btn-danger btn-sm ">Deletar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    props: ['dados', 'admin'],
    methods: {
        editar(habilidade){
            this.$emit('acaoEditar', {habilidade: habilidade})
        },
        excluirProjeto(id){
            this.$emit('acaoExcluir', {habilidadeId: id})
        }
    },
    mounted() {
    }

}
</script>

<style>
    .card-img-top{
        width: 20%;
    }
    .card-habilidades{
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.7);
        color: white;
    }
</style>