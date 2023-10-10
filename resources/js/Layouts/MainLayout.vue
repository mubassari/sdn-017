<script setup>
import { MainNavbar, MainFooter, Toast } from "~Components/layouts"
import { Head } from "@inertiajs/vue3";
defineProps({ title: { type: String, default: '' } })
</script>

<template>
    <Head :title="title" />
    <Toast />
    <MainNavbar />
    <slot />
    <MainFooter />
</template>
