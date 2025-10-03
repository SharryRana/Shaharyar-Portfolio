<template>
  <div class="flex h-screen bg-gray-900 text-gray-100">
    <!-- Sidebar -->
    <aside
      :class="[
        'fixed inset-y-0 left-0 z-50 w-64 bg-gray-800 transform transition-transform duration-300 ease-in-out',
        sidebarOpen ? 'translate-x-0' : '-translate-x-full',
        'lg:translate-x-0' // Always visible on large screens
      ]"
    >
      <div class="h-full flex flex-col">
        <!-- Logo -->
        <div class="flex items-center justify-center h-16 text-xl font-bold border-b border-gray-700">
          Blog Admin
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
          <a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-700">Dashboard</a>
          <a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-700">Categories</a>
          <a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-700">Blogs</a>
          <a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-700">Users</a>
          <a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-700">Settings</a>
        </nav>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col transition-all duration-300 ease-in-out"
         :class="sidebarOpen ? 'lg:ml-64' : 'ml-0 lg:ml-64'">

      <!-- Topbar -->
      <header class="flex items-center justify-between bg-gray-800 h-16 px-4 border-b border-gray-700">
        <!-- Sidebar Toggle -->
        <button class="lg:hidden text-gray-200 hover:text-white" @click="sidebarOpen = !sidebarOpen">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>

        <!-- Search Bar -->
        <div class="relative flex-1 mx-4 max-w-full sm:max-w-md lg:max-w-lg xl:max-w-xl">
          <input
            type="text"
            placeholder="Search..."
            class="w-full pl-10 pr-4 py-2 rounded-lg bg-gray-700 text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
          />
            <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        <!-- Profile -->
        <div class="flex items-center space-x-4">
          <button class="relative">
            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405M19 13V7a2 2 0 00-2-2H7a2 2 0 00-2 2v6m10 4H6a2 2 0 01-2-2V7"/>
            </svg>
          </button>
          <img src="https://i.pravatar.cc/40" alt="Profile" class="w-8 h-8 rounded-full border border-gray-600"/>
        </div>
      </header>

      <!-- Content Slot -->
      <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 bg-gray-900">
        <slot></slot>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
const sidebarOpen = ref(false);
</script>
