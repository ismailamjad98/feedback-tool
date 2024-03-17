<template>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-4 col-md-6 col-sm-6">
                <div class="card rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="card-body">
                        <div class="mb-3 text-center">
                            <img class="img-fluid rounded-circle my-3" src="/assets/images/icons/logo.png" width="50"
                                height="50" alt="avatar">
                            <h5 class="card-title fw-semibold">Register</h5>
                            <p class="card-text text-muted">Enter your email and password to Register</p>
                        </div>
                        <form method="post" id="registerForm" @submit="register" action="javascript:void(0)">

                            <div class="col-12" v-if="Object.keys(validationErrors).length > 0">
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        <li v-for="(value, key) in validationErrors" :key="key">{{ value[0] }}</li>
                                    </ul>
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="first_name" class="form-label fw-semibold">First Name</label>
                                <input type="text" class="form-control" id="first_name" placeholder="First Name"
                                    v-model="user.first_name">
                            </div>

                            <div class="mb-3">
                                <label for="last_name" class="form-label fw-semibold">Last Name</label>
                                <input type="text" class="form-control" id="last_name" placeholder="Last Name"
                                    v-model="user.last_name">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email"
                                    v-model="user.email">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password"
                                    v-model="user.password">
                            </div>
                            <button type="submit" class="btn btn-dark w-100" :disabled="processing">
                                {{ processing ? "Please wait" : "Register" }}</button>
                        </form>
                        <div class="text-center mt-3">
                            <span>Already have an account?
                                <router-link to="/login">
                                    <p class="text-primary cursor-pointer"> Login</p>
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
    name: 'register',
    data() {
        return {
            user: {
                first_name: "",
                last_name: "",
                email: "",
                password: "",
            },
            validationErrors: {},
            processing: false
        }
    },
    methods: {
        async register() {
            this.processing = true
            await axios.post('/register', this.user).then((response) => {
                this.validationErrors = {};
                this.$router.push({ name: 'login' });
            }).catch((error) => {
                if (error.response && error.response.status === 422) {
                    const { errors } = error.response.data;
                    this.validationErrors = errors;
                } else {
                    console.error('An error occurred:', error);
                }
            }).finally(() => {
                this.processing = false
            })
        }
    }
}
</script>