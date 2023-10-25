<script setup>
defineProps({
  links: { type: Array },
  dari: { type: Number },
  ke: { type: Number },
  total: { type: Number }
})
</script>
<template>
  <nav class="flex flex-col items-center justify-center p-4 " aria-label="Table navigation">
    <span class="text-sm text-gray-700 dark:text-gray-400">
      Menampilkan
      <template v-if="dari || ke">
        data <span class="font-semibold text-gray-900 dark:text-white">{{ dari }}</span> &ndash; <span
        class="font-semibold text-gray-900 dark:text-white">{{ ke }}</span>, dari
      </template>
       total <span
        class="font-semibold text-gray-900 dark:text-white">{{ total }}</span> data
    </span>
    <ul class="inline-flex h-8 mt-2 -space-x-px text-sm xs:mt-0" v-if="links.length > 3">
      <li v-for="(link, p) in links" :key="p">
        <component :is="(link.url && !link.active) ? 'Link' : 'span'" :href="link.url" v-html="link.label"
          class="flex items-center justify-center h-8 px-3 border border-gray-300 dark:border-gray-700 " :class="{
            'text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:bg-gray-700 dark:text-white cursor-default': (!link.url || link.active),
            'leading-tight text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800  dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white': (link.url && !link.active),
            'rounded-l': p == 0,
            'rounded-r': p == links.length - 1
          }">
        </component>
      </li>

    </ul>
  </nav>
</template>