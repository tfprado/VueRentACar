<template>
  <v-container fluid grid-list-xl class="pa-3 white">
    <div class="text-xs-left">State:</div>
    <v-layout wrap align-center>
      <v-flex xs12 d-flex class="pb-0">
        <v-select
          append-icon='fa-caret-down'
          :items="items"
          label="New Mexico"
          solo
        ></v-select>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
  export default {
    props: {
      label
    },
    data: () => ({
      items: ['Washington', 'New York', 'Texas', 'Vermont']
    })
  }
</script>
