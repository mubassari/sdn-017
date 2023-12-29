<script setup>
import { Pagination, Artikel } from '~Components/core'
import { MainLayout } from '~Layouts';

const props = defineProps({
  'kategori': { type: Object, required: true },
  'list_artikel': { type: Object, required: true }
})

</script>

<template>
  <MainLayout :title="kategori.nama">
    <div class="flex flex-col items-center justify-center pt-24 bg-white dark:bg-gray-900 ">
      <h1
        class="my-3 text-3xl font-extrabold leading-none tracking-tight text-center text-gray-900 uppercase dark:text-white md:text-4xl lg:text-5xl">
        {{ kategori.nama }}
      </h1>
      <div class="max-w-screen-xl px-4 py-4 mx-auto md:py-16 lg:px-6">
        <div class="grid grid-cols-2 gap-3 xl:grid-cols-4 xl:gap-5">
          <Artikel v-for="artikel in list_artikel.data" :key="artikel.id" :artikel="artikel"
            :kategori="[kategori.nama, kategori.slug]">
          </Artikel>
        </div>
      </div>
      <Pagination :links="list_artikel.links" :dari="list_artikel.from" :ke="list_artikel.to" :total="list_artikel.total"
        class="px-5 pt-10 m-2" />
    </div>
  </MainLayout>
</template>