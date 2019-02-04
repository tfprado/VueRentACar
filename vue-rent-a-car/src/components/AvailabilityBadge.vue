<template>
  <v-btn flat dark :class="{'green': available, 'red': !available }">
    <template v-if="available">
      Available
    </template>
    <template v-if="!available">
      Not Available
    </template>
  </v-btn>
</template>

<script>
export default {
  props: {
    available: {
      type: Number,
      default: 1
    }
  }
}
</script>
