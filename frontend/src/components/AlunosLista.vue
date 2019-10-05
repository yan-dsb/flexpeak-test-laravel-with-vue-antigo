<template>
  <div class="columns">
    <div class="column" v-if="isLoading">
      <div class="columns is-mobile">
        <div class="column">
          <router-link to="/alunos/cadastro" class="button is-primary is-rounded">Cadastrar Alunos</router-link>
        </div>
      </div>
      Carregando alunos...
    </div>
    <div class="column" v-else>
      <div class="columns is-mobile">
        <div class="column">
          <router-link to="/alunos/cadastro" class="button is-primary is-rounded">Cadastrar Alunos</router-link>
        </div>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Curso</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="aluno in alunos">
            <tr v-bind:key="aluno.id">
              <td>{{ aluno.id }}</td>
              <td>{{ aluno.nome }}</td>
              <td>{{ aluno.curso.nome }}</td>
              <td>
                <button class="button is-info is-rounded" @click="editarAluno(aluno.id)">Editar</button>&nbsp;
                <button
                  class="button is-danger is-rounded"
                  @click="deletarAluno(aluno.id)"
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
      alunos: {}
    };
  },
  async created() {
    try {
      const response = await Backend.get("/alunos");
      this.alunos = response.data.data;
      console.log(response.data.data);

      this.isLoading = false;
    } catch (e) {}
  },
  methods:{
    async deletarAluno(id){
      await Backend.delete('/alunos/'+id);
      let index = this.alunos.findIndex(aluno => aluno.id === id);
      this.alunos.splice(index, 1);
    },
    editarAluno(id) {
      this.$router.push({ path: `/alunos/${id}` });
    }
  }
};
</script>