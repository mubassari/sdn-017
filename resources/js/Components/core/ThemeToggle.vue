<script setup>
import { ref, onBeforeMount } from 'vue';
let themeIsDark = ref(true);

onBeforeMount(() => {
  if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
    themeIsDark.value = true;
  } else {
    document.documentElement.classList.remove('dark');
    themeIsDark.value = false;

  }
})

const themeToggle = () => {
  themeIsDark.value = !themeIsDark.value;

  // if set via local storage previously
  if (localStorage.getItem('color-theme')) {
    if (localStorage.getItem('color-theme') === 'light') {
      document.documentElement.classList.add('dark');
      localStorage.setItem('color-theme', 'dark');
    } else {
      document.documentElement.classList.remove('dark');
      localStorage.setItem('color-theme', 'light');
    }

    // if NOT set via local storage previously
  } else {
    if (document.documentElement.classList.contains('dark')) {
      document.documentElement.classList.remove('dark');
      localStorage.setItem('color-theme', 'light');
    } else {
      document.documentElement.classList.add('dark');
      localStorage.setItem('color-theme', 'dark');
    }
  }
}
</script>
<template>
  <button @click="themeToggle" id="theme-toggle" type="button"
    class="text-gray-500 inline-flex items-center justify-center dark:text-gray-400 hover:bg-gray-100 w-10 h-10 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
    <font-awesome-icon v-if="themeIsDark" icon="sun" size="lg"></font-awesome-icon>
    <font-awesome-icon v-else icon="moon" size="lg"></font-awesome-icon>
    <span class="sr-only">Toggle theme</span>
  </button>
</template>