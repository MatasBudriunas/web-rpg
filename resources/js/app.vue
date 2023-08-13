<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: 'app',
    mounted() {
        console.log("Component mounted:", this.$options.name);
    },
};
</script>

<style>
</style>
