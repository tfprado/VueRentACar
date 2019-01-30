<template>
  <v-app>
      <v-content>
          <custom-button dark/>
          <custom-button/>
          <HelloWorld/>
      </v-content>
  </v-app>
</template>

<script>
import HelloWorld from '../components/HelloWorld'
import CustomButton from '@/components/Button'

export default {
  name: 'App',
  components: {
    HelloWorld,
    CustomButton
  },
  data () {
    return {
      //
    }
  }
}
</script>
