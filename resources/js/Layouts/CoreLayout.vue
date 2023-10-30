<script setup>
import { Head, usePage } from "@inertiajs/vue3";

const page = usePage();
const sekolah = page.props.sekolah;

defineProps({title: { type: String, default: '' } })
</script>

<template>
    <Head :title="title">
    <link rel="shortcut icon" :href="sekolah.ikon" type="image/x-icon">
    </Head>
    <slot />
</template>
