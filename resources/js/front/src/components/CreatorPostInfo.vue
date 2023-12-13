<script setup lang="ts">
interface ICreatorPostInfoProps {
    name: string,
}
const props = defineProps<ICreatorPostInfoProps>();
</script>

<template>
    <span class="flex gap-1 text-xs"><i class="fa-regular fa-user mt-[2px]"/><span class="hover:underline cursor-pointer">{{ props.name }}</span></span>
</template>

<style scoped>

</style>