<script setup lang="ts">
import { store } from '../store.ts';
import { onMounted, ref } from 'vue';
import { client } from '../http/client.ts';
import { ws } from '../plugins/echo.ts';
import { toast } from 'vue3-toastify';
import Idea from '../components/Idea.vue';
import { me } from '../api/auth/me.ts';

export interface IIdea {
    id: string,
    title: string,
    author: { id: string, name: string },
    likes: string[],
    published_at: string,
}

type TLikeEvent = {
    post_id: string,
    user_id: string,
    is_liked: boolean,
}

async function load(url: string = 'api/posts/list') {
    if (isListEnd) {
        return;
    }

    store.isLoadingActive = true;
    const { data } = await client.get(url);
    store.isLoadingActive = false;

    if (data.pagination.total === 0) {
        isListEnd = true;
        return;
    }

    posts.value = [
        ...posts.value,
        ...data.posts,
    ];

    if (data.pagination.page === 1) {
        pagination.value = data.pagination;
        return;
    }

    if (!data.pagination.has_more_pages) {
        isListEnd = true;
        return;
    }
    pagination.value.next_url = data.pagination.next_url;
}

function addPaginationListener() {
    if (! endOfList.value) {
        toast.info('Ocorreu um erro, por favor, recarregue a página');
        return;
    }

    const observer = new IntersectionObserver(async ([listEnd]) => {
        if (listEnd.intersectionRatio <= 0) return;

        await load(pagination.value.next_url);
    });

    observer.observe(endOfList.value);
}

function likeEventHandler(event: TLikeEvent) {
    const post = posts.value.find((post) => post.id === event.post_id);

    if (!post) return;

    if (event.is_liked) {
        post.likes.push(event.user_id);
        return;
    }

    post.likes = post.likes.filter(id => id !== event.user_id);
}

function addFeedListeners() {
    ws.channel('feed')
        .listen('LikeEvent', likeEventHandler);
}

onMounted(async () => {
    await load();
    const { user } = await me();
    store.user = user;
    addPaginationListener();
    addFeedListeners();
});

const pagination = ref({
    total: 0,
    page: 1,
    next_url: '',
    has_more_pages: '',
});

const endOfList = ref(null);

let isListEnd = false;

const posts = ref<IIdea[]>([]);
</script>

<template>
    <div class="bg-white h-full dark:bg-zinc-800">
        <main id="list" class="mx-auto w-full pb-10 max-w-[800px] flex flex-col items-center gap-6 px-10 overflow-x-hidden">
            <Idea
                v-for="(post, ranking) in posts"
                :idea="post"
                :ranking="ranking + 1"
                class="self-start"
            />
            <div ref="endOfList" id="loading">{{ isListEnd ? 'End of list' : 'Loading...' }}</div>
        </main>
    </div>
</template>

<style scoped>

</style>
