<script setup>
import { MainLayout } from "~Layouts";
import { ref } from "@vue/reactivity";
import { Carousel, Slide, Navigation } from "vue3-carousel";
import { usePage } from "@inertiajs/vue3";
import "vue3-carousel/dist/carousel.css";

const page = usePage();
const sekolah = page.props.sekolah;

const props = defineProps({ list_kategori: { type: Object, required: true } });

const currentArticleShownId = ref(1);

// Jumbotron
const jumbotronContent = ref([
    {
        judul: "Hello",
        sampul: "https://placehold.co/600x400",
        slug: "hello",
    },
    {
        judul: "Hai",
        sampul: "https://placehold.co/500x400",
        slug: null,
    },
    {
        judul: "Apa Kabar",
        sampul: "https://placehold.co/300x100",
        slug: "apa-kabar",
    },
]);

const sekolahContent = ref([
    {
        uri: "index",
        judul: "Tentang Sekolah",
        icon: "school",
    },
    {
        uri: "sambutan",
        judul: "Sambutan Kepala Sekolah",
        icon: "scroll",
    },
    {
        uri: "visi_misi_tujuan",
        judul: "Visi, Misi & Tujuan",
        icon: "circle-up",
    },
    {
        uri: "gtk",
        judul: "Guru & Tenaga Kependidikan",
        icon: "address-card",
    },
]);
</script>
<template>
    <MainLayout title="Halaman Utama">
        <main>
            <!-- Slide -->
            <Carousel :autoplay="5000" :wrap-around="true" :pauseAutoplayOnHover="true">
                <Slide v-for="jumbotron in jumbotronContent" :key="jumbotron.slug">
                    <section class="bg-fixed bg-gray-700 bg-center bg-no-repeat bg-cover bg-blend-multiply"
                        :style="`background-image: url('${jumbotron.sampul}')`">
                        <div
                            class="px-4 text-center min-h-[100svh] w-screen flex flex-col items-center justify-center hover:backdrop-blur-sm transition ease-out duration-200">
                            <h1
                                class="mb-10 text-4xl font-extrabold leading-none tracking-tight text-white md:text-5xl lg:text-6xl">
                                {{ jumbotron.judul }}
                            </h1>
                            <div class="flex flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                                <a v-if="jumbotron.slug" :href="jumbotron.slug" :key="jumbotron.slug"
                                    class="px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg max-w-fit hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                                    Baca Selengkapnya
                                    <font-awesome-icon icon="arrow-right-long" class="ml-1"></font-awesome-icon>
                                </a>
                                <span v-else class="px-5 py-3 text-base font-medium text-center max-w-fit">
                                    &nbsp;
                                </span>
                            </div>
                        </div>
                    </section>
                </Slide>

                <template #addons>
                    <Navigation />
                </template>
            </Carousel>
            <!-- End Slide -->

            <section class="flex flex-col items-center justify-center py-10 bg-white scroll-my-20 dark:bg-gray-900">
                <div class="max-w-screen-md mx-auto my-8 lg:my-16">
                    <h1
                        class="my-5 text-2xl font-extrabold leading-none tracking-tight text-center text-gray-900 uppercase dark:text-white md:text-3xl lg:text-4xl">
                        Selamat Datang di {{ sekolah.umum.nama }}
                    </h1>
                </div>
                <div class="max-w-screen-xl px-4 py-4 mx-auto md:py-16 lg:px-6">
                    <div class="space-y-4 md:grid xl:grid-cols-4 md:grid-cols-2 sm:gap-3 xl:gap-5 md:space-y-0">
                        <Link v-for="(info, index) in sekolahContent" :key="index" :href="route(info.uri)"
                            class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <font-awesome-icon :icon="info.icon"
                            class="mb-3 text-gray-500 w-7 h-7 dark:text-gray-400"></font-awesome-icon>
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ info.judul }}
                        </h5>
                        </Link>
                    </div>
                </div>
            </section>

            <!-- Artikel -->
            <section class="flex flex-col items-center justify-center py-10 bg-white scroll-my-20 dark:bg-gray-900">
                <h1
                    class="mb-3 text-3xl font-extrabold leading-none tracking-tight text-center text-gray-900 uppercase dark:text-white md:text-4xl lg:text-5xl">
                    Artikel Terbaru
                </h1>
                <div class="flex flex-wrap items-center justify-center pt-10">
                    <button v-for="kategori in list_kategori" :key="kategori.id" type="button"
                        @click="currentArticleShownId = kategori.id"
                        class="rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 border focus:ring-4 focus:outline-none transition ease-out"
                        :class="
                            currentArticleShownId == kategori.id
                                ? 'text-blue-700 hover:text-white border-blue-600 bg-white hover:bg-blue-700 focus:ring-blue-300 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:bg-gray-900 dark:focus:ring-blue-800'
                                : 'text-gray-900 border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-gray-300  dark:text-white dark:focus:ring-gray-800'
                        ">
                        {{ kategori.nama }}
                    </button>
                </div>
                <div class="max-w-screen-xl px-4 py-4 mx-auto md:py-16 lg:px-6">
                    <TransitionGroup tag="div" enter-from-class="opacity-0" enter-active-class="duration-500"
                        leave-active-class="duration-500" leave-to-class="opacity-0"
                        class="space-y-4 md:grid xl:grid-cols-4 md:grid-cols-2 sm:gap-3 xl:gap-5 md:space-y-0">
                        <div v-for="artikel in list_kategori[
                            currentArticleShownId - 1
                        ].artikel" :key="artikel.id"
                            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <img class="object-cover w-full rounded-t-lg aspect-square" :src="artikel.sampul" />
                            <div class="p-5">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ artikel.judul }}
                                </h5>
                                <div class="mt-2.5 mb-5 space-y-1">
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                                        {{ artikel.kategori }}
                                    </span>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ artikel.waktu }}
                                    </p>
                                </div>
                                <Link :href="
                                    route('artikel.tampil', [
                                        list_kategori[
                                            currentArticleShownId - 1
                                        ].slug,
                                        artikel.slug,
                                    ])
                                "
                                    class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Baca Selengkapnya
                                <font-awesome-icon icon="arrow-right-long" class="ml-1"></font-awesome-icon>
                                </Link>
                            </div>
                        </div>
                    </TransitionGroup>
                </div>
                <Link :href="list_kategori[currentArticleShownId - 1].slug" v-if="
                    list_kategori[currentArticleShownId - 1].artikel
                        .length !== 0
                "
                    class="py-2.5 px-5 m-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 uppercase text-center">
                Lihat Lebih Banyak
                </Link>
                <span v-else class="text-3xl italic font-extrabold text-gray-400 uppercase dark:text-gray-700">
                    Tidak Ada Artikel
                </span>
            </section>
            <!-- End Artikel -->
        </main>
        <div
            class="w-10 h-10 m-0 text-gray-900 bg-white hover:text-blue-700 dark:hover:text-blue-500 md:w-16 md:h-16 dark:bg-gray-900 dark:text-white">
        </div>
    </MainLayout>
</template>

<style lang="scss">
.carousel__prev {
    @apply rounded-r-md;
}

.carousel__next {
    @apply rounded-l-md;
}

.carousel__prev,
.carousel__next {
    @apply w-10 h-10 m-0 text-gray-900 bg-white hover:text-blue-700 dark:hover:text-blue-500 md:w-16 md:h-16 dark:bg-gray-900 dark:text-white;
}
</style>
