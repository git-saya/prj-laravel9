<template>
    <div>
        <h1 v-if="!user.id">New User</h1>
        <h1 v-if="user.id">Update User: {{ user.name }}</h1>
            
        <div className="card animated fadeInDown">
            <form @submit="handleSubmit">
                <input type="text" v-model="user.name" placeholder="Fullname" />
                <div v-if="errors.name" style="color: red">
                    {{ errors.name[0] }}
                </div>

                <input type="text" v-model="user.email" placeholder="Email" />
                <div v-if="errors.email" style="color: red">
                    {{ errors.email[0] }}
                </div>

                <input type="text" placeholder="Password" v-model="user.password" />
                <div v-if="errors.password" style="color: red">
                    {{ errors.password[0] }}
                </div>

                <input type="text" placeholder="Password Confirmation" v-model="user.password_confirmation" />
                <button type="submit" className="btn">Save</button>
            </form>
        </div>
    </div>
</template>

<script>
	export default {
		data() {
			return {
				user: {
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                errors: {}
			}
		},
		methods: {
			async fetchUser(id) {
                const responseUser = await axios.get(`/api/users/${id}`, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem('ACCESS_TOKEN')}`
                    }
                })
                
                this.user = responseUser.data.data
			},
            handleSubmit(e) {
                e.preventDefault()
                if(this.user.id) {
                    axios.put(`/api/users/${this.user.id}`, this.user, {
                            headers: {
                                'Content-Type': 'application/json',
                                'Authorization': `Bearer ${localStorage.getItem('ACCESS_TOKEN')}`
                            }
                        })
                        .then(() => {
                            this.$router.push({name: 'Users'})
                        }).catch((error) => {
                            const response = error.response
                            if(response && response.status === 422) {
                                this.errors = response.data.errors
                            }
                        })
                } else {
                    axios.post(`/api/users`, this.user, {
                            headers: {
                                'Content-Type': 'application/json',
                                'Authorization': `Bearer ${localStorage.getItem('ACCESS_TOKEN')}`
                            }
                        })
                        .then(() => {
                            this.$router.push({name: 'Users'})
                        }).catch((error) => {
                            const response = error.response
                            if(response && response.status === 422) {
                                this.errors = response.data.errors
                            }
                        })
                }
            }
		},
		async mounted() {
            if(this.$route.params.id) {
                const id = this.$route.params.id
			    await this.fetchUser(id)
            }
		}
	}
</script>