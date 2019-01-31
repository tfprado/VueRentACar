<template>
    <v-layout align-center justify-center row fill-height class="mt-5">
      <v-flex sx4></v-flex>
      <v-flex sx4 class="pa-3 white">
        <InputSelect :label="'Pickup Location:'" :options="locations"/>
        <VehicleList/>
      </v-flex>
      <v-flex sx4></v-flex>
    </v-layout>
</template>

<script>
import InputSelect from '@/components/inputs/Select'
import VehicleList from '@/components/VehicleList'

export default {
  components: {
    InputSelect,
    VehicleList
  },
  computed: {
    locations () {
      return this.$store.getters.allLocations
    }
  }
}
</script>
