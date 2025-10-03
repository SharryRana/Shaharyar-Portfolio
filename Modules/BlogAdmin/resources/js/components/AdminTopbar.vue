<template>
  <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
    <div class="flex items-center justify-between h-16 px-3 sm:px-4 md:px-6 lg:px-8 xl:px-10">
      <!-- Left Section -->
      <div class="flex items-center flex-1 min-w-0">
        <button
          @click="$emit('toggle-sidebar')"
          class="p-2 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 lg:hidden mr-2"
        >
          <i class="fas fa-bars"></i>
        </button>

        <!-- Search Bar -->
        <div class="relative flex-1 max-w-md lg:max-w-lg xl:max-w-xl">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-search text-gray-400"></i>
          </div>
          <input
            type="text"
            placeholder="Search..."
            class="pl-10 pr-4 py-2 w-full border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm lg:text-base"
          >
        </div>
      </div>

      <!-- Right Section -->
      <div class="flex items-center space-x-1 sm:space-x-2 md:space-x-4 ml-4">
        <!-- Theme Toggle -->
        <button
          @click="$emit('toggle-theme')"
          class="p-2 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200"
        >
          <i class="fas fa-moon dark:hidden"></i>
          <i class="fas fa-sun hidden dark:block"></i>
        </button>

        <!-- Notifications -->
        <div class="relative">
          <button
            @click="notificationsOpen = !notificationsOpen"
            class="p-2 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 relative transition-colors duration-200"
          >
            <i class="fas fa-bell"></i>
            <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
          </button>

          <!-- Notifications Dropdown -->
          <div
            v-if="notificationsOpen"
            class="absolute right-0 mt-2 w-72 sm:w-80 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 z-50"
          >
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
              <h3 class="font-semibold text-gray-900 dark:text-white">Notifications</h3>
            </div>
            <div class="max-h-96 overflow-y-auto">
              <div v-for="notification in notifications" :key="notification.id"
                   class="p-4 border-b border-gray-100 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                <p class="text-sm text-gray-700 dark:text-gray-300">{{ notification.message }}</p>
                <span class="text-xs text-gray-500">{{ notification.time }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Profile Dropdown -->
        <div class="relative">
          <button
            @click="profileOpen = !profileOpen"
            class="flex items-center space-x-2 sm:space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200"
          >
            <img
              src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
              alt="Profile"
              class="w-8 h-8 rounded-full"
            >
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300 hidden sm:block">Admin User</span>
            <i class="fas fa-chevron-down text-gray-400 text-xs hidden sm:block"></i>
          </button>

          <!-- Profile Dropdown Menu -->
          <div
            v-if="profileOpen"
            class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 z-50"
          >
            <div class="py-1">
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                <i class="fas fa-user mr-2"></i>Profile
              </a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                <i class="fas fa-cog mr-2"></i>Settings
              </a>
              <a href="/logout" method="post" as="button" class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                <i class="fas fa-sign-out-alt mr-2"></i>Sign out
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref } from 'vue'

defineEmits(['toggle-sidebar', 'toggle-theme'])

const notificationsOpen = ref(false)
const profileOpen = ref(false)

const notifications = [
  { id: 1, message: 'New comment on "Getting Started with Vue 3"', time: '5 min ago' },
  { id: 2, message: 'User John Doe registered', time: '1 hour ago' },
  { id: 3, message: 'Blog post published successfully', time: '2 hours ago' }
]
</script>
