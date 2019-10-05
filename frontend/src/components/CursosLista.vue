<template>
  <div class="columns">
    <div class="column" v-if="isLoading">
      <div class="columns is-mobile">
        <div class="column">
          <router-link to="/cursos/cadastro" class="button is-primary is-rounded">Cadastrar Cursos</router-link>
        </div>
      </div>
      Carregando cursos...
    </div>
    <div class="column" v-else>
      <div class="columns is-mobile">
        <div class="column">
          <router-link to="/cursos/cadastro" class="button is-primary is-rounded">Cadastrar Cursos</router-link>
        </div>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Professor</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="curso in cursos">
            <tr v-bind:key="curso.id">
              <td>{{ curso.id }}</td>
              <td>{{ curso.nome }}</td>
              <td>{{ curso.professor.nome }}</td>
              <td>
                <button class="button is-info is-rounded" @click="editarCurso(curso.id)">Editar</button>&nbsp;
                <button
                  class="button is-danger is-rounded"
                  @click="deletarCurso(curso.id)"
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
      cursos: {}
    };
  },
  async created() {
    try {
      const response = await Backend.get("/cursos");
      this.cursos = response.data.data;
      this.isLoading = false;
    } catch (e) {}
  },
  methods:{
    async deletarCurso(id){
      await Backend.delete('/cursos/'+id);
      let index = this.cursos.findIndex(curso => curso.id === id);
      this.cursos.splice(index, 1);
    },
    editarCurso(id) {
      this.$router.push({ path: `/cursos/${id}` });
    }
  }
};
</script>