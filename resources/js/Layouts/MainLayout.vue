<script setup>
import { MainNavbar, MainFooter } from "~Components/layouts"
import { Head } from "@inertiajs/vue3";
defineProps({ title: { type: String, default: '' } })
</script>

<template>
    <Head :title="title" />
    <MainNavbar />
    <slot />
    <MainFooter />
</template>
