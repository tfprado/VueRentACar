import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    vehicles: [],
    locations: [],
    filteredVehicles: [],
    currentVehicle: {}
  },
  getters: {
    allVehicles: state => state.vehicles,
    allLocations: state => state.locations,
    filteredVehicles: state => state.filteredVehicles,
    currentVehicle: state => state.currentVehicle
  },
  mutations: {
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
    getVehicles ({ commit }) {
      axios.get('http://localhost:8001/vehicles').then(response => {
        commit('GET_VEHICLES', response.data)
      })
    },
    getVehicle ({ commit, state }, slug) {
      const vehicle = this.state.vehicles.find(vehicle => vehicle.slug === slug)
      commit('SET_VEHICLE', vehicle)
    },
    getLocations ({ commit }) {
      axios.get('http://localhost:8001/locations/list').then(response => {
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
