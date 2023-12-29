<script setup>
const props = defineProps({
  artikel: { type: Object, required: true },
  kategori: { type: Array, required: true },
})

</script>

<template>
  <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <img class="object-cover w-full rounded-t-lg aspect-square" :src="artikel.sampul" />
    <div class="p-5">
      <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 xl:text-2xl dark:text-white">
        {{ artikel.judul }}
      </h5>
      <div class="mt-2.5 mb-5 space-y-1">
        <span
          class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
          {{ kategori[0] }}
        </span>
        <p class="text-xs text-gray-500 xl:text-sm dark:text-gray-400">
          {{ artikel.waktu }}
        </p>
      </div>
      <Link :href="route('artikel.tampil', [kategori[1], artikel.slug])"
        class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg xl:text-sm hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
      Baca Selengkapnya
      <font-awesome-icon icon="arrow-right-long" class="ml-1"></font-awesome-icon>
      </Link>
    </div>
  </div>
</template>