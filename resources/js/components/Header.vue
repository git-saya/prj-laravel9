<template>
	<aside>
		<router-link :to="{name: 'Home'}">Home</router-link>
		<router-link v-bind:to="{name: 'About'}">About</router-link>
		<router-link v-bind:to="{name: 'Users'}">Users</router-link>
	</aside>
</template>

<script>
	export default {
		
	}
</script>