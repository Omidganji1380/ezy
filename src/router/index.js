import {createRouter, createWebHistory} from 'vue-router'
import Login from '../views/ClientView/Login.vue'
import PageBuilder from '../views/ClientView/PageBuilder/PageBuilder.vue'
import Preview from "@/views/ClientView/PageBuilder/Preview/Preview.vue";
import EditPageBuilder from "@/views/ClientView/PageBuilder/Edit/EditPageBuilder.vue";

const routes = [
    {
        path     : '/',
        name     : 'ClientView_Index',
        component: Login,
        props    : true
    },
    {
        path     : '/:link',
        name     : 'ClientView_Preview',
        component: Preview,
        props    : true
    },
    {
        path     : '/user/page-builder',
        name     : 'ClientView_PageBuilder',
        component: PageBuilder,
        props    : true
    },
    {
        path     : '/user/page-builder/edit/:id',
        name     : 'ClientView_PageBuilder_Edit',
        component: EditPageBuilder,
        props    : true
    },
]

const router = createRouter({
                                history: createWebHistory(process.env.BASE_URL),
                                routes
                            })

export default router
