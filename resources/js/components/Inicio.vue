<template>
    <div>
        <div class="background-inicio">
            <div class="conteudo-inicio">
                    <div class="container-conteudo-inicio">
                        <div class="circulo mb-3">

                        </div>
                        <h1>Angelo Francisco</h1>
                        <h4>Desenvolvedor web</h4>
                    </div>
            </div>
        </div>
        <div class="background-maneiro2">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="card mb-3 card-habilidades" style="max-width: 1000px; border:none">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img src="/storage/imagens/perfilAngelo.jpg" width="100%" alt="Imagem Angelo Francisco">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title" ><span style="border-bottom: 1px solid red">Sobre mim</span></h5>
                                <p class="card-text">Meu nome é Angelo Francisco, Sou desenvolvedor web júnior, estou em busca de me ingressar no mercado de trabalho, sou dedicado, responsavel e amo minha profissão.<br>
                                Sou formado em Analise e Desenvolvimento de Sistemas na Estácio de Sá<br>
                                </p>
                                <h5 class="card-title"><span style="border-bottom: 1px solid red">Mais informações</span></h5>
                                <div>
                                    <div class="row informacoes p-2">
                                        <div class="col">
                                        <p><strong>Nome:</strong> Angelo Francisco</p>
                                        <p><strong>Telefone:</strong> (21) 3592-0740 </p>
                                        <p><strong>Email:</strong> angelofrancisco@outlook.com </p>
                                        
                                        </div>
                                        <div class="col">
                                        <p><strong>Idade:</strong> 24 anos</p>
                                        <p><strong>Endereço:</strong> Rio de Janeiro, RJ</p>
                                        <p><strong>Emprego:</strong> Procurando emprego</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!--div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Inicio</div>

                        </div>
                    </div-->
                </div>
            </div>
        </div>
        <div class="background-maneiro">
            <div class="container pt-5">
                <div class="row">
                    <h4 class="mb-5"><span style="text-align: left; border-bottom: 1px solid red; color: white">Algumas habilidades</span></h4>
                    <div class="card-group">
                        <div class="card card-habilidades"> 
                            <img src="/storage/imagens/iconephp.png" class="card-img-top ml-3" alt="teste">
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
                        <div class="card card-habilidades">
                            <img src="/storage/imagens/iconecss.png" class="card-img-top ml-3" alt="teste">
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
                        <div class="card card-habilidades" >
                            <img src="/storage/imagens/iconebd.png" class="card-img-top ml-3" alt="teste">
                            <div class="card-body">
                            <h5 class="card-title">Banco de Dados</h5>
                            <p class="card-text">Tenho conhecimentos em PostgresSql e Mysql.<br>
                            Adiquiri esses conhecimentos principalmente na faculdade e no estágio que eu fiz durante a faculdade.</p>
                            <p class="card-text">Tenho capacidade de criar banco de dados com relacionamentos, realizar o CRUD, realizar pesquisas avançadas entre outros.</p>
                            </div>
                        </div>
                    </div>

                    <!--div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Inicio</div>

                        </div>
                    </div-->
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
export default {

}
</script>

<style>
    .background-inicio{
    max-width: 100%;
    background-image: url(/storage/imagens/backgroundProgramador.jpg);
    background-position: center center;
    background-attachment: scroll;
    background-repeat: no-repeat;
    background-size: contain;
    background-size: cover;
    }
    
    .conteudo-inicio {
        background: rgba(0,0,0,0.7); 
        width: 100%; 
        height: 100%;
        padding-top: 100px;
        padding-bottom: 100px;
        padding-left: 20px;
        padding-right: 20px;
    }
    .circulo {
        width: 150px;
        height: 150px;
        background-image: url(/storage/imagens/perfilAngelo.jpg);
        background-position: center center;
        background-size: contain;
        background-size: cover;
        border-radius: 50%;
        border: 1px solid white;
    }
    .container-conteudo-inicio{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
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
    .card-img-top{
        width: 20%;
    }
    .card-habilidades{
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.7);
        color: white;
    }
    
</style>