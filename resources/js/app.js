require('./bootstrap');


import Vue          from 'vue'
import VueRouter    from 'vue-router'
import Homepage     from './components/Homepage'
import Create       from './components/Create'
import Read         from './components/Read'
import Update       from './components/Update'
import Comments     from './components/Comments'
import UpdatePage        from "./components/UpdatePage";
import CreatePage        from "./components/CreatePage";
import Pages        from "./components/Pages";
import Dashboard    from "./components/Dashboard";

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',

    routes: [
        {
            path: '/admin/dashboard',
            name: 'dashboard',
            component: Dashboard,
            props: true
        },
        {
            path: '/admin/pages',
            name: 'pages',
            component: Pages,
            props: true
        },
        {
            path: '/admin/read',
            name: 'read',
            component: Read,
            props: true,
        },
        {
            path: '/admin/create',
            name: 'create',
            component: Create,
            props: true
        },
        {
            path: '/admin/update',
            name: 'update',
            component: Update,
            props: true
        },
        {
            path: '/admin/update-page',
            name: 'update-page',
            component: UpdatePage,
            props: true
        },
        {
            path: '/admin/create-page',
            name: 'create-page',
            component: CreatePage,
            props: true
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { Homepage, Comments },
    router,
});

require('./templateJS/waypoints.min.js');
require('./templateJS/owl-carousel.js');
require('./templateJS/scrollreveal.min.js');
require('./templateJS/jquery.counterup.min.js');
require('./templateJS/imgfix.min.js');

require('./templateJS/custom.js');

