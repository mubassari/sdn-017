<script setup>
import { AdminLayout } from '~Layouts';
import { Card } from "~Components/core"
import { FormUser } from "~Components/forms"
import { useForm } from "@inertiajs/vue3";
import { ref } from '@vue/reactivity';

const title = ref('Tambah Pengguna');

const user = useForm({
  username: '',
  role: [],
  gtk_id: 0,
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
    <Card class="mb-4 col-span-full xl:mb-2">
      <FormUser :user="user" @submit="user.post(route('admin.user.simpan'))" />
    </Card>
  </AdminLayout>
</template>