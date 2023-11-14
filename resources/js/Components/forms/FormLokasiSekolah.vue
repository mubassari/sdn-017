<script setup>
import { ref } from '@vue/reactivity'
import { InputGeneral } from '~Components/core/forms'

const props = defineProps({
  sekolah: { type: Object, required: true },
})

const emits = defineEmits(['submit'])

const clearError = (name) => props.sekolah.clearErrors(name)

const latitude = ref(props.sekolah.latitude);
const longitude = ref(props.sekolah.longitude);

const pratinjau = ref(false);

</script>
<template>
  <form @submit.prevent="">
    <div class="mb-6">
      <div class="grid grid-cols-1 md:gap-5 md:grid-cols-3">
        <InputGeneral v-model="latitude" :error="sekolah.errors.latitude" @clear-error="clearError" title="Latitude"
          name="latitude" />
        <InputGeneral v-model="longitude" :error="sekolah.errors.longitude" @clear-error="clearError" title="Longitude"
          name="longitude" />
        <div class="mb-5">
          <span class="block mb-2 text-sm font-medium">&nbsp;</span>
          <button type="button" @click="pratinjau = !pratinjau"
            class="text-white bg-blue-700 w-full hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <font-awesome-icon :icon="pratinjau ? 'eye-slash' : 'eye'" class="mr-1"></font-awesome-icon>
            Pratinjau
          </button>
        </div>
      </div>
      <iframe v-if="pratinjau"
        :src="'https://maps.google.com/maps?q=' + latitude + ',%20' + longitude + '&z=18&output=embed'" style="border:0;"
        class="w-full rounded-lg" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="inline-flex rounded-md shadow-sm" role="group">
      <button type="button" :disabled="sekolah.processing || !sekolah.isDirty"
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