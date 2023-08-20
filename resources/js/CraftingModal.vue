<template>
    <div v-if="showModal" @click="closeModal">
        <div class="crafting-modal-bg" :class="{ 'show-bg': showModal }"></div>
        <div class="crafting-modal" @click.stop>
            <div class="modal-content">
                <div class="item-comparison">
                    <div v-if="oldItem" class="item-details">
                        <h3>Current Item</h3>
                        <p>Type: {{ oldItem.type }}</p>
                        <p>Name: {{ oldItem.name }}</p>
                        <p>Attack: {{ oldItem.attack }}</p>
                        <p>Defence: {{ oldItem.defence }}</p>
                        <p>Health: {{ oldItem.health }}</p>
                        <p>Speed: {{ oldItem.speed }}</p>
                    </div>
                    <div class="item-details">
                        <h3>Newly Crafted Item</h3>
                        <p>Type: {{ newItem.type }}</p>
                        <p>Name: {{ newItem.name }}</p>
                        <p>Attack: {{ newItem.attack }}</p>
                        <p>Defence: {{ newItem.defence }}</p>
                        <p>Health: {{ newItem.health }}</p>
                        <p>Speed: {{ newItem.speed }}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button v-if="!oldItem" @click="equipItem" class="btn btn-primary">Equip</button>
                    <button v-if="oldItem" @click="equipItem" class="btn btn-primary">Replace</button>
                    <button class="close-button btn btn-primary" @click="$emit('close')">Close</button>
                </div>
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
        closeModal(event) {
            if (event.target.classList.contains('crafting-modal-bg')) {
                this.$emit('close');
            }
        }
    },
};
</script>

<style scoped>
.item-comparison {
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

.item-details {
    flex: 1;
    padding: 0 10px;
}

.modal-footer {
    text-align: center;
    margin-top: 20px;
    display: flex;
    justify-content: center;
    gap: 20px;
}

.crafting-modal {
    position: fixed;
    top: 30%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    max-width: 650px;
    width: 90%;
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

@media (min-width: 768px) {
    .item-details {
        flex: 0 0 45%;
    }
}

@media (max-width: 768px) {
    .item-details {
        flex: 0 0 48%;
    }

    .modal-content {
        font-size: 0.9rem;
    }
}

</style>
