<script setup>
import { InputImage, InputGeneral, InputSelect } from "~Components/core/forms";
import { usePage } from '@inertiajs/vue3'
import { ref } from '@vue/reactivity'

const inputImage = ref(null);
const page = usePage()
const lists = ref([{ id: 0, nama: 'Pilih Jabatan' }, ...page.props.jabatan])

const props = defineProps({
  gtk: { type: Object, required: true },
})
const emits = defineEmits(['submit'])

const resetForm = () => {
  props.gtk.reset();
  inputImage.value.imagePreview = null;
}

const clearError = (name) => props.gtk.clearErrors(name)
</script>

<template>
  <form @submit.prevent="">
    <div class="mb-6">
      <InputGeneral class="mb-5" v-model="gtk.nama" :error="gtk.errors.nama" @clear-error="clearError" title="Nama GTK"
        name="nama" :required="true" />
      <InputImage class="mb-5" v-model="gtk.sampul" :error="gtk.errors.sampul" @clear-error="clearError"
        title="Gambar Sampul" name="sampul" ref="inputImage" accept="image/jpeg,image/png,image/jpg" />
      <InputSelect v-model="gtk.gtk_jabatan_id" :error="gtk.errors.gtk_jabatan_id" @clear-error="clearError"
        title="Jabatan GTK" name="gtk_jabatan_id" :required="true" :lists="lists" />
    </div>

    <div class="inline-flex rounded-md shadow-sm" role="group">
      <button type="reset" :disabled="gtk.processing || !gtk.isDirty"
        :class="{ 'cursor-not-allowed': gtk.processing || !gtk.isDirty }" @click="resetForm"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-l-lg text-base w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 border border-gray-600">
        <font-awesome-icon icon="arrow-rotate-left" class="mr-1"></font-awesome-icon>
        Atur Ulang
      </button>
      <button :disabled="gtk.processing || !gtk.isDirty" :class="{ 'cursor-not-allowed': gtk.processing || !gtk.isDirty }"
        @click="$emit('submit')"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-r-lg text-base w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 border border-gray-600">
        <font-awesome-icon icon="floppy-disk" class="mr-1"></font-awesome-icon>
        Simpan
      </button>
    </div>
  </form>
</template>