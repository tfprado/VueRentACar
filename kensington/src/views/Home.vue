<template>
  <div class="home pt-2 mt-5">
    <breadcrumb></breadcrumb>
    <page-title></page-title>
    <v-container>
      <v-layout row>

        <sidebar-menu></sidebar-menu>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import Breadcrumb from '@/components/kh/Breadcrumb'
import PageTitle from '@/components/kh/PageTitle'
import SidebarMenu from '@/components/kh/SidebarMenu'

export default {
  components: {
    Breadcrumb,
    PageTitle,
    SidebarMenu
  }
}
</script>
