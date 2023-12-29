<script setup>
import { MainNavbar, MainFooter, Toast } from "~Components/layouts"
import CoreLayout from './CoreLayout.vue'
import { usePage } from "@inertiajs/vue3";
import { ref } from '@vue/reactivity'

const page = usePage();
const url = window.location.href;
const host = window.location.host;
const origin = window.location.origin;
const pathname = window.location.pathname;
const sekolah = page.props.sekolah;

const props = defineProps({
    title: { type: String, default: '' },
    type: { type: String, default: 'website' },
    image: { type: String, default: null },
    description: { type: String, default: null },
    keywords: { type: String, default: '' },
    index: { type: Boolean, default: true },
})

const description = ref(props.description ?? sekolah.umum.nama + ' merupakan sekolah yang beralamat di ' + sekolah.umum.alamat)
const image = ref(props.image ? (props.image.startsWith('http') ? '' : origin) + props.image : origin + '/gambar/default-sekolah.png')
const image_h = ref(0)
const image_w = ref(0)

function getMeta(url, callback) {
    const img = new Image();
    img.src = url;
    img.onload = function () { callback(this.width, this.height); }
}
getMeta(
    image.value,
    function (width, height) { image_h.value = height; image_w.value = width }
);
</script>

<template>
    <CoreLayout :title="title">
        <template #head>
            <meta name="description" :content="description" />
            <meta name="keywords" :content="'sekolah,school' + (keywords ? ',' + keywords : '')">
            <meta property="og:locale" content="id_ID">
            <meta property="og:type" :content="type">
            <meta property="og:title" :content="title">
            <meta property="og:description" :content="description">
            <meta property="og:url" :content="url">
            <meta property="og:site_name" :content="host">
            <meta property="og:image" :content="image">
            <meta property="og:image:width" :content="image_w">
            <meta property="og:image:height" :content="image_h">
            <meta name="twitter:card" content="summary">
            <meta name="twitter:description" :content="description">
            <meta name="twitter:title" :content="title">
            <meta name="twitter:image" :content="image">
            <link rel="canonical" :href="origin + pathname">
            <meta name="robots" content="index, follow" v-if="index">
            <meta name="robots" content="noindex, nofollow" v-else>
            <slot name="head" />
        </template>
        <Toast />
        <MainNavbar />
        <slot />
        <MainFooter />
    </CoreLayout>
</template>
