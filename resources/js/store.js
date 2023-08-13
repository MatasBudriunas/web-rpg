import { createStore } from 'vuex';
import axios from 'axios';

const state = {
    player: {
        name: '',
        attack: 0,
        defence: 0,
        health: 0,
        speed: 0,
    },
};

const mutations = {
    SET_PLAYER(state, player) {
        state.player = player;
    },
};

const actions = {
    async fetchPlayer({ commit }) {
        const token = localStorage.getItem('auth-token');

        try {
            const response = await axios.get('/api/player');
            commit('SET_PLAYER', response.data);
        } catch (error) {
            console.error("An error occurred while fetching player information:", error);
        }
    },
};

export default createStore({
    state,
    mutations,
    actions,
});
