<template>
  <v-flex xs12 md5>
    <v-card>
        <v-img :src="image" height="200px">
        </v-img>
        <v-card-title primary-title>
          <div>
            <h3 class="headline mb-0">{{ name }}</h3>
          </div>
        </v-card-title>
        <v-card-text>
          <div v-html="description"></div>
          <div>${{ price }}/day</div>
        </v-card-text>
        <v-card-actions class="justify-space-around">
          <AvailabilityBadge :available="available"/>
          <!-- <router-link :to="/vehicles/ + slug">More Details</router-link> -->
          <v-btn :disabled="!isAvailable" color="primary" :to="{ name: 'vehicleDetail', params: { slug: slug} }">
            More Details
          </v-btn>
        </v-card-actions>
    </v-card>
  </v-flex>
</template>

<script>
import AvailabilityBadge from '@/components/AvailabilityBadge'
export default {
  components: {
    AvailabilityBadge
  },
  props: {
    name: {
      type: String,
      required: true
    },
    description: {
      type: String,
      default: ''
    },
    image: {
      type: String,
      default: null
    },
    price: {
      type: Number,
      default: null
    },
    available: {
      type: Number,
      default: 1
    },
    slug: {
      type: String,
      default: ''
    }
  },
  computed: {
    isAvailable () {
      if (this.available === 0) { return false } else {
        return true
      }
    }
  }
}
</script>
