import Vue from "vue"
import Router from 'vue-router'
Vue.use(Router)
import Index from '../Layouts/index'
import Dashboard from '../Layouts/dashboard'

export default new Router({
        mode:"history",

        routes: [
            {
                    path: '',
                    component:Index,
                    name:'index',
                    children: [
                               {
                                path: '',
                                component: () => import('../Pages/Home'),

                                }
                            ]

             },
            {

                path: '/dashboard',
                component:Dashboard,
                name:'dashboard',


                children: [
                    {
                        path: '',
                        component: () => import('../Pages/Admin/Index'),

                    },
                    {
                        path: '/products',
                        component: () => import('../Pages/Admin/CreateNewProduct'),
                    },
                    {
                        path: '/categories',
                        component: () => import('../Pages/Admin/CreateNewCategory'),
                    },
                    {
                        path: '/brands',
                        component: () => import('../Pages/Admin/Brands'),
                    },
                ]


            },





            ]
        })
