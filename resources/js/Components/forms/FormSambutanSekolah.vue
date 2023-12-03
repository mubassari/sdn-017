<script setup>
import { Tiptap, InputSelect } from '~Components/core/forms'
import { usePage } from '@inertiajs/vue3'
import { ref } from '@vue/reactivity';

const props = defineProps({
  sekolah: { type: Object, required: true },
})

const page = usePage()
const kepala_sekolah_lists = ref([{ id: 0, nama: 'Pilih Kepala Sekolah' }, ...page.props.id_kepala_sekolah])

const emits = defineEmits(['submit'])

const clearError = (name) => props.sekolah.clearErrors(name)
</script>
<template>
  <form @submit.prevent="">
    <div class="mb-6">
      <InputSelect v-model="sekolah.kepala_sekolah_id" :error="sekolah.errors.kepala_sekolah_id" @clear-error="clearError"
        title="Nama Kepala Sekolah" name="kepala_sekolah_id" required :lists="kepala_sekolah_lists" />
      <Tiptap v-model="sekolah.isi" :error="sekolah.errors.isi" @clear-error="clearError" title="Isi Sambutan"
        name="isi" />
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