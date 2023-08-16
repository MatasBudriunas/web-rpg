<template>
    <div v-if="showModal">
        <div class="crafting-modal-bg" :class="{ 'show-bg': showModal }"></div>
        <div class="crafting-modal">
            <div class="modal-content">
                <button class="close-button" @click="$emit('close')">Close</button>
                <div v-if="oldItem">
                    <h3>Current Item</h3>
                    <!-- old item details -->
                </div>
                <h3>Newly Crafted Item</h3>
                <!-- new item details -->
                <button v-if="!oldItem" @click="equipItem">Equip</button>
                <button v-if="oldItem" @click="replaceItem">Replace</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['showModal', 'oldItem', 'newItem'],
    methods: {
        equipItem() {

        },
        replaceItem() {

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
