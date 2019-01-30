<template>
    <v-btn id="test" small
    :class="{'grey': dark, 'grey lighten-5': !dark}">
        <v-icon>fa-home</v-icon>
    </v-btn>
</template>

<style>
    #test{
        padding: 0;
        min-width: 0;
    }
</style>

<script>
export default {
  name: 'Button',
  props: {
    dark: {
      type: Boolean,
      default: false
    }
  }
}
</script>
