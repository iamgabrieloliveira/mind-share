<script setup lang="ts">
import { store } from '../store.ts';
import CreatorPostInfo from './CreatorPostInfo.vue';
import LikesPostInfo from './LikesPostInfo.vue';
import CreateAtIdeaInfo from './CreateAtIdeaInfo.vue';
import { IIdea } from '../pages/Feed.vue';

interface IIdeaProps {
    idea: IIdea,
    ranking: number,
}

const { idea } = defineProps<IIdeaProps>();
</script>

<template>
    <div>
        <RouterLink :to="{ name: 'idea', params: { id: idea.id } }">
            <h1 class="text-md whitespace-nowrap mb-1 hover:underline cursor-pointer">{{ ranking + '.' }} {{ idea.title }}</h1>
        </RouterLink>
        <p class="text-xs text-gray-600 flex gap-2">
            <CreatorPostInfo :name="idea.author.name"/>
            -
            <LikesPostInfo
                class="cursor-pointer"
                :class="{ 'opacity-50': !store.user }"
                :title="!store.user ? 'Your must be authenticated to perform votes' : null"
                @click="async () => {
                    if (!store.user) return;

                    // const { id } = store.user;

                    // idea.toggleUserLike(id);
                    // await persistLike(idea, id);
                }"
                :liked="store.user ? idea.likes.includes(store.user.id) : false"
                :total="idea.likes.length"
            />
            -
            <CreateAtIdeaInfo :created-at="idea.published_at"/>
            - {{ idea.published_at }}
        </p>
    </div>
</template>

<style scoped>

</style>
