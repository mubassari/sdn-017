<script setup>
import { AdminLayout } from '~Layouts';
import { Card } from "~Components/core"
import { FormUser } from "~Components/forms"
import { useForm } from "@inertiajs/vue3";
import { ref } from '@vue/reactivity';

const title = ref('Ubah Pengguna');

const props = defineProps({ user: { type: Object, required: true } })

const user = useForm({
  id: props.user.id,
  username: props.user.username,
  role: props.user.role,
  gtk_id: props.user.gtk_id,
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
      <FormUser :user="user" @submit="user.put(route('admin.user.perbarui', user.id))" />
    </Card>
  </AdminLayout>
</template>