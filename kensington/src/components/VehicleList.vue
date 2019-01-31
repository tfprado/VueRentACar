<template>
  <v-container grid-list-xl>
    <v-layout row wrap>
      <v-flex sm12>
        <Vehicle
          v-for="(vehicle, index) in filteredVehicles"
          :key="index"
          :name="vehicle.title"
          :description="vehicle.description"
          :image="vehicle.image.path"
          :price="vehicle.price"
          :available="vehicle.available"
          :slug="vehicle.slug"
          class="mb-3"
        />
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import Vehicle from '@/components/watchandlearn/Vehicle'
export default {
  components: {
    Vehicle
  },
  props: {
    filtered: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    vehicles () {
      return this.$store.getters.allVehicles
    },
    filteredVehicles () {
      return this.$store.getters.filteredVehicles
    }
  }
}
</script>
