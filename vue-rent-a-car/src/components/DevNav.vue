<template>
  <v-toolbar app fixed id="nav">
    <v-toolbar-title>Vue Rent a Car</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-toolbar-items>
      <v-layout row align-center>
        <v-btn flat class="ml-3" active-class="v-btn--active khLightGreen white--text" to="/">
          Home
        </v-btn>
        <v-btn flat active-class="v-btn--active khLightGreen white--text" to="/test">
          Vehicles
        </v-btn>
        <router-link to="/" class="no-decorations">Home</router-link> |
        <router-link to="/test" class="no-decorations">Test</router-link>
      </v-layout>
    </v-toolbar-items>
  </v-toolbar>
</template>
