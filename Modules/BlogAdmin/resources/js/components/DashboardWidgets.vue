<template>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 3xl:grid-cols-6 gap-4 sm:gap-6 lg:gap-8 mb-6 sm:mb-8">
    <dashboard-card
      v-for="stat in stats"
      :key="stat.title"
      :title="stat.title"
      :value="stat.value"
      :icon="stat.icon"
      :color="stat.color"
      :change="stat.change"
    />
  </div>
</template>

<script setup>
import DashboardCard from '../Components/DashboardCard.vue'

const stats = [
  {
    title: 'Total Blogs',
    value: '1,234',
    icon: 'fas fa-newspaper',
    color: 'blue',
    change: '+12%'
  },
  {
    title: 'Total Users',
    value: '5,678',
    icon: 'fas fa-users',
    color: 'green',
    change: '+8%'
  },
  {
    title: 'Categories',
    value: '45',
    icon: 'fas fa-folder',
    color: 'purple',
    change: '+3%'
  },
  {
    title: 'Comments',
    value: '12,345',
    icon: 'fas fa-comments',
    color: 'orange',
    change: '+15%'
  }
]
</script>
