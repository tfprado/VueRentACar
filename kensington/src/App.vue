<template>
  <v-app>
    <v-toolbar nav id="nav">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">Test</router-link>
    </v-toolbar>
    <v-content>
      <router-view/>
    </v-content>
  </v-app>
</template>


<style lang="scss">
#nav {
  padding: 30px;
  a {
    font-weight: bold;
    color: #2c3e50;
    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
