<template>
  <v-app>
    <DevNav/>
    <v-content>
      <router-view/>
    </v-content>
  </v-app>
</template>

<script>
/* eslint-disable */
import DevNav from '@/components/DevNav'

export default {
  components: {
    DevNav
  },
  mounted () {
    this.$store.dispatch('getApiUrl')
    this.$store.dispatch('getLocations')
    this.$store.dispatch('getVehicles')
  }
}
</script>
