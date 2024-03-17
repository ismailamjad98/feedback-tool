<template>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-4 col-md-6 col-sm-6">
                <div class="card rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="card-body">
                        <div class="mb-3 text-center">
                            <img class="img-fluid rounded-circle my-3" src="/assets/images/icons/logo.png" width="50"
                                height="50" alt="avatar">
                            <h5 class="card-title fw-semibold">Welcome back</h5>
                            <p class="card-text text-muted">Enter your email and password to login</p>
                        </div>
                        <form action="javascript:void(0)" class="row" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" required
                                    v-model="auth.email">
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <label for="password" class="form-label fw-semibold">Password</label>
                                    <!-- <span class="text-primary fw-semibold">Forget Password?</span> -->
                                </div>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" placeholder="Password"
                                        required v-model="auth.password">

                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark w-100" @click="login">Login</button>
                        </form>
                        <div class="text-center mt-3">
                            <span>Not have an account?
                                <router-link to="/register">
                                    <p class="text-primary cursor-pointer"> Create new account</p>
                                </router-link>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "login",
    data() {
        return {
            auth: {
                email: "",
                password: ""
            },
        }
    },
    computed: {
        authenticated() {
            return this.$store.getters.authenticated;
        },
        user() {
            return this.$store.getters.user;
        }
    },
    methods: {
        async login() {
            this.$store.dispatch('login', this.auth);
        },
    }
}
</script>