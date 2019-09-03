<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <div class="text-center form-wrapper">

                            <form class="form-signin" v-on:submit.prevent="login">
                                <label for="inputEmail" class="sr-only">Email</label>
                                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus v-model="email">

                                <label for="inputPassword" class="sr-only">Password</label>
                                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required v-model="password">

                                <br>
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: '',
                password: '',
                loginError: false,
            }
        },

        methods: {
            login: function () {
                let email = this.email;
                let password = this.password;
                this.$store.dispatch('login', { email, password })
                    .then(() => this.$router.push({ name: 'app' }))
                    .catch(err => {
                        this.loginError = true
                    })
            }
        }
    }
</script>