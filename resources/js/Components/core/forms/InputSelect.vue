<script setup>
import { usePage } from '@inertiajs/vue3'
import { ref } from 'vue'

const page = usePage()
const kategori_list = ref([{ id: 0, nama: 'Pilih Kategori' }, ...page.props.kategori])

const props = defineProps({
  modelValue: { type: [Number, String] },
  error: { type: String },
  title: { type: String, default: 'Masukkan Teks' },
  type: { type: String, default: 'text' },
  name: { type: String, required: true },
  required: { type: Boolean, default: false }
});
const emits = defineEmits(['update:modelValue', 'clearError']);
</script>
<template>
  <div>
    <label :for="name" class="block mb-2 text-xl font-medium"
      :class="{ 'text-red-700 dark:text-red-500': error, 'text-gray-900 dark:text-white': !error }">
      {{ title }}
    </label> <select :placeholder="title" :name="name" :id="name" :value="modelValue"
      @change="$emit('update:modelValue', $event.target.value); $emit('clearError', name)"
      class="border text-sm rounded-lg block w-full p-2.5"
      :class="{ 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-red-100 dark:border-red-400': error, 'bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500': !error }">

      <option v-for="kategori in kategori_list" :value="kategori.id" :key="kategori.id" :disabled="kategori.id == 0">{{
        kategori.nama }}</option>
    </select>
    <p v-if="error" class="mt-2 text-sm text-red-600 dark:text-red-500">
      {{ error }}
    </p>
  </div>
</template>