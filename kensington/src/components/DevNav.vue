<template>
  <v-toolbar nav id="nav">
    <v-toolbar-title>Dev Nav</v-toolbar-title>
    <div class="ml-5">
      <router-link to="/" class="no-decorations">Home</router-link> |
      <router-link to="/test" class="no-decorations">Test</router-link>
    </div>
  </v-toolbar>
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
