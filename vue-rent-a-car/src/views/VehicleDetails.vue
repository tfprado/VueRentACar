<template>
  <!-- <v-container fluid class="vehicle-details"> -->
    <v-card>
      <h2 class="text-xs-center py-3">{{ vehicle.title }}</h2>
      <v-divider class="mb-3"></v-divider>
      <v-layout row wrap justify-center>
        <v-flex xs12 md12>
          <div>
            <v-img max-height="400px" :src="vehicle.image.path"></v-img>
          </div>
        </v-flex>
        <v-flex class="car-prices" xs12 md6>
          <ul>
            <li><strong>By day</strong> ${{ vehicle.price }}</li>
            <li><strong>Reservation:</strong> {{ dates.start }} - {{ dates.end }}</li>
            <li><strong>Number of days</strong> {{ dates.daysBetween }}</li>
            <li><strong>Price:</strong>${{ dates.price }}</li>
          </ul>
        </v-flex>
        <v-flex xs12 md6>
          <div class="text-xs-center" v-html="vehicle.description"></div>
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
      </v-layout>
   </v-card>
  <!-- </v-container> -->
</template>

<script>
import { DateTime } from 'luxon'

export default {
  name: 'VehicleDetails',
  computed: {
    vehicle () {
      return this.$store.getters.currentVehicle
    },
    dates () {
      // if date doesnt exist get it from local storage
      const start = DateTime.fromISO(this.$store.getters.pickupDate)
      const end = DateTime.fromISO(this.$store.getters.dropoffDate)
      const daysBetween = end.diff(start, ['days'])
      const price = this.vehicle.price * daysBetween.values.days
      return {
        start: start.toFormat('dd/MM/yyyy'),
        end: end.toFormat('dd/MM/yyyy'),
        daysBetween: daysBetween.values.days,
        price
      }
    }
  },
  beforeMount () {
    this.$store.dispatch('getVehicle', this.$route.params.slug)
    // Second method for persisting dates
    if (this.$store.getters.pickpupDate === '') {
      this.$store.dispatch('setDates', {value: localStorage.getItem('pickup'), type: 'pickup'})
    }
    if (this.$store.getters.dropoffDate === '') {
      this.$store.dispatch('setDates', {value: localStorage.getItem('dropoff'), type: 'dropoff'})
    }
  }
}
</script>
