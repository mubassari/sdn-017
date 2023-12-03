<script setup>
const props = defineProps({
  modelValue: { type: [String, Number] },
  error: { type: String },
  title: { type: String },
  disabled: { type: Boolean },
  type: { type: String, default: 'text' },
  name: { type: String, required: true },
  required: { type: Boolean, default: false }
});
const emits = defineEmits(['update:modelValue', 'clearError', 'startClick', 'endClick', 'slotClick']);
</script>

<template>
  <div class="mb-5">
    <label v-if="title" :for="name" class="block mb-2 text-sm font-medium"
      :class="{ 'text-red-700 dark:text-red-500': error, 'text-gray-900 dark:text-white': !error }">
      {{ title }}
    </label>
    <div class="flex">
      <span v-if="$slots.start" @click="$emit('startClick'); $emit('slotClick')"
        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
        <slot name="start"></slot>
      </span>
      <input :type="type" class="flex-1 order text-sm block w-full p-2.5"
        :class="{ 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-red-100 dark:border-red-400': error, 'bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500': !error, 'rounded-s-0 rounded-e-lg': $slots.start && !$slots.end, 'rounded-e-0 rounded-s-lg': !$slots.start && $slots.end, 'rounded-lg': !$slots.start && !$slots.end }"
        :name="name" :id="name" :value="modelValue" :required="required"
        @input="$emit('update:modelValue', $event.target.value); $emit('clearError', name)"
        :placeholder="'Masukkan ' + (title ?? 'Data')" :disabled="disabled">
      <span v-if="$slots.end" @click="$emit('endClick'); $emit('slotClick')"
        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-md rounded-s-0 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
        <slot name="end"></slot>
      </span>
    </div>
    <p v-if="error" class="mt-2 text-sm text-red-600 dark:text-red-500">
      {{ error }}
    </p>
  </div>
</template>