<template>
    <div>
        <div class="container">
            <div class="">
                <h5 class="card-text">{{descricao}}</h5>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col" v-for="detalhe, chave in dados" :key="chave">
                        <div class="card h-100 card-habilidades"> 
                            <img  :src="'/storage/'+detalhe.imagens_projeto" class="card-img-top image" alt="image">
                            <div class="card-body">
                                <h4 class="card-title">{{detalhe.titulo}}</h4>
                                <p class="card-text">{{detalhe.descricao}}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-around">
                                <button v-if="admin" type="Button"  @click="editarTela(detalhe)" class="btn btn-secondary btn-sm ">Editar</button>
                                <button v-if="admin" type="Button"  @click="deletarTela(detalhe)" class="btn btn-danger btn-sm ">Deletar</button>
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
    props: ['titulo','dados', 'descricao', 'admin'],
    data() {
        return {
            urlBase: 'http://angelofrancisco.site/api/projeto_imagem',
        }
    },
    methods: {
        deletarTela(tela){
            if (confirm('Deseja excluir tela do projeto?')){
            axios.delete(this.urlBase+'/'+tela.id)
                .then(response => {
                    this.transacaoStatus = 'deletado'
                    this.transacaoDetalhes = {
                        mensagem: 'ID do registro: ' + response.data.id
                    }
                    this.$emit('refresh', {})
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
        editarTela(detalhe){
            this.$emit('editar', {dados: detalhe})
        }
    },
}
</script>

<style>
    .card-img-top{
        width: 100%;
    }
    .card-habilidades{
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.7);
        color: white;
    }
    .col{
        padding: 10px 5px;
    }
    img {
  max-width: 100%;
  display: block;
}
.thumbnail {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 320px;
  height: 240px;
  -webkit-transform: translate(-50%, -50%);
  /* Safari and Chrome */
  -moz-transform: translate(-50%, -50%);
  /* Firefox */
  -ms-transform: translate(-50%, -50%);
  /* IE 9 */
  -o-transform: translate(-50%, -50%);
  /* Opera */
  transform: translate(-50%, -50%);
}

.image {
  -webkit-transition: all 1s ease;
  /* Safari and Chrome */
  -moz-transition: all 1s ease;
  /* Firefox */
  -o-transition: all 1s ease;
  /* IE 9 */
  -ms-transition: all 1s ease;
  /* Opera */
  transition: all 1s ease;
}
.image:hover {
  -webkit-transform: scale(2);
  /* Safari and Chrome */
  -moz-transform: scale(2);
  /* Firefox */
  -ms-transform: scale(2);
  /* IE 9 */
  -o-transform: scale(2);
  /* Opera */
  transform: scale(2);

  position: relative;

  z-index: 999;

}
</style>