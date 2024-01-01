<script setup>
defineProps(
  { title: { type: String } }
)
</script>

<template>
  <div class="mb-3">
    <div
      class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
      <h2 class="mb-5 text-xl font-semibold text-gray-900 dark:text-white" v-if="title">
        {{ title }}
      </h2>
      <slot />
    </div>
  </div>
</template>