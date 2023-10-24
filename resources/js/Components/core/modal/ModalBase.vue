<script setup>
defineEmits(['close']);
</script>

<template>
  <div tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-[52] w-full p-4 overflow-x-hidden overflow-y-auto h-screen flex items-center justify-center max-h-full">
    <div class="relative w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
        <button type="button" @click="$emit('close')"
          class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-hide="authentication-modal">
          <font-awesome-icon icon="times"></font-awesome-icon>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="px-6 py-6 lg:px-8">
          <slot />
        </div>
      </div>
    </div>
  </div>
  <div @click="$emit('close')" class="bg-gray-900 bg-opacity-50 visible dark:bg-opacity-80 fixed inset-0 z-[51]"></div>
</template>