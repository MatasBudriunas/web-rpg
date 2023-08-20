<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/dashboard">Game Dashboard</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link to="/dashboard" class="nav-link">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click="logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import axios from 'axios';
import {clearAuthToken} from './axios-config';

export default {
    methods: {
        async logout() {
            try {
                const token = localStorage.getItem('auth-token');
                await axios.post('/api/logout', {}, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });
                localStorage.removeItem('auth-token');
                clearAuthToken();
                window.location.href = '/auth';
            } catch (error) {
                console.log(error);
            }
        },
    }
};
</script>

<style scoped>

</style>
