<template>
  <v-app>
    
    <NavBar/>
    <!-- <DevNav/> -->
    <v-content class="mt-5">
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
#content {
  background-color:lightgray;
  height: 20em;
}
</style>

<script>
/* eslint-disable */
import NavBar from '@/components/NavBar'
import DevNav from '@/components/DevNav'
import PreferenceEditor from '@/components/kh/PreferenceEditor'

export default {
  components: {
    NavBar,
    DevNav,
    PreferenceEditor
  },
  mounted () {
    this.$store.dispatch('getLocations')
    this.$store.dispatch('getVehicles')
  }
}
</script>
