<template>
  <div id="test">
    <v-container fluid text-xs-center justify-content-center fill-height id="content">
      <v-layout row wrap>
        <v-flex sx2></v-flex>
        <ReservationForm/>
        <v-flex sx2></v-flex>
      </v-layout>
    </v-container>
    <v-container>
      <v-layout row wrap>
         <v-flex sx12 md12 class="pt-5">
          <VehicleList filtered/>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import ReservationForm from '@/components/watchandlearn/ReservationForm'
import VehicleList from '@/components/VehicleList'

export default {
  name: 'Test',
  components: {
    ReservationForm,
    VehicleList
  }
}
</script>
