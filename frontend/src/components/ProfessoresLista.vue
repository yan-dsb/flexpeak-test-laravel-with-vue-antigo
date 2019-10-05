<template>
  <div class="columns">
    <div class="column" v-if="isLoading">
      <div class="columns is-mobile">
        <div class="column">
          <router-link
            to="/professores/cadastro"
            class="button is-primary is-rounded"
          >Cadastrar Professores</router-link>
        </div>
      </div>Carregando professores...
    </div>
    <div class="column" v-else>
      <div class="columns is-mobile">
        <div class="column">
          <router-link
            to="/professores/cadastro"
            class="button is-primary is-rounded"
          >Cadastrar Professores</router-link>
        </div>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Data de Nascimento</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="professor in professores">
            <tr v-bind:key="professor.id">
              <td>{{ professor.id }}</td>
              <td>{{ professor.nome }}</td>
              <td>{{ professor.data_nascimento }}</td>
              <td>
                <button
                  class="button is-info is-rounded"
                  @click="editarProfessor(professor.id)"
                >Editar</button>&nbsp;
                <button
                  class="button is-danger is-rounded"
                  @click="deletarProfessor(professor.id)"
                >Deletar</button>&nbsp;
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Backend from "../api/Backend";

export default {
  data() {
    return {
      isLoading: true,
      professores: {}
    };
  },
  async created() {
    const response = await Backend.get("/professores");
    this.professores = response.data.data;
    this.isLoading = false;
  },
  methods: {
    async deletarProfessor(id) {
      const response = await Backend.delete("/professores/" + id);
      let index = this.professores.findIndex(professor => professor.id === id);
      this.professores.splice(index, 1);
    },
    editarProfessor(id) {
      this.$router.push({ path: `/professores/${id}` });
    }
  }
};
</script>