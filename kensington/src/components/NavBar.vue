<template>
  <div>
    <preference-editor class="hidden-xs-only"></preference-editor>
    <v-toolbar app dense class="pa-5 mt-4 mb-5 white">
      <div class="">
        <v-img
          :src="require('@/assets/images/kensington-health-logo.png')"
          contain
          width="238"
          height="120"
        >
        </v-img>
      </div>
      <v-toolbar-items class="hidden-sm-and-down">
        <v-btn flat class="custom-btn">About</v-btn>
        <v-menu open-on-hover bottom offset-y>
          <v-btn
            slot="activator"
            flat
            class="custom-btn"
          >
            <span>Services</span>
            <v-icon>fa-caret-down</v-icon>
          </v-btn>
          <v-list>
            <v-list-tile
              v-for="(item, index) in items"
              :key="index"
            >
              <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile>
          </v-list>
        </v-menu>
        <v-btn flat class="custom-btn">Volunteer</v-btn>
        <v-btn flat class="custom-btn">Foundation</v-btn>
      </v-toolbar-items>
      <v-spacer></v-spacer>
      <search-dialog></search-dialog>
      <v-divider vertical></v-divider>
      <search-text></search-text>
      <v-divider vertical inset></v-divider>
      <v-btn dark small color="#f8bf16"> <span class="font-weight-bold title">Donate</span></v-btn>
    </v-toolbar>
  </div>
</template>

<style lang="scss">
.custom-btn {
  font-size: 19px;
  font-weight: bolder;
  min-width: 0;
}
.custom-btn::before {
    color: transparent
}

.custom-btn:hover {
    background-color: white;
    border-color:#e1e1e1;
    border-style: solid;
    border-width: .1;
    zoom: 1;
    box-shadow: 1px 2px 4px #888888;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
}
</style>

<script>
import PreferenceEditor from '@/components/kh/PreferenceEditor'
import SearchDialog from '@/components/inputs/SearchInputDialog'
import SearchText from '@/components/inputs/SearchInputText'

export default {
  components: {
    PreferenceEditor,
    SearchDialog,
    SearchText
  },
  data: () => ({
    items: [
      { title: 'Click Me' },
      { title: 'Click Me' },
      { title: 'Click Me' },
      { title: 'Click Me 2' }
    ]
  })
}
</script>
