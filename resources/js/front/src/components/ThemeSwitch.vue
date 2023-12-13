<script setup lang="ts">
import { onMounted, ref } from 'vue';

const isDarkTheme = ref(false);

onMounted(() => {
    isDarkTheme.value = document.documentElement.classList.contains('dark');
});

const toogleDarkMode = () => {
    document.documentElement.classList.toggle('dark');
    isDarkTheme.value = !isDarkTheme.value;
}

</script>

<template>
    <div @click="toogleDarkMode()" class="absolute text-3xl cursor-pointer top-10 right-10">
        <i class="dark-icon fa-regular fa-sun text-white"/>
        <i class="light-icon fa-solid fa-moon text-black"/>
    </div>
</template>
