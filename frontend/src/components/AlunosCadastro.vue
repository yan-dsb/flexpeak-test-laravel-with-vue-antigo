<template>
  <div class="columns">
    <div class="column is-two-fifths">
      <form @submit.prevent="onSubmit">
        <span class="help is-danger" v-text="errors"></span>
        <div class="field">
          <label class="label">Nome</label>
          <div class="control">
            <input
              class="input"
              type="name"
              placeholder="Digite o nome do aluno"
              v-model="nome"
              @keydown="errors = ''"
            />
          </div>
        </div>
        <div class="field">
          <label class="label">Data de Nascimento</label>
          <div class="control">
            <input class="input" type="date" v-model="data_nascimento" @keydown="errors = ''" />
          </div>
        </div>
        <div class="field">
          <label class="label">Curso</label>
          <div class="control">
            <div class="select is-info">
              <select v-model="item">
                  <option :value="null" disabled>-- Escolha um curso --</option>
                <option
                  v-for="curso in cursos"
                  :value="curso.id"
                  v-bind:key="curso.id"
                >{{curso.nome}}</option>
              </select>
            </div>
          </div>
        </div>
         <label class="label">Endereço:</label>
         <form @submit.prevent="onSubmit2">
         <label class="label">CEP</label>
        <div class="field is-grouped">
          
          <div class="control">
            <input class="input" v-model="cep" type="text" id="cep" size="10" maxlength="9" />
          </div>
          <button class="button is-link">Buscar</button>
        </div>
        </form>
        <div class="field">
             <label class="label">Rua:</label>
             <div class="control">
                 <input class="input" v-model="logradouro" type="text" id="rua" size="60" >
             </div>
        </div>
        <div class="field">
             <label class="label">Numero:</label>
             <div class="control">
                 <input class="input" v-model="numero" type="text" >
             </div>
        </div>
        <div class="field">
             <label class="label">Bairro:</label>
             <div class="control">
                 <input class="input" v-model="bairro" type="text" id="bairro" size="40" >
             </div>
        </div>
        <div class="field">
             <label class="label">Cidade:</label>
             <div class="control">
                 <input class="input" v-model="cidade" type="text" id="cidade" size="40" >
             </div>
        </div>
        <div class="field">
             <label class="label">Estado:</label>
             <div class="control">
                 <input class="input" v-model="estado" type="text" id="uf" size="2" >
             </div>
        </div>
        <span class="help is-success" v-text="success"></span>
        <hr />
        <div class="field is-grouped">
          <button class="button is-success">Salvar</button>
          <router-link to="/alunos" style="margin-left: 20px" class="button is-info">Voltar</router-link>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Backend from '../api/Backend'
import axios from 'axios';
export default {
  data() {
    return {
        nome:"",
        data_nascimento: "",
        logradouro: "",
        numero: "",
        bairro: "",
        cidade: "",
        estado: "",
        cep: "",
        cursos: {},
        item: null,
        errors : "",
        success : ""
    }
  },
  async created(){
      const response = await Backend.get('/cursos');
      
      this.cursos = response.data.data;
  },
  methods:{
     onSubmit(){
        this.cadastrarAlunos();
     },
     onSubmit2(){
         this.buscarCEP();
     }
     ,
     async buscarCEP(){
         const response = await axios.get(`http://api.postmon.com.br/v1/cep/${this.$data.cep}`);
         this.logradouro = response.data.logradouro;
         this.bairro = response.data.bairro;
         this.cidade = response.data.cidade;
         this.estado = response.data.estado;   
     }
     ,
      async cadastrarAlunos(){
          const data = {
              nome : this.$data.nome,
              data_nascimento : this.$data.data_nascimento,
              logradouro : this.$data.logradouro,
              numero : this.$data.numero,
              bairro : this.$data.bairro,
              cidade : this.$data.cidade,
              estado : this.$data.estado,
              cep : this.$data.cep,
              curso : this.$data.item
          }
          await Backend.post('/alunos', data).
                then(response => {
                    (this.nome = ""),
                    (this.data_nascimento = ""),
                    (this.cep = ""),
                    (this.logradouro = ""),
                    (this.cidade = ""),
                    (this.bairro = ""),
                    (this.estado = ""),
                    (this.numero = ""),
                    (this.item = null),
                    (this.success = "Cadastro efetuado com sucesso"),
                    this.$emit("completed", response.data.data);
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
            console.log(data);
            
          
      }
  }
};
</script>