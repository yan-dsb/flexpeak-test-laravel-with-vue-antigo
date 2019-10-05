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
        <input class="input" type="date"  v-model="data_nascimento" @keydown="errors = ''">
      </div>
    </div>
    <span class="help is-success" v-text="success"></span>
    <hr>
    <div class="field is-grouped">
    <button class="button is-success">Salvar</button>
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
            nome: '',
            data_nascimento: '',
            errors: '',
            success: '',
            isLoading: true
        }
    },
    methods:{
        onSubmit(){
            this.isLoading =true;
            this.cadastrarProfessores()
        },
        async cadastrarProfessores(){
            Backend.post('/professores', this.$data)
            .then(response=>{
                this.nome = '',
                this.data_nascimento= '',
                this.success = 'Cadastro efetuado com sucesso',
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