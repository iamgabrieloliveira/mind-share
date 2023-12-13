<script setup lang="ts">
interface ILikesPostInfoProps {
    total: number,
    liked: boolean,
}
const props = defineProps<ILikesPostInfoProps>();
</script>

<template>
    <span class="flex gap-1"><i :class="[liked ? 'fa-solid' : 'fa-regular']" class="mt-[1px] fa-thumbs-up"></i> {{ props.total }}</span>
</template>

<style scoped>

</style>