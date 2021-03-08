import Vue from 'vue'
import Vuex from 'vuex'
import axios from "axios";

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {

        categoryData: [],
        categoryDeleteMessage:[],
        categoryCreateMessage:[],

        productsData:[],
        productCreateMessage:[],

        brandsData:[],
        brandCreateMessage:[],
        brandDeleteMessage:[],


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
        },
        PRODUCT_CREATE_GETTER:(state) =>
        {
            return state.productCreateMessage
        },
        BRAND_GETTER:(state,getters)=>
        {
            return state.brandsData
        },
        BRAND_CREATE_GETTER:(state) =>
        {
            return state.brandCreateMessage
        },
        BRAND_DESTROY_GETTER:(state) =>
        {
            return state.brandDeleteMessage
        },

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
            state.categoryCreateMessage = data
        },
        PRODUCTS_MUTATION:(state,data) => {
            state.productsData = data
        },
        PRODUCT_CREATE_MUTATION:(state,data) =>
        {
            state.productCreateMessage = data
        },
        BRAND_MUTATION:(state,data) => {
            state.brandsData = data
        },
        BRAND_CREATE_MUTATION:(state,data) =>
        {
            state.brandCreateMessage = data
        },
        BRAND_DESTROY_MUTATION:(state,data) =>{
            state.brandDeleteMessage = data
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
        async PRODUCTS_ACTION({ commit }, data) {
            const res = await axios.post('/api/products/index',data)
            commit('PRODUCTS_MUTATION',res.data)
        },
        async PRODUCT_CREATE_ACTION({commit},data) {
            const res = await axios.post('/api/products/create', data)
            commit('PRODUCT_CREATE_MUTATION',res.data)
        },
        async BRAND_ACTION({ commit }) {
            const res = await axios.get('/api/brands/index')
            commit('BRAND_MUTATION',res.data)
        },
        async BRAND_CREATE_ACTION({commit},data) {
            const res = await axios.post('/api/brands/create', data)
            commit('CATEGORY_CREATE_MUTATION',res.data)

        },
        async BRAND_DESTROY_ACTION({ commit},data) {
            const res = await axios.post('/api/brands/destroy', data)
            commit('BRAND_DESTROY_MUTATION',res.data)

        },

    }
})
export default store
