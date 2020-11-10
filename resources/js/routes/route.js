import Vue from 'vue';
import VueRouter from 'vue-router';
import PageNotFound from '../views/404NotFound'
import Login from '../views/auth/login'
import Register from '../views/auth/register'
//import Register from '@/js/pages/Register'
//import Dashboard from '@/js/pages/Dashboard'
//import Home from '@/js/pages/Home';

Vue.use(VueRouter);

const routes = [
    { path: '/login', name: 'login', component: Login, },
    { path: '/register', name: 'register', component: Register, },
    /*
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
    },*/
    // ... other routes ...
    // and finally the default route, when none of the above matches:
    { path: "*", component: PageNotFound }
];

/*
 * history mode, which means we need to configure a Laravel route 
 * that will match all possible URLs depending on which route the user enters the Vue SPA. 
*/
export default new VueRouter({ 
    //base: '/v',
    mode: 'history', 
    routes: routes 
})