<template>
    <v-app>
      <v-content id="content">
        <v-container fluid text-xs-center>
          <v-layout row wrap>
            <v-flex xs12>
              <!-- <vehicle-list :vehicles="vehicles"/> :value is the name of the prop, should = the name of data -->
              <vehicle-list/>

            </v-flex>
            <!-- <v-flex sx12> -->
              <ReservationForm/>
            <!-- </v-flex> -->
          </v-layout>
        </v-container>
      </v-content>
    </v-app>
</template>

<style>
#content {
  background-color:lightgray;
}
</style>


<script>
import VehicleList from '@/components/VehicleList'
import ReservationForm from '@/components/watchandlearn/ReservationForm'

export default {
  name: 'Test',
  components: {
    VehicleList,
    ReservationForm
  }
}
</script>
