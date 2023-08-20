<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ isRegistering ? 'Register' : 'Login' }}</div>
                    <div class="card-body">
                        <form @submit.prevent="handleSubmit">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" v-model="username" required/>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" v-model="password" required/>
                            </div>
                            <div v-if="isRegistering" class="form-group mb-3">
                                <label for="password_confirmation">Confirm Password:</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                       v-model="passwordConfirmation" required/>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ isRegistering ? 'Register' : 'Login' }}
                                </button>
                            </div>
                            <button type="button" class="btn btn-link btn-block mt-3" @click="toggleMode">
                                {{
                                    isRegistering ? "Already have an account? Login" : "Don't have an account? Register"
                                }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {useRouter} from 'vue-router';
import axios from 'axios';

export default {
    name: 'AuthForm',
    data() {
        return {
            username: '',
            password: '',
            passwordConfirmation: '',
            isRegistering: false
        };
    },
    mounted() {
        console.log("AuthForm component has been mounted!");
    },
    methods: {
        toggleMode() {
            this.isRegistering = !this.isRegistering;
        },
        async handleSubmit() {
            const router = useRouter();
            console.log(router);
            const url = this.isRegistering ? '/api/register' : '/api/login';

            const userData = {
                username: this.username,
                password: this.password,
            };

            if (this.isRegistering) {
                userData.password_confirmation = this.passwordConfirmation;
            }

            try {
                const response = await axios.post(url, userData);
                localStorage.setItem('auth-token', response.data.token);
                this.$store.dispatch('fetchPlayer');

                window.location.href = '/dashboard';
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>

<style scoped>

</style>
