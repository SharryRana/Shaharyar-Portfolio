<template>
  <AdminLayout title="Dashboard">
    <div class="space-y-4 sm:space-y-6 lg:space-y-8">
      <!-- Page Header -->
      <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-4 sm:space-y-0">
        <div>
          <h1 class="text-xl sm:text-2xl lg:text-3xl xl:text-4xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
          <p class="text-sm sm:text-base lg:text-lg text-gray-600 dark:text-gray-400">Welcome to your blog administration panel</p>
        </div>
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 sm:px-4 lg:px-6 py-2 lg:py-3 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2 w-full sm:w-auto text-sm sm:text-base lg:text-lg">
          <i class="fas fa-plus"></i>
          <span>New Blog Post</span>
        </button>
      </div>

      <!-- Stats Cards -->
      <DashboardWidgets />

      <!-- Charts and Analytics -->
      <div class="grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
        <!-- Blog Views Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 sm:p-6 lg:p-8">
          <h3 class="text-base sm:text-lg lg:text-xl font-semibold text-gray-900 dark:text-white mb-4 lg:mb-6">Blog Views Analytics</h3>
          <div class="h-48 sm:h-64 lg:h-80 xl:h-96 flex items-center justify-center bg-gray-50 dark:bg-gray-900 rounded-lg">
            <p class="text-sm sm:text-base lg:text-lg text-gray-500 dark:text-gray-400 text-center px-4">Chart will be implemented with Chart.js</p>
          </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 sm:p-6 lg:p-8">
          <h3 class="text-base sm:text-lg lg:text-xl font-semibold text-gray-900 dark:text-white mb-4 lg:mb-6">Recent Activity</h3>
          <div class="space-y-3 sm:space-y-4 lg:space-y-6">
            <div v-for="activity in recentActivities" :key="activity.id"
                 class="flex items-center space-x-3 lg:space-x-4 p-3 lg:p-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
              <div :class="['w-8 h-8 lg:w-10 lg:h-10 rounded-full flex items-center justify-center flex-shrink-0', activity.color]">
                <i :class="[activity.icon, 'text-white text-sm lg:text-base']"></i>
              </div>
              <div class="flex-1 min-w-0">
                <p class="text-sm lg:text-base font-medium text-gray-900 dark:text-white truncate">{{ activity.title }}</p>
                <p class="text-xs lg:text-sm text-gray-500">{{ activity.time }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Additional Widget for Large Screens -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 sm:p-6 lg:p-8 2xl:block hidden">
          <h3 class="text-base sm:text-lg lg:text-xl font-semibold text-gray-900 dark:text-white mb-4 lg:mb-6">Quick Actions</h3>
          <div class="space-y-3 sm:space-y-4 lg:space-y-6">
            <button class="w-full flex items-center space-x-3 lg:space-x-4 p-3 lg:p-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 text-left">
              <div class="w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-blue-500 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-plus text-white text-sm lg:text-base"></i>
              </div>
              <div>
                <p class="text-sm lg:text-base font-medium text-gray-900 dark:text-white">Create New Post</p>
                <p class="text-xs lg:text-sm text-gray-500">Start writing a new blog post</p>
              </div>
            </button>
            <button class="w-full flex items-center space-x-3 lg:space-x-4 p-3 lg:p-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 text-left">
              <div class="w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-green-500 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-folder text-white text-sm lg:text-base"></i>
              </div>
              <div>
                <p class="text-sm lg:text-base font-medium text-gray-900 dark:text-white">Manage Categories</p>
                <p class="text-xs lg:text-sm text-gray-500">Organize your content</p>
              </div>
            </button>
            <button class="w-full flex items-center space-x-3 lg:space-x-4 p-3 lg:p-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 text-left">
              <div class="w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-purple-500 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-chart-bar text-white text-sm lg:text-base"></i>
              </div>
              <div>
                <p class="text-sm lg:text-base font-medium text-gray-900 dark:text-white">View Analytics</p>
                <p class="text-xs lg:text-sm text-gray-500">Check detailed reports</p>
              </div>
            </button>
          </div>
        </div>
      </div>

      <!-- Recent Blogs Table -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="px-4 sm:px-6 lg:px-8 py-4 lg:py-6 border-b border-gray-200 dark:border-gray-700">
          <h3 class="text-base sm:text-lg lg:text-xl font-semibold text-gray-900 dark:text-white">Recent Blog Posts</h3>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full min-w-full">
            <thead class="bg-gray-50 dark:bg-gray-700">
              <tr>
                <th class="px-3 sm:px-6 lg:px-8 py-3 lg:py-4 text-left text-xs lg:text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                  Title
                </th>
                <th class="px-3 sm:px-6 lg:px-8 py-3 lg:py-4 text-left text-xs lg:text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden sm:table-cell">
                  Author
                </th>
                <th class="px-3 sm:px-6 lg:px-8 py-3 lg:py-4 text-left text-xs lg:text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                  Status
                </th>
                <th class="px-3 sm:px-6 lg:px-8 py-3 lg:py-4 text-left text-xs lg:text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden md:table-cell">
                  Views
                </th>
                <th class="px-3 sm:px-6 lg:px-8 py-3 lg:py-4 text-left text-xs lg:text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden lg:table-cell">
                  Date
                </th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
              <tr v-for="blog in recentBlogs" :key="blog.id" class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                <td class="px-3 sm:px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                  <div class="max-w-xs truncate" :title="blog.title">
                    {{ blog.title }}
                  </div>
                  <div class="text-xs text-gray-500 dark:text-gray-400 sm:hidden mt-1">
                    {{ blog.author }} • {{ blog.views }} views
                  </div>
                </td>
                <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 hidden sm:table-cell">
                  {{ blog.author }}
                </td>
                <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                  <span :class="[
                    'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                    blog.status === 'Published' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' :
                    blog.status === 'Draft' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' :
                    'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200'
                  ]">
                    {{ blog.status }}
                  </span>
                </td>
                <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 hidden md:table-cell">
                  {{ blog.views }}
                </td>
                <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 hidden lg:table-cell">
                  {{ blog.date }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '../layouts/AdminLayout.vue'
import DashboardWidgets from '../Components/DashboardWidgets.vue'

defineProps({
  title: String
})

const recentActivities = [
  {
    id: 1,
    title: 'New blog post published',
    time: '2 minutes ago',
    icon: 'fas fa-newspaper',
    color: 'bg-blue-500'
  },
  {
    id: 2,
    title: 'User registration',
    time: '1 hour ago',
    icon: 'fas fa-user-plus',
    color: 'bg-green-500'
  },
  {
    id: 3,
    title: 'Comment approved',
    time: '3 hours ago',
    icon: 'fas fa-comment',
    color: 'bg-purple-500'
  }
]

const recentBlogs = [
  {
    id: 1,
    title: 'Getting Started with Vue 3',
    author: 'John Doe',
    status: 'Published',
    views: '1,234',
    date: '2024-01-15'
  },
  {
    id: 2,
    title: 'Laravel Best Practices',
    author: 'Jane Smith',
    status: 'Published',
    views: '2,567',
    date: '2024-01-14'
  },
  {
    id: 3,
    title: 'Tailwind CSS Tips',
    author: 'Mike Johnson',
    status: 'Draft',
    views: '0',
    date: '2024-01-13'
  }
]
</script>
