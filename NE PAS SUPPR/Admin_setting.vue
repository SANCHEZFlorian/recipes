<!-- The exported code uses Tailwind CSS. Install Tailwind CSS in your dev environment to ensure all styles work. -->
<template>
  <div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <div
      class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 bg-white shadow-md z-10"
    >
      <div class="flex-1 flex flex-col min-h-0 border-r border-gray-200">
        <!-- Logo -->
        <div class="flex items-center h-16 px-4 border-b border-gray-200">
          <img :src="logoUrl" alt="Family Recipe" class="h-10 w-auto" />
          <h1 class="ml-2 text-xl font-bold text-emerald-600">Family Recipe</h1>
        </div>
        <!-- Navigation Menu -->
        <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
          <a
            href="#"
            class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
          >
            <i class="fas fa-chart-pie w-5 h-5 mr-3 text-gray-500"></i>
            Dashboard Overview
          </a>
          <a
            href="#"
            class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
          >
            <i class="fas fa-utensils w-5 h-5 mr-3 text-gray-500"></i>
            Recipe Management
          </a>
          <a
            href="#"
            class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
          >
            <i class="fas fa-carrot w-5 h-5 mr-3 text-gray-500"></i>
            Ingredient Management
          </a>
          <a
            href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/f020ca5d-76a8-4b4b-8587-1e7cc939a0ed"
            data-readdy="true"
            class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
          >
            <i class="fas fa-tags w-5 h-5 mr-3 text-gray-500"></i>
            Category Management
          </a>
          <a
            href="#"
            class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
          >
            <i class="fas fa-balance-scale w-5 h-5 mr-3 text-gray-500"></i>
            Measurement Management
          </a>
          <a
            href="#"
            class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
          >
            <i class="fas fa-users w-5 h-5 mr-3 text-gray-500"></i>
            User Management
          </a>
          <a
            href="#"
            class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
          >
            <i class="fas fa-user-friends w-5 h-5 mr-3 text-gray-500"></i>
            Group Management
          </a>
          <a
            href="#"
            class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
          >
            <i class="fas fa-shield-alt w-5 h-5 mr-3 text-gray-500"></i>
            Content Moderation
          </a>
          <a
            href="#"
            class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg bg-emerald-50 text-emerald-700 cursor-pointer"
          >
            <i class="fas fa-cogs w-5 h-5 mr-3 text-emerald-600"></i>
            Site Configuration
          </a>
          <a
            href="#"
            class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
          >
            <i class="fas fa-chart-line w-5 h-5 mr-3 text-gray-500"></i>
            Analytics & Reports
          </a>
          <a
            href="#"
            class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
          >
            <i class="fas fa-file-alt w-5 h-5 mr-3 text-gray-500"></i>
            System Logs
          </a>
        </nav>
      </div>
    </div>
    <!-- Main Content -->
    <div class="md:pl-64 flex flex-col flex-1">
      <!-- Top Header -->
      <header class="sticky top-0 z-10 bg-white shadow-sm">
        <div
          class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8"
        >
          <!-- Mobile Menu Button -->
          <button
            @click="toggleSidebar"
            class="md:hidden text-gray-600 hover:text-emerald-600 cursor-pointer whitespace-nowrap !rounded-button"
          >
            <i class="fas fa-bars text-xl"></i>
          </button>
          <!-- Breadcrumb -->
          <div class="flex items-center text-sm text-gray-500">
            <a
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/70699a77-6b77-4a4f-8e7c-1d864e6e5ccc"
              data-readdy="true"
              class="hover:text-emerald-600 cursor-pointer"
              >Home</a
            >
            <i class="fas fa-chevron-right mx-2 text-xs text-gray-400"></i>
            <span class="text-emerald-600 font-medium">Admin Settings</span>
          </div>
          <!-- Right Header Items -->
          <div class="flex items-center space-x-4">
            <!-- Notification Bell -->
            <div class="relative">
              <button
                class="text-gray-600 hover:text-emerald-600 cursor-pointer whitespace-nowrap !rounded-button"
              >
                <i class="fas fa-bell text-xl"></i>
                <span
                  class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"
                  >3</span
                >
              </button>
            </div>
            <!-- User Menu -->
            <div class="relative">
              <button
                @click="toggleUserMenu"
                class="flex items-center space-x-2 cursor-pointer whitespace-nowrap !rounded-button"
              >
                <img
                  :src="adminAvatar"
                  alt="Admin"
                  class="h-8 w-8 rounded-full object-cover"
                />
                <span class="text-gray-700 font-medium hidden sm:inline-block"
                  >Admin User</span
                >
                <i class="fas fa-chevron-down text-gray-500 text-xs"></i>
              </button>
              <!-- User Dropdown -->
              <div
                v-if="showUserMenu"
                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
              >
                <a
                  href="#"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                  >My Profile</a
                >
                <a
                  href="#"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                  >Settings</a
                >
                <div class="border-t border-gray-100">
                  <a
                    href="#"
                    class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 cursor-pointer"
                    >Logout</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- Mobile Sidebar -->
      <div
        v-if="isMobileSidebarOpen"
        class="md:hidden fixed inset-0 z-40 bg-gray-600 bg-opacity-75"
      >
        <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-xl">
          <div
            class="flex items-center justify-between h-16 px-4 border-b border-gray-200"
          >
            <div class="flex items-center">
              <img :src="logoUrl" alt="Family Recipe" class="h-10 w-auto" />
              <h1 class="ml-2 text-xl font-bold text-emerald-600">Family Recipe</h1>
            </div>
            <button
              @click="toggleSidebar"
              class="text-gray-500 hover:text-gray-700 cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fas fa-times text-xl"></i>
            </button>
          </div>
          <nav class="px-2 py-4 space-y-1 overflow-y-auto">
            <a
              href="#"
              class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
            >
              <i class="fas fa-chart-pie w-5 h-5 mr-3 text-gray-500"></i>
              Dashboard Overview
            </a>
            <a
              href="#"
              class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
            >
              <i class="fas fa-utensils w-5 h-5 mr-3 text-gray-500"></i>
              Recipe Management
            </a>
            <a
              href="#"
              class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
            >
              <i class="fas fa-carrot w-5 h-5 mr-3 text-gray-500"></i>
              Ingredient Management
            </a>
            <a
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/f020ca5d-76a8-4b4b-8587-1e7cc939a0ed"
              data-readdy="true"
              class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
            >
              <i class="fas fa-tags w-5 h-5 mr-3 text-gray-500"></i>
              Category Management
            </a>
            <a
              href="#"
              class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
            >
              <i class="fas fa-balance-scale w-5 h-5 mr-3 text-gray-500"></i>
              Measurement Management
            </a>
            <a
              href="#"
              class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
            >
              <i class="fas fa-users w-5 h-5 mr-3 text-gray-500"></i>
              User Management
            </a>
            <a
              href="#"
              class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
            >
              <i class="fas fa-user-friends w-5 h-5 mr-3 text-gray-500"></i>
              Group Management
            </a>
            <a
              href="#"
              class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
            >
              <i class="fas fa-shield-alt w-5 h-5 mr-3 text-gray-500"></i>
              Content Moderation
            </a>
            <a
              href="#"
              class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg bg-emerald-50 text-emerald-700 cursor-pointer"
            >
              <i class="fas fa-cogs w-5 h-5 mr-3 text-emerald-600"></i>
              Site Configuration
            </a>
            <a
              href="#"
              class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
            >
              <i class="fas fa-chart-line w-5 h-5 mr-3 text-gray-500"></i>
              Analytics & Reports
            </a>
            <a
              href="#"
              class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
            >
              <i class="fas fa-file-alt w-5 h-5 mr-3 text-gray-500"></i>
              System Logs
            </a>
          </nav>
        </div>
        <div class="absolute inset-0" @click="toggleSidebar"></div>
      </div>
      <!-- Page Content -->
      <main class="flex-1 overflow-y-auto bg-gray-50 min-h-screen">
        <div class="py-6">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-8">
              <h1 class="text-3xl font-bold text-gray-900">Admin Settings</h1>
              <p class="mt-1 text-sm text-gray-600">
                Manage your platform settings, users, content, and
                configurations
              </p>
            </div>
            <!-- Dashboard Overview -->
            <div class="mb-8">
              <h2 class="text-xl font-semibold text-gray-800 mb-4">
                Dashboard Overview
              </h2>
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                  <div class="p-5">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 bg-emerald-100 rounded-md p-3">
                        <i class="fas fa-users text-emerald-600 text-xl"></i>
                      </div>
                      <div class="ml-5 w-0 flex-1">
                        <dl>
                          <dt
                            class="text-sm font-medium text-gray-500 truncate"
                          >
                            Total Users
                          </dt>
                          <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-gray-900">
                              2,451
                            </div>
                            <div
                              class="ml-2 flex items-baseline text-sm font-semibold text-green-600"
                            >
                              <i class="fas fa-arrow-up"></i>
                              <span class="sr-only">Increased by</span>
                              12%
                            </div>
                          </dd>
                        </dl>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg">
                  <div class="p-5">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                        <i class="fas fa-utensils text-blue-600 text-xl"></i>
                      </div>
                      <div class="ml-5 w-0 flex-1">
                        <dl>
                          <dt
                            class="text-sm font-medium text-gray-500 truncate"
                          >
                            Total Recipes
                          </dt>
                          <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-gray-900">
                              4,782
                            </div>
                            <div
                              class="ml-2 flex items-baseline text-sm font-semibold text-green-600"
                            >
                              <i class="fas fa-arrow-up"></i>
                              <span class="sr-only">Increased by</span>
                              8%
                            </div>
                          </dd>
                        </dl>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg">
                  <div class="p-5">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 bg-purple-100 rounded-md p-3">
                        <i
                          class="fas fa-user-friends text-purple-600 text-xl"
                        ></i>
                      </div>
                      <div class="ml-5 w-0 flex-1">
                        <dl>
                          <dt
                            class="text-sm font-medium text-gray-500 truncate"
                          >
                            Active Groups
                          </dt>
                          <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-gray-900">
                              342
                            </div>
                            <div
                              class="ml-2 flex items-baseline text-sm font-semibold text-green-600"
                            >
                              <i class="fas fa-arrow-up"></i>
                              <span class="sr-only">Increased by</span>
                              5%
                            </div>
                          </dd>
                        </dl>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg">
                  <div class="p-5">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 bg-amber-100 rounded-md p-3">
                        <i class="fas fa-flag text-amber-600 text-xl"></i>
                      </div>
                      <div class="ml-5 w-0 flex-1">
                        <dl>
                          <dt
                            class="text-sm font-medium text-gray-500 truncate"
                          >
                            Pending Reports
                          </dt>
                          <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-gray-900">
                              18
                            </div>
                            <div
                              class="ml-2 flex items-baseline text-sm font-semibold text-red-600"
                            >
                              <i class="fas fa-arrow-up"></i>
                              <span class="sr-only">Increased by</span>
                              3
                            </div>
                          </dd>
                        </dl>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Main Content Tabs -->
            <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
              <div class="border-b border-gray-200">
                <nav class="flex -mb-px">
                  <button
                    v-for="(tab, index) in tabs"
                    :key="index"
                    @click="activeTab = tab.id"
                    :class="[
'py-4 px-6 text-center border-b-2 font-medium text-sm whitespace-nowrap cursor-pointer !rounded-button',
activeTab === tab.id
? 'border-emerald-500 text-emerald-600'
: 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
]"
                  >
                    <i :class="['mr-2', tab.icon]"></i>
                    {{ tab.name }}
                  </button>
                </nav>
              </div>
              <!-- Tab Content -->
              <div class="p-6">
                <!-- User Management Tab -->
                <div v-if="activeTab === 'users'" class="space-y-6">
                  <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between gap-4"
                  >
                    <div class="flex-1">
                      <h3 class="text-lg font-medium text-gray-900">
                        User Management
                      </h3>
                      <p class="mt-1 text-sm text-gray-500">
                        Manage users, permissions, and account settings
                      </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                      <button
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        <i class="fas fa-download mr-2"></i>
                        Export
                      </button>
                      <button
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        <i class="fas fa-plus mr-2"></i>
                        Add User
                      </button>
                    </div>
                  </div>
                  <!-- Search and Filters -->
                  <div class="flex flex-col sm:flex-row gap-4">
                    <div class="relative flex-grow">
                      <div
                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                      >
                        <i class="fas fa-search text-gray-400"></i>
                      </div>
                      <input
                        type="text"
                        placeholder="Search users..."
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                      />
                    </div>
                    <div class="flex flex-wrap gap-2">
                      <div class="relative inline-block text-left">
                        <button
                          @click="toggleRoleFilter"
                          class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                        >
                          <i class="fas fa-user-tag mr-2"></i>
                          Role
                          <i class="fas fa-chevron-down ml-2"></i>
                        </button>
                        <div
                          v-if="showRoleFilter"
                          class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10"
                        >
                          <div class="py-1">
                            <a
                              href="#"
                              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                              >All Roles</a
                            >
                            <a
                              href="#"
                              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                              >Admin</a
                            >
                            <a
                              href="#"
                              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                              >Moderator</a
                            >
                            <a
                              href="#"
                              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                              >User</a
                            >
                          </div>
                        </div>
                      </div>
                      <div class="relative inline-block text-left">
                        <button
                          @click="toggleStatusFilter"
                          class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                        >
                          <i class="fas fa-toggle-on mr-2"></i>
                          Status
                          <i class="fas fa-chevron-down ml-2"></i>
                        </button>
                        <div
                          v-if="showStatusFilter"
                          class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10"
                        >
                          <div class="py-1">
                            <a
                              href="#"
                              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                              >All Statuses</a
                            >
                            <a
                              href="#"
                              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                              >Active</a
                            >
                            <a
                              href="#"
                              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                              >Suspended</a
                            >
                            <a
                              href="#"
                              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                              >Pending</a
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Users Table -->
                  <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-gray-50">
                        <tr>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                          >
                            <div class="flex items-center">
                              <input
                                type="checkbox"
                                class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded"
                              />
                            </div>
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                          >
                            User
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                          >
                            Role
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                          >
                            Status
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                          >
                            Joined
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                          >
                            Last Active
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                          >
                            Actions
                          </th>
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                        <tr
                          v-for="(user, index) in users"
                          :key="index"
                          class="hover:bg-gray-50"
                        >
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <input
                                type="checkbox"
                                class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded"
                              />
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="flex-shrink-0 h-10 w-10">
                                <img
                                  :src="user.avatar"
                                  :alt="user.name"
                                  class="h-10 w-10 rounded-full object-cover"
                                />
                              </div>
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                  {{ user.name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                  {{ user.email }}
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <span
                              :class="[
'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
user.role === 'Admin' ? 'bg-purple-100 text-purple-800' :
user.role === 'Moderator' ? 'bg-blue-100 text-blue-800' :
'bg-gray-100 text-gray-800'
]"
                            >
                              {{ user.role }}
                            </span>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <span
                              :class="[
'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
user.status === 'Active' ? 'bg-green-100 text-green-800' :
user.status === 'Suspended' ? 'bg-red-100 text-red-800' :
'bg-yellow-100 text-yellow-800'
]"
                            >
                              {{ user.status }}
                            </span>
                          </td>
                          <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                          >
                            {{ user.joined }}
                          </td>
                          <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                          >
                            {{ user.lastActive }}
                          </td>
                          <td
                            class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                          >
                            <div class="flex justify-end space-x-2">
                              <button
                                class="text-emerald-600 hover:text-emerald-900 cursor-pointer whitespace-nowrap !rounded-button"
                              >
                                <i class="fas fa-edit"></i>
                              </button>
                              <button
                                class="text-red-600 hover:text-red-900 cursor-pointer whitespace-nowrap !rounded-button"
                              >
                                <i class="fas fa-trash-alt"></i>
                              </button>
                              <div class="relative">
                                <button
                                  @click="toggleUserActions(index)"
                                  class="text-gray-500 hover:text-gray-700 cursor-pointer whitespace-nowrap !rounded-button"
                                >
                                  <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div
                                  v-if="activeUserActions === index"
                                  class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10"
                                >
                                  <div class="py-1">
                                    <a
                                      href="#"
                                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                                      >View Profile</a
                                    >
                                    <a
                                      href="#"
                                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                                      >Edit Permissions</a
                                    >
                                    <a
                                      href="#"
                                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                                      >Reset Password</a
                                    >
                                    <a
                                      href="#"
                                      class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 cursor-pointer"
                                      >Suspend Account</a
                                    >
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- Pagination -->
                  <div class="flex items-center justify-between">
                    <div class="flex-1 flex justify-between sm:hidden">
                      <a
                        href="#"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer"
                      >
                        Previous
                      </a>
                      <a
                        href="#"
                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer"
                      >
                        Next
                      </a>
                    </div>
                    <div
                      class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"
                    >
                      <div>
                        <p class="text-sm text-gray-700">
                          Showing <span class="font-medium">1</span> to
                          <span class="font-medium">10</span> of
                          <span class="font-medium">97</span> users
                        </p>
                      </div>
                      <div>
                        <nav
                          class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                          aria-label="Pagination"
                        >
                          <a
                            href="#"
                            class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 cursor-pointer"
                          >
                            <span class="sr-only">Previous</span>
                            <i class="fas fa-chevron-left"></i>
                          </a>
                          <a
                            href="#"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer"
                          >
                            1
                          </a>
                          <a
                            href="#"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-emerald-50 text-sm font-medium text-emerald-600 hover:bg-emerald-100 cursor-pointer"
                          >
                            2
                          </a>
                          <a
                            href="#"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer"
                          >
                            3
                          </a>
                          <span
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700"
                          >
                            ...
                          </span>
                          <a
                            href="#"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer"
                          >
                            10
                          </a>
                          <a
                            href="#"
                            class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 cursor-pointer"
                          >
                            <span class="sr-only">Next</span>
                            <i class="fas fa-chevron-right"></i>
                          </a>
                        </nav>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Groups Management Tab -->
                <div v-if="activeTab === 'groups'" class="space-y-6">
                  <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between gap-4"
                  >
                    <div class="flex-1">
                      <h3 class="text-lg font-medium text-gray-900">
                        Group Management
                      </h3>
                      <p class="mt-1 text-sm text-gray-500">
                        Manage cooking groups, permissions, and content
                      </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                      <button
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        <i class="fas fa-download mr-2"></i>
                        Export
                      </button>
                      <button
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        <i class="fas fa-plus mr-2"></i>
                        Add Group
                      </button>
                    </div>
                  </div>
                  <!-- Search and Filters -->
                  <div class="flex flex-col sm:flex-row gap-4">
                    <div class="relative flex-grow">
                      <div
                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                      >
                        <i class="fas fa-search text-gray-400"></i>
                      </div>
                      <input
                        type="text"
                        placeholder="Search groups..."
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                      />
                    </div>
                    <div class="flex flex-wrap gap-2">
                      <div class="relative inline-block text-left">
                        <button
                          class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                        >
                          <i class="fas fa-globe mr-2"></i>
                          Privacy
                          <i class="fas fa-chevron-down ml-2"></i>
                        </button>
                      </div>
                      <div class="relative inline-block text-left">
                        <button
                          class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                        >
                          <i class="fas fa-toggle-on mr-2"></i>
                          Status
                          <i class="fas fa-chevron-down ml-2"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <!-- Groups Table -->
                  <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-gray-50">
                        <tr>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                          >
                            <div class="flex items-center">
                              <input
                                type="checkbox"
                                class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded"
                              />
                            </div>
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                          >
                            Group
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                          >
                            Privacy
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                          >
                            Members
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                          >
                            Created
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                          >
                            Status
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                          >
                            Actions
                          </th>
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                        <tr
                          v-for="(group, index) in groups"
                          :key="index"
                          class="hover:bg-gray-50"
                        >
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <input
                                type="checkbox"
                                class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded"
                              />
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="flex-shrink-0 h-10 w-10">
                                <img
                                  :src="group.image"
                                  :alt="group.name"
                                  class="h-10 w-10 rounded-md object-cover"
                                />
                              </div>
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                  {{ group.name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                  {{ group.owner }}
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <span
                              :class="[
'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
group.privacy === 'Public' ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800'
]"
                            >
                              {{ group.privacy }}
                            </span>
                          </td>
                          <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                          >
                            {{ group.members }}
                          </td>
                          <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                          >
                            {{ group.created }}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <span
                              :class="[
'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
group.status === 'Active' ? 'bg-green-100 text-green-800' :
group.status === 'Archived' ? 'bg-gray-100 text-gray-800' :
'bg-yellow-100 text-yellow-800'
]"
                            >
                              {{ group.status }}
                            </span>
                          </td>
                          <td
                            class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                          >
                            <div class="flex justify-end space-x-2">
                              <button
                                class="text-emerald-600 hover:text-emerald-900 cursor-pointer whitespace-nowrap !rounded-button"
                              >
                                <i class="fas fa-edit"></i>
                              </button>
                              <button
                                class="text-red-600 hover:text-red-900 cursor-pointer whitespace-nowrap !rounded-button"
                              >
                                <i class="fas fa-trash-alt"></i>
                              </button>
                              <div class="relative">
                                <button
                                  class="text-gray-500 hover:text-gray-700 cursor-pointer whitespace-nowrap !rounded-button"
                                >
                                  <i class="fas fa-ellipsis-v"></i>
                                </button>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- Pagination -->
                  <div class="flex items-center justify-between">
                    <div class="flex-1 flex justify-between sm:hidden">
                      <a
                        href="#"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer"
                      >
                        Previous
                      </a>
                      <a
                        href="#"
                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer"
                      >
                        Next
                      </a>
                    </div>
                    <div
                      class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"
                    >
                      <div>
                        <p class="text-sm text-gray-700">
                          Showing <span class="font-medium">1</span> to
                          <span class="font-medium">10</span> of
                          <span class="font-medium">42</span> groups
                        </p>
                      </div>
                      <div>
                        <nav
                          class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                          aria-label="Pagination"
                        >
                          <a
                            href="#"
                            class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 cursor-pointer"
                          >
                            <span class="sr-only">Previous</span>
                            <i class="fas fa-chevron-left"></i>
                          </a>
                          <a
                            href="#"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-emerald-50 text-sm font-medium text-emerald-600 hover:bg-emerald-100 cursor-pointer"
                          >
                            1
                          </a>
                          <a
                            href="#"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer"
                          >
                            2
                          </a>
                          <a
                            href="#"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer"
                          >
                            3
                          </a>
                          <a
                            href="#"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer"
                          >
                            4
                          </a>
                          <a
                            href="#"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer"
                          >
                            5
                          </a>
                          <a
                            href="#"
                            class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 cursor-pointer"
                          >
                            <span class="sr-only">Next</span>
                            <i class="fas fa-chevron-right"></i>
                          </a>
                        </nav>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Content Moderation Tab -->
                <div v-if="activeTab === 'moderation'" class="space-y-6">
                  <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between gap-4"
                  >
                    <div class="flex-1">
                      <h3 class="text-lg font-medium text-gray-900">
                        Content Moderation
                      </h3>
                      <p class="mt-1 text-sm text-gray-500">
                        Review and moderate reported content across the platform
                      </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                      <button
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        <i class="fas fa-history mr-2"></i>
                        History
                      </button>
                      <button
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        <i class="fas fa-check-double mr-2"></i>
                        Approve All
                      </button>
                    </div>
                  </div>
                  <!-- Moderation Tabs -->
                  <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                      <button
                        v-for="(tab, index) in moderationTabs"
                        :key="index"
                        @click="activeModerationTab = tab.id"
                        :class="[
'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm cursor-pointer !rounded-button',
activeModerationTab === tab.id
? 'border-emerald-500 text-emerald-600'
: 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
]"
                      >
                        {{ tab.name }}
                        <span
                          :class="[
'ml-2 py-0.5 px-2 rounded-full text-xs',
activeModerationTab === tab.id
? 'bg-emerald-100 text-emerald-600'
: 'bg-gray-100 text-gray-600'
]"
                        >
                          {{ tab.count }}
                        </span>
                      </button>
                    </nav>
                  </div>
                  <!-- Reported Content -->
                  <div class="space-y-4">
                    <div
                      v-for="(report, index) in reportedContent"
                      :key="index"
                      class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden"
                    >
                      <div
                        class="p-4 border-b border-gray-200 bg-gray-50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2"
                      >
                        <div>
                          <div class="flex items-center">
                            <span
                              :class="[
'px-2 py-1 text-xs font-medium rounded-full',
report.type === 'Recipe' ? 'bg-blue-100 text-blue-800' :
report.type === 'Comment' ? 'bg-purple-100 text-purple-800' :
'bg-amber-100 text-amber-800'
]"
                            >
                              {{ report.type }}
                            </span>
                            <span class="ml-2 text-sm text-gray-500"
                              >Reported {{ report.timeAgo }}</span
                            >
                          </div>
                          <h4 class="mt-1 text-base font-medium text-gray-900">
                            {{ report.title }}
                          </h4>
                        </div>
                        <div class="flex items-center space-x-2">
                          <span
                            :class="[
'px-2 py-1 text-xs font-medium rounded-full',
report.reason === 'Inappropriate Content' ? 'bg-red-100 text-red-800' :
report.reason === 'Spam' ? 'bg-yellow-100 text-yellow-800' :
'bg-gray-100 text-gray-800'
]"
                          >
                            {{ report.reason }}
                          </span>
                          <span
                            class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800"
                          >
                            {{ report.reports }} reports
                          </span>
                        </div>
                      </div>
                      <div class="p-4">
                        <div class="flex items-start space-x-4">
                          <img
                            :src="report.userAvatar"
                            :alt="report.userName"
                            class="h-10 w-10 rounded-full object-cover"
                          />
                          <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">
                              {{ report.userName }}
                              <span class="text-gray-500 font-normal"
                                >{{ report.userRole }}</span
                              >
                            </p>
                            <p class="text-sm text-gray-500">
                              {{ report.content }}
                            </p>
                            <div v-if="report.image" class="mt-2">
                              <img
                                :src="report.image"
                                alt="Reported content"
                                class="h-32 w-auto rounded-md object-cover"
                              />
                            </div>
                          </div>
                        </div>
                        <div class="mt-4 flex justify-end space-x-3">
                          <button
                            class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                          >
                            <i class="fas fa-eye mr-1.5"></i>
                            View
                          </button>
                          <button
                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 cursor-pointer whitespace-nowrap !rounded-button"
                          >
                            <i class="fas fa-check mr-1.5"></i>
                            Approve
                          </button>
                          <button
                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 cursor-pointer whitespace-nowrap !rounded-button"
                          >
                            <i class="fas fa-ban mr-1.5"></i>
                            Remove
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Load More Button -->
                  <div class="text-center">
                    <button
                      class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                    >
                      Load More
                      <i class="fas fa-chevron-down ml-2"></i>
                    </button>
                  </div>
                </div>
                <!-- Site Configuration Tab -->
                <div v-if="activeTab === 'config'" class="space-y-6">
                  <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between gap-4"
                  >
                    <div class="flex-1">
                      <h3 class="text-lg font-medium text-gray-900">
                        Site Configuration
                      </h3>
                      <p class="mt-1 text-sm text-gray-500">
                        Manage global settings, appearance, and platform
                        functionality
                      </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                      <button
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        <i class="fas fa-undo mr-2"></i>
                        Reset
                      </button>
                      <button
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        <i class="fas fa-save mr-2"></i>
                        Save Changes
                      </button>
                    </div>
                  </div>
                  <!-- Configuration Sections -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- General Settings -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                      <div
                        class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200"
                      >
                        <h3 class="text-base font-medium text-gray-900">
                          General Settings
                        </h3>
                      </div>
                      <div class="p-4 space-y-4">
                        <div>
                          <label
                            for="site-name"
                            class="block text-sm font-medium text-gray-700"
                            >Site Name</label
                          >
                          <input
                            type="text"
                            id="site-name"
                            value="Family Recipe"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                          />
                        </div>
                        <div>
                          <label
                            for="site-description"
                            class="block text-sm font-medium text-gray-700"
                            >Site Description</label
                          >
                          <textarea
                            id="site-description"
                            rows="3"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                          >
Discover, create, and share delicious recipes from around the world.</textarea
                          >
                        </div>
                        <div>
                          <label
                            for="contact-email"
                            class="block text-sm font-medium text-gray-700"
                            >Contact Email</label
                          >
                          <input
                            type="email"
                            id="contact-email"
                            value="contact@Family Recipe.com"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                          />
                        </div>
                        <div>
                          <label
                            for="timezone"
                            class="block text-sm font-medium text-gray-700"
                            >Timezone</label
                          >
                          <select
                            id="timezone"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                          >
                            <option>UTC (GMT+0)</option>
                            <option selected>America/New_York (GMT-4)</option>
                            <option>Europe/London (GMT+1)</option>
                            <option>Asia/Tokyo (GMT+9)</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <!-- Appearance -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                      <div
                        class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200"
                      >
                        <h3 class="text-base font-medium text-gray-900">
                          Appearance
                        </h3>
                      </div>
                      <div class="p-4 space-y-4">
                        <div>
                          <label class="block text-sm font-medium text-gray-700"
                            >Theme</label
                          >
                          <div class="mt-2 grid grid-cols-3 gap-3">
                            <div class="flex items-center">
                              <input
                                id="theme-light"
                                name="theme"
                                type="radio"
                                checked
                                class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300"
                              />
                              <label
                                for="theme-light"
                                class="ml-2 block text-sm text-gray-700"
                              >
                                Light
                              </label>
                            </div>
                            <div class="flex items-center">
                              <input
                                id="theme-dark"
                                name="theme"
                                type="radio"
                                class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300"
                              />
                              <label
                                for="theme-dark"
                                class="ml-2 block text-sm text-gray-700"
                              >
                                Dark
                              </label>
                            </div>
                            <div class="flex items-center">
                              <input
                                id="theme-auto"
                                name="theme"
                                type="radio"
                                class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300"
                              />
                              <label
                                for="theme-auto"
                                class="ml-2 block text-sm text-gray-700"
                              >
                                Auto
                              </label>
                            </div>
                          </div>
                        </div>
                        <div>
                          <label class="block text-sm font-medium text-gray-700"
                            >Primary Color</label
                          >
                          <div class="mt-2 grid grid-cols-5 gap-3">
                            <div class="flex items-center">
                              <input
                                id="color-emerald"
                                name="color"
                                type="radio"
                                checked
                                class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300"
                              />
                              <label
                                for="color-emerald"
                                class="ml-2 block text-sm text-gray-700"
                              >
                                <div
                                  class="h-4 w-4 rounded-full bg-emerald-600"
                                ></div>
                              </label>
                            </div>
                            <div class="flex items-center">
                              <input
                                id="color-blue"
                                name="color"
                                type="radio"
                                class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300"
                              />
                              <label
                                for="color-blue"
                                class="ml-2 block text-sm text-gray-700"
                              >
                                <div
                                  class="h-4 w-4 rounded-full bg-blue-600"
                                ></div>
                              </label>
                            </div>
                            <div class="flex items-center">
                              <input
                                id="color-purple"
                                name="color"
                                type="radio"
                                class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300"
                              />
                              <label
                                for="color-purple"
                                class="ml-2 block text-sm text-gray-700"
                              >
                                <div
                                  class="h-4 w-4 rounded-full bg-purple-600"
                                ></div>
                              </label>
                            </div>
                            <div class="flex items-center">
                              <input
                                id="color-red"
                                name="color"
                                type="radio"
                                class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300"
                              />
                              <label
                                for="color-red"
                                class="ml-2 block text-sm text-gray-700"
                              >
                                <div
                                  class="h-4 w-4 rounded-full bg-red-600"
                                ></div>
                              </label>
                            </div>
                            <div class="flex items-center">
                              <input
                                id="color-amber"
                                name="color"
                                type="radio"
                                class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300"
                              />
                              <label
                                for="color-amber"
                                class="ml-2 block text-sm text-gray-700"
                              >
                                <div
                                  class="h-4 w-4 rounded-full bg-amber-600"
                                ></div>
                              </label>
                            </div>
                          </div>
                        </div>
                        <div>
                          <label class="block text-sm font-medium text-gray-700"
                            >Logo</label
                          >
                          <div class="mt-2 flex items-center space-x-4">
                            <img
                              :src="logoUrl"
                              alt="Logo"
                              class="h-10 w-auto"
                            />
                            <button
                              class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                            >
                              Change
                            </button>
                          </div>
                        </div>
                        <div>
                          <label class="block text-sm font-medium text-gray-700"
                            >Favicon</label
                          >
                          <div class="mt-2 flex items-center space-x-4">
                            <img
                              :src="logoUrl"
                              alt="Favicon"
                              class="h-6 w-auto"
                            />
                            <button
                              class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                            >
                              Change
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Features & Permissions -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                      <div
                        class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200"
                      >
                        <h3 class="text-base font-medium text-gray-900">
                          Features & Permissions
                        </h3>
                      </div>
                      <div class="p-4 space-y-4">
                        <div>
                          <div class="flex items-center justify-between">
                            <label
                              for="user-registration"
                              class="text-sm font-medium text-gray-700"
                              >User Registration</label
                            >
                            <div
                              class="relative inline-block w-10 mr-2 align-middle select-none"
                            >
                              <input
                                type="checkbox"
                                id="user-registration"
                                checked
                                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer"
                              />
                              <label
                                for="user-registration"
                                class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                              ></label>
                            </div>
                          </div>
                          <p class="mt-1 text-xs text-gray-500">
                            Allow new users to register on the platform
                          </p>
                        </div>
                        <div>
                          <div class="flex items-center justify-between">
                            <label
                              for="user-groups"
                              class="text-sm font-medium text-gray-700"
                              >User Groups</label
                            >
                            <div
                              class="relative inline-block w-10 mr-2 align-middle select-none"
                            >
                              <input
                                type="checkbox"
                                id="user-groups"
                                checked
                                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer"
                              />
                              <label
                                for="user-groups"
                                class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                              ></label>
                            </div>
                          </div>
                          <p class="mt-1 text-xs text-gray-500">
                            Enable user-created cooking groups
                          </p>
                        </div>
                        <div>
                          <div class="flex items-center justify-between">
                            <label
                              for="recipe-comments"
                              class="text-sm font-medium text-gray-700"
                              >Recipe Comments</label
                            >
                            <div
                              class="relative inline-block w-10 mr-2 align-middle select-none"
                            >
                              <input
                                type="checkbox"
                                id="recipe-comments"
                                checked
                                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer"
                              />
                              <label
                                for="recipe-comments"
                                class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                              ></label>
                            </div>
                          </div>
                          <p class="mt-1 text-xs text-gray-500">
                            Allow users to comment on recipes
                          </p>
                        </div>
                        <div>
                          <div class="flex items-center justify-between">
                            <label
                              for="recipe-ratings"
                              class="text-sm font-medium text-gray-700"
                              >Recipe Ratings</label
                            >
                            <div
                              class="relative inline-block w-10 mr-2 align-middle select-none"
                            >
                              <input
                                type="checkbox"
                                id="recipe-ratings"
                                checked
                                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer"
                              />
                              <label
                                for="recipe-ratings"
                                class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                              ></label>
                            </div>
                          </div>
                          <p class="mt-1 text-xs text-gray-500">
                            Allow users to rate recipes
                          </p>
                        </div>
                        <div>
                          <div class="flex items-center justify-between">
                            <label
                              for="content-moderation"
                              class="text-sm font-medium text-gray-700"
                              >Content Moderation</label
                            >
                            <div
                              class="relative inline-block w-10 mr-2 align-middle select-none"
                            >
                              <input
                                type="checkbox"
                                id="content-moderation"
                                checked
                                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer"
                              />
                              <label
                                for="content-moderation"
                                class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                              ></label>
                            </div>
                          </div>
                          <p class="mt-1 text-xs text-gray-500">
                            Enable content reporting and moderation
                          </p>
                        </div>
                      </div>
                    </div>
                    <!-- Email Settings -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                      <div
                        class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200"
                      >
                        <h3 class="text-base font-medium text-gray-900">
                          Email Settings
                        </h3>
                      </div>
                      <div class="p-4 space-y-4">
                        <div>
                          <label
                            for="smtp-host"
                            class="block text-sm font-medium text-gray-700"
                            >SMTP Host</label
                          >
                          <input
                            type="text"
                            id="smtp-host"
                            value="smtp.example.com"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                          />
                        </div>
                        <div>
                          <label
                            for="smtp-port"
                            class="block text-sm font-medium text-gray-700"
                            >SMTP Port</label
                          >
                          <input
                            type="text"
                            id="smtp-port"
                            value="587"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                          />
                        </div>
                        <div>
                          <label
                            for="smtp-username"
                            class="block text-sm font-medium text-gray-700"
                            >SMTP Username</label
                          >
                          <input
                            type="text"
                            id="smtp-username"
                            value="noreply@Family Recipe.com"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                          />
                        </div>
                        <div>
                          <label
                            for="smtp-password"
                            class="block text-sm font-medium text-gray-700"
                            >SMTP Password</label
                          >
                          <input
                            type="password"
                            id="smtp-password"
                            value="••••••••••••"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                          />
                        </div>
                        <div>
                          <button
                            class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                          >
                            Test Connection
                          </button>
                        </div>
                      </div>
                    </div>
                    <!-- API & Integrations -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                      <div
                        class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200"
                      >
                        <h3 class="text-base font-medium text-gray-900">
                          API & Integrations
                        </h3>
                      </div>
                      <div class="p-4 space-y-4">
                        <div>
                          <div class="flex items-center justify-between">
                            <label
                              for="api-access"
                              class="text-sm font-medium text-gray-700"
                              >API Access</label
                            >
                            <div
                              class="relative inline-block w-10 mr-2 align-middle select-none"
                            >
                              <input
                                type="checkbox"
                                id="api-access"
                                checked
                                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer"
                              />
                              <label
                                for="api-access"
                                class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                              ></label>
                            </div>
                          </div>
                          <p class="mt-1 text-xs text-gray-500">
                            Enable API access for third-party applications
                          </p>
                        </div>
                        <div>
                          <label
                            for="api-key"
                            class="block text-sm font-medium text-gray-700"
                            >API Key</label
                          >
                          <div class="mt-1 flex rounded-md shadow-sm">
                            <input
                              type="text"
                              id="api-key"
                              value="cb_api_1a2b3c4d5e6f7g8h9i0j"
                              readonly
                              class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-l-md border border-gray-300 bg-gray-50 text-gray-500 sm:text-sm"
                            />
                            <button
                              class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-gray-50 text-gray-500 rounded-r-md hover:bg-gray-100 cursor-pointer whitespace-nowrap !rounded-button"
                            >
                              <i class="fas fa-copy"></i>
                            </button>
                          </div>
                        </div>
                        <div>
                          <label class="block text-sm font-medium text-gray-700"
                            >Social Media Integration</label
                          >
                          <div class="mt-2 space-y-2">
                            <div class="flex items-center justify-between">
                              <div class="flex items-center">
                                <i
                                  class="fab fa-facebook text-blue-600 text-xl w-6"
                                ></i>
                                <span class="ml-2 text-sm text-gray-700"
                                  >Facebook</span
                                >
                              </div>
                              <div
                                class="relative inline-block w-10 mr-2 align-middle select-none"
                              >
                                <input
                                  type="checkbox"
                                  id="facebook-integration"
                                  checked
                                  class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer"
                                />
                                <label
                                  for="facebook-integration"
                                  class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                                ></label>
                              </div>
                            </div>
                            <div class="flex items-center justify-between">
                              <div class="flex items-center">
                                <i
                                  class="fab fa-twitter text-blue-400 text-xl w-6"
                                ></i>
                                <span class="ml-2 text-sm text-gray-700"
                                  >Twitter</span
                                >
                              </div>
                              <div
                                class="relative inline-block w-10 mr-2 align-middle select-none"
                              >
                                <input
                                  type="checkbox"
                                  id="twitter-integration"
                                  checked
                                  class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer"
                                />
                                <label
                                  for="twitter-integration"
                                  class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                                ></label>
                              </div>
                            </div>
                            <div class="flex items-center justify-between">
                              <div class="flex items-center">
                                <i
                                  class="fab fa-instagram text-pink-600 text-xl w-6"
                                ></i>
                                <span class="ml-2 text-sm text-gray-700"
                                  >Instagram</span
                                >
                              </div>
                              <div
                                class="relative inline-block w-10 mr-2 align-middle select-none"
                              >
                                <input
                                  type="checkbox"
                                  id="instagram-integration"
                                  class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer"
                                />
                                <label
                                  for="instagram-integration"
                                  class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                                ></label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Security Settings -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                      <div
                        class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200"
                      >
                        <h3 class="text-base font-medium text-gray-900">
                          Security Settings
                        </h3>
                      </div>
                      <div class="p-4 space-y-4">
                        <div>
                          <div class="flex items-center justify-between">
                            <label
                              for="two-factor-auth"
                              class="text-sm font-medium text-gray-700"
                              >Two-Factor Authentication</label
                            >
                            <div
                              class="relative inline-block w-10 mr-2 align-middle select-none"
                            >
                              <input
                                type="checkbox"
                                id="two-factor-auth"
                                checked
                                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer"
                              />
                              <label
                                for="two-factor-auth"
                                class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                              ></label>
                            </div>
                          </div>
                          <p class="mt-1 text-xs text-gray-500">
                            Require 2FA for admin accounts
                          </p>
                        </div>
                        <div>
                          <label
                            for="password-policy"
                            class="block text-sm font-medium text-gray-700"
                            >Password Policy</label
                          >
                          <select
                            id="password-policy"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                          >
                            <option>Basic (8+ characters)</option>
                            <option selected>
                              Standard (8+ chars, 1 uppercase, 1 number)
                            </option>
                            <option>
                              Strong (10+ chars, uppercase, number, symbol)
                            </option>
                          </select>
                        </div>
                        <div>
                          <label
                            for="session-timeout"
                            class="block text-sm font-medium text-gray-700"
                            >Session Timeout</label
                          >
                          <select
                            id="session-timeout"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                          >
                            <option>30 minutes</option>
                            <option selected>1 hour</option>
                            <option>4 hours</option>
                            <option>8 hours</option>
                            <option>24 hours</option>
                          </select>
                        </div>
                        <div>
                          <div class="flex items-center justify-between">
                            <label
                              for="captcha"
                              class="text-sm font-medium text-gray-700"
                              >CAPTCHA on Forms</label
                            >
                            <div
                              class="relative inline-block w-10 mr-2 align-middle select-none"
                            >
                              <input
                                type="checkbox"
                                id="captcha"
                                checked
                                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer"
                              />
                              <label
                                for="captcha"
                                class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                              ></label>
                            </div>
                          </div>
                          <p class="mt-1 text-xs text-gray-500">
                            Enable CAPTCHA on registration and contact forms
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Analytics Tab -->
                <div v-if="activeTab === 'analytics'" class="space-y-6">
                  <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between gap-4"
                  >
                    <div class="flex-1">
                      <h3 class="text-lg font-medium text-gray-900">
                        Analytics & Reports
                      </h3>
                      <p class="mt-1 text-sm text-gray-500">
                        View platform statistics, user activity, and content
                        metrics
                      </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                      <div class="relative inline-block text-left">
                        <button
                          class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                        >
                          <i class="fas fa-calendar-alt mr-2"></i>
                          Last 30 Days
                          <i class="fas fa-chevron-down ml-2"></i>
                        </button>
                      </div>
                      <button
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        <i class="fas fa-download mr-2"></i>
                        Export
                      </button>
                    </div>
                  </div>
                  <!-- Analytics Overview -->
                  <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5"
                  >
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                      <div class="p-5">
                        <div class="flex items-center">
                          <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                            <i class="fas fa-eye text-blue-600 text-xl"></i>
                          </div>
                          <div class="ml-5 w-0 flex-1">
                            <dl>
                              <dt
                                class="text-sm font-medium text-gray-500 truncate"
                              >
                                Page Views
                              </dt>
                              <dd class="flex items-baseline">
                                <div
                                  class="text-2xl font-semibold text-gray-900"
                                >
                                  245,128
                                </div>
                                <div
                                  class="ml-2 flex items-baseline text-sm font-semibold text-green-600"
                                >
                                  <i class="fas fa-arrow-up"></i>
                                  <span class="sr-only">Increased by</span>
                                  14.5%
                                </div>
                              </dd>
                            </dl>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                      <div class="p-5">
                        <div class="flex items-center">
                          <div
                            class="flex-shrink-0 bg-green-100 rounded-md p-3"
                          >
                            <i
                              class="fas fa-user-plus text-green-600 text-xl"
                            ></i>
                          </div>
                          <div class="ml-5 w-0 flex-1">
                            <dl>
                              <dt
                                class="text-sm font-medium text-gray-500 truncate"
                              >
                                New Users
                              </dt>
                              <dd class="flex items-baseline">
                                <div
                                  class="text-2xl font-semibold text-gray-900"
                                >
                                  1,432
                                </div>
                                <div
                                  class="ml-2 flex items-baseline text-sm font-semibold text-green-600"
                                >
                                  <i class="fas fa-arrow-up"></i>
                                  <span class="sr-only">Increased by</span>
                                  8.2%
                                </div>
                              </dd>
                            </dl>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                      <div class="p-5">
                        <div class="flex items-center">
                          <div
                            class="flex-shrink-0 bg-amber-100 rounded-md p-3"
                          >
                            <i
                              class="fas fa-utensils text-amber-600 text-xl"
                            ></i>
                          </div>
                          <div class="ml-5 w-0 flex-1">
                            <dl>
                              <dt
                                class="text-sm font-medium text-gray-500 truncate"
                              >
                                New Recipes
                              </dt>
                              <dd class="flex items-baseline">
                                <div
                                  class="text-2xl font-semibold text-gray-900"
                                >
                                  842
                                </div>
                                <div
                                  class="ml-2 flex items-baseline text-sm font-semibold text-green-600"
                                >
                                  <i class="fas fa-arrow-up"></i>
                                  <span class="sr-only">Increased by</span>
                                  5.7%
                                </div>
                              </dd>
                            </dl>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                      <div class="p-5">
                        <div class="flex items-center">
                          <div
                            class="flex-shrink-0 bg-purple-100 rounded-md p-3"
                          >
                            <i
                              class="fas fa-comment text-purple-600 text-xl"
                            ></i>
                          </div>
                          <div class="ml-5 w-0 flex-1">
                            <dl>
                              <dt
                                class="text-sm font-medium text-gray-500 truncate"
                              >
                                Comments
                              </dt>
                              <dd class="flex items-baseline">
                                <div
                                  class="text-2xl font-semibold text-gray-900"
                                >
                                  3,754
                                </div>
                                <div
                                  class="ml-2 flex items-baseline text-sm font-semibold text-green-600"
                                >
                                  <i class="fas fa-arrow-up"></i>
                                  <span class="sr-only">Increased by</span>
                                  12.3%
                                </div>
                              </dd>
                            </dl>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Charts -->
                  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- User Growth Chart -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                      <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-base font-medium text-gray-900">
                          User Growth
                        </h3>
                      </div>
                      <div class="p-4 h-80">
                        <div ref="userGrowthChart" class="h-full w-full"></div>
                      </div>
                    </div>
                    <!-- Content Activity Chart -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                      <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-base font-medium text-gray-900">
                          Content Activity
                        </h3>
                      </div>
                      <div class="p-4 h-80">
                        <div
                          ref="contentActivityChart"
                          class="h-full w-full"
                        ></div>
                      </div>
                    </div>
                    <!-- Traffic Sources Chart -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                      <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-base font-medium text-gray-900">
                          Traffic Sources
                        </h3>
                      </div>
                      <div class="p-4 h-80">
                        <div
                          ref="trafficSourcesChart"
                          class="h-full w-full"
                        ></div>
                      </div>
                    </div>
                    <!-- Popular Categories Chart -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                      <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-base font-medium text-gray-900">
                          Popular Categories
                        </h3>
                      </div>
                      <div class="p-4 h-80">
                        <div
                          ref="popularCategoriesChart"
                          class="h-full w-full"
                        ></div>
                      </div>
                    </div>
                  </div>
                  <!-- Recent Activity -->
                  <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                      <h3 class="text-base font-medium text-gray-900">
                        Recent Activity
                      </h3>
                    </div>
                    <div class="p-4">
                      <ul class="space-y-4">
                        <li
                          v-for="(activity, index) in recentActivities"
                          :key="index"
                          class="flex items-start space-x-3"
                        >
                          <div
                            :class="[
'flex-shrink-0 h-8 w-8 rounded-full flex items-center justify-center',
activity.type === 'user' ? 'bg-blue-100' :
activity.type === 'recipe' ? 'bg-green-100' :
activity.type === 'comment' ? 'bg-purple-100' :
'bg-amber-100'
]"
                          >
                            <i
                              :class="[
'text-sm',
activity.type === 'user' ? 'fas fa-user text-blue-600' :
activity.type === 'recipe' ? 'fas fa-utensils text-green-600' :
activity.type === 'comment' ? 'fas fa-comment text-purple-600' :
'fas fa-star text-amber-600'
]"
                            ></i>
                          </div>
                          <div class="flex-1 min-w-0">
                            <p
                              class="text-sm text-gray-800"
                              v-html="activity.message"
                            ></p>
                            <p class="text-xs text-gray-500 mt-0.5">
                              {{ activity.time }}
                            </p>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { ref, onMounted } from "vue";
import * as echarts from "echarts";
// Logo and Avatar
const logoUrl =
  "https://readdy.ai/api/search-image?query=minimalist%20cooking%20logo%20with%20a%20chef%20hat%20and%20spoon%20clean%20design%20professional%20modern%20flat%20design%20vector%20style%20green%20color%20scheme%20suitable%20for%20a%20cooking%20app&width=200&height=200&seq=1&orientation=squarish";
const adminAvatar =
  "https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20young%20man%20with%20short%20brown%20hair%20and%20friendly%20smile%20neutral%20background%20high%20quality%20portrait%20photo&width=100&height=100&seq=2&orientation=squarish";
// UI State
const isMobileSidebarOpen = ref(false);
const showUserMenu = ref(false);
const showRoleFilter = ref(false);
const showStatusFilter = ref(false);
const activeUserActions = ref<number | null>(null);
const activeTab = ref("users");
const activeModerationTab = ref("pending");
// Toggle functions
const toggleSidebar = () => {
  isMobileSidebarOpen.value = !isMobileSidebarOpen.value;
};
const toggleUserMenu = () => {
  showUserMenu.value = !showUserMenu.value;
};
const toggleRoleFilter = () => {
  showRoleFilter.value = !showRoleFilter.value;
  showStatusFilter.value = false;
};
const toggleStatusFilter = () => {
  showStatusFilter.value = !showStatusFilter.value;
  showRoleFilter.value = false;
};
const toggleUserActions = (index: number) => {
  activeUserActions.value = activeUserActions.value === index ? null : index;
};
// Tab definitions
const tabs = [
  { id: "users", name: "User Management", icon: "fas fa-users" },
  { id: "groups", name: "Group Management", icon: "fas fa-user-friends" },
  { id: "moderation", name: "Content Moderation", icon: "fas fa-shield-alt" },
  { id: "config", name: "Site Configuration", icon: "fas fa-cogs" },
  { id: "analytics", name: "Analytics", icon: "fas fa-chart-line" },
];
// Moderation tabs
const moderationTabs = [
  { id: "pending", name: "Pending Review", count: 18 },
  { id: "approved", name: "Approved", count: 245 },
  { id: "rejected", name: "Rejected", count: 32 },
];
// Sample data for users
const users = [
  {
    name: "John Doe",
    email: "john.doe@example.com",
    role: "Admin",
    status: "Active",
    joined: "Jan 15, 2025",
    lastActive: "2 hours ago",
    avatar:
      "https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20young%20man%20with%20short%20brown%20hair%20and%20friendly%20smile%20neutral%20background%20high%20quality%20portrait%20photo&width=100&height=100&seq=3&orientation=squarish",
  },
  {
    name: "Sarah Johnson",
    email: "sarah.j@example.com",
    role: "Moderator",
    status: "Active",
    joined: "Feb 3, 2025",
    lastActive: "1 day ago",
    avatar:
      "https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20young%20woman%20with%20long%20brown%20hair%20and%20warm%20smile%20natural%20lighting%20neutral%20background%20high%20quality%20portrait%20photo&width=100&height=100&seq=4&orientation=squarish",
  },
  {
    name: "Michael Chen",
    email: "michael.c@example.com",
    role: "User",
    status: "Active",
    joined: "Mar 12, 2025",
    lastActive: "3 days ago",
    avatar:
      "https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20young%20asian%20man%20with%20glasses%20and%20friendly%20expression%20neutral%20background%20high%20quality%20portrait%20photo&width=100&height=100&seq=5&orientation=squarish",
  },
  {
    name: "Emily Rodriguez",
    email: "emily.r@example.com",
    role: "User",
    status: "Pending",
    joined: "Apr 5, 2025",
    lastActive: "Never",
    avatar:
      "https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20latina%20woman%20with%20dark%20hair%20and%20warm%20smile%20natural%20lighting%20neutral%20background%20high%20quality%20portrait%20photo&width=100&height=100&seq=6&orientation=squarish",
  },
  {
    name: "David Kim",
    email: "d.kim@example.com",
    role: "Moderator",
    status: "Suspended",
    joined: "Dec 8, 2024",
    lastActive: "2 weeks ago",
    avatar:
      "https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20middle%20aged%20asian%20man%20with%20short%20black%20hair%20and%20serious%20expression%20neutral%20background%20high%20quality%20portrait%20photo&width=100&height=100&seq=7&orientation=squarish",
  },
];
// Sample data for groups
const groups = [
  {
    name: "Italian Cuisine Lovers",
    owner: "John Doe",
    privacy: "Public",
    members: 128,
    created: "Jan 10, 2025",
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=italian%20cuisine%20ingredients%20on%20rustic%20wooden%20table%20with%20pasta%20tomatoes%20basil%20olive%20oil%20parmesan%20cheese%20and%20garlic%20warm%20mediterranean%20lighting%20authentic%20food%20photography%20high%20resolution%20appetizing%20presentation&width=100&height=100&seq=8&orientation=squarish",
  },
  {
    name: "Baking Enthusiasts",
    owner: "Sarah Johnson",
    privacy: "Public",
    members: 256,
    created: "Feb 15, 2025",
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=freshly%20baked%20bread%20and%20pastries%20on%20a%20wooden%20table%20with%20flour%20rolling%20pin%20and%20baking%20ingredients%20warm%20cozy%20bakery%20atmosphere%20soft%20natural%20lighting%20high%20resolution%20appetizing%20presentation%20of%20homemade%20baked%20goods&width=100&height=100&seq=9&orientation=squarish",
  },
  {
    name: "Vegetarian Recipes",
    owner: "Michael Chen",
    privacy: "Public",
    members: 189,
    created: "Mar 5, 2025",
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=colorful%20vegetarian%20food%20spread%20with%20fresh%20vegetables%20legumes%20grains%20and%20herbs%20on%20a%20table%20vibrant%20healthy%20meal%20preparation%20bright%20natural%20lighting%20high%20resolution%20appetizing%20presentation%20of%20plant%20based%20cuisine&width=100&height=100&seq=10&orientation=squarish",
  },
  {
    name: "Family Meal Planning",
    owner: "Emily Rodriguez",
    privacy: "Private",
    members: 142,
    created: "Mar 20, 2025",
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=family%20gathered%20around%20dining%20table%20with%20homemade%20meal%20parents%20and%20children%20enjoying%20dinner%20together%20warm%20home%20atmosphere%20natural%20lighting%20high%20resolution%20lifestyle%20photography%20showing%20family%20mealtime%20and%20food%20sharing&width=100&height=100&seq=11&orientation=squarish",
  },
  {
    name: "Asian Fusion Cooking",
    owner: "David Kim",
    privacy: "Public",
    members: 98,
    created: "Apr 2, 2025",
    status: "Archived",
    image:
      "https://readdy.ai/api/search-image?query=asian%20fusion%20dishes%20with%20colorful%20ingredients%20and%20presentation%20modern%20take%20on%20traditional%20asian%20cuisine%20vibrant%20food%20styling%20professional%20lighting%20high%20resolution%20appetizing%20presentation%20of%20sushi%20noodles%20and%20stir%20fry%20dishes&width=100&height=100&seq=12&orientation=squarish",
  },
];
// Sample data for reported content
const reportedContent = [
  {
    type: "Recipe",
    timeAgo: "2 hours ago",
    title: "Inappropriate Recipe Title",
    reason: "Inappropriate Content",
    reports: 3,
    userName: "User123",
    userRole: "• Member",
    userAvatar:
      "https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20young%20man%20with%20beard%20and%20casual%20style%20neutral%20background%20high%20quality%20portrait%20photo&width=100&height=100&seq=13&orientation=squarish",
    content:
      "This recipe contains inappropriate language in the title and instructions that violate our community guidelines.",
    image:
      "https://readdy.ai/api/search-image?query=close%20up%20of%20a%20dish%20with%20text%20overlay%20showing%20recipe%20title%20professional%20food%20photography%20with%20bright%20lighting%20and%20clean%20presentation%20on%20white%20plate%20high%20resolution%20appetizing%20presentation&width=300&height=200&seq=14&orientation=landscape",
  },
  {
    type: "Comment",
    timeAgo: "5 hours ago",
    title: "Offensive Comment on Pasta Recipe",
    reason: "Harassment",
    reports: 2,
    userName: "CookingFan42",
    userRole: "• New Member",
    userAvatar:
      "https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20middle%20aged%20woman%20with%20short%20hair%20and%20glasses%20neutral%20background%20high%20quality%20portrait%20photo&width=100&height=100&seq=15&orientation=squarish",
    content:
      "This comment contains personal attacks against another user and uses offensive language that violates our community standards.",
    image: null,
  },
  {
    type: "User Profile",
    timeAgo: "1 day ago",
    title: "Suspicious User Activity",
    reason: "Spam",
    reports: 5,
    userName: "SpamBot2025",
    userRole: "• New Member",
    userAvatar:
      "https://readdy.ai/api/search-image?query=generic%20avatar%20silhouette%20placeholder%20with%20gray%20background%20simple%20minimal%20design%20high%20quality%20vector%20style&width=100&height=100&seq=16&orientation=squarish",
    content:
      "This user has been posting the same promotional content across multiple recipe comments, including external links to commercial websites.",
    image: null,
  },
];
// Sample data for recent activities
const recentActivities = [
  {
    type: "user",
    message:
      '<span class="font-medium">Sarah Johnson</span> registered a new account',
    time: "2 hours ago",
  },
  {
    type: "recipe",
    message:
      '<span class="font-medium">John Doe</span> published a new recipe: <span class="text-emerald-600">Italian Carbonara</span>',
    time: "3 hours ago",
  },
  {
    type: "comment",
    message:
      '<span class="font-medium">Michael Chen</span> commented on <span class="text-emerald-600">Vegetarian Pad Thai</span>',
    time: "5 hours ago",
  },
  {
    type: "rating",
    message:
      '<span class="font-medium">Emily Rodriguez</span> rated <span class="text-emerald-600">Chocolate Chip Cookies</span> 5 stars',
    time: "6 hours ago",
  },
  {
    type: "user",
    message:
      'Admin <span class="font-medium">David Kim</span> updated user permissions',
    time: "1 day ago",
  },
  {
    type: "recipe",
    message:
      '<span class="font-medium">Lisa Wong</span> updated recipe: <span class="text-emerald-600">Beef Stir Fry</span>',
    time: "1 day ago",
  },
  {
    type: "comment",
    message:
      'Moderator <span class="font-medium">Sarah Johnson</span> removed a comment from <span class="text-emerald-600">Sourdough Bread</span>',
    time: "2 days ago",
  },
];
// Chart references
const userGrowthChart = ref<HTMLElement | null>(null);
const contentActivityChart = ref<HTMLElement | null>(null);
const trafficSourcesChart = ref<HTMLElement | null>(null);
const popularCategoriesChart = ref<HTMLElement | null>(null);
onMounted(() => {
  // Initialize charts
  if (userGrowthChart.value) {
    const chart = echarts.init(userGrowthChart.value);
    chart.setOption({
      animation: false,
      tooltip: {
        trigger: "axis",
      },
      grid: {
        left: "3%",
        right: "4%",
        bottom: "3%",
        containLabel: true,
      },
      xAxis: {
        type: "category",
        boundaryGap: false,
        data: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
      },
      yAxis: {
        type: "value",
      },
      series: [
        {
          name: "New Users",
          type: "line",
          smooth: true,
          lineStyle: {
            color: "#10b981",
            width: 4,
          },
          areaStyle: {
            color: {
              type: "linear",
              x: 0,
              y: 0,
              x2: 0,
              y2: 1,
              colorStops: [
                {
                  offset: 0,
                  color: "rgba(16, 185, 129, 0.3)",
                },
                {
                  offset: 1,
                  color: "rgba(16, 185, 129, 0.05)",
                },
              ],
            },
          },
          data: [420, 532, 601, 834, 1290, 1432],
        },
      ],
    });
  }
  if (contentActivityChart.value) {
    const chart = echarts.init(contentActivityChart.value);
    chart.setOption({
      animation: false,
      tooltip: {
        trigger: "axis",
        axisPointer: {
          type: "shadow",
        },
      },
      legend: {
        data: ["Recipes", "Comments", "Ratings"],
      },
      grid: {
        left: "3%",
        right: "4%",
        bottom: "3%",
        containLabel: true,
      },
      xAxis: {
        type: "category",
        data: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
      },
      yAxis: {
        type: "value",
      },
      series: [
        {
          name: "Recipes",
          type: "bar",
          stack: "total",
          emphasis: {
            focus: "series",
          },
          color: "#10b981",
          data: [320, 302, 301, 334, 390, 330],
        },
        {
          name: "Comments",
          type: "bar",
          stack: "total",
          emphasis: {
            focus: "series",
          },
          color: "#8b5cf6",
          data: [120, 132, 101, 134, 90, 230],
        },
        {
          name: "Ratings",
          type: "bar",
          stack: "total",
          emphasis: {
            focus: "series",
          },
          color: "#f59e0b",
          data: [220, 182, 191, 234, 290, 330],
        },
      ],
    });
  }
  if (trafficSourcesChart.value) {
    const chart = echarts.init(trafficSourcesChart.value);
    chart.setOption({
      animation: false,
      tooltip: {
        trigger: "item",
      },
      legend: {
        orient: "vertical",
        left: "left",
      },
      series: [
        {
          name: "Traffic Source",
          type: "pie",
          radius: "70%",
          center: ["50%", "50%"],
          data: [
            { value: 48, name: "Direct" },
            { value: 32, name: "Search" },
            { value: 12, name: "Social Media" },
            { value: 8, name: "Referral" },
          ],
          emphasis: {
            itemStyle: {
              shadowBlur: 10,
              shadowOffsetX: 0,
              shadowColor: "rgba(0, 0, 0, 0.5)",
            },
          },
          color: ["#10b981", "#3b82f6", "#8b5cf6", "#f59e0b"],
        },
      ],
    });
  }
  if (popularCategoriesChart.value) {
    const chart = echarts.init(popularCategoriesChart.value);
    chart.setOption({
      animation: false,
      tooltip: {
        trigger: "axis",
        axisPointer: {
          type: "shadow",
        },
      },
      grid: {
        left: "3%",
        right: "4%",
        bottom: "3%",
        containLabel: true,
      },
      xAxis: {
        type: "value",
      },
      yAxis: {
        type: "category",
        data: [
          "Italian",
          "Desserts",
          "Vegetarian",
          "Asian",
          "Baking",
          "Quick Meals",
        ],
      },
      series: [
        {
          name: "Recipes",
          type: "bar",
          data: [845, 742, 654, 590, 520, 482],
          color: "#10b981",
        },
      ],
    });
  }
  // Close dropdowns when clicking outside
  document.addEventListener("click", (e) => {
    const target = e.target as HTMLElement;
    if (showUserMenu.value && !target.closest(".user-menu")) {
      showUserMenu.value = false;
    }
    if (showRoleFilter.value && !target.closest(".role-filter")) {
      showRoleFilter.value = false;
    }
    if (showStatusFilter.value && !target.closest(".status-filter")) {
      showStatusFilter.value = false;
    }
    if (activeUserActions.value !== null && !target.closest(".user-actions")) {
      activeUserActions.value = null;
    }
  });
  // Resize charts on window resize
  window.addEventListener("resize", () => {
    if (userGrowthChart.value) {
      const chart = echarts.getInstanceByDom(userGrowthChart.value);
      chart?.resize();
    }
    if (contentActivityChart.value) {
      const chart = echarts.getInstanceByDom(contentActivityChart.value);
      chart?.resize();
    }
    if (trafficSourcesChart.value) {
      const chart = echarts.getInstanceByDom(trafficSourcesChart.value);
      chart?.resize();
    }
    if (popularCategoriesChart.value) {
      const chart = echarts.getInstanceByDom(popularCategoriesChart.value);
      chart?.resize();
    }
  });
});
</script>

<style scoped>
/* Toggle Switch Styles */
.toggle-checkbox:checked {
  right: 0;
  border-color: #10b981;
}
.toggle-checkbox:checked + .toggle-label {
  background-color: #10b981;
}
.toggle-checkbox {
  right: 0;
  transition: all 0.3s;
}
.toggle-label {
  transition: background-color 0.3s ease;
}
</style>
