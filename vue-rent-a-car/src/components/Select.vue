<template>
  <v-select
    append-icon='fa-caret-down'
    :items="options"
    :label="label"
    item-text="label"
    @input="$emit('onSelect', $event)"
  ></v-select>

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
