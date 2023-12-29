<script setup>
import { MainLayout } from '~Layouts';

const props = defineProps({
  'artikel': { type: Object, required: true },
  'artikel_terkait': { type: Object, required: true }
})

var tempElement = document.createElement('div');
tempElement.innerHTML = props.artikel.isi;

// Get all <p> elements inside the temporary element
var paragraphs = tempElement.getElementsByTagName('p');
var description = '';
// Check if there is at least one <p> element
if (paragraphs.length > 0) {
  // Get the content of the first <p> tag
  description = paragraphs[0].textContent;
}
</script>

<template>
  <MainLayout :title="artikel.judul" type="article" :description="description" :image="artikel.sampul">

    <main class="py-24 antialiased bg-white dark:bg-gray-900">
      <div class="flex justify-between max-w-screen-xl px-4 mx-auto ">
        <article
          class="w-full max-w-2xl mx-auto format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
          <header class="mb-4 lg:mb-6 not-format ">
            <h1
              class="mb-4 text-5xl font-extrabold leading-tight text-center text-gray-900 lg:mb-6 lg:text-6xl dark:text-white">
              {{ artikel.judul }}
            </h1>
            <div class="flex justify-center my-5 divide-x-2 divide-gray-500 dark:divide-gray-700">
              <Link :href="route('artikel.index', artikel.kategori_slug)"
                class="bg-blue-100 text-blue-800 text-xs font-semibold mr-3 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
              {{ artikel.kategori }}
              </Link>
              <span class="pl-3 text-sm text-gray-500 dark:text-gray-400">
                {{ artikel.waktu }}
              </span>
            </div>
          </header>
          <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
          <div v-html="artikel.isi">
          </div>
        </article>
      </div>
    </main>

    <section aria-label="Artikel Terkait" class="py-8 lg:py-24 bg-gray-50 dark:bg-gray-800">
      <div class="max-w-screen-xl px-4 mx-auto">
        <h2
          class="mb-16 text-2xl font-extrabold leading-none tracking-tight text-center text-gray-900 uppercase dark:text-white md:text-4xl lg:text-5xl">
          Artikel Terkait
        </h2>
        <div class="grid justify-center gap-12 sm:grid-cols-2 lg:grid-cols-4">
          <div v-for="artikel in artikel_terkait" :key="artikel.id"
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
              <Link :href="route('artikel.tampil', [artikel.kategori_slug, artikel.slug])"
                class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Baca Selengkapnya
              <font-awesome-icon icon="arrow-right-long" class="ml-1"></font-awesome-icon>
              </Link>
            </div>
          </div>
        </div>
      </div>
    </section>

  </MainLayout>
</template>

<style lang="scss">
.format *>img {
  @apply rounded;
}

.format *>table {
  @apply border-spacing-0;
}

.format *>table>tbody>tr>th {
  @apply uppercase text-gray-900 dark:text-white bg-gray-200 dark:bg-gray-800 px-6 py-3;
}

.format *>table>tbody>tr>td {
  @apply font-medium px-6 py-4;
}

.format *>table>tbody>tr>th,
.format *>table>tbody>tr>td {
  @apply w-auto relative align-top box-border border border-gray-500;
}

.format *>table>tbody>tr>td>p,
.format *>table>tbody>tr>th>p {
  @apply indent-0 m-0;
}
</style>