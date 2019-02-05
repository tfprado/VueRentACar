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
    currentVehicle: {},
    location: null,
    pickupDate: '',
    dropoffDate: '',
    pickupTime: '',
    dropoffTime: ''
  },
  getters: {
    apiURL: state => state.apiUrl,
    allVehicles: state => state.vehicles,
    allLocations: state => state.locations,
    filteredVehicles: state => state.filteredVehicles,
    currentVehicle: state => state.currentVehicle,
    pickupDate: state => state.pickupDate,
    dropoffDate: state => state.dropoffDate
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
    },
    SET_LOCATION: (state, location) => {
      state.location = location
    },
    SET_PICKUPDATE: (state, date) => {
      state.pickupDate = date
    },
    SET_DROPOFFDATE: (state, date) => {
      state.dropoffDate = date
    },
    SET_PICKUPTIME: (state, time) => {
      state.pickupTime = time
    },
    SET_DROPOFFTIME: (state, time) => {
      state.dropoffTime = time
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
    filterVehicles ({ commit, state }) {
      const filtered = state.vehicles.filter(vehicle => {
        let foundLocations = vehicle.locations.findIndex(location => {
          return location.id === this.state.location
        })
        return foundLocations !== -1
      })
      const filteredVehicles = []
      filtered.forEach(vehicle => {
        // If Vehicle has dates
        if (vehicle.dates.length > 0) {
          // Check if requested dates overlap with booked dates
          const overlaps = []
          vehicle.dates.forEach(date => {
            const startDate1 = new Date(date.pickup)
            const endDate1 = new Date(date.drop_off)
            const startDate2 = new Date(this.state.pickupDate)
            const endDate2 = new Date(this.state.dropoffDate)

            // If dates match add true, false if not
            overlaps.push((startDate1 < endDate2) && (startDate2 < endDate1))
          })
          if (!overlaps.includes(true)) {
            filteredVehicles.push(vehicle)
          }
          return
        }
        // Else add it filtered vehicle array
        filteredVehicles.push(vehicle)
      })
      commit('SET_FILTERED', filteredVehicles)
    },
    filterOnApi ({ commit }, value) {
      axios.get('http://localhost:8001/vehicles/filter/' + value).then(response => {
        commit('SET_FILTERED', response.data)
      })
    },
    setLocation ({ commit, state }, value) {
      commit('SET_LOCATION', value)
    },
    setDates ({ commit, state }, date) {
      if (date.type === 'pickup') {
        localStorage.setItem('pickup', date.value)
        commit('SET_PICKUPDATE', date.value)
        return
      }
      localStorage.setItem('dropoff', date.value)
      commit('SET_DROPOFFDATE', date.value)
    },
    setTimes ({ commit, state }, time) {
      if (time.type === 'pickup') {
        commit('SET_PICKUPTIME', time.value)
        return
      }
      commit('SET_DROPOFFTIME', time.value)
    }
  }
})
