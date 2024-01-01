<script setup>
import { AdminLayout } from '~Layouts';
import { Card } from "~Components/core"
import { FormUserUbah, FormUserPassword } from "~Components/forms"
import { useForm } from "@inertiajs/vue3";
import { ref } from '@vue/reactivity';

const title = ref('Ubah Pengguna');

const props = defineProps({ user: { type: Object, required: true } })

const user_ubah = useForm({
  id: props.user.id,
  username: props.user.username,
  role: props.user.role,
})

const user_password = useForm({
  id: props.user.id,
  password_lama: '',
  password: '',
  password_confirmation: ''
})

</script>

<template>
  <AdminLayout :title="title">
    <div class="mb-4 col-span-full xl:mb-2">
      <h1 class="mb-3 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
        {{ title }}
      </h1>
    </div>
    <Card class="mb-4 col-span-full xl:mb-2" title="Pengaturan Umum" id="user">
      <FormUserUbah :user="user_ubah" @submit="user_ubah.put(route('admin.user.perbarui', user_ubah.id))" />
    </Card>
    <Card class="mb-4 col-span-full xl:mb-2" title="Pengaturan Kata Sandi" id="password">
      <FormUserPassword :user="user_password"
        @submit="user_password.put(route('admin.user.perbarui_password', user_password.id))" />
    </Card>
  </AdminLayout>
</template>