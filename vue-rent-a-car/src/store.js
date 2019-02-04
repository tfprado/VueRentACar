import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    apiUrl: 'localhost',
    vehicles: [],
    locations: [],
    filteredVehicles: [],
    currentVehicle: {}
  },
  getters: {
    apiURL: state => state.apiUrl,
    allVehicles: state => state.vehicles,
    allLocations: state => state.locations,
    filteredVehicles: state => state.filteredVehicles,
    currentVehicle: state => state.currentVehicle
  },
  mutations: {
    SET_API_URL: (state, url) => {
      state.apiUrl = url
    },
    GET_VEHICLES: (state, vehicles) => {
      state.vehicles = vehicles
    },
    GET_LOCATIONS: (state, locations) => {
      state.locations = locations
    },
    SET_FILTERED: (state, vehicles) => {
      state.filteredVehicles = vehicles
    },
    SET_VEHICLE: (state, vehicle) => {
      state.currentVehicle = vehicle
    }
  },
  actions: {
    getApiUrl ({ commit }) {
      const apiUrl = 'http://' + window.location.hostname + ':8001'
      commit('SET_API_URL', apiUrl)
    },
    getVehicles ({ commit }) {
      const path = this.state.apiUrl + '/vehicles'
      axios.get(path)
        .then(response => {
          commit('GET_VEHICLES', response.data)
        })
    },
    getVehicle ({ commit, state }, slug) {
      const vehicle = state.vehicles.find(vehicle => vehicle.slug === slug)
      commit('SET_VEHICLE', vehicle)
    },
    getLocations ({ commit }) {
      const path = this.state.apiUrl + '/locations/list'
      axios.get(path).then(response => {
        commit('GET_LOCATIONS', response.data)
      })
    },
    filterVehicles ({ commit, state }, value) {
      const filtered = state.vehicles.filter(vehicle => {
        let foundLocations = vehicle.locations.findIndex(location => {
          return location.id === value
        })
        return foundLocations !== -1
      })
      commit('SET_FILTERED', filtered)
    },
    filterOnApi ({ commit }, value) {
      axios.get('http://localhost:8001/vehicles/filter/' + value).then(response => {
        commit('SET_FILTERED', response.data)
      })
    }
  }
})
