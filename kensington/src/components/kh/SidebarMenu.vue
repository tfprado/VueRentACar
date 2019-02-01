<template>
  <div>
    <v-list>
      <v-list-tile class="grey lighten-3 mb-1">
        <v-list-tile-action>
          <v-icon>home</v-icon>
        </v-list-tile-action>
        <v-list-tile-title>Diagnostic Imaging</v-list-tile-title>
      </v-list-tile>

      <v-list-group class="grey lighten-3 mb-1">
        <v-list-tile slot="activator">
          <v-list-tile-action>
            <v-icon></v-icon>
          </v-list-tile-action>
          <v-list-tile-title>About Us</v-list-tile-title>
        </v-list-tile>
      </v-list-group>

      <v-list-group
        value="true"
        class="grey lighten-3 mb-1"
      >
        <v-list-tile style="background-color: green;" slot="activator">
          <v-list-tile-action>
            <v-icon></v-icon>
          </v-list-tile-action>
          <v-list-tile-title>Our Services</v-list-tile-title>
        </v-list-tile>
          <v-list-tile
            v-for="(service, i) in services"
            :key="i"
            @click=""
          >
            <v-list-tile-title v-text="service[0]"></v-list-tile-title>
            <v-list-tile-action>
              <v-icon v-text="service[1]"></v-icon>
            </v-list-tile-action>
          </v-list-tile>
      </v-list-group>

      <v-list-tile class="grey lighten-3 mb-1">
        <v-list-tile-action>
          <v-icon></v-icon>
        </v-list-tile-action>
        <v-list-tile-title>How to book and appointment</v-list-tile-title>
      </v-list-tile>

      <v-list-group class="grey lighten-3 mb-1">
        <v-list-tile slot="activator">
        <v-list-tile-action>
          <v-icon></v-icon>
        </v-list-tile-action>
        <v-list-tile-title>Resource Libary</v-list-tile-title>
        </v-list-tile>
      </v-list-group>

      <v-list-tile class="grey lighten-3 mb-1">
        <v-list-tile-action>
          <v-icon>phone</v-icon>
        </v-list-tile-action>
        <v-list-tile-title>Contact Us</v-list-tile-title>
      </v-list-tile>

    </v-list>
  </div>
</template>

<style scoped>
.theme--light.v-list .v-list__group--active:before, .theme--light.v-list .v-list__group--active:after {
    background:#e0e0e0;
}
</style>

<script>
  export default {
    data: () => ({
      services: [
        ['Mammogram', 'people_outline'],
        ['Bone Mineral Desnity', 'settings'],
        ['Ultrasound', ''],
        ['X-ray', '']
      ]
    })
  }
</script>