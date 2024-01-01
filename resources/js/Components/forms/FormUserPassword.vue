<script setup>
import { InputGeneral } from "~Components/core/forms";
import { ref } from '@vue/reactivity'

const props = defineProps({
  user: { type: Object, required: true },
})
const emits = defineEmits(['submit'])

const passwordIsShown = ref(false);
const passwordLamaIsShown = ref(false);

const clearError = (name) => props.user.clearErrors(name)
</script>

<template>
  <form @submit.prevent="">
    <div class="mb-6">
      <div>
        <InputGeneral v-model="user.password_lama" :error="user.errors.password_lama" @clear-error="clearError"
          @slot-click="passwordLamaIsShown = !passwordLamaIsShown" title="Kata Sandi" name="password_lama"
          :type="passwordLamaIsShown ? 'text' : 'password'">
          <template #end>
            <font-awesome-icon :icon="passwordLamaIsShown ? 'eye-slash' : 'eye'"></font-awesome-icon>
          </template>
        </InputGeneral>
      </div>
      <div class="grid grid-cols-1 md:gap-5 md:grid-cols-2">
        <InputGeneral v-model="user.password" :error="user.errors.password" @clear-error="clearError"
          @slot-click="passwordIsShown = !passwordIsShown" title="Kata Sandi" name="password"
          :type="passwordIsShown ? 'text' : 'password'">
          <template #end>
            <font-awesome-icon :icon="passwordIsShown ? 'eye-slash' : 'eye'"></font-awesome-icon>
          </template>
        </InputGeneral>
        <InputGeneral v-model="user.password_confirmation" :error="user.errors.password_confirmation"
          @clear-error="clearError" @slot-click="passwordIsShown = !passwordIsShown" title="Konfirmasi Kata Sandi"
          name="password_confirmation" :type="passwordIsShown ? 'text' : 'password'">
          <template #end>
            <font-awesome-icon :icon="passwordIsShown ? 'eye-slash' : 'eye'"></font-awesome-icon>
          </template>
        </InputGeneral>
      </div>
    </div>
    <div class="inline-flex rounded-md shadow-sm" role="group">
      <button type="button" :disabled="user.processing || !user.isDirty"
        :class="{ 'cursor-not-allowed': user.processing || !user.isDirty }" @click="resetForm"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-l-lg text-base w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 border border-gray-600">
        <font-awesome-icon icon="arrow-rotate-left" class="mr-1"></font-awesome-icon>
        Atur Ulang
      </button>
      <button :disabled="user.processing || !user.isDirty"
        :class="{ 'cursor-not-allowed': user.processing || !user.isDirty }" @click="$emit('submit')"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-r-lg text-base w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 border border-gray-600">
        <font-awesome-icon icon="floppy-disk" class="mr-1"></font-awesome-icon>
        Simpan
      </button>
    </div>
  </form>
</template>