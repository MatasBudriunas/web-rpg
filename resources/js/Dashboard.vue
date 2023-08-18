<template>
    <dashboard-navbar></dashboard-navbar>
    <div class="player-info-container">
        <player-currency></player-currency>
        <div class="info-and-items">
            <player-info></player-info>
            <equipped-items :items="items" />
        </div>
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
import EquippedItems from './Items/EquippedItems.vue';

export default {
    components: {
        PlayerCurrency,
        PlayerInfo,
        DashboardNavbar,
        CraftingModal,
        EquippedItems,
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
        ...mapState(['items']),
    },

    async mounted() {
        try {
            await this.$store.dispatch('fetchPlayer');
            await this.$store.dispatch('fetchItems');
        } catch (error) {
            console.error("An error occurred while fetching player information:", error);
        }
    },

    methods: {
        async openCraftModal() {
            try {
                const response = await axios.get('/api/craft-item');
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
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding-top: 10px;
}

.info-and-items {
    display: flex;
    width: 80%;
    justify-content: space-between;
    margin: 0 auto;
}

.player-currency {
    position: absolute;
    top: 0;
    right: 0;
}

.equipped-items {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: repeat(2, 1fr);
    gap: 10px;
    margin-left: 10px;
}

.player-info {

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
