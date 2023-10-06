<script setup>
import { MainLayout } from '~Layouts';
import { ref, onMounted, onUnmounted } from 'vue'

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

const currentJumbotron = ref(0);
const intervalJumbotron = ref(null);

const loopJumbotron = () => {
    clearInterval(intervalJumbotron.value)
    intervalJumbotron.value = setInterval(() => {
        if (currentJumbotron.value != jumbotronContent.value.length - 1) {
            currentJumbotron.value = currentJumbotron.value + 1
        } else {
            currentJumbotron.value = 0
        }
    }, 5000);
}

const unloopJumbotron = () => clearInterval(intervalJumbotron.value)
// End Jumbotron


onMounted(() => loopJumbotron());
onUnmounted(() => unloopJumbotron());

</script>
<template>
    <MainLayout title="Halaman Utama">
        <main>
            <!-- Slide -->
            <Transition enter-from-class="-translate-y-full scale-x-50 opacity-0" enter-active-class="duration-500"
                leave-active-class="duration-500" leave-to-class="-translate-y-full scale-x-50 opacity-0" mode="out-in">
                <section :key="currentJumbotron" @mouseenter="unloopJumbotron" @mouseleave="loopJumbotron"
                    class="bg-fixed bg-cover bg-center bg-no-repeat bg-gray-700 bg-blend-multiply"
                    :style="`background-image: url('${jumbotronContent[currentJumbotron].sampul}')`">
                    <div
                        class="px-4 text-center py-24 lg:py-[15rem] hover:backdrop-blur-sm transition ease-out duration-200">
                        <h1
                            class="mb-10 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                            {{ jumbotronContent[currentJumbotron].judul }}
                        </h1>
                        <div class="flex space-y-4 flex-row justify-center sm:space-y-0 sm:space-x-4">
                            <a :href="jumbotronContent[currentJumbotron].slug"
                                v-if="jumbotronContent[currentJumbotron].slug" :key="currentJumbotron"
                                class="max-w-fit py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                                Baca Selengkapnya
                                <font-awesome-icon icon="arrow-right-long" class="ml-1"></font-awesome-icon>
                            </a>
                            <span v-else class="max-w-fit py-3 px-5 text-base font-medium text-center">
                                &nbsp;
                            </span>
                        </div>
                    </div>
                </section>
            </Transition>
            <!-- End Slide -->

            <!-- Sambutan -->
            <section class="scroll-my-20 py-4 bg-white dark:bg-gray-900">
                <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
                    <figure class="max-w-screen-md mx-auto">
                        <div class="flex flex-col items-center justify-center mb-6">
                            <img class="w-40 h-40 mb-3 rounded-full"
                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gouch.png"
                                alt="profile picture">
                            <div class="font-medium text-gray-900 dark:text-white">Micheal Gough</div>
                            <div class="text-sm font-light text-gray-500 dark:text-gray-400">CEO at Google</div>
                        </div>
                        <blockquote>
                            <p class="text-2xl font-medium text-gray-900 dark:text-white">"Flowbite is just awesome. It
                                contains
                                tons of predesigned components and pages starting from login screen to complex dashboard.
                                Perfect choice for your next SaaS application...</p>
                        </blockquote>
                        <figcaption class="flex flex-col items-center justify-center mt-6">
                            <a href="#" class="mb-3 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                Baca sambutan lengkap
                                <font-awesome-icon icon="arrow-right-long" class="ml-1"></font-awesome-icon>
                            </a>

                        </figcaption>
                    </figure>
                </div>
            </section>
            <!-- End Sambutan -->

            <!-- Visi-Misi-Tujuan -->
            <section class="scroll-my-20 py-4 bg-white dark:bg-gray-900">
                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                    <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
                        <div
                            class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                            <h3 class="text-3xl font-extrabold uppercase">Visi</h3>
                            <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">
                            <!-- List -->
                            <ul role="list" class="mb-8 text-center divide-y-2 divide-gray-100 dark:divide-gray-700">
                                <li class="flex items-center py-4">
                                    <span>“Terwujudnya Peserta Didik Yang Beriman, Cerdas, Terampil, Mandiri Dan Berwawasan
                                        Lingkungan”</span>
                                </li>
                            </ul>
                        </div>
                        <div
                            class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                            <h3 class="text-3xl font-extrabold uppercase">Misi</h3>
                            <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">
                            <!-- List -->
                            <ul role="list" class="mb-8 text-center divide-y-2 divide-gray-100 dark:divide-gray-700">
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
                            class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                            <h3 class="text-3xl font-extrabold uppercase">Tujuan</h3>
                            <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">
                            <!-- List -->
                            <ul role="list" class="mb-8 text-center divide-y-2 divide-gray-100 dark:divide-gray-700">
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

            <!-- Artikel -->
            <section class="scroll-my-20 py-10 bg-white dark:bg-gray-900 flex flex-col items-center justify-center ">
                <h1
                    class="mb-3 text-3xl font-extrabold tracking-tight leading-none text-gray-900 dark:text-white text-center uppercase md:text-4xl lg:text-5xl">
                    Artikel Terbaru
                </h1>
                <div class="flex items-center justify-center pt-10 flex-wrap">
                    <button type="button"
                        class="text-blue-700 hover:text-white border border-blue-600 bg-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:bg-gray-900 dark:focus:ring-blue-800">All
                        categories</button>
                    <button type="button"
                        class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:text-white dark:focus:ring-gray-800">Shoes</button>
                    <button type="button"
                        class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:text-white dark:focus:ring-gray-800">Bags</button>
                    <button type="button"
                        class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:text-white dark:focus:ring-gray-800">Electronics</button>
                    <button type="button"
                        class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:text-white dark:focus:ring-gray-800">Gaming</button>
                </div>
                <div class="py-4 px-4 mx-auto max-w-screen-xl md:py-16 lg:px-6">
                    <div class="space-y-4 md:grid xl:grid-cols-4 md:grid-cols-2 sm:gap-3 xl:gap-5 lg:space-y-0">
                        <div
                            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="rounded-t-lg"
                                    src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gouch.png" />
                            </a>
                            <div class="p-5">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    Noteworthy technology acquisitions 2021
                                </h5>
                                <div class="mt-2.5 mb-5 divide-x-2 divide-gray-500 dark:divide-gray-700">
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-semibold mr-3 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                                        Artikel
                                    </span>
                                    <span class="pl-3 text-sm text-gray-500 dark:text-gray-400">
                                        Senin, 01 November 2023
                                    </span>
                                </div>
                                <a href="#"
                                    class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Read more
                                    <font-awesome-icon icon="arrow-right-long" class="ml-1"></font-awesome-icon>
                                </a>
                            </div>
                        </div>
                        <div
                            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="rounded-t-lg"
                                    src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gouch.png" />
                            </a>
                            <div class="p-5">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    Noteworthy technology acquisitions 2021
                                </h5>
                                <div class="mt-2.5 mb-5 divide-x-2 divide-gray-500 dark:divide-gray-700">
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-semibold mr-3 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                                        Artikel
                                    </span>
                                    <span class="pl-3 text-sm text-gray-500 dark:text-gray-400">
                                        Senin, 01 November 2023
                                    </span>
                                </div>
                                <a href="#"
                                    class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Read more
                                    <font-awesome-icon icon="arrow-right-long" class="ml-1"></font-awesome-icon>
                                </a>
                            </div>
                        </div>
                        <div
                            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="rounded-t-lg"
                                    src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gouch.png" />
                            </a>
                            <div class="p-5">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    Noteworthy technology acquisitions 2021
                                </h5>
                                <div class="mt-2.5 mb-5 divide-x-2 divide-gray-500 dark:divide-gray-700">
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-semibold mr-3 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                                        Artikel
                                    </span>
                                    <span class="pl-3 text-sm text-gray-500 dark:text-gray-400">
                                        Senin, 01 November 2023
                                    </span>
                                </div>
                                <a href="#"
                                    class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Read more
                                    <font-awesome-icon icon="arrow-right-long" class="ml-1"></font-awesome-icon>
                                </a>
                            </div>
                        </div>
                        <div
                            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="rounded-t-lg"
                                    src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gouch.png" />
                            </a>
                            <div class="p-5">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    Noteworthy technology acquisitions 2021
                                </h5>
                                <div class="mt-2.5 mb-5 divide-x-2 divide-gray-500 dark:divide-gray-700">
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-semibold mr-3 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                                        Artikel
                                    </span>
                                    <span class="pl-3 text-sm text-gray-500 dark:text-gray-400">
                                        Senin, 01 November 2023
                                    </span>
                                </div>
                                <a href="#"
                                    class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Read more
                                    <font-awesome-icon icon="arrow-right-long" class="ml-1"></font-awesome-icon>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href=""
                    class="py-2.5 px-5 m-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 uppercase text-center">
                    Lihat Lebih Banyak
                </a>
            </section>
            <!-- End Artikel -->

        </main>
    </MainLayout></template>