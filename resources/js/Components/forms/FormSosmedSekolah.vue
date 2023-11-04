<script setup>
import { InputGeneral } from '~Components/core/forms'

const props = defineProps({
  sekolah: { type: Object, required: true },
})

const emits = defineEmits(['submit'])

const clearError = (name) => props.sekolah.clearErrors(name)
</script>
<template>
  <form @submit.prevent="">
    <div class="mb-6">
      <div class="grid grid-cols-1 md:gap-5 md:grid-cols-2">
        <InputGeneral v-model="sekolah.facebook" :error="sekolah.errors.facebook" @clear-error="clearError"
          title="Facebook" name="facebook" />
        <InputGeneral v-model="sekolah.instagram" :error="sekolah.errors.instagram" @clear-error="clearError"
          title="Instagram" name="instagram" />
      </div>
      <div class="grid grid-cols-1 md:gap-5 md:grid-cols-2">
        <InputGeneral v-model="sekolah.tiktok" :error="sekolah.errors.tiktok" @clear-error="clearError" title="Tiktok"
          name="tiktok" />
        <InputGeneral v-model="sekolah.twitter" :error="sekolah.errors.twitter" @clear-error="clearError" title="Twitter"
          name="twitter" />
      </div>
    </div>
    <div class="inline-flex rounded-md shadow-sm" role="group">
      <button :disabled="sekolah.processing || !sekolah.isDirty"
        :class="{ 'cursor-not-allowed': sekolah.processing || !sekolah.isDirty }" @click="sekolah.reset()"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-l-lg text-base w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 border border-gray-600">
        <font-awesome-icon icon="arrow-rotate-left" class="mr-1"></font-awesome-icon>
        Atur Ulang
      </button>
      <button :disabled="sekolah.processing || !sekolah.isDirty"
        :class="{ 'cursor-not-allowed': sekolah.processing || !sekolah.isDirty }" @click="$emit('submit')"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-r-lg text-base w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 border border-gray-600">
        <font-awesome-icon icon="floppy-disk" class="mr-1"></font-awesome-icon>
        Simpan
      </button>
    </div>
  </form>
</template>