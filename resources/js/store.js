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
    items: {
        gloves: null,
        helmet: null,
        boots: null,
        armor: null,
        weapon: null,
    },
};

const mutations = {
    SET_PLAYER(state, player) {
        state.player = player;
    },
    SET_ITEMS(state, items) {
        state.items = items;
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

    async fetchItems({ commit }) {
        try {
            const response = await axios.get('/api/items');
            commit('SET_ITEMS', response.data);
        } catch (error) {
            console.error("An error occurred while fetching items:", error);
        }
    },
};

export default createStore({
    state,
    mutations,
    actions,
});
