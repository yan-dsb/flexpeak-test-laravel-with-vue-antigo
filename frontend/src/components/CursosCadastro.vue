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
              placeholder="Digite o nome do curso"
              v-model="nome"
              @keydown="errors = ''"
            />
          </div>
        </div>
        <div class="field">
          <label class="label">Professor</label>
          <div class="control">
            <div class="select is-info">
              <select v-model="item">
                  <option :value="null" disabled>-- Escolha um professor --</option>
                <option
                  v-for="professor in professores"
                  :value="professor.id"
                  v-bind:key="professor.id"
                >{{professor.nome}}</option>
              </select>
            </div>
          </div>
        </div>
        <span class="help is-success" v-text="success"></span>
        <hr />
        <div class="field is-grouped">
          <button class="button is-success">Salvar</button>
          <router-link to="/cursos" style="margin-left: 20px" class="button is-info">Voltar</router-link>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Backend from "../api/Backend.js";
export default {
  data() {
    return {
      nome: "",
      item: null,
      professores: {},
      errors: "",
      success: "",
      isLoading: true
    };
  },
  async created() {
    const response = await Backend.get("/professores");
    this.professores = response.data.data;
  },
  methods: {
    onSubmit() {
      this.isLoading = true;
      this.cadastrarCursos();
    },
    async cadastrarCursos() {
        const data = {
            nome: this.$data.nome,
            professor: this.$data.item
        }
      Backend.post("/cursos", data)
        .then(response => {
          (this.nome = ""),
            (this.item = null),
            (this.success = "Cadastro efetuado com sucesso"),
            (this.isLoading = false),
            this.$emit("completed", response.data.data);
        })
        .catch(error => {
          this.errors = error.response.data.errors;
          this.isLoading = false;
        });
    }
  }
};
</script>