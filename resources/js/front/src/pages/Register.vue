<script setup lang="ts">
import Button from '../components/global/Button.vue';
// import Input from '../components/global/Input.vue';
import { ref } from 'vue';
import { store } from '../store.ts';
import { register } from '../api/auth/register.ts';
import { router } from '../router';

type TForm = {
    name: string,
    email: string,
    password: string,
    password_confirmation: string,
}

const form = ref<TForm>({
    email: '',
    name: '',
    password: '',
    password_confirmation: ''
})

const handleSubmit = async () => {
    store.isLoadingActive = true;
    await register(form.value);
    store.isLoadingActive = false;
    router.push({ name: 'feed' });
}

</script>

<template>
    <main class="px-10 py-5 w-full pb-[160px] bg-white dark:bg-zinc-900 h-full text-white flex flex-col items-center justify-center">
        <div class="w-full max-w-md">
            <h1 class="text-5xl text-zinc-900 dark:text-zinc-100 font-bold self-start tracking-tight">Welcome!</h1>
            <hr class="border-zinc-400 w-full mb-12 my-4">
            <div class="w-full flex flex-col items-center gap-8">
                <input name="name" v-model="form.name" placeholder="Name" type="text" id="name"/>
                <input name="email" v-model="form.email" placeholder="Email" type="email" id="email"/>
                <input name="password" v-model="form.password" placeholder="Password" type="password" id="password"/>
                <input name="password_confirmation" v-model="form.password_confirmation" placeholder="Repeat your password" type="password" id="password_confirmation"/>
                <div class="flex flex-col self-start gap-5">
                    <Button @click="handleSubmit">Submit</Button>
                    <RouterLink class="dark:text-blue-500 text-blue-800" :to="{ name: 'login'} ">Already have account?</RouterLink>
                </div>
            </div>
        </div>
    </main>
</template>
