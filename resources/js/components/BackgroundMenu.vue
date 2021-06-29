<template>
    <div class="background-menu">
            <div class="conteudo-inicio">
                <div class="container-conteudo-inicio">
                    <slot></slot>
                </div>
            </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>
    .background-menu{
        max-width: 100%;
        background-position: center center;
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: contain;
        background-size: cover;
    }
    
    .conteudo-inicio {
        background: rgba(0,0,0,0.8); 
        width: 100%; 
        height: 100%;
        padding-top: 200px;
        padding-bottom: 100px;
        padding-left: 20px;
        padding-right: 20px;
    }
    .container-conteudo-inicio{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
    }

</style>