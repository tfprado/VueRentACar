<template>
  <v-container fluid grid-list-xl>
    <v-layout wrap align-center>
      <v-flex xs12 d-flex class="pb-0">
        <v-select
          append-icon='fa-caret-down'
          :items="options"
          :label="label"
          item-text="label"
          @input="$emit('onSelect', $event)"
        ></v-select>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      default: ''
    },
    options: {
      type: Array,
      required: true
    }
  }
}
</script>
