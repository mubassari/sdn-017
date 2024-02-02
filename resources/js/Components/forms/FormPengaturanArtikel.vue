<script setup>
import { InputSelect } from '~Components/core/forms'
import { ref } from '@vue/reactivity';

const props = defineProps({
  pengaturan: { type: Object, required: true },
})

const terbaru_lists = ref([
  { id: 0, nama: 'Pilih Angka' },
  { nama: 4 }, { nama: 8 }, { nama: 12 },
]);

const terkait_lists = ref([
  { id: 0, nama: 'Pilih Angka' },
  { nama: 4 }, { nama: 8 },
]);

const kategori_lists = ref([
  { id: 0, nama: 'Pilih Angka' },
  { nama: 8 }, { nama: 12 },
  { nama: 16 }, { nama: 20 },
]);

const pencarian_lists = ref([
  { id: 0, nama: 'Pilih Angka' },
  { nama: 8 }, { nama: 12 },
  { nama: 16 }, { nama: 20 },
]);

const emits = defineEmits(['submit'])

const clearError = (name) => props.pengaturan.clearErrors(name)
</script>
<template>
  <form @submit.prevent="">
    <div class="mb-6">
      <div class="grid grid-cols-1 md:gap-5 md:grid-cols-2">
        <InputSelect v-model="pengaturan.max_artikel_terbaru" :error="pengaturan.errors.max_artikel_terbaru" @clear-error="clearError"
          title="Maksimal Artikel Terbaru" name="max_artikel_terbaru" required :lists="terbaru_lists" />
        <InputSelect v-model="pengaturan.max_artikel_terkait" :error="pengaturan.errors.max_artikel_terkait" @clear-error="clearError"
          title="Maksimal Artikel Terkait" name="max_artikel_terkait" required :lists="terkait_lists" />
      </div>
      <div class="grid grid-cols-1 md:gap-5 md:grid-cols-2">
        <InputSelect v-model="pengaturan.max_artikel_kategori" :error="pengaturan.errors.max_artikel_kategori" @clear-error="clearError"
          title="Maksimal Artikel pada Kategori" name="max_artikel_kategori" required :lists="kategori_lists" />
        <InputSelect v-model="pengaturan.max_artikel_pencarian" :error="pengaturan.errors.max_artikel_pencarian" @clear-error="clearError"
          title="Maksimal Artikel pada Pencarian" name="max_artikel_pencarian" required :lists="pencarian_lists" />
      </div>
    </div>
    <div class="inline-flex rounded-md shadow-sm" role="group">
      <button type="button" :disabled="pengaturan.processing || !pengaturan.isDirty"
        :class="{ 'cursor-not-allowed': pengaturan.processing || !pengaturan.isDirty }" @click="pengaturan.reset()"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-l-lg text-base w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 border border-gray-600">
        <font-awesome-icon icon="arrow-rotate-left" class="mr-1"></font-awesome-icon>
        Atur Ulang
      </button>
      <button :disabled="pengaturan.processing || !pengaturan.isDirty"
        :class="{ 'cursor-not-allowed': pengaturan.processing || !pengaturan.isDirty }" @click="$emit('submit')"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-r-lg text-base w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 border border-gray-600">
        <font-awesome-icon icon="floppy-disk" class="mr-1"></font-awesome-icon>
        Simpan
      </button>
    </div>
  </form>
</template>