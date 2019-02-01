<template>
    <div>
       <v-text-field
        v-if="Search"
        label="Search Here"
        v-model="SearchText"
        solo
        hide-details
        box
      >
        <template slot="append">
          <v-icon @click="searchOff">cancel</v-icon>
          <v-icon @click="searchOff">search</v-icon>
        </template>
      </v-text-field>
      <v-btn @click="searchOn" color="green--text" dark icon v-if="!Search">
        <v-icon>fa-search</v-icon>
      </v-btn>
    </div>
</template>

<script>
export default {
  props: {
    Search: Boolean
  },
  methods: {
    searchOn () {
      this.Search = true
    },
    searchOff () {
      this.Search = false
    }
  },
  data: () => ({
    SearchText: ''
  })
}
</script>
