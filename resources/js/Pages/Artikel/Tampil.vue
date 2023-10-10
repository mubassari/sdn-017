<script setup>
import { MainLayout } from '~Layouts';

const props = defineProps({ 'artikel': { type: Object, required: true } })

</script>

<template>
  <MainLayout :title="artikel.judul">

    <main class="py-24 bg-white dark:bg-gray-900 antialiased">
      <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
        <article
          class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
          <header class="mb-4 lg:mb-6 not-format ">
            <h1
              class="mb-4 text-5xl font-extrabold leading-tight text-center text-gray-900 lg:mb-6 lg:text-6xl dark:text-white">
              {{ artikel.judul }}
            </h1>
            <div class="my-5 divide-x-2 divide-gray-500 dark:divide-gray-700 flex justify-center">
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
          <img class="rounded-t-lg w-full" :src="artikel.sampul" />
          <div v-html="artikel.isi">
          </div>
        </article>
      </div>
    </main>

    <aside aria-label="Related articles" class="py-8 lg:py-24 bg-gray-50 dark:bg-gray-800">
      <div class="px-4 mx-auto max-w-screen-xl">
        <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Related articles</h2>
        <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
          <article class="max-w-xs">
            <a href="#">
              <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-1.png" class="mb-5 rounded-lg"
                alt="Image 1">
            </a>
            <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
              <a href="#">Our first office</a>
            </h2>
            <p class="mb-4 text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many changes!
              After months of preparation.</p>
            <a href="#"
              class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
              Read in 2 minutes
            </a>
          </article>
          <article class="max-w-xs">
            <a href="#">
              <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-2.png" class="mb-5 rounded-lg"
                alt="Image 2">
            </a>
            <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
              <a href="#">Enterprise design tips</a>
            </h2>
            <p class="mb-4  text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many changes!
              After months of preparation.</p>
            <a href="#"
              class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
              Read in 12 minutes
            </a>
          </article>
          <article class="max-w-xs">
            <a href="#">
              <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-3.png" class="mb-5 rounded-lg"
                alt="Image 3">
            </a>
            <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
              <a href="#">We partnered with Google</a>
            </h2>
            <p class="mb-4  text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many changes!
              After months of preparation.</p>
            <a href="#"
              class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
              Read in 8 minutes
            </a>
          </article>
          <article class="max-w-xs">
            <a href="#">
              <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-4.png" class="mb-5 rounded-lg"
                alt="Image 4">
            </a>
            <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
              <a href="#">Our first project with React</a>
            </h2>
            <p class="mb-4  text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many changes!
              After months of preparation.</p>
            <a href="#"
              class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
              Read in 4 minutes
            </a>
          </article>
        </div>
      </div>
    </aside>

  </MainLayout>
</template>

<style lang="scss">
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