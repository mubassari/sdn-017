<script setup>
import { ref } from "@vue/reactivity"
import { MainLayout } from '~Layouts';

const title = ref("Visi, Misi & Tujuan")
</script>

<template>
  <MainLayout :title="title">
    <div class="flex flex-col items-center justify-center pt-24 bg-white dark:bg-gray-900">
      <h1
        class="my-3 text-3xl font-extrabold leading-none tracking-tight text-center text-gray-900 uppercase dark:text-white md:text-4xl lg:text-5xl">
        {{ title }}
      </h1>
      <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-16 lg:px-6">
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
    </div>
  </MainLayout>
</template>