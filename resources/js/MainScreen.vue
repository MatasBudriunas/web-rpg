<template>
    <div class="main-screen">
        <div v-for="row in grid" :key="row.y" class="row">
            <div v-for="cell in row.cells" :key="cell.x" class="cell"
                 :class="{ 'player': isPlayerPosition(cell) }"
                 @click="movePlayer(cell.x, cell.y)"></div>
        </div>
    </div>
</template>

<script>
import {mapState} from 'vuex';
import axios from 'axios';

export default {
    computed: {
        ...mapState(['player']),

        mapWidth() {
            return this.player.map_width;
        },

        mapHeight() {
            return this.player.map_height;
        },

        grid() {
            return this.createGrid();
        }
    },

    methods: {
        createGrid() {
            const rows = [];
            for (let y = 0; y < this.mapHeight; y++) {
                const row = { y, cells: [] };
                for (let x = 0; x < this.mapWidth; x++) {
                    row.cells.push({ x, y });
                }
                rows.push(row);
            }
            return rows;
        },

        isPlayerPosition(cell) {
            return cell.x === this.player.coordinates_x && cell.y === this.player.coordinates_y;
        },

        movePlayer(x, y) {
            const data = {
                coordinate_x: x,
                coordinate_y: y,
            };

            axios.post('/api/move', data).then(response => {
                this.$store.commit('UPDATE_PLAYER_COORDINATES', response.data.data.coordinates);
            }).catch(error => {
                console.error('An error occurred while moving the player:', error);
            });
        },
    }
}
</script>

<style scoped>
.main-screen {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border: 2px solid #000;
    overflow: hidden;
}

.row {
    display: flex;
    justify-content: center;
    width: 100%;
    height: 20px;
}

.cell {
    width: 20px;
    height: 100%;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

.cell.player {
    background-color: black;
}
</style>
