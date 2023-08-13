import axios from 'axios';

const token = localStorage.getItem('auth-token');

if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

export function clearAuthToken() {
    delete axios.defaults.headers.common['Authorization'];
}
