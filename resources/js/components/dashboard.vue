<template>
    <div>
        <div class="d-flex justify-content-between">
            <h3>Hello, {{ $store.state.app.user.first_name }}
            </h3>
            <a class="" href="#" @click="logout">Logout</a>
        </div>

        <FeedbackListing />
    </div>
</template>

<script>
import FeedbackListing from "./feedback/index.vue";
export default {
    components: {
        FeedbackListing
    },
    methods: {
        logout() {
            axios.post('/logout').then(() => {
                this.$store.dispatch('logout');
                this.$router.push({ name: 'login' });
            });
        }
    }
}
</script>