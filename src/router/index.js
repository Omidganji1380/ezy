import {createRouter, createWebHistory} from 'vue-router'
import Index from '../views/ClientView/Index.vue'
import PageBuilder from '../views/ClientView/PageBuilder/PageBuilder.vue'

const routes = [
    {
        path     : '/',
        name     : 'ClientView_Index',
        component: Index
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
