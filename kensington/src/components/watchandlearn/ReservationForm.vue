<template>
  <v-flex sx4 md6 class="pa-3 white mt-1" id="reservationFormContainer">
    <InputSelect :label="'Choose your pickup location:'" :options="locations" @onSelect="filterVehicles"/>
  </v-flex>
</template>

<style>
#reservationFormContainer{
  max-height: 10em;
}
</style>

<script>
import InputSelect from '@/components/inputs/Select'

export default {
  components: {
    InputSelect
  },
  computed: {
    locations () {
      return this.$store.getters.allLocations
    }
  },
  methods: {
    filterVehicles (value) {
      this.$store.dispatch('filterVehicles', +value)
    },
    filterVehiclesOnApi (value) {
      this.$store.dispatch('filterOnApi', +value)
    }
  }
}
</script>
