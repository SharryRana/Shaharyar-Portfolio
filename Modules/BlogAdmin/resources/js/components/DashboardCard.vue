<template>
  <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 sm:p-6 lg:p-8 hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
    <div class="flex items-center justify-between">
      <div class="flex-1 min-w-0">
        <p class="text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400 mb-1 truncate">
          {{ title }}
        </p>
        <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white">
          {{ value }}
        </p>
        <p :class="[
          'text-xs font-medium mt-1',
          change.startsWith('+') ? 'text-green-600' : 'text-red-600'
        ]">
          {{ change }} from last month
        </p>
      </div>
      <div :class="[
        'w-10 h-10 sm:w-12 sm:h-12 lg:w-16 lg:h-16 rounded-full flex items-center justify-center flex-shrink-0 ml-3',
        colorClasses[color]
      ]">
        <i :class="[icon, 'text-white text-sm sm:text-lg lg:text-xl']"></i>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  title: String,
  value: String,
  icon: String,
  color: String,
  change: String
})

const colorClasses = {
  blue: 'bg-blue-500',
  green: 'bg-green-500',
  purple: 'bg-purple-500',
  orange: 'bg-orange-500',
  red: 'bg-red-500'
}
</script>
