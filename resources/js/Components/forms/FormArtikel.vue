<script setup>
import { InputImage, InputGeneral, InputSelect, Tiptap } from "~Components/core/forms";
import { ref } from 'vue'

const inputImage = ref(null);

const props = defineProps({
  artikel: { type: Object, required: true },
})
const emits = defineEmits(['submit'])

const resetForm = () => {
  props.artikel.reset();
  inputImage.value.imagePreview = null;
}

const clearError = (name) => props.artikel.clearErrors(name)
</script>

<template>
  <form @submit.prevent="">
    <div class="mb-6">
      <InputGeneral class="mb-5" v-model="artikel.judul" :error="artikel.errors.judul" @clear-error="clearError"
        title="Judul Artikel" name="judul" :required="true" />
      <InputImage class="mb-5" v-model="artikel.sampul" :error="artikel.errors.sampul" @clear-error="clearError"
        title="Gambar Sampul" name="sampul" ref="inputImage" accept="image/jpeg,image/png,image/jpg" />
      <InputSelect v-model="artikel.kategori_id" :error="artikel.errors.kategori_id" @clear-error="clearError"
        title="Kategori Artikel" name="kategori_id" :required="true" />
      <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
      <Tiptap class="mb-5" v-model="artikel.isi" :error="artikel.errors.isi" @clear-error="clearError" />
    </div>

    <div class="inline-flex rounded-md shadow-sm" role="group">
      <button type="reset" :disabled="artikel.processing" @click="resetForm"
        :class="{ 'cursor-not-allowed': artikel.processing }"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-l-lg text-base w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 border border-gray-600">
        <font-awesome-icon icon="arrow-rotate-left" class="mr-1"></font-awesome-icon>
        Atur Ulang
      </button>
      <button :disabled="artikel.processing" :class="{ 'cursor-not-allowed': artikel.processing }"
        @click="$emit('submit')"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-r-lg text-base w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 border border-gray-600">
        <font-awesome-icon icon="floppy-disk" class="mr-1"></font-awesome-icon>
        Simpan
      </button>
    </div>
  </form>
</template>