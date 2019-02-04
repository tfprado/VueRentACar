import 'font-awesome/css/font-awesome.min.css'
import Vue from 'vue'
import './plugins/vuetify'
import titleMixin from './plugins/titleMixin'
import App from './App.vue'
import router from './router'
import store from './store'
import './assets/css/main.scss'

Vue.config.productionTip = false
Vue.mixin(titleMixin)

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
