<template>
  <nav class="mb-5">
    <v-toolbar app dense id="nav" class="pa-5">
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
              @click=""
            >
              <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile>
          </v-list>
        </v-menu>
        <v-btn flat class="custom-btn">Volunteer</v-btn>
        <v-btn flat class="custom-btn">Foundation</v-btn>
      </v-toolbar-items>
      <v-spacer></v-spacer>
      <v-btn dark small color="#f8bf16"> <span class="font-weight-bold" style="font-size: 20px;">Donate</span></v-btn>
    </v-toolbar>
  </nav>
</template>

<style lang="scss">
#nav {
  background-color: #fff;
  a {
    font-weight: bold;
    color: #2c3e50;
    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
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
export default {
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
