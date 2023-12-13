<script setup lang="ts">
</script>

<template>
    <RouterLink :to="{ name: 'create-idea' }">
        <div class="hover:-translate-y-1 hover:opacity-95 shadow-xl shadow-black/10 transition-transform flex items-center justify-center fixed h-14 w-14 rounded-full bg-black-700 bottom-10 right-10 cursor-pointer">
            <i class="fa-solid fa-feather text-white text-xl"/>
        </div>
    </RouterLink>
</template>

<style scoped>
</style>