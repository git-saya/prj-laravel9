import {createRouter, createWebHistory, createWebHashHistory} from 'vue-router'

import Home from '../Pages/Home.vue'
import Users from '../Pages/Users.vue'
import UserForm from '../Pages/UserForm.vue'
import Login from '../Pages/auth/LoginSample.vue'
import Register from '../Pages/auth/RegisterSample.vue'
import About from '../Pages/About.vue'
import NotFound from '../Pages/NotFound.vue'

const routes = [
	{
		name: 'Home',
		path: '/vue',
		component: Home,
		meta: {
			requiresAuth: true
		}
	},
	{
		name: 'Users',
		path: '/vue/users',
		component: Users,
		meta: {
			requiresAuth: true
		}
	},
	{
		name: 'UserAdd',
		path: '/vue/users/new',
		component: UserForm,
		meta: {
			requiresAuth: true
		}
	},
	{
		name: 'UserEdit',
		path: '/vue/users/:id/edit',
		component: UserForm,
		meta: {
			requiresAuth: true
		}
	},
	{
		name: 'About',
		path: '/vue/about',
		component: About
	},
	{
		name: 'Login',
		path: '/vue/login',
		component: Login,
		meta: {
			requiresAuth: false
		}
	},
	{
		name: 'Register',
		path: '/vue/register',
		component: Register,
		meta: {
			requiresAuth: false
		}
	},
	{
		path: '/:pathMatch(.*)',
		component: NotFound
	}
]

const router = new createRouter({
	history: createWebHistory(),
	routes
})

router.beforeEach((to, from) => {
	if(to.meta.requiresAuth && !localStorage.getItem('ACCESS_TOKEN')) {
		return {name: 'Login'}
	}

	if(!to.meta.requiresAuth && localStorage.getItem('ACCESS_TOKEN')) {
		return {name: 'Home'}
	}
})

export default router