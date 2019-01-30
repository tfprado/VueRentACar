<template>
  <div class="home">
    <v-btn color="success">Success</v-btn>
    <v-btn color="error">Error</v-btn>
    <v-btn color="warning">Warning</v-btn>
    <v-btn color="info">Info</v-btn>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Home',
  mounted () {
    axios.get('http://localhost:8001/vehicles').then(response => {
      console.log(response.data)
    })
  }
}
</script>
