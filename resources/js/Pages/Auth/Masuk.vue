<script setup>
import { MainLayout } from '~Layouts';
import { InputGeneral } from "~Components/core/forms";
import { useForm } from "@inertiajs/vue3";
import { ref } from '@vue/reactivity'

const passwordIsShown = ref(false);

const user = useForm({
  username: '',
  password: '',
  remember: false,
})

const clearError = (name) => user.clearErrors(name)
</script>

<template>
  <MainLayout title="Masuk" :index="false">
    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div
          class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
              Masuk ke Admin Panel
            </h1>
            <form class="space-y-4 md:space-y-6" action="#">
              <InputGeneral v-model="user.username" :error="user.errors.username" @clear-error="clearError"
                title="Username" name="username" required>
                <template #start>
                  <font-awesome-icon icon="at"></font-awesome-icon>
                </template>
              </InputGeneral>
              <InputGeneral v-model="user.password" :error="user.errors.password" @clear-error="clearError"
                @slot-click="passwordIsShown = !passwordIsShown" title="Kata Sandi" name="password"
                :type="passwordIsShown ? 'text' : 'password'">
                <template #end>
                  <font-awesome-icon :icon="passwordIsShown ? 'eye-slash' : 'eye'"></font-awesome-icon>
                </template>
              </InputGeneral>
              <div class="flex items-center justify-between">
                <div class="flex items-start">
                  <div class="flex items-center h-5">
                    <input id="remember" type="checkbox" required v-model="user.remember"
                      class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                  </div>
                  <div class="ml-3 text-sm">
                    <label for="remember" class="text-gray-500 dark:text-gray-300">
                      Ingat Saya
                    </label>
                  </div>
                </div>
              </div>
              <button type="submit" :disabled="user.processing || !user.isDirty"
                :class="{ 'cursor-not-allowed': user.processing || !user.isDirty }" @click="user.post(route('auth'))"
                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Masuk
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>
  </MainLayout>
</template>