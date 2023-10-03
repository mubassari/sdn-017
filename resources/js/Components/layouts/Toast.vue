<script setup>
import { ToastContent } from '~Components/core';
import { onUnmounted } from 'vue';
import { router, usePage } from '@inertiajs/vue3'
import toast from '~Stores/toast'

const page = usePage()

let removeFinishEventListener = router.on('finish', () => {
  if (page.props.alert) {
    toast.add(page.props.alert)
  }
})

onUnmounted(() => removeFinishEventListener())
</script>

<template>
  <TransitionGroup tag="div" enter-from-class="translate-x-full opacity-0" enter-active-class="duration-500"
    leave-active-class="duration-500" leave-to-class="translate-x-full opacity-0"
    class="fixed top-4 right-4 z-100 space-y-4 w-full max-w-xs ">
    <ToastContent v-for="(item, index) in toast.items" :key="item.key" :pesan="item.pesan" @remove="toast.remove(index)" />
  </TransitionGroup>
</template>