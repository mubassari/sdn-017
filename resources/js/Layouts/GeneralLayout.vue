<script setup>
import { Head } from "@inertiajs/vue3";
defineProps({ title: { type: String, default: '' } })
</script>

<template>
    <Head :title="title" />
    <slot />
</template>
