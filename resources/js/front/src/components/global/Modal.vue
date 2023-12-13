<script setup lang="ts">
interface ModalProps {
    opened: boolean,
}

const { opened } = defineProps<ModalProps>();
</script>

<template>
    <Teleport v-if="opened" to="#app">
        <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 shadow-2xl">
            <slot/>
        </div>
    </Teleport>
</template>

<style scoped>

</style>