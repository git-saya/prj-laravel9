<template>
    <div id="defaultLayout">
            <Header />
            <div className="content">
                <header>
                    <div>
                        Laravel
                    </div>
                    <div>
                        Logout
                    </div>
                </header>
                <main>
                    <router-view></router-view>
                </main>
            </div>
    </div>
</template>

<script>
import Header from './components/Header.vue'
import Footer from './components/Footer.vue'

export default {
    components: {
        Header,
        Footer
    }
}
</script>