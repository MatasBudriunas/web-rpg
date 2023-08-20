<template>
    <div class="actions-menu col-12">
        <button class="btn btn-success mb-2" @click="openCraftModal">Craft Item</button>
    </div>
</template>

<script>
export default {
    methods: {
        async openCraftModal() {
            this.$emit('openCrafting');
        },
    }
}
</script>

<style scoped>
.actions-menu {
    margin-top: 100px;
    right: 20px;
}
</style>
