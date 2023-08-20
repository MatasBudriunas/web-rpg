<template>
    <div class="modal-container" v-if="showModal" @click="closeModal">
        <div class="equipment-modal-bg" :class="{ 'show-bg': showModal }"></div>
        <div class="equipment-modal" @click.stop>
            <h2 class="modal-header">Equipment</h2>
            <div class="modal-content">
                <div v-if="item && item.details">
                    <div class="item-details">
                        <div class="stat-line"><span class="stat-name">Type:</span> <span
                            class="stat-value">{{ item.details.type }}</span></div>
                        <div class="stat-line"><span class="stat-name">Name:</span> <span
                            class="stat-value">{{ item.details.name }}</span></div>
                        <div class="stat-line"><span class="stat-name">Attack:</span> <span
                            class="stat-value">{{ item.details.attack }}</span></div>
                        <div class="stat-line"><span class="stat-name">Defence:</span> <span
                            class="stat-value">{{ item.details.defence }}</span></div>
                        <div class="stat-line"><span class="stat-name">Health:</span> <span
                            class="stat-value">{{ item.details.health }}</span></div>
                        <div class="stat-line"><span class="stat-name">Speed:</span> <span
                            class="stat-value">{{ item.details.speed }}</span></div>
                    </div>
                </div>
                <div v-else class="nothing-equipped">Nothing is equipped.</div>
            </div>
            <div class="modal-footer">
                <button class="close-button btn btn-primary" @click="$emit('close')">Close</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['showModal', 'item'],
    methods: {
        closeModal(event) {
            if (event.target.classList.contains('equipment-modal-bg')) {
                this.$emit('close');
            }
        }
    },
};
</script>

<style scoped>
.modal-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 100;
}

.equipment-modal {
    position: fixed;
    top: 30%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px 40px;;
    border-radius: 5px;
    max-width: 400px;
    width: 70%;
    z-index: 100;
    transition: all 0.3s;
}

.modal-header {
    display: flex;
    margin-bottom: 15px;
    justify-content: center;
}

.equipment-modal-bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 99;
    opacity: 0;
    transition: opacity 0.3s;
}

.show-bg {
    opacity: 1;
}

.stat-line {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
}

.stat-name {
    color: #555;
    font-weight: bold;
}

.stat-value {
    text-align: right;
}

.modal-footer {
    display: flex;
    justify-content: center;
    margin-top: 20px
}

.close-button {
    cursor: pointer;
    display: inline-block;
}

.nothing-equipped {
    font-size: 1rem;
    text-align: center;
}

.item-details {
    margin: 0 20px;
}
</style>
