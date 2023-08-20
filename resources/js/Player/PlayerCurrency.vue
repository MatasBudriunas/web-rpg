<template>
    <div class="currency-info">
        Currency: {{ player.currency }}
    </div>
</template>

<script>
import {mapState} from 'vuex';

export default {
    computed: {
        ...mapState(['player']),
    },
}
</script>

<style scoped>
.currency-info {
    position: absolute;
    top: 10px;
    right: 20px;
    font-weight: bold;
    font-size: 14px;
}
</style>
