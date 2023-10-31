<script setup>
import { ref, computed } from 'vue';
import { InputImage, InputGeneral } from "~Components/core/forms";
import { ModalBase } from '~Components/core/modal'

const value = ref(null)
const selectedRadio = ref(null)
const file = ref(null)
const base64Image = ref(null)
const emits = defineEmits(['input', 'close'])

const fileInput = computed({
  get() {
    return file.value
  },

  set(value) {
    if (value) {
      file.value = value
      const reader = new FileReader();

      reader.onload = () => {
        base64Image.value = reader.result;
      };

      reader.readAsDataURL(value);
    }
  }
})

</script>

<template>
  <ModalBase @close="$emit('close')">
    <div class="flex items-center mb-2">
      <input type="radio" value="url" name="radio-gambar" v-model="selectedRadio"
        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
      <label class="ml-2 font-medium text-gray-900 dark:text-gray-300" @click="selectedRadio = 'url'">
        Masukkan Tautan Gambar
      </label>
    </div>
    <InputGeneral v-model="value" name="url" :required="true" type="url" @click="selectedRadio = 'url'" />
    <div class="flex items-center mb-2">
      <input checked type="radio" value="file" name="radio-gambar" v-model="selectedRadio"
        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
      <label class="ml-2 font-medium text-gray-900 dark:text-gray-300" @click="selectedRadio = 'file'">
        Masukkan Gambar
      </label>
    </div>
    <InputImage v-model="fileInput" name="file" accept="image/jpeg,image/png,image/jpg"
      @click="selectedRadio = 'file'" />
    <div class="flex items-center mt-5 space-x-2">
      <button type="button" @click="$emit('close')"
        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
        Batal
      </button>
      <button type="button" @click="$emit('input', selectedRadio == 'url' ? value : base64Image)"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        :class="{ 'cursor-not-allowed': (selectedRadio == 'url' && value == null) || (selectedRadio == 'file' && base64Image == null) }"
        :disabled="(selectedRadio == 'url' && value == null) || (selectedRadio == 'file' && base64Image == null)">
        Simpan
      </button>
    </div>
  </ModalBase>
</template>