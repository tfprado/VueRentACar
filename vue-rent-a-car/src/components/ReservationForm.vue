<template>
  <v-card class="">
    <v-layout row wrap>
      <v-flex xs4 class="pa-3 mt-1">
        <InputSelect :label="'Choose your pickup location:'" :options="locations" @onSelect="filterVehicles"/>
      </v-flex>
      <v-flex xs2 class="pa-3 mt-1">
        <v-menu
          :close-on-content-click="false"
          v-model="menu1"
          :nudge-right="40"
          lazy
          transition="scale-transition"
          offset-y
          full-width
          min-width="290px"
        >
          <v-text-field
            slot="activator"
            v-model="pickupDate"
            label="Pickup day"
            prepend-icon="event"
            readonly
          ></v-text-field>
          <v-date-picker v-model="pickupDate" @input="menu1 = false"></v-date-picker>
        </v-menu>
      </v-flex>
      <v-flex xs2 class="pa-3 mt-1">
        <v-menu
        ref="pickupMenu"
        :close-on-content-click="false"
        v-model="timeMenu1"
        :nudge-right="40"
        :return-value.sync="pickupTime"
        lazy
        transition="scale-transition"
        offset-y
        full-width
        max-width="290px"
        min-width="290px"
        >
          <v-text-field
            slot="activator"
            v-model="pickupTime"
            label="Pickup Time"
            prepend-icon="access_time"
            readonly
          ></v-text-field>
          <v-time-picker
            v-if="timeMenu1"
            v-model="pickupTime"
            full-width
            @change="$refs.pickupMenu.save(pickupTime)"
          ></v-time-picker>
        </v-menu>
      </v-flex>
      <v-flex xs2 class="pa-3 mt-1">
        <v-menu
          :close-on-content-click="false"
          v-model="menu2"
          :nudge-right="40"
          lazy
          transition="scale-transition"
          offset-y
          full-width
          min-width="290px"
        >
          <v-text-field
            slot="activator"
            v-model="dropoffDate"
            label="Drop Off day"
            prepend-icon="event"
            readonly
          ></v-text-field>
          <v-date-picker v-model="dropoffDate" @input="menu2 = false"></v-date-picker>
        </v-menu>
      </v-flex>
      <v-flex xs2 class="pa-3 mt-1">
        <v-menu
        ref="dropoffMenu"
        :close-on-content-click="false"
        v-model="timeMenu2"
        :nudge-right="40"
        :return-value.sync="dropoffTime"
        lazy
        transition="scale-transition"
        offset-y
        full-width
        max-width="290px"
        min-width="290px"
        >
          <v-text-field
            slot="activator"
            v-model="dropoffTime"
            label="Drop Off Time"
            prepend-icon="access_time"
            readonly
          ></v-text-field>
          <v-time-picker
            v-if="timeMenu2"
            v-model="dropoffTime"
            full-width
            @change="$refs.dropoffMenu.save(dropoffTime)"
          ></v-time-picker>
        </v-menu>
      </v-flex>
    </v-layout>
  </v-card>
</template>

<script>
import InputSelect from '@/components/Select'

export default {
   data () {
      return {
        pickupDate: new Date().toISOString().substr(0, 10),
        dropoffDate: new Date().toISOString().substr(0, 10),
        pickupTime: null,
        dropoffTime: null,
        timeMenu1: false,
        timeMenu2: false,
        menu1: false,
        menu2: false
      }
  },
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
