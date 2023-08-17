<template>
    <div v-if="showModal">
        <div class="crafting-modal-bg" :class="{ 'show-bg': showModal }"></div>
        <div class="crafting-modal">
            <div class="modal-content">
                <button class="close-button" @click="$emit('close')">Close</button>
                <div v-if="oldItem">
                    <h3>Current Item</h3>
                    <p>Type: {{ oldItem.type }}</p>
                    <p>Attack: {{ oldItem.attack }}</p>
                </div>
                <h3>Newly Crafted Item</h3>
                <p>Type: {{ newItem.type }}</p>
                <p>Name: {{ newItem.name }}</p>
                <p>Attack: {{ newItem.attack }}</p>
                <p>Defence: {{ newItem.defence }}</p>
                <p>Health: {{ newItem.health }}</p>
                <p>Speed: {{ newItem.speed }}</p>
                <button v-if="!oldItem" @click="equipItem">Equip</button>
                <button v-if="oldItem" @click="equipItem">Replace</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['showModal', 'oldItem', 'newItem'],
    methods: {
        async equipItem() {
            try {
                await this.$store.dispatch('equipItem', this.newItem.log_id);
                this.$emit('close');
            } catch (error) {
                console.error('An error occurred while equipping the item:', error);
            }
        },
    },
};
</script>

<style scoped>
.crafting-modal {
    position: fixed;
    top: 30%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    width: 600px;
    z-index: 100;
    transition: all 0.3s;
}

.crafting-modal-bg {
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

.close-button {
    float: right;
    cursor: pointer;
}
</style>
