<script setup lang="ts">
import { toast } from 'vue3-toastify';
import { store } from '../store.ts';
import { client } from '../http/client.ts';
import { ref } from 'vue';
import { router } from '../router';

const form = ref({ title: '', content: '' });

async function save() {
    if (! form.value.title) {
        toast.error('The filed title is required');
        return;
    }

    if (! form.value.content) {
        toast.error('The filed title is required');
        return;
    }

    store.isLoadingActive = true;
    await client.post('api/ideas/create', form.value);
    store.isLoadingActive = false;

    toast.success('Idea created sucessfully');
    setTimeout(() => router.push({ name: 'feed' }), 200);
}
</script>

<template>
    <div class="mx-auto w-full pb-10 max-w-[1000px] flex flex-col items-center gap-6 px-10">
        <h1 class="text-4xl self-start font-bold">Publish your idea</h1>
        <div class="w-full flex flex-col gap-3">
            <input v-model="form.title" type="text" placeholder="Title" class="focus:border-2 outline-none focus:border-black-700/50 w-full border-2 text-sm px-2 py-1 rounded">
            <MarkdownEditor
                :preview="false"
                language="en-US"
                :toolbars-exclude="['save']"
                v-model="form.content"
            />
        </div>
        <div class="self-end">
            <RouterLink :to="{ name: 'feed' }">
                <span class="cursor-pointer rounded text-black font-weight-[500] font-bold text-black/70 text-sm hover:text-black/50 transition-colors px-6 py-1.5 pt-3">Cancel</span>
            </RouterLink>
            <button @click="save()" class="rounded-md bg-positive-green hover:bg-positive-green-900 text-white font-weight-[500] font-bold text-sm px-6 py-1.5 pt-2">Publish</button>
        </div>
    </div>
</template>

<style scoped>

</style>
