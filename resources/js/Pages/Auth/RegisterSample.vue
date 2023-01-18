<template>
	<div class="login-signup-form animated fadeInDown">
		<div className="form">
            <form v-on:submit.prevent="register">
                <h1 className="title">
                	Signup for free.
            	</h1>

                <p>{{ form }}</p>
                
                <input type="text" id="fullname" v-model="form.fullname" placeholder="Fullname">
				<div v-if="errors.name" style="color: red">
                    {{ errors.name[0] }}
                </div>

                <input type="text" id="email" v-model="form.email" placeholder="Email">
				<div v-if="errors.email" style="color: red">
                    {{ errors.email[0] }}
                </div>

                <input type="text" id="password" v-model="form.password" placeholder="Password">
				<div v-if="errors.password" style="color: red">
                    {{ errors.password[0] }}
                </div>

                <input type="text" id="password_confirmation" v-model="form.password_confirmation" placeholder="Password Confirmation">

                <button type="submit" class="btn btn-block">Submit</button>
				<p className="message">
                	Already registered? <router-link v-bind:to="{name: 'Login'}">Sign In</router-link>
            	</p>
            </form>
        </div>
	</div>
</template>

<script>
	import {reactive, ref} from 'vue'
	import {useRouter} from 'vue-router'
	export default {
        setup() {
            const router = useRouter()

            let form = reactive({
                email: '',
                password: '',
				fullname: '',
				password_confirmation: ''
            })

            let errors = ref({})

            const register = async () => {
                await axios.post('/api/register', form)
                .then(response => {
					router.push({name: 'Login'})
                }).catch(error => {
                    const response = error.response
                    if(response && response.status === 422) {
                        errors.value = response.data.messages
                    }
                })
            }

            return {
                form,
                register,
                errors
            }
        }
	}
</script>