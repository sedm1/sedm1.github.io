import { createStore } from 'vuex'
import axios from "axios"
export default createStore({
  state: {
    napravlenia: [],
    treners: []
  },
  getters: {
    NAPRAVLENIA(state){
      return state.napravlenia
    },
    TRENERS(state){
      return state.treners
    }
  },
  mutations: {
    SET_NAPRAVLENIA_TO_STATE: (state, napravlenia) => {
      state.napravlenia = napravlenia
    },
    SET_TRENERS_TO_STATE: (state, treners) => {
      state.treners = treners
    }
  },
  actions: {
    async GET_NAPRAVLENIA_FROM_DB({commit}){
      try {
        const Napravlenia = await axios("http://localhost:3000/Napravlenia", {
          method: 'GET'
        })
        commit('SET_NAPRAVLENIA_TO_STATE', Napravlenia.data)
      } catch (error) {
        console.log("Не удалось получить направления" + error)
      }
    },
    async GET_TRENERS_FROM_DB({commit}){
      try {
        const Treners = await axios("http://localhost:3000/Treners", {
          method: "GET"
        })
        commit('SET_TRENERS_TO_STATE', Treners.data)
      } catch(error) {
        console.log("Не удалось получить тренеров" + error)
      }
    }
  },
  modules: {
  }
})
