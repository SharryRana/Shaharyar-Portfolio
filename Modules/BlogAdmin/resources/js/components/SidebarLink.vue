<template>
  <Link
    :href="href"
    class="flex items-center px-4 lg:px-6 py-3 lg:py-4 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200 group"
    :class="{
      'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border-r-2 border-blue-600': $page.url.startsWith(href)
    }"
  >
    <span class="mr-3 lg:mr-4 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors">
      <i v-if="icon === 'dashboard'" class="fas fa-tachometer-alt text-sm lg:text-base"></i>
      <i v-else-if="icon === 'category'" class="fas fa-folder text-sm lg:text-base"></i>
      <i v-else-if="icon === 'article'" class="fas fa-newspaper text-sm lg:text-base"></i>
      <i v-else-if="icon === 'people'" class="fas fa-users text-sm lg:text-base"></i>
      <i v-else-if="icon === 'comment'" class="fas fa-comments text-sm lg:text-base"></i>
      <i v-else-if="icon === 'settings'" class="fas fa-cog text-sm lg:text-base"></i>
    </span>
    <span class="font-medium text-sm lg:text-base">
      <slot />
    </span>
  </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  href: String,
  icon: String
})
</script>
