<template>
    <div :key="forceRerender" class="items-container">
        <div v-for="(item, index) in allItems" :key="item.id" class="item-wrapper" @click="openEquipmentModal(item, index)">
            <div :key="index" class="item-box" :class="itemQualityClasses[index]">
                <div v-if="item.type" class="item-type">{{ item.type }}</div>
                <div v-else class="coming-soon">Coming soon...</div>
            </div>
        </div>

        <equipment-modal
            :showModal="showEquipmentModal"
            :item="selectedItem"
            @close="closeEquipmentModal">
        </equipment-modal>
    </div>
</template>

<script>
import EquipmentModal from './EquipmentModal.vue';
import { mapState } from 'vuex';


export default {
    components: {
        EquipmentModal,
    },
    props: {
        items: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            showEquipmentModal: false,
            selectedItem: null,
            newlyEquippedIndex: null,
            forceRerender: 0,
        };
    },
    computed: {
        ...mapState(['items']),
        allItems() {
            const equippedItems = [
                { id: 1, type: 'Weapon', details: this.items.weapon },
                { id: 2, type: 'Armor', details: this.items.armor },
                { id: 3, type: 'Helmet', details: this.items.helmet },
                { id: 4, type: 'Gloves', details: this.items.gloves },
                { id: 5, type: 'Boots', details: this.items.boots },
            ];
            const comingSoon = Array(3).fill({ id: null });
            return [...equippedItems, ...comingSoon];
        },
        itemQualityClasses() {
            return this.allItems.map((item, index) => {
                if (item.details) {
                    const rarity = item.details.rarity;
                    switch (rarity) {
                        case '2':
                            return 'quality-uncommon';
                        case '3':
                            return 'quality-rare';
                        case '4':
                            return 'quality-legendary';
                        default:
                            return '';
                    }
                }
                return '';
            });
        }
    },
    methods: {
        openEquipmentModal(item) {
            this.selectedItem = item;
            this.showEquipmentModal = true;
        },
        closeEquipmentModal() {
            this.showEquipmentModal = false;
        },
    },
};
</script>

<style scoped>
.items-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(4, minmax(70px, auto));
    column-gap: 30px;
    width: fit-content;
    margin-left: 20px;
    margin-right: auto;
    align-items: flex-end;
}

.item-box {
    width: 65px;
    height: 60px;
    border: 1px solid #ccc;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    border-radius: 10px;
}

.coming-soon {
    font-size: 0.8rem;
}

.item-type {
    /* Style for item type */
}

.item-wrapper {
    position: relative;
    width: 60px;
    height: 60px;
}

.quality-common {
    /* No specific styles for common items */
}

.quality-uncommon {
    box-shadow: 0 0 10px 1px rgba(0, 128, 0, 0.5);
}

.quality-rare {
    box-shadow: 0 0 10px 1px rgba(0, 0, 255, 0.5);
}

.quality-legendary {
    box-shadow: 0 0 10px 1px gold;
    animation: goldHue 2s infinite linear;
}

@keyframes goldHue {
    0%   { box-shadow: 0 0 10px 1px rgba(255, 215, 0, 0.5); }
    50%  { box-shadow: 0 0 15px 2px rgba(255, 215, 0, 0.7); }
    100% { box-shadow: 0 0 10px 1px rgba(255, 215, 0, 0.5); }
}

</style>
