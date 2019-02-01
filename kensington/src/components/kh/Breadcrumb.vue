<template>
    <v-container fluid class="grey lighten-2 mt-3">
      <v-layout row>
        <v-flex sx12>
          <v-breadcrumbs class="pa-0 justify-center" :items="items" divider="/"></v-breadcrumbs>
        </v-flex>
      </v-layout>
    </v-container>
</template>

<script>
  export default {
    data: () => ({
      items: [
        {
          text: 'Home',
          disabled: false,
          href: 'breadcrumbs_dashboard'
        },
        {
          text: 'Services',
          disabled: false,
          href: 'breadcrumbs_link_1'
        },
        {
          text: 'Diagnostic Imaging',
          disabled: false,
          href: 'breadcrumbs_link_1'
        },
        {
          text: 'Services',
          disabled: true,
          href: 'breadcrumbs_link_2'
        }
      ]
    })
  }
</script>
