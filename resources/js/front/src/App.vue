<script setup lang="ts">
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
import { store } from './store.ts';
import Header from './components/layout/Header.vue';
import NewIdeaButton from './components/NewIdeaButton.vue';
import { router} from './router';
</script>

<template>
<!--    <ThemeSwitch/>-->
    <Header class="mb-8"/>
    <Loading :active="store.isLoadingActive" loader="dots"/>
    <Transition name="slide-fade">
        <NewIdeaButton v-if="store.user && router.currentRoute.value.name !== 'create-idea'"/>
    </Transition>
    <router-view/>
</template>

<style scoped>
.slide-fade-enter-active {
    transition: all 0.15s ease-in;
}

.slide-fade-leave-active {
    transition: all 0.15s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    opacity: 0;
}
</style>
