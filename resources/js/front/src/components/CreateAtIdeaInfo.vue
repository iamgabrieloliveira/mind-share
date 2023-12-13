<script setup lang="ts">
interface ICreatedAtIdeaInfoProps {
    createdAt: string,
}

const { createdAt } = defineProps<ICreatedAtIdeaInfoProps>();
</script>

<template>
    <span class="flex gap-1"><i class="fa-regular fa-calendar mt-[1px]"></i> {{ createdAt }}</span>
</template>

<style scoped>

</style>