<template>
	<div>
		<p>Home</p>
		<p v-if="user">Hai, <strong>{{ user.name }}</strong></p>
		<button @click="logout">Logout</button>
	</div>
</template>

<script>
	import {useRouter} from 'vue-router'
	export default {
		data() {
			return {
				user: {}
			}
		},
		setup() {
			const router = useRouter()

			const logout = () => {
				axios.post('/api/user/logout', {}, {
					headers: {
						'Content-Type': 'application/json',
						'Authorization': `Bearer ${localStorage.getItem('ACCESS_TOKEN')}`
					}
				}).then(() => {
					localStorage.removeItem('ACCESS_TOKEN')
					router.push({name: 'Login'})
				})
			}

			return {
				logout
			}
		},
		methods: {
			async fetchUser() {
				const responseUser = await axios.get('/api/user', {
					headers: {
						'Content-Type': 'application/json',
						'Authorization': `Bearer ${localStorage.getItem('ACCESS_TOKEN')}`
					}
				})
				
				this.user = responseUser.data.data
			}
		},
		async mounted() {
			await this.fetchUser()
		}
	}
</script>