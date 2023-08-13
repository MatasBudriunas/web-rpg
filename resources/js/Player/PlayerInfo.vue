<template>
    <div class="player-card-wrapper">
        <div class="player-info card">
            <div class="card-body">
                <h1 class="card-title">{{ player.username }}</h1>
                <p class="card-text">Attack: {{ player.attack }}</p>
                <p class="card-text">Defence: {{ player.defence }}</p>
                <p class="card-text">Health: {{ player.health }}</p>
                <p class="card-text">Speed: {{ player.speed }}</p>
                <div class="progress position-relative">
                    <div :class="progressBarClass" role="progressbar" :style="{ width: progressPercentage + '%' }"
                         :aria-valuenow="progressPercentage" aria-valuemin="0" aria-valuemax="100"></div>
                    <span class="progress-text" style="top: 50%; transform: translateY(-50%);">
          {{ progressPercentage }}%
        </span>
                </div>
                <div class="level-info">
                    Level: {{ player.level }} | XP: {{ player.current_xp }}/{{ player.needed_xp }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapState} from 'vuex';

export default {
    computed: {
        ...mapState(['player']),
        progressPercentage() {
            return (this.player.current_xp / this.player.needed_xp) * 100;
        },
        progressBarClass() {
            if (this.progressPercentage < 25) return 'progress-bar bg-danger';
            if (this.progressPercentage < 50) return 'progress-bar bg-warning';
            if (this.progressPercentage < 75) return 'progress-bar bg-info';
            return 'progress-bar bg-success';
        },
    },
};
</script>

<style scoped>
.player-card-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50vh;
}

.player-info.card {
    width: 40%;
    margin-top: 20px;
    text-align: center;
    border: 1px solid #ced4da;
    border-radius: 5px;
    padding: 10px;
}

.progress {
    margin-top: 10px;
}

.level-info {
    text-align: center;
    font-size: 14px;
    margin-top: 5px;
}

.progress-text {
    position: absolute;
    width: 100%;
    text-align: center;
    top: 50%;
    transform: translateY(-50%);
    font-size: 12px;
    font-weight: bold;
    color: #000;
}
</style>
