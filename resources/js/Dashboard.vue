<template>
    <dashboard-navbar></dashboard-navbar>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12 player-info-container">
                <player-info></player-info>
                <equipped-items :items="items"/>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-6 col-sm-12 main-screen-container">
                <main-screen></main-screen>
            </div>
            <div class="col-xl-1 col-lg-1 col-md-3 col-sm-12 right-section-container">
                <player-currency></player-currency>
                <div class="right-section">
                    <actions-menu @openCrafting="openCraftModal"></actions-menu>
                </div>
            </div>
        </div>
    </div>
    <chat-box></chat-box>
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
import ActionsMenu from './Actions/ActionsMenu.vue';
import MainScreen from './MainScreen.vue';
import ChatBox from './ChatBox.vue';

export default {
    components: {
        PlayerCurrency,
        PlayerInfo,
        DashboardNavbar,
        CraftingModal,
        EquippedItems,
        ActionsMenu,
        MainScreen,
        ChatBox,
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
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 0;
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

.right-section-container {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.right-section {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.main-screen-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.main-screen {
    border: 2px solid #000;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    margin: 0;
    padding: 0;
}

.container-fluid {
    margin-top: 10px;
    margin-bottom: 50px;
}

@media (max-width: 767px) {
    .player-info-container, .main-screen-container, .right-section-container {
        flex: 0 0 auto;
        max-width: 100%;
    }

    .player-info-container {
        width: 20%;
    }

    .main-screen-container {
        width: 60%;
    }

    .right-section-container {
        width: 20%;
    }
}

@media (max-width: 730px) {
    .player-info-container,
    .right-section-container,
    .main-screen-container {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .right-section-container {
        order: 1;
        margin-bottom: 20px;
    }

    .main-screen-container {
        order: 2;
    }

    .main-screen {
        height: 300px;
        width: 100%;
    }

    .player-info-container {
        order: 3;
        flex-direction: row;
        justify-content: space-around;
        padding: 0 20px;
    }

    .right-section .actions-menu {
        margin: 0 auto;
        padding-top: 50px;
    }
}
</style>
