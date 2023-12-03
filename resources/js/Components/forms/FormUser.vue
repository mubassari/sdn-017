<script setup>
import { InputGeneral, InputSelect } from "~Components/core/forms";
import { usePage } from '@inertiajs/vue3'
import { ref } from '@vue/reactivity'

const page = usePage()

const PAGE_UBAH = page.url.includes('ubah');

const gtk_lists = ref(null)
const role_lists = ref([...page.props.role])

if (!PAGE_UBAH) {
  gtk_lists.value = [{ id: 0, nama: 'Pilih GTK' }, ...page.props.gtk]
}

const props = defineProps({
  user: { type: Object, required: true },
})
const emits = defineEmits(['submit'])

const passwordIsShown = ref(false);

const clearError = (name) => props.user.clearErrors(name)
</script>

<template>
  <form @submit.prevent="">
    <div class="mb-6">
      <div class="grid grid-cols-1 md:gap-5 md:grid-cols-2">
        <InputSelect v-if="!PAGE_UBAH" v-model="user.gtk_id" :error="user.errors.gtk_id" @clear-error="clearError"
          title="Nama GTK" name="gtk_id" required :lists="gtk_lists" />
        <InputGeneral v-else v-model="user.gtk_id" title="Nama GTK" name="gtk_id" type="text" disabled />
        <InputGeneral v-model="user.username" :error="user.errors.username" @clear-error="clearError" title="Username"
          name="username" required>
          <template #start>
            <font-awesome-icon icon="at"></font-awesome-icon>
          </template>
        </InputGeneral>
      </div>

      <div class="mb-5">
        <label class="block mb-2 text-sm font-medium"
          :class="{ 'text-red-700 dark:text-red-500': user.errors.role, 'text-gray-900 dark:text-white': !user.errors.role }">
          Pilih Role
        </label>
        <div class="grid grid-cols-3 gap-3 md:gap-5 md:grid-cols-5">
          <div v-for="(role, role_key) in role_lists" :key="role_key" class="flex items-center me-4">
            <input :id="'role_' + role.id" type="checkbox" :value="role.id" v-model="user.role"
              @change="clearError('role')"
              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label :for="'role_' + role.id" class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">
              {{ role.nama }}
            </label>
          </div>
        </div>
        <p v-if="user.errors.role" class="mt-2 text-sm text-red-600 dark:text-red-500">
          {{ user.errors.role }}
        </p>
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