import Vue from 'vue'
import Vuex from 'vuex'
import axios from "axios";

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {

        categoryData: [],
        categoryDeleteMessage:[],
        categoryCreateMessage:[],

        productsData:[]
    },
    getters:{
        CATEGOR_GETTER:(state,getters)=>
        {
            return state.categoryData
        },
        CATEGORY_DESTROY_GETTER:(state) =>
        {
            return state.categoryDeleteMessage
        },
        CATEGORY_CREATE_GETTER:(state) =>
        {
            return state.categoryCreateMessage
        },
        PRODUCTS_GETTER:(state,getters)=>
        {
            return state.productsData
        }



    },
    mutations: {
        CATEGORY_MUTATION:(state,data) => {
            state.categoryData = data
        },
        CATEGORY_DESTROY_MUTATION:(state,data) =>{
            state.categoryDeleteMessage = data
        },
        CATEGORY_CREATE_MUTATION:(state,data) =>
        {
            state. categoryCreateMessage = data
        },
        PRODUCTS_MUTATION:(state,data) => {
            state.productsData = data
        },

    },
    actions: {
       async CATEGORIES_ACTION({ commit }) {
           const res = await axios.get('/api/categories/index')
            commit('CATEGORY_MUTATION',res.data)
        },
        async CATEGORY_DESTROY_ACTION({ commit},data) {
            const res = await axios.post('/api/categories/destroy', data)
            commit('CATEGORY_DESTROY_MUTATION',res.data)

        },
        async CATEGORY_CREATE_ACTION({commit},data) {
            const res = await axios.post('/api/categories/create', data)
            commit('CATEGORY_CREATE_MUTATION',res.data)

        },
        async PRODUCTS_ACTION({ commit }) {
            const res = await axios.get('/api/products/index')
            commit('PRODUCTS_MUTATION',res.data)
        },
    }
})
export default store
