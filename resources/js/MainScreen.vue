<template>
    <div class="main-screen">
        <div v-for="row in grid" :key="row.y" class="row">
            <div v-for="cell in row.cells" :key="cell.x" class="cell"
                 :class="{ 'player': isPlayerPosition(cell), 'passable': cell.is_passable }"
                 @click="movePlayer(cell.x, cell.y)"></div>
        </div>
    </div>
</template>

<script>
import {mapState} from 'vuex';
import axios from 'axios';
import {findPath} from "./Utils/path-finding";

export default {
    computed: {
        data() {
            return {
                isPlayerMoving: false,
            };
        },
        ...mapState(['player', 'map']),

        mapWidth() {
            return this.map.width;
        },

        mapHeight() {
            return this.map.height;
        },

        grid() {
            return this.createGrid();
        },
    },

    methods: {
        createGrid() {
            const rows = [];
            for (let y = 0; y < this.mapHeight; y++) {
                const row = { y, cells: [] };
                for (let x = 0; x < this.mapWidth; x++) {
                    const tile = this.map.tiles.find(tile => tile.coordinates_x === x && tile.coordinates_y === y);
                    row.cells.push({ x, y, type: tile.type, is_passable: tile.is_passable });
                }
                rows.push(row);
            }
            return rows;
        },
        isPlayerPosition(cell) {
            return cell.x === this.player.coordinates_x && cell.y === this.player.coordinates_y;
        },
        movePlayer(targetX, targetY) {
            if (this.isPlayerMoving) return;

            this.isPlayerMoving = true;

            const start = { x: this.player.coordinates_x, y: this.player.coordinates_y };
            const target = { x: targetX, y: targetY };
            const path = findPath(start, target, this.map);

            if (path) {
                let index = 0;
                const moveStep = () => {
                    const step = path[index];
                    if (step) {
                        this.$store.commit('UPDATE_PLAYER_COORDINATES', { x: step.x, y: step.y });
                        index++;
                        if (index < path.length) {
                            setTimeout(moveStep, 300);
                        } else {
                            this.updatePlayerCoordinates(targetX, targetY);
                            this.isPlayerMoving = false;
                        }
                    }
                };
                moveStep();
            }
        },
        updatePlayerCoordinates(x, y) {
            const data = {
                coordinates_x: x,
                coordinates_y: y,
                map_id: this.player.map_id
            };

            axios.post('/api/move', data).then(response => {
                this.$store.commit('UPDATE_PLAYER_COORDINATES', response.data.coordinates);
            }).catch(error => {
                console.error('An error occurred while moving the player:', error);
            });
        },
        handleSpecialFeature(cell) {
            const type = cell.special_feature_type;
            const data = cell.special_feature_data;

            switch (type) {
                case 'MAP_TRANSITION':
                    this.transitionToMap(data);
                    break;
                default:
                    console.warn('Unknown special feature type:', type);
            }
        },
        transitionToMap(data) {
            // TODO implement transitions between maps
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
    height: 64px;
}

.cell {
    width: 64px;
    height: 100%;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

.cell.player {
    width: 64px;
    height: 64px;
    background-color: black;
    background-image: url('/images/placeholder.png');
    background-size: cover;
    background-repeat: no-repeat;
    box-sizing: border-box;
}

.cell.passable {
    cursor: pointer;
}
</style>
