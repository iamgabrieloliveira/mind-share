<script setup lang="ts">

import Button from '../components/global/Button.vue';
// import Input from '../components/global/Input.vue';
import { router } from '../router';
import { ref } from 'vue';
import { store } from "../store.ts";
import { login } from '../api/auth/login.ts';
import { showLoadingWhile } from '../utils.ts';

type TForm = {
    email: string,
    password: string,
}

const form = ref<TForm>({ email: '', password: '' });

const handleSubmit = () => {
    showLoadingWhile(
        login(form.value)
            .then(({ user }) => {
                store.user = user;

                router.push({ name: 'feed' });
            })
    );
}
</script>

<template>
     <main class="w-full bg-white pb-[160px] transition-colors dark:bg-zinc-900 h-full text-white flex flex-col items-center justify-center">

        <div class="w-full max-w-md">
            <h1 class="text-5xl text-zinc-900 dark:text-zinc-100 font-bold self-start tracking-tight">Hello</h1>

            <hr class="border-zinc-400 w-full mb-12 my-4">

            <div class="w-full flex flex-col items-center gap-8">
                <input v-model="form.email" placeholder="Email" type="text" id="email" name="email"/>
                <input v-model="form.password" name="password" placeholder="Password" type="password" id="password"/>
                <div class="flex flex-col self-start gap-5">
                    <Button @click="handleSubmit">Log in</Button>
                    <RouterLink class="dark:text-blue-500 text-blue-800" :to="{ name: 'register'} ">Don't have account?</RouterLink>
                </div>
            </div>

        </div>

    </main>
</template>
