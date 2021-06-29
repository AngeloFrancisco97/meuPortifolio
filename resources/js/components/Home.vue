<template>
    <div class="page-content" style="padding-top: 70px" id="content">
            <slot></slot>

        <div class="p-5" >
            <!-- Toggle button -->
            <button id="sidebarCollapse" @click="collapse()" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Menu</small></button>

            <!-- Demo content -->
            <div class="d-flex jusfify-content-left" style="font-size: 20px;">
                <a :href="projetos" class="mr-3"  style="text-decoration:none !important" >
                    <div class="py-4 px-5 flex-column d-flex justify-content-center align-items-center" id="projetos" @mouseover="botoesOver('projetos')" @mouseleave="botoesLeave('projetos')" style="background: gray; color:white; border-radius: 10%">
                        <i class="fas fa-project-diagram mb-2" style="font-size: 30px"></i>
                        <span>Projetos</span>
                    </div>
                </a>
                <a :href="perfil" class="mr-3" >
                    <div class="py-4 px-5 flex-column d-flex justify-content-center align-items-center" id="perfil" @mouseover="botoesOver('perfil')" @mouseleave="botoesLeave('perfil')" style="background: gray; color:white; border-radius: 10%">
                        <i class="fas fa-user mb-2" style="font-size: 30px"></i>
                        <span>Usuarios</span>
                    </div>
                </a><a :href="habilidades" class="mr-3" >
                    <div class="py-4 px-5 flex-column d-flex justify-content-center align-items-center" id="habilidades" @mouseover="botoesOver('habilidades')" @mouseleave="botoesLeave('habilidades')" style="background: gray; color:white; border-radius: 10%">
                        <i class="fas fa-tools mb-2" style="font-size: 30px"></i>
                        <span>Habilidades</span>
                    </div>
                </a>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    props: ['projetos', 'habilidades', 'perfil'],
    data() {
        return {
            link: ''
        }
    },
    
    methods: {
        collapse(){
            $('#sidebar, #content').toggleClass('active');
        },
        botoesOver(link){
            $("#"+link).css("background-color", "darkgray");
        },
        botoesLeave(link){
            $("#"+link).css("background-color", "gray");
        }
    },
    mounted() {
    },
}
</script>

<style>

</style>