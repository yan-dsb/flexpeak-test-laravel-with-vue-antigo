<template>
<div class="columns">
    <div class="column is-two-fifths">
  <form @submit.prevent="onSubmit">
    <span class="help is-danger" v-text="errors"></span>
    <div class="field">
      <label class="label">Nome</label>
      <div class="control">
        <input class="input" type="name" placeholder="Digite o nome do professor" v-model="nome" @keydown="errors = ''">
      </div>
    </div>
    <div class="field">
      <label class="label">Data de Nascimento</label>
      <div class="control">
        <input class="input" type="date" placeholder="Digite o nome do professor" v-model="data_nascimento" @keydown="errors = ''">
      </div>
    </div>
    <span class="help is-success" v-text="success"></span>
    <hr>
    <div class="field is-grouped">
    <button class="button is-success"  @click="alterarProfessor(id)">Salvar</button>
    <router-link to="/professores" style="margin-left: 20px" class="button is-info">Voltar</router-link>
    </div>
  </form>
  </div>
  </div>
</template>

<script>
import Backend from '../api/Backend.js';
export default {
    data(){
        return{
            id: 0,
            nome: '',
            data_nascimento: '',
            errors: '',
            success: '',
            isLoading: true
        }
    },
    async created(){
      const response = await Backend.get(`/professores/${this.$route.params.id}`);
      this.nome = response.data.data.nome;
      this.data_nascimento = response.data.data.data_nascimento;
      this.id = response.data.data.id;
      console.log(response);
      
    },
    methods:{
        onSubmit(){
            this.isLoading =true;
            this.alterarProfessor()
        },
        async alterarProfessor(id){
            Backend.put('/professores/'+id,this.$data)
            .then(response=>{
                this.nome = '',
                this.data_nascimento= '',
                this.success = 'Alterado com sucesso',
                this.isLoading = false,
                this.$emit('completed', response.data.data)
            })
            .catch(error =>{
                this.errors = error.response.data.errors
                this.isLoading = false
            })
        }
    }
}
</script>