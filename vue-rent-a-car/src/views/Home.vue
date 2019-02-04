<template>
  <div class="home">
    <h1 class="mx-4 py-4">Home</h1>
    <v-container class="">
      <v-layout row wrap class="">
        <v-flex xs12 class="mb-5">
          <reservation-form></reservation-form>
        </v-flex>
        <v-flex xs12>
          <vehicle-list></vehicle-list>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import ReservationForm from '@/components/ReservationForm'
import VehicleList from '@/components/VehicleList'

export default {
  title: 'Vue Rent a Car Demo',
  name: 'Home',
  components: {
    ReservationForm,
    VehicleList
  }
}
</script>
