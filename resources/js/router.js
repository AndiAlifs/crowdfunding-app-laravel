import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            alias: '/home',
            component: () => import('./Home.vue')
        },
        {
            path: '/donations',
            name: 'donations',
            component: () => import('./Donations.vue')
        },
        {
            path: '/campaigns',
            name: 'campaigns',
            component: () => import('./Campaigns.vue')
        },
        {
            path: '/blogs',
            name: 'blogs',
            component: () => import('./Blogs.vue')
        },
        {
            path: '*',
            redirect: '/'
        },
    ]
});

export default router
