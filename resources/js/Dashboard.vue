<template>
    <dashboard-navbar></dashboard-navbar>
    <div class="player-info-container">
        <player-info></player-info>
        <player-currency></player-currency>
        <button class="craft-button" @click="openCraftModal">Craft Item</button>
    </div>
    <crafting-modal
        :showModal="showCraftModal"
        :oldItem="oldItem"
        :newItem="newItem"
        @close="closeCraftModal"></crafting-modal>
</template>

<script>
import DashboardNavbar from './DashboardNavbar.vue';
import PlayerInfo from './Player/PlayerInfo.vue';
import PlayerCurrency from "./Player/PlayerCurrency.vue";
import CraftingModal from './CraftingModal.vue';
import {mapState} from 'vuex';
import axios from 'axios';

export default {
    components: {
        PlayerCurrency,
        PlayerInfo,
        DashboardNavbar,
        CraftingModal,
    },

    data() {
        return {
            showCraftModal: false,
            oldItem: null,
            newItem: null,
        };
    },

    computed: {
        ...mapState(['player']),
    },

    async mounted() {
        try {
            await this.$store.dispatch('fetchPlayer');
        } catch (error) {
            console.error("An error occurred while fetching player information:", error);
        }
    },

    methods: {
        async openCraftModal() {
            try {
                const response = await axios.get('/craft-item');
                this.newItem = response.data;
                this.oldItem = this.getCurrentItemOfType(this.newItem.type);
                this.showCraftModal = true;
            } catch (error) {
                console.error('An error occurred while crafting:', error);
            }
        },
        getCurrentItemOfType(type) {
            return this.$store.state.items[type];
        },
        closeCraftModal() {
            this.showCraftModal = false;
        },
    },
}
</script>

<style>
.player-info-container {
    position: relative;
    padding-top: 10px;
}

.craft-button {
    display: block;
    margin: 10px auto;
    padding: 10px 20px;
    background-color: #4CAF50;
    border: none;
    color: white;
    text-align: center;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
}
</style>
