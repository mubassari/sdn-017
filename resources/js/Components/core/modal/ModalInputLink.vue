<script setup>
import { ref } from '@vue/reactivity';
import { InputGeneral } from "~Components/core/forms";
import { ModalBase } from '~Components/core/modal'

const value = ref(null)
const emits = defineEmits(['input', 'close'])
</script>

<template>
  <ModalBase @close="$emit('close')">
    <InputGeneral v-model="value" title="Masukkan Tautan" name="judul" :required="true" type="url" />
    <div class="flex items-center mt-5 space-x-2">
      <button type="button" @click="$emit('close')"
        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
        Batal
      </button>
      <button type="button" @click="$emit('input', value)"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        :disabled="value == null">
        Simpan
      </button>
    </div>
  </ModalBase>
</template>