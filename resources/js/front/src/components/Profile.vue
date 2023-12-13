<script setup lang="ts">
import { ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { logout } from '../api/auth/logout.ts';
import { store } from '../store.ts';

const router = useRouter();
const route = useRoute();

const isProfileDropdownActive = ref(false);

async function handleLogout() {
    await logout();
    store.user = undefined;
    await router.push({ name: 'login' });
}

function handleClick() {
    if (route.name === 'login') return;

    isProfileDropdownActive.value = !isProfileDropdownActive.value
}
</script>

<template>
    <div class="relative">
        <span @click="handleClick()" class="border-[1px] hover:opacity-60 cursor-pointer border-zinc-500 px-2 py-1 rounded-lg"><i class="text-white fa-regular fa-user"></i></span>
        <Transition name="slide-fade">
            <div v-if="isProfileDropdownActive" class="flex flex-col gap-1 items-start pr-10 absolute border-[1px] mt-1 -ml-24 bg-black-700 rounded px-3 py-2 text-white border-zinc-500">
                <button class="text-xs font-semibold -tracking-wide hover:opacity-70">Home</button>
                <button v-if="store.user" @click="handleLogout()" class="mt-3 text-xs text-red-500 font-semibold -tracking-wide hover:opacity-70">Logout</button>
                <RouterLink v-else :to="{ name: 'login' }">
                    <button @click="handleLogout()" class="mt-3 text-xs text-green-500 font-semibold -tracking-wide hover:opacity-70">Log in</button>
                </RouterLink>
            </div>
        </Transition>
    </div>
</template>

<style scoped>
/*
  Enter and leave animations can use different
  durations and timing functions.
*/
.slide-fade-enter-active {
    transition: all 0.2s ease-in;
}

.slide-fade-leave-active {
    transition: all 0.2s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateY(-20px);
    opacity: 0;
}
</style>
