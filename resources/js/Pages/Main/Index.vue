<script setup>
import { MainLayout } from '~Layouts';
import { ref } from '@vue/reactivity'
import { Carousel, Slide, Navigation } from 'vue3-carousel'
import { usePage } from '@inertiajs/vue3'
import 'vue3-carousel/dist/carousel.css'

const page = usePage()
const sekolah = page.props.sekolah

const props = defineProps({ 'list_kategori': { type: Object, required: true } })

const currentArticleShownId = ref(1);

// Jumbotron
const jumbotronContent = ref([
    {
        judul: 'Hello',
        sampul: 'https://placehold.co/600x400',
        slug: 'hello'
    },
    {
        judul: 'Hai',
        sampul: 'https://placehold.co/500x400',
        slug: null
    },
    {
        judul: 'Apa Kabar',
        sampul: 'https://placehold.co/300x100',
        slug: 'apa-kabar'
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

            <!-- Visi-Misi-Tujuan -->
            <section class="py-4 bg-white scroll-my-20 dark:bg-gray-900">
                <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-16 lg:px-6">
                    <figure class="max-w-screen-md mx-auto my-10">
                        <div class="flex flex-col items-center justify-center mb-6">
                            <img class="w-40 h-40 mb-3 rounded-full"
                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gouch.png"
                                alt="profile picture">
                            <div class="text-lg font-medium text-gray-900 dark:text-white">
                                Micheal Gough
                            </div>
                            <div class="text-base font-light text-gray-500 dark:text-gray-400">
                                Kepala Sekolah {{ sekolah.umum.nama }}
                            </div>
                        </div>
                        <figcaption class="flex flex-col items-center justify-center mt-6">
                            <a href="#" class="mb-3 text-base font-bold text-blue-600 dark:text-blue-500 hover:underline">
                                Baca sambutan
                                <font-awesome-icon icon="arrow-right-long" class="ml-1"></font-awesome-icon>
                            </a>
                        </figcaption>
                    </figure>
                    <div class="gap-6 space-y-8 lg:grid lg:grid-cols-3 lg:space-y-0">
                        <div
                            class="flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                            <h3 class="text-3xl font-extrabold uppercase">Visi</h3>
                            <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">
                            <!-- List -->
                            <ul role="list" class="mb-8 text-left divide-y-2 divide-gray-100 dark:divide-gray-700">
                                <li class="flex items-center py-4">
                                    <span>“Terwujudnya Peserta Didik Yang Beriman, Cerdas, Terampil, Mandiri Dan
                                        Berwawasan
                                        Lingkungan”</span>
                                </li>
                            </ul>
                        </div>
                        <div
                            class="flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                            <h3 class="text-3xl font-extrabold uppercase">Misi</h3>
                            <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">
                            <!-- List -->
                            <ul role="list" class="mb-8 text-left divide-y-2 divide-gray-100 dark:divide-gray-700">
                                <li class="flex items-center py-4">
                                    <span>
                                        Menanamkan Keimanan dan Ketaqwaan melalui pengalaman ajaran Agama
                                    </span>
                                </li>
                                <li class="flex items-center py-4">
                                    <span>
                                        Mengoptimalkan Proses Pembelajaran dan Bimbingan
                                    </span>
                                </li>
                                <li class="flex items-center py-4">
                                    <span>
                                        Mengembangkan bidang Ilmu Pengetahuan dan Teknologi berdasarkan minat, bakat dan
                                        potensi peserta didik
                                    </span>
                                </li>
                                <li class="flex items-center py-4">
                                    <span>
                                        Membina kemandirian peserta didik melalui kegiatan pembiasaan, kewirausahaan dan
                                        pengembangan diri yang terencana dan berkesinambungan
                                    </span>
                                </li>
                                <li class="flex items-center py-4">
                                    <span>
                                        Meningkatkan kesadaran untuk memelihara lingkungan
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div
                            class="flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                            <h3 class="text-3xl font-extrabold uppercase">Tujuan</h3>
                            <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">
                            <!-- List -->
                            <ul role="list" class="mb-8 text-left divide-y-2 divide-gray-100 dark:divide-gray-700">
                                <li class="flex items-center py-4">
                                    <span>
                                        Mengembangkan budaya sekolah yang religius melalui kegiatan keagamaan
                                    </span>
                                </li>
                                <li class="flex items-center py-4">
                                    <span>
                                        Semua kelas melaksanakan pendekatan pembelajaran aktif pada semua mata pelajaran
                                    </span>
                                </li>
                                <li class="flex items-center py-4">
                                    <span>
                                        Mengembangkan bidang Ilmu Pengetahuan dan Teknologi berdasarkan minat, bakat dan
                                        potensi peserta didik
                                    </span>
                                </li>
                                <li class="flex items-center py-4">
                                    <span>
                                        Membina kemandirian peserta didik melalui kegiatan pembiasaan, kewirausahaan dan
                                        pengembangan diri yang terencana dan berkesinambungan
                                    </span>
                                </li>
                                <li class="flex items-center py-4">
                                    <span>
                                        Menyelenggarakan berbagai kegiatan sosial yang menjadi bagian dari pendidikan
                                        karakter bangsa
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Visi Misi Tujuan -->

            <section class="py-10 bg-white scroll-my-20 dark:bg-gray-900">
                <div class="max-w-screen-md mx-auto mb-8 lg:mb-16">
                    <h1 class="mb-5 text-3xl font-extrabold leading-none tracking-tight text-center text-gray-900 uppercase dark:text-white md:text-4xl lg:text-5xl">
                        Guru & Tenaga Kependidikan
                    </h1>        
                </div>
                <div class="max-w-screen-xl px-4 py-4 mx-auto md:py-16 lg:px-6">
                    <div class="space-y-4 md:grid xl:grid-cols-4 md:grid-cols-2 sm:gap-3 xl:gap-5 md:space-y-0">
                        <a href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <font-awesome-icon icon="times" class="mb-3 text-gray-500 w-7 h-7 dark:text-gray-400"></font-awesome-icon>
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                               Tentang sekolah
                            </h5>
                        </a>
                        <a href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <font-awesome-icon icon="times" class="mb-3 text-gray-500 w-7 h-7 dark:text-gray-400"></font-awesome-icon>
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                Sambutan Kepala Sekolah
                            </h5>
                        </a>
                        <a href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <font-awesome-icon icon="times" class="mb-3 text-gray-500 w-7 h-7 dark:text-gray-400"></font-awesome-icon>
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                Visi-Misi-Tujuan
                            </h5>
                        </a>
                        <a href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <font-awesome-icon icon="times" class="mb-3 text-gray-500 w-7 h-7 dark:text-gray-400"></font-awesome-icon>
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                Guru & Tenaga Kependidikan
                            </h5>
                        </a>
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
                        :class="currentArticleShownId == kategori.id ? 'text-blue-700 hover:text-white border-blue-600 bg-white hover:bg-blue-700 focus:ring-blue-300 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:bg-gray-900 dark:focus:ring-blue-800' : 'text-gray-900 border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-gray-300  dark:text-white dark:focus:ring-gray-800'">
                        {{ kategori.nama }}
                    </button>
                </div>
                <div class="max-w-screen-xl px-4 py-4 mx-auto md:py-16 lg:px-6">
                    <TransitionGroup tag="div" enter-from-class="opacity-0" enter-active-class="duration-500"
                        leave-active-class="duration-500" leave-to-class="opacity-0"
                        class="space-y-4 md:grid xl:grid-cols-4 md:grid-cols-2 sm:gap-3 xl:gap-5 md:space-y-0">
                        <div v-for="artikel in list_kategori[currentArticleShownId - 1].artikel" :key="artikel.id"
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
                                <Link
                                    :href="route('artikel.tampil', [list_kategori[currentArticleShownId - 1].slug, artikel.slug])"
                                    class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Baca Selengkapnya
                                <font-awesome-icon icon="arrow-right-long" class="ml-1"></font-awesome-icon>
                                </Link>
                            </div>
                        </div>
                    </TransitionGroup>
                </div>
                <Link :href="list_kategori[currentArticleShownId - 1].slug"
                    v-if="list_kategori[currentArticleShownId - 1].artikel.length !== 0"
                    class="py-2.5 px-5 m-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 uppercase text-center">
                Lihat Lebih Banyak
                </Link>
                <span v-else class="text-3xl italic font-extrabold text-gray-400 uppercase dark:text-gray-700">
                    Tidak Ada Artikel
                </span>
            </section>
            <!-- End Artikel -->
        </main>
    </MainLayout>
</template>

<style lang="scss">
.carousel__prev,
.carousel__next {
    @apply text-white hover:text-blue-700;
}
</style>