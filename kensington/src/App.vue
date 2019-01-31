<template>
  <v-app>
    <!-- Start of Infusion Preference Editor -->
    <div class="flc-prefsEditor-separatedPanel fl-prefsEditor-separatedPanel" id="fluid-id-bm30dikv-440">
      <!-- This is the div that will contain the Preference Editor component -->
      <div class="flc-slidingPanel-panel flc-prefsEditor-iframe" id="fluid-id-bm30dikv-546" aria-label="User Preferences"
        role="group" aria-expanded="false" style="height: 0px;"></div>
      <!-- This div is for the sliding panel that shows and hides the Preference Editor controls -->
      <div class="fl-panelBar">
        <span class="fl-prefsEditor-buttons">
          <button id="reset" class="flc-prefsEditor-reset fl-prefsEditor-reset"><span class="fl-icon-undo"></span>
            Reset</button>
          <button id="show-hide" class="flc-slidingPanel-toggleButton fl-prefsEditor-showHide"> Show/Hide</button>
        </span>
      </div>
    </div>
    <!-- End of Preference Editor -->
    <!-- <NavBar/> -->
    <DevNav/>
    <v-content>
      <router-view/>
    </v-content>
  </v-app>
</template>

<style lang="scss">
#nav {
  padding: 30px;
  a {
    font-weight: bold;
    color: #2c3e50;
    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
#content {
  background-color:lightgray;
  height: 20em;
}
</style>

<script>
import NavBar from '@/components/NavBar'
import DevNav from '@/components/DevNav'
export default {
  components: {
    NavBar,
    DevNav
  },
  mounted () {
    this.$store.dispatch('getLocations')
    this.$store.dispatch('getVehicles')
    $(document).trigger('vue-loaded')
  }
}
</script>
