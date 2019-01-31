<template>
  <v-app>
    <!-- <NavBar/> -->
    <DevNav/>
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

<script>
import NavBar from '@/components/NavBar'
import DevNav from '@/components/DevNav'
export default {
  components: {
    NavBar,
    DevNav
  },
  mounted () {
    this.$store.dispatch('getLocations'),
    this.$store.dispatch('getVehicles')
  }
}
</script>
