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
    equipMessage: '',
};

const mutations = {
    SET_PLAYER(state, player) {
        state.player = player;
    },
    SET_ITEMS(state, items) {
        state.items = items;
    },
    EQUIP_ITEM(state, { item, slot }) {
        state.items[slot] = item;
        state.equipMessage = 'Item successfully equipped!';
    },
    ITEM_EQUIPPED(state) {
        state.itemEquipped = !state.itemEquipped;
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
            const itemsData = response.data.data;

            const items = {
                gloves: itemsData.gloves || null,
                helmet: itemsData.helmet || null,
                boots: itemsData.boots || null,
                armor: itemsData.armor || null,
                weapon: itemsData.weapon || null,
            };

            commit('SET_ITEMS', items);
        } catch (error) {
            console.error("An error occurred while fetching items:", error);
        }
    },
    async equipItem({ commit }, itemLogId) {
        try {
            const response = await axios.post('/api/equip-item', { itemId: itemLogId });

            if (response.data) {
                const item = response.data;
                const slot = item.type;

                commit('EQUIP_ITEM', { item, slot });
                commit('ITEM_EQUIPPED');
            } else {
                throw new Error('An error occurred while equipping the item');
            }
        } catch (error) {
            console.error(error);
            state.equipMessage = error.message;
        }
    },
};

const getters = {
    combinedPlayerStats: (state) => {
        let combinedStats = {
            attack: 0,
            defence: 0,
            health: 0,
            speed: 0,
        };

        Object.keys(state.items).forEach((itemType) => {
            let item = state.items[itemType];
            if (item) {
                combinedStats.attack += item.attack ?? 0;
                combinedStats.defence += item.defence ?? 0;
                combinedStats.health += item.health ?? 0;
                combinedStats.speed += item.speed ?? 0;
            }
        });

        combinedStats.attack += state.player.attack ?? 0;
        combinedStats.defence += state.player.defence ?? 0;
        combinedStats.health += state.player.health ?? 0;
        combinedStats.speed += state.player.speed ?? 0;

        return combinedStats;
    },
};

export default createStore({
    state,
    mutations,
    actions,
    getters,
});
