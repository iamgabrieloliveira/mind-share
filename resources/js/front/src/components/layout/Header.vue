<script setup lang="ts">
import Profile from '../Profile.vue';
</script>

<template>
    <header class="px-10 w-full flex items-center justify-between bg-black-700 gap-5 py-3">
        <RouterLink class="text-white text-sm hover:underline font-semibold tracking-wide" :to="{ name: 'feed' }">Explore</RouterLink>
<!--        <input class="rounded outline-none text-xs bg-zinc-600 text-white font-semibold px-2 py-1" type="text">-->
        <Profile/>
    </header>
</template>

<style scoped>

</style>