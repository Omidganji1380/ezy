import {createRouter, createWebHistory} from 'vue-router'
import Login from '../views/ClientView/Login.vue'
import PageBuilder from '../views/ClientView/PageBuilder/PageBuilder.vue'

const routes = [
    {
        path     : '/',
        name     : 'ClientView_Index',
        component: Login
    }, {
        path     : '/page-builder',
        name     : 'ClientView_PageBuilder',
        component: PageBuilder,
        props    : true
    },
]

const router = createRouter({
                                history: createWebHistory(process.env.BASE_URL),
                                routes
                            })

export default router
