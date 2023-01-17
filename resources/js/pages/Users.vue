<template>
    <div>
        <div>
            <h1>Users</h1>
            <router-link :to="{name: 'UserAdd'}">Add new</router-link>
        </div>

        <div className="card animated fadeInDown">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Create Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.created_at }}</td>
                        <td>
                            <router-link className="btn-edit" :to="{name: 'UserEdit', params: {id: user.id}}">Edit</router-link>
                            &nbsp;
                            <button @click="deleteUser(user)" className="btn-delete">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
	import {useRouter} from 'vue-router'
    import axiosClient from '../axios-client'
	export default {
		data() {
			return {
				users: []
			}
		},
		setup() {
			
		},
		methods: {
			async fetchUsers() {
				const responseUser = await axios.get('/api/users', {
					headers: {
						'Content-Type': 'application/json',
						'Authorization': `Bearer ${localStorage.getItem('ACCESS_TOKEN')}`
					}
				})

				this.users = responseUser.data.data.data
			},
            deleteUser(u) {
                if(!window.confirm('Are you sure want to delete this user?')) {
                    return
                }

                if(u.id) {
                    axios.delete(`/api/users/${u.id}`, {
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer ${localStorage.getItem('ACCESS_TOKEN')}`
                        }
                    })
                    .then(() => {
                        this.fetchUsers()
                    })
                }
            }
		},
		async mounted() {
			await this.fetchUsers()
		}
	}
</script>