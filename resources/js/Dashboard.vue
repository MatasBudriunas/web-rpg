<template>
    <dashboard-navbar></dashboard-navbar>
    <div class="player-info-container">
        <player-info></player-info>
        <player-currency></player-currency>
    </div>
</template>

<script>
import DashboardNavbar from './DashboardNavbar.vue';
import PlayerInfo from './Player/PlayerInfo.vue';
import PlayerCurrency from "./Player/PlayerCurrency.vue";
import { mapState } from 'vuex';

export default {
    components: {
        PlayerCurrency,
        PlayerInfo,
        DashboardNavbar,
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
}
</script>

<style>
.player-info-container {
    position: relative;
    padding-top: 10px;
}
</style>
