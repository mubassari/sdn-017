<script setup>
import { InputImage, InputGeneral, Tiptap } from "~Components/core/forms";
import { ref } from 'vue'

const inputImage = ref(null);

const props = defineProps({
  berita: { type: Object, required: true },
})
const emits = defineEmits(['submit'])

const resetForm = () => {
  props.berita.reset();
  inputImage.value.imagePreview = null;
}

const clearError = (name) => props.berita.clearErrors(name)
</script>

<template>
  <form @submit.prevent="$emit('submit')">
    <div class="mb-6">
      <InputGeneral v-model="berita.judul" :error="berita.errors.judul" @clear-error="clearError" title="Judul Berita"
        name="judul" :required="true" />
      <InputImage v-model="berita.sampul" :error="berita.errors.sampul" @clear-error="clearError" title="Gambar Sampul"
        name="sampul" ref="inputImage" accept="image/jpeg,image/png,image/jpg" />
      <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
      <Tiptap v-model="berita.isi" :error="berita.errors.isi" @clear-error="clearError" />
    </div>

    <div class="inline-flex rounded-md shadow-sm" role="group">
      <button type="reset" :disabled="berita.processing" @click="resetForm"
        :class="{ 'cursor-not-allowed': berita.processing }"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-l-lg text-base w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 border border-gray-600">
        Atur Ulang
      </button>
      <button type="submit" :disabled="berita.processing" :class="{ 'cursor-not-allowed': berita.processing }"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-r-lg text-base w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 border border-gray-600">
        Simpan
      </button>
    </div>
  </form>
</template>