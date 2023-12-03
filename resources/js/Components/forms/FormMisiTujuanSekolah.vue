<script setup>
import { InputGeneral } from '~Components/core/forms'

const props = defineProps({
  sekolah: { type: Object, required: true },
})

const emits = defineEmits(['submit'])

const clearError = (name) => props.sekolah.clearErrors(name)
</script>
<template>
  <form @submit.prevent="">
    <div class="mb-6">
      <div v-for="(content, vindex) in sekolah.content" :key="vindex" class="flex">
        <InputGeneral v-model="sekolah.content[vindex]" :name="'visi[' + vindex + ']'" class="w-full" required />
        <button type="button" @click="sekolah.content.splice(vindex, 1)" title="Hapus Data"
          class="px-3 py-2 mb-5 ml-3 text-xs font-medium text-center text-white bg-red-700 rounded-lg focus:outline-none hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
          <font-awesome-icon icon="trash"></font-awesome-icon>
        </button>
      </div>
      <button type="button" @click="sekolah.content.push('')" title="Tambah Data"
        class="w-full px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <font-awesome-icon icon="plus" class="mr-1"></font-awesome-icon>
        Tambah Data
      </button>
    </div>
    <div class="inline-flex rounded-md shadow-sm" role="group">
      <button type="button" :disabled="sekolah.processing || !sekolah.isDirty"
        :class="{ 'cursor-not-allowed': sekolah.processing || !sekolah.isDirty }" @click="sekolah.reset()"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-l-lg text-base w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 border border-gray-600">
        <font-awesome-icon icon="arrow-rotate-left" class="mr-1"></font-awesome-icon>
        Atur Ulang
      </button>
      <button :disabled="sekolah.processing || !sekolah.isDirty"
        :class="{ 'cursor-not-allowed': sekolah.processing || !sekolah.isDirty }" @click="$emit('submit')"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-r-lg text-base w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 border border-gray-600">
        <font-awesome-icon icon="floppy-disk" class="mr-1"></font-awesome-icon>
        Simpan
      </button>
    </div>
  </form>
</template>