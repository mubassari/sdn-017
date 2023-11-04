<script setup>
import { MainNavbar, MainFooter, Toast } from "~Components/layouts"
import CoreLayout from './CoreLayout.vue'

defineProps({ title: { type: String, default: '' } })
</script>

<template>
    <CoreLayout :title="title">
        <Toast />
        <MainNavbar />
        <slot />
        <MainFooter />
    </CoreLayout>
</template>
