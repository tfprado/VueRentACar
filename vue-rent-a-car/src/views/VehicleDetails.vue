<template>
  <!-- <v-container fluid class="vehicle-details"> -->
    <v-card>
      <h2 class="text-xs-center py-3">{{ vehicle.title }}</h2>
      <v-divider class="mb-3"></v-divider>
      <v-layout row wrap justify-center>
        <v-flex xs12 md6 class="pl-5">
          <div>
            <v-img max-width="400px" :src="vehicle.image.path"></v-img>
          </div>
        </v-flex>
        <v-flex xs12 md6>
          <div class="text-xs-center" v-html="vehicle.description"></div>
        </v-flex>
        <v-flex sx6 md3>
          <p class="text-xs-center">Price per day: ${{ vehicle.price }}</p>
        </v-flex>
        <v-flex sx6 md3>
          <p class="text-xs-center">Available Cars: {{ vehicle.available }}</p>
        </v-flex>
        <v-flex sx6 md3>
          <p class="text-xs-center">Available at these locations:</p>
          <ul class="no-decorations"  v-for="(location, id) in vehicle.locations" :key="id">
            <li class="text-xs-center" style="text-decoration: none;">{{ location.title }}</li>
          </ul>
        </v-flex>
        <v-flex sx6 md3>
          <p class="text-xs-center">Available Cars: {{ vehicle.available}}</p>
        </v-flex>
      </v-layout>
   </v-card>
  <!-- </v-container> -->
</template>

<script>
export default {
  computed: {
    vehicle () {
      console.log(this.$store.getters.currentVehicle)
      return this.$store.getters.currentVehicle
    },
    vehicleImg () {
      return this.$store.getters.currentVehicleImg
    }
  },
  created () {
    this.$store.dispatch('getVehicle', this.$route.params.slug)
    // console.log(this.$route.params.slug)
  }
}
</script>
