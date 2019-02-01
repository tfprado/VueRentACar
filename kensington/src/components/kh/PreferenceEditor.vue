<template>
    <!-- Start of Infusion Preference Editor -->
    <div class="flc-prefsEditor-separatedPanel fl-prefsEditor-separatedPanel" id="infusion-pe">
      <!-- This is the div that will contain the Preference Editor component -->
      <div class="flc-slidingPanel-panel flc-prefsEditor-iframe" id="" aria-label="User Preferences"
        role="group" aria-expanded="false" style="height: 0px;"><custom-button></custom-button></div>
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
</template>

<style scoped>
#infusion-pe {
  background-color: black;
  min-height: 3em;
  z-index: 10;
  position: fixed;
  width: 100%;
}
/* #infusion-pe {
  position: fixed;
    top: 0;
    z-index: 10;
    width: 100%;
}

.infusion-header {
    height: 9rem;
    z-index: 2;
} */
</style>

<script>
import CustomButton from '@/components/Button'

export default {
  components: {
    CustomButton
  },
  mounted () {
    // eslint-disable-next-line
    $(document).trigger('vue-loaded')
  }
}
</script>
