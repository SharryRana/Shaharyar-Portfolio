<template>
  <div>
    <!-- Mobile Overlay -->
    <div
      v-if="isOpen"
      class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 lg:hidden"
      @click="$emit('toggle-sidebar')"
    ></div>

    <!-- Sidebar -->
    <aside :class="[
      'fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 shadow-xl transform transition-transform duration-300 ease-in-out',
      'lg:translate-x-0 lg:static lg:inset-0 lg:shadow-none',
      isOpen ? 'translate-x-0' : '-translate-x-full'
    ]">
      <!-- Logo -->
      <div class="flex items-center justify-between h-16 px-4 lg:px-6 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center space-x-3">
          <div class="w-8 h-8 lg:w-10 lg:h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
            <span class="text-white font-bold text-sm lg:text-base">B</span>
          </div>
          <span class="text-xl lg:text-2xl font-bold text-gray-800 dark:text-white">BlogAdmin</span>
        </div>
      </div>

      <!-- Navigation -->
      <nav class="mt-6 px-4 lg:px-6">
        <div class="space-y-2">
          <sidebar-link href="/admin/dashboard" icon="dashboard">
            Dashboard
          </sidebar-link>
          <sidebar-link href="/admin/categories" icon="category">
            Categories
          </sidebar-link>
          <sidebar-link href="/admin/blogs" icon="article">
            Blogs
          </sidebar-link>
          <sidebar-link href="/admin/users" icon="people">
            Users
          </sidebar-link>
          <sidebar-link href="/admin/comments" icon="comment">
            Comments
          </sidebar-link>
          <sidebar-link href="/admin/settings" icon="settings">
            Settings
          </sidebar-link>
        </div>
      </nav>
    </aside>
  </div>
</template>

<script setup>
import SidebarLink from '../Components/SidebarLink.vue'

defineProps({
  isOpen: Boolean
})

defineEmits(['toggle-sidebar'])
</script>
