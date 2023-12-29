<script setup>
import { Head, usePage } from "@inertiajs/vue3";

const page = usePage();
const sekolah = page.props.sekolah;

defineProps({ title: { type: String, default: '' } })
</script>

<template>
    <Head :title="title">
        <link rel="shortcut icon" :href="sekolah.umum.ikon" type="image/x-icon">
        <slot name="head" />
    </Head>
    <slot />
</template>
