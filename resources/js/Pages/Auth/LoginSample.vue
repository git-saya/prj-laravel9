<template>
	<div class="login-signup-form animated fadeInDown">
		<div className="form">
            <form v-on:submit.prevent="login">
                <h1 className="title">
                    Login into your account.
                </h1>

                <p>{{ form }}</p>
                
                <input type="text" id="email" v-model="form.email" placeholder="Email">
                <div v-if="errors.email" style="color: red">
                    {{ errors.email[0] }}
                </div>

                <input type="text" id="password" v-model="form.password" placeholder="Password">
                <div v-if="errors.password" style="color: red">
                    {{ errors.password[0] }}
                </div>

                <button type="submit" class="btn btn-block">Submit</button>
                <p className="message">
                    Not registered? 
                    <router-link v-bind:to="{name: 'Register'}">Create an account</router-link>
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
                password: ''
            })

            let errors = ref({})

            const login = async () => {
                await axios.post('/api/sanctum/token', form)
                .then(response => {
                    if(response.data.status) {
                        localStorage.setItem('ACCESS_TOKEN', response.data.token)
                        router.push({name: 'Home'})
                    }
                }).catch(error => {
                    const response = error.response
                    if(response && response.status === 422) {
                        errors.value = response.data.messages
                    }
                })
            }

            return {
                form,
                login,
                errors
            }
        }
	}
</script>