<template>
  <div>
    <section class="section">
      <div class="container">
        <nav class="navbar is-transparent" role="navigation" aria-label="main navigation">
          <div class="navbar-brand">
            <a class="navbar-item is-active">
              <img
                src="http://paginas.unimedfama.com.br/atendimentos/img/logo_flexpeak.png"
                width="200"
                height="200"
              />
            </a>
            <div class="navbar-burger burger" data-target="navMenu">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>
          <div class="navbar-menu" id="navMenu">
            <div class="navbar-start">
            <div class="navbar-item" >
              <router-link to="/" class="navbar-item">Home</router-link>
            </div>
            <div class="navbar-item has-dropdown is-hoverable" >
              <a class="navbar-link is-arrowless">Professor</a>
              <div class="navbar-dropdown">
                <router-link to="/professores" class="navbar-item">Lista Professores</router-link>
              </div>
            </div>
            <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link is-arrowless">Curso</a>
              <div class="navbar-dropdown">
                <router-link to="/cursos" class="navbar-item">Lista Cursos</router-link>
              </div>
            </div>
            <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link is-arrowless">Aluno</a>
              <div class="navbar-dropdown">
                <router-link to="/alunos" class="navbar-item">Lista Alunos</router-link>
              </div>
            </div>
          </div>
          </div>
        </nav>
        <router-view :key="this.$route.fullPath" v-if="this.$route.path !== '/'"></router-view>
      </div>
    </section>
  </div>
</template>