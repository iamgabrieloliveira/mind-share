<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { client } from '../http/client.ts';
import { store } from '../store.ts';
import Button from '../components/global/Button.vue';
import { toast } from 'vue3-toastify';

type TIdea = {
    id: string,
    title: string,
    content: string,
}

const router = useRouter();
const route = useRoute();

const isAnswerInputOpen = ref(false);
const answerContent = ref('');

const idea = ref<TIdea|null>(null);

onMounted(async () => {
   const id = route.params.id;

   if (!id) throw new Error('Not found');

   store.isLoadingActive = true;
   const response = await client.get(`api/posts/idea/${id}`) as { data: { idea: TIdea } };
   idea.value = response.data.idea;
   store.isLoadingActive = false;
});

async function saveComment() {
    if (!answerContent.value) {
        return toast.error('The content field is required');
    }

    store.isLoadingActive = true;
    await client.post('api/comments', {
        content: answerContent.value,
        post_id: router.currentRoute.value.params.id,
    });
    store.isLoadingActive = false;
}

</script>

<template>
    <div class="mx-auto w-full pb-24 max-w-[900px] flex flex-col items-center gap-6 px-10">
        <RouterLink class="self-start" :to="{ name: 'feed' }"><p class="px-5 text-black/40 hover:underline cursor-pointer">Back</p></RouterLink>
        <div v-if="idea" class="self-start">
            <div class="px-5  mb-5">
                <h1 class="text-2xl font-semibold" v-text="idea.title"/>
            </div>
            <MarkdownPreview class="p-0" editorId="preview-editor" :modelValue="idea.content"/>
        </div>
        <div class="w-full border-2 border-black-700/20 rounded-lg p-7">
            <button v-if="!isAnswerInputOpen" @click="isAnswerInputOpen = true" style="background-color: rgb(246, 248, 250);" class="border-2 focus:outline-none border-black-700/20 px-2 rounded py-1 text-sm">Answer</button>
            <div v-else class="flex flex-col items-center">
                <MarkdownEditor class="mb-5" :preview="false" language="en-US" :toolbars-exclude="['save', 'code']" v-model="answerContent"/>
                <div class="self-end">
                    <span @click="isAnswerInputOpen = false" class="cursor-pointer rounded text-black font-weight-[500] font-bold text-black/70 text-sm hover:text-black/50 transition-colors px-6 py-1.5 pt-3">Cancel</span>
                    <button @click="saveComment()" class="rounded-md bg-positive-green hover:bg-positive-green-900 text-white font-weight-[500] font-bold text-sm px-6 py-1.5 pt-2">Publish</button>
                </div>
            </div>
        </div>
<!--        <div class="self-start" v-if="idea" v-for="comment in idea.getComments()">-->
<!--        </div>-->
    </div>
</template>

<style>
</style>
