import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.config.productionTip = false

Vue.use(VueRouter);

import Dashboard from './components/Dashboard.vue';
import ProfessoresLista from './components/ProfessoresLista.vue';
import CursosLista from './components/CursosLista.vue';
import AlunosLista from './components/AlunosLista.vue';
import ProfessoresCadastro from './components/ProfessoresCadastro.vue';
import ProfessoresAlterar from './components/ProfessoresAlterar.vue';
import CursosCadastro from './components/CursosCadastro.vue';
import CursosAlterar from './components/CursosAlterar.vue';
import AlunosCadastro from './components/AlunosCadastro.vue';
import AlunosAlterar from './components/AlunosAlterar.vue';

const routes = [
  { path: '/', component: Dashboard},
  { path: '/professores', component:  ProfessoresLista},
  { path: '/cursos', component: CursosLista},
  { path: '/alunos', component: AlunosLista},
  { path: '/professores/cadastro', component: ProfessoresCadastro},
  { path: '/professores/:id', component: ProfessoresAlterar},
  { path: '/cursos/cadastro', component: CursosCadastro},
  { path: '/cursos/:id', component: CursosAlterar},
  { path: '/alunos/cadastro', component: AlunosCadastro},
  { path: '/alunos/:id', component: AlunosAlterar}
]

const router  = new VueRouter({
  mode: 'history',
  routes
});

new Vue({
  router,
  render: h=> h(Dashboard)
}).$mount('#app')