<script setup>
import { onMounted } from 'vue';

const props = defineProps({
  pesan: { type: String },
  status: { type: String },
  durasi: { type: Number, default: 3000 }
})
const emits = defineEmits(['remove'])

onMounted(() => setTimeout(() => emits('remove'), props.durasi))
</script>

<template>
  <div class="flex items-center p-4 text-sm border rounded-lg" :class="{
    'text-green-800 border-green-300 bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800': status == 'success',
    'text-red-800 border-red-300 bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800': status == 'danger' || status == 'error'
  }" role="alert">
    <div class="ml-3 text-sm font-medium">{{ pesan }}</div>
    <button type="button" @click="$emit('remove')"
      class="ml-auto -mx-1.5 -my-1.5 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white"
      data-dismiss-target="#toast-default" aria-label="Close">
      <span class="sr-only">Close</span>
      <font-awesome-icon icon="times"></font-awesome-icon>
    </button>
  </div>
</template>