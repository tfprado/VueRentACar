<template>
    <v-layout align-center justify-center row fill-height class="mt-5">
      <v-flex sx4></v-flex>
      <v-flex sx4>
      <InputSelect/>
      </v-flex>
      <v-flex sx4></v-flex>
    </v-layout>
</template>

<script>
import InputSelect from '@/components/inputs/Select'

export default {
  components: {
    InputSelect
  }
}
</script>
