<script setup>
import { onMounted } from 'vue';

const props = defineProps({
  modelValue: { type: [String, Number] },
  error: { type: String },
  disabled: { type: Boolean },
  title: { type: String },
  name: { type: String, required: true },
  required: { type: Boolean, default: false }
});
const emits = defineEmits(['update:modelValue', 'clearError']);

const adjustTextareaHeight = () => {
  const textarea = document.getElementById(props.name)
  textarea.style.height = 'auto';
  textarea.style.height = `${textarea.scrollHeight}px`;
}

onMounted(() => adjustTextareaHeight());
</script>

<template>
  <div class="mb-5">
    <label v-if="title" :for="name" class="block mb-2 text-sm font-medium"
      :class="{ 'text-red-700 dark:text-red-500': error, 'text-gray-900 dark:text-white': !error }">
      {{ title }}
    </label>
    <textarea class="border text-sm rounded-lg block min-w-full p-2.5"
      :class="{ 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-red-100 dark:border-red-400': error, 'bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500': !error }"
      :name="name" :id="name" :value="modelValue" :required="required" :disabled="disabled"
      @input="adjustTextareaHeight(); $emit('update:modelValue', $event.target.value); $emit('clearError', name)"
      :placeholder="'Masukkan ' + title"></textarea>
    <p v-if="error" class="mt-2 text-sm text-red-600 dark:text-red-500">
      {{ error }}
    </p>
  </div>
</template>

<style lang="scss" scoped>
textarea {
  @apply resize-none overflow-y-hidden box-border w-full;
}
</style>