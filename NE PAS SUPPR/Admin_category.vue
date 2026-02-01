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
          <img :src="logoUrl" alt="CookBook" class="h-10 w-auto" />
          <h1 class="ml-2 text-xl font-bold text-emerald-600">CookBook</h1>
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
            href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/b6d9bf3c-6e71-4b8a-8050-62a0d626260a"
            data-readdy="true"
            class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
          >
            <i class="fas fa-carrot w-5 h-5 mr-3 text-gray-500"></i>
            Ingredient Management
          </a>
          <a
            href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/43e71165-096b-40be-8d15-7246ea575e8f"
            data-readdy="true"
            class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg bg-emerald-50 text-emerald-700 cursor-pointer"
          >
            <i class="fas fa-tags w-5 h-5 mr-3 text-emerald-600"></i>
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
            class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
          >
            <i class="fas fa-cogs w-5 h-5 mr-3 text-gray-500"></i>
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
            <a
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/43e71165-096b-40be-8d15-7246ea575e8f"
              data-readdy="true"
              class="hover:text-emerald-600 cursor-pointer"
              >Admin Settings</a
            >
            <i class="fas fa-chevron-right mx-2 text-xs text-gray-400"></i>
            <span class="text-emerald-600 font-medium"
              >Category Management</span
            >
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
              <img :src="logoUrl" alt="CookBook" class="h-10 w-auto" />
              <h1 class="ml-2 text-xl font-bold text-emerald-600">CookBook</h1>
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
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/b6d9bf3c-6e71-4b8a-8050-62a0d626260a"
              data-readdy="true"
              class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
            >
              <i class="fas fa-carrot w-5 h-5 mr-3 text-gray-500"></i>
              Ingredient Management
            </a>
            <a
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/43e71165-096b-40be-8d15-7246ea575e8f"
              data-readdy="true"
              class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg bg-emerald-50 text-emerald-700 cursor-pointer"
            >
              <i class="fas fa-tags w-5 h-5 mr-3 text-emerald-600"></i>
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
              class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
            >
              <i class="fas fa-cogs w-5 h-5 mr-3 text-gray-500"></i>
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
              <h1 class="text-3xl font-bold text-gray-900">
                Category Management
              </h1>
              <p class="mt-1 text-sm text-gray-600">
                Create, organize, and manage recipe categories for better
                content organization
              </p>
            </div>
            <!-- Category Management Content -->
            <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
              <!-- Header with Actions -->
              <div
                class="px-6 py-5 border-b border-gray-200 bg-white flex flex-col md:flex-row md:items-center md:justify-between gap-4"
              >
                <div class="flex-1">
                  <h3 class="text-lg font-medium text-gray-900">
                    Recipe Categories
                  </h3>
                  <p class="mt-1 text-sm text-gray-500">
                    Manage categories and their associated recipes
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
                    @click="openAddCategoryModal"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 cursor-pointer whitespace-nowrap !rounded-button"
                  >
                    <i class="fas fa-plus mr-2"></i>
                    Add Category
                  </button>
                </div>
              </div>
              <!-- Search and Filters -->
              <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex flex-col sm:flex-row gap-4">
                  <div class="relative flex-grow">
                    <div
                      class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                    >
                      <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input
                      v-model="searchQuery"
                      type="text"
                      placeholder="Search categories..."
                      class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    />
                  </div>
                  <div class="flex flex-wrap gap-2">
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
                            @click.prevent="filterByStatus('All')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >All Statuses</a
                          >
                          <a
                            href="#"
                            @click.prevent="filterByStatus('Active')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >Active</a
                          >
                          <a
                            href="#"
                            @click.prevent="filterByStatus('Inactive')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >Inactive</a
                          >
                        </div>
                      </div>
                    </div>
                    <div class="relative inline-block text-left">
                      <button
                        @click="toggleRecipeCountFilter"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        <i class="fas fa-sort-amount-down mr-2"></i>
                        Recipe Count
                        <i class="fas fa-chevron-down ml-2"></i>
                      </button>
                      <div
                        v-if="showRecipeCountFilter"
                        class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10"
                      >
                        <div class="py-1">
                          <a
                            href="#"
                            @click.prevent="sortByRecipeCount('All')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >All</a
                          >
                          <a
                            href="#"
                            @click.prevent="sortByRecipeCount('Highest')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >Highest First</a
                          >
                          <a
                            href="#"
                            @click.prevent="sortByRecipeCount('Lowest')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >Lowest First</a
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Applied Filters -->
                <div
                  v-if="activeFilters.length > 0"
                  class="mt-3 flex flex-wrap items-center gap-2"
                >
                  <span class="text-xs text-gray-500">Active filters:</span>
                  <div
                    v-for="(filter, index) in activeFilters"
                    :key="index"
                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800"
                  >
                    {{ filter }}
                    <button
                      @click="removeFilter(index)"
                      class="ml-1.5 text-gray-500 hover:text-gray-700 cursor-pointer whitespace-nowrap !rounded-button"
                    >
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                  <button
                    @click="clearFilters"
                    class="text-xs text-emerald-600 hover:text-emerald-800 cursor-pointer whitespace-nowrap !rounded-button"
                  >
                    Clear all
                  </button>
                </div>
              </div>
              <!-- Categories Table -->
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
                            :checked="allSelected"
                            @change="toggleSelectAll"
                            class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded"
                          />
                        </div>
                      </th>
                      <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        Category
                      </th>
                      <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        Description
                      </th>
                      <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        Recipes
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
                        Created
                      </th>
                      <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        Last Modified
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
                      v-for="(category, index) in filteredCategories"
                      :key="index"
                      class="hover:bg-gray-50"
                    >
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                          <input
                            type="checkbox"
                            v-model="category.selected"
                            class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded"
                          />
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                          <div class="flex-shrink-0 h-10 w-10">
                            <img
                              :src="category.image"
                              :alt="category.name"
                              class="h-10 w-10 rounded-md object-cover"
                            />
                          </div>
                          <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                              {{ category.name }}
                            </div>
                            <div class="text-xs text-gray-500">
                              {{ category.slug }}
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="px-6 py-4">
                        <div class="text-sm text-gray-900 max-w-xs truncate">
                          {{ category.description }}
                        </div>
                        <button
                          v-if="category.description.length > 60"
                          class="text-xs text-emerald-600 hover:text-emerald-800 cursor-pointer whitespace-nowrap !rounded-button"
                        >
                          Read more
                        </button>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                          {{ category.recipeCount }}
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span
                          :class="[
'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
category.status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'
]"
                        >
                          {{ category.status }}
                        </span>
                      </td>
                      <td
                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                      >
                        {{ category.created }}
                      </td>
                      <td
                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                      >
                        {{ category.lastModified }}
                      </td>
                      <td
                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                      >
                        <div class="flex justify-end space-x-2">
                          <button
                            @click="editCategory(category)"
                            class="text-emerald-600 hover:text-emerald-900 cursor-pointer whitespace-nowrap !rounded-button"
                          >
                            <i class="fas fa-edit"></i>
                          </button>
                          <button
                            @click="confirmDelete(category)"
                            class="text-red-600 hover:text-red-900 cursor-pointer whitespace-nowrap !rounded-button"
                          >
                            <i class="fas fa-trash-alt"></i>
                          </button>
                          <div class="relative">
                            <button
                              @click="toggleCategoryActions(index)"
                              class="text-gray-500 hover:text-gray-700 cursor-pointer whitespace-nowrap !rounded-button"
                            >
                              <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div
                              v-if="activeCategoryActions === index"
                              class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10"
                            >
                              <div class="py-1">
                                <a
                                  href="#"
                                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                                  >View Recipes</a
                                >
                                <a
                                  href="#"
                                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                                  >Duplicate</a
                                >
                                <a
                                  href="#"
                                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                                >
                                  {{ category.status === 'Active' ? 'Deactivate'
                                  : 'Activate' }}
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr v-if="filteredCategories.length === 0">
                      <td colspan="8" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                          <i
                            class="fas fa-search text-gray-400 text-4xl mb-4"
                          ></i>
                          <h3 class="text-lg font-medium text-gray-900 mb-1">
                            No categories found
                          </h3>
                          <p class="text-sm text-gray-500">
                            Try adjusting your search or filter criteria
                          </p>
                          <button
                            @click="clearFilters"
                            class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 cursor-pointer whitespace-nowrap !rounded-button"
                          >
                            Clear Filters
                          </button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- Bulk Actions (appears when items are selected) -->
              <div
                v-if="hasSelectedItems"
                class="bg-gray-50 px-6 py-3 border-t border-gray-200"
              >
                <div class="flex items-center justify-between">
                  <div class="flex items-center">
                    <span class="text-sm text-gray-700 mr-4"
                      >{{ selectedCount }} items selected</span
                    >
                    <div class="relative inline-block text-left">
                      <button
                        @click="toggleBulkActions"
                        class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        Bulk Actions
                        <i class="fas fa-chevron-down ml-2"></i>
                      </button>
                      <div
                        v-if="showBulkActions"
                        class="origin-top-left absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10"
                      >
                        <div class="py-1">
                          <a
                            href="#"
                            @click.prevent="bulkActivate"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >Activate Selected</a
                          >
                          <a
                            href="#"
                            @click.prevent="bulkDeactivate"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >Deactivate Selected</a
                          >
                          <a
                            href="#"
                            @click.prevent="bulkExport"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >Export Selected</a
                          >
                          <a
                            href="#"
                            @click.prevent="confirmBulkDelete"
                            class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 cursor-pointer"
                            >Delete Selected</a
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                  <button
                    @click="clearSelection"
                    class="text-sm text-gray-600 hover:text-gray-900 cursor-pointer whitespace-nowrap !rounded-button"
                  >
                    Clear selection
                  </button>
                </div>
              </div>
              <!-- Pagination -->
              <div
                class="bg-white px-6 py-4 border-t border-gray-200 flex items-center justify-between"
              >
                <div class="flex-1 flex justify-between sm:hidden">
                  <button
                    :disabled="currentPage === 1"
                    @click="prevPage"
                    :class="[
'relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md cursor-pointer whitespace-nowrap !rounded-button',
currentPage === 1 ? 'bg-gray-100 text-gray-400' : 'bg-white text-gray-700 hover:bg-gray-50'
]"
                  >
                    Previous
                  </button>
                  <button
                    :disabled="currentPage === totalPages"
                    @click="nextPage"
                    :class="[
'ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md cursor-pointer whitespace-nowrap !rounded-button',
currentPage === totalPages ? 'bg-gray-100 text-gray-400' : 'bg-white text-gray-700 hover:bg-gray-50'
]"
                  >
                    Next
                  </button>
                </div>
                <div
                  class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"
                >
                  <div>
                    <p class="text-sm text-gray-700">
                      Showing
                      <span class="font-medium">{{ paginationStart }}</span> to
                      <span class="font-medium">{{ paginationEnd }}</span> of
                      <span class="font-medium">{{ totalCategories }}</span>
                      categories
                    </p>
                  </div>
                  <div class="flex items-center">
                    <div class="mr-4">
                      <label for="perPage" class="sr-only"
                        >Items per page</label
                      >
                      <select
                        id="perPage"
                        v-model="perPage"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm rounded-md"
                      >
                        <option value="10">10 per page</option>
                        <option value="25">25 per page</option>
                        <option value="50">50 per page</option>
                        <option value="100">100 per page</option>
                      </select>
                    </div>
                    <nav
                      class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                      aria-label="Pagination"
                    >
                      <button
                        :disabled="currentPage === 1"
                        @click="prevPage"
                        :class="[
'relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button',
currentPage === 1 ? 'bg-gray-100 text-gray-400' : 'bg-white text-gray-500 hover:bg-gray-50'
]"
                      >
                        <span class="sr-only">Previous</span>
                        <i class="fas fa-chevron-left"></i>
                      </button>
                      <template v-for="page in displayedPages" :key="page">
                        <span
                          v-if="page === '...'"
                          class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700"
                        >
                          ...
                        </span>
                        <button
                          v-else
                          @click="goToPage(page)"
                          :class="[
'relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button',
page === currentPage ? 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' : 'bg-white text-gray-700 hover:bg-gray-50'
]"
                        >
                          {{ page }}
                        </button>
                      </template>
                      <button
                        :disabled="currentPage === totalPages"
                        @click="nextPage"
                        :class="[
'relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button',
currentPage === totalPages ? 'bg-gray-100 text-gray-400' : 'bg-white text-gray-500 hover:bg-gray-50'
]"
                      >
                        <span class="sr-only">Next</span>
                        <i class="fas fa-chevron-right"></i>
                      </button>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <!-- Add/Edit Category Modal -->
  <div
    v-if="showCategoryModal"
    class="fixed inset-0 z-50 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
  >
    <div
      class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
    >
      <div
        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        aria-hidden="true"
        @click="closeCategoryModal"
      ></div>
      <span
        class="hidden sm:inline-block sm:align-middle sm:h-screen"
        aria-hidden="true"
        >&#8203;</span
      >
      <div
        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
      >
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
              <h3
                class="text-lg leading-6 font-medium text-gray-900"
                id="modal-title"
              >
                {{ editMode ? 'Edit Category' : 'Add New Category' }}
              </h3>
              <div class="mt-4 space-y-4">
                <div>
                  <label
                    for="category-name"
                    class="block text-sm font-medium text-gray-700"
                    >Category Name</label
                  >
                  <input
                    type="text"
                    id="category-name"
                    v-model="currentCategory.name"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    placeholder="e.g. Italian Cuisine"
                  />
                </div>
                <div>
                  <label
                    for="category-slug"
                    class="block text-sm font-medium text-gray-700"
                    >Slug</label
                  >
                  <input
                    type="text"
                    id="category-slug"
                    v-model="currentCategory.slug"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    placeholder="e.g. italian-cuisine"
                  />
                </div>
                <div>
                  <label
                    for="category-description"
                    class="block text-sm font-medium text-gray-700"
                    >Description</label
                  >
                  <textarea
                    id="category-description"
                    v-model="currentCategory.description"
                    rows="3"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    placeholder="Describe this category..."
                  ></textarea>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700"
                    >Status</label
                  >
                  <div class="mt-2 flex items-center">
                    <div
                      class="relative inline-block w-10 mr-2 align-middle select-none"
                    >
                      <input
                        type="checkbox"
                        id="category-status"
                        v-model="categoryStatusActive"
                        class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer"
                      />
                      <label
                        for="category-status"
                        class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                      ></label>
                    </div>
                    <span class="text-sm text-gray-700"
                      >{{ categoryStatusActive ? 'Active' : 'Inactive' }}</span
                    >
                  </div>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700"
                    >Category Image</label
                  >
                  <div class="mt-2 flex items-center">
                    <div
                      class="flex-shrink-0 h-16 w-16 bg-gray-100 rounded-md overflow-hidden"
                    >
                      <img
                        v-if="currentCategory.image"
                        :src="currentCategory.image"
                        alt="Category preview"
                        class="h-full w-full object-cover"
                      />
                      <div
                        v-else
                        class="h-full w-full flex items-center justify-center text-gray-400"
                      >
                        <i class="fas fa-image text-2xl"></i>
                      </div>
                    </div>
                    <button
                      class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 cursor-pointer whitespace-nowrap !rounded-button"
                    >
                      Change
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button
            @click="saveCategory"
            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:ml-3 sm:w-auto sm:text-sm cursor-pointer whitespace-nowrap !rounded-button"
          >
            {{ editMode ? 'Save Changes' : 'Add Category' }}
          </button>
          <button
            @click="closeCategoryModal"
            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm cursor-pointer whitespace-nowrap !rounded-button"
          >
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete Confirmation Modal -->
  <div
    v-if="showDeleteModal"
    class="fixed inset-0 z-50 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
  >
    <div
      class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
    >
      <div
        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        aria-hidden="true"
        @click="closeDeleteModal"
      ></div>
      <span
        class="hidden sm:inline-block sm:align-middle sm:h-screen"
        aria-hidden="true"
        >&#8203;</span
      >
      <div
        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
      >
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div
              class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
            >
              <i class="fas fa-exclamation-triangle text-red-600"></i>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3
                class="text-lg leading-6 font-medium text-gray-900"
                id="modal-title"
              >
                {{ bulkDeleteMode ? 'Delete Selected Categories' : 'Delete
                Category' }}
              </h3>
              <div class="mt-2">
                <p class="text-sm text-gray-500">
                  {{ bulkDeleteMode ? `Are you sure you want to delete the
                  ${selectedCount} selected categories? This action cannot be
                  undone.` : `Are you sure you want to delete
                  "${categoryToDelete?.name}"? This action cannot be undone.` }}
                </p>
                <div
                  v-if="categoryToDelete && categoryToDelete.recipeCount > 0"
                  class="mt-2 p-3 bg-amber-50 text-amber-800 rounded-md text-sm"
                >
                  <i class="fas fa-exclamation-circle mr-2"></i>
                  Warning: This category contains {{
                  categoryToDelete.recipeCount }} recipes. Deleting it may
                  affect recipe organization.
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button
            @click="deleteCategory"
            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm cursor-pointer whitespace-nowrap !rounded-button"
          >
            Delete
          </button>
          <button
            @click="closeDeleteModal"
            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm cursor-pointer whitespace-nowrap !rounded-button"
          >
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { ref, computed, onMounted } from "vue";
// Logo and Avatar
const logoUrl =
  "https://readdy.ai/api/search-image?query=minimalist%2520cooking%2520logo%2520with%2520a%2520chef%2520hat%2520and%2520spoon%2520clean%2520design%2520professional%2520modern%2520flat%2520design%2520vector%2520style%2520green%2520color%2520scheme%2520suitable%2520for%2520a%2520cooking%2520app&width=200&height=200&seq=1&orientation=squarish";
const adminAvatar =
  "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520young%2520man%2520with%2520short%2520brown%2520hair%2520and%2520friendly%2520smile%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=2&orientation=squarish";
// UI State
const isMobileSidebarOpen = ref(false);
const showUserMenu = ref(false);
const showStatusFilter = ref(false);
const showRecipeCountFilter = ref(false);
const activeCategoryActions = ref<number | null>(null);
const showCategoryModal = ref(false);
const showDeleteModal = ref(false);
const showBulkActions = ref(false);
const editMode = ref(false);
const bulkDeleteMode = ref(false);
const searchQuery = ref("");
const activeFilters = ref<string[]>([]);
const statusFilter = ref("All");
const recipeCountSort = ref("All");
const currentPage = ref(1);
const perPage = ref(10);
// Category being edited or deleted
const currentCategory = ref({
  id: "",
  name: "",
  slug: "",
  description: "",
  image: "",
  status: "Active",
  recipeCount: 0,
  created: "",
  lastModified: "",
});
const categoryStatusActive = ref(true);
const categoryToDelete = ref<any>(null);
// Sample data for categories
const categories = ref([
  {
    id: "1",
    name: "Italian Cuisine",
    slug: "italian-cuisine",
    description:
      "Traditional and modern Italian recipes including pasta, pizza, risotto, and more.",
    image:
      "https://readdy.ai/api/search-image?query=italian%2520cuisine%2520ingredients%2520on%2520rustic%2520wooden%2520table%2520with%2520pasta%2520tomatoes%2520basil%2520olive%2520oil%2520parmesan%2520cheese%2520and%2520garlic%2520warm%2520mediterranean%2520lighting%2520authentic%2520food%2520photography%2520high%2520resolution%2520appetizing%2520presentation&width=100&height=100&seq=8&orientation=squarish",
    status: "Active",
    recipeCount: 128,
    created: "Jan 10, 2025",
    lastModified: "3 days ago",
    selected: false,
  },
  {
    id: "2",
    name: "Baking & Desserts",
    slug: "baking-desserts",
    description:
      "Sweet treats, pastries, cakes, cookies, and all things baking related.",
    image:
      "https://readdy.ai/api/search-image?query=freshly%2520baked%2520bread%2520and%2520pastries%2520on%2520a%2520wooden%2520table%2520with%2520flour%2520rolling%2520pin%2520and%2520baking%2520ingredients%2520warm%2520cozy%2520bakery%2520atmosphere%2520soft%2520natural%2520lighting%2520high%2520resolution%2520appetizing%2520presentation%2520of%2520homemade%2520baked%2520goods&width=100&height=100&seq=9&orientation=squarish",
    status: "Active",
    recipeCount: 256,
    created: "Feb 15, 2025",
    lastModified: "1 week ago",
    selected: false,
  },
  {
    id: "3",
    name: "Vegetarian",
    slug: "vegetarian",
    description:
      "Meat-free recipes featuring vegetables, legumes, grains, and plant-based proteins.",
    image:
      "https://readdy.ai/api/search-image?query=colorful%2520vegetarian%2520food%2520spread%2520with%2520fresh%2520vegetables%2520legumes%2520grains%2520and%2520herbs%2520on%2520a%2520table%2520vibrant%2520healthy%2520meal%2520preparation%2520bright%2520natural%2520lighting%2520high%2520resolution%2520appetizing%2520presentation%2520of%2520plant%2520based%2520cuisine&width=100&height=100&seq=10&orientation=squarish",
    status: "Active",
    recipeCount: 189,
    created: "Mar 5, 2025",
    lastModified: "2 days ago",
    selected: false,
  },
  {
    id: "4",
    name: "Quick & Easy",
    slug: "quick-easy",
    description:
      "Fast recipes that can be prepared in 30 minutes or less, perfect for busy weeknights.",
    image:
      "https://readdy.ai/api/search-image?query=quick%2520meal%2520preparation%2520with%2520simple%2520ingredients%2520on%2520kitchen%2520counter%2520showing%2520fast%2520cooking%2520process%2520bright%2520kitchen%2520setting%2520with%2520natural%2520lighting%2520high%2520resolution%2520appetizing%2520presentation%2520of%2520easy%2520to%2520make%2520dishes&width=100&height=100&seq=11&orientation=squarish",
    status: "Active",
    recipeCount: 142,
    created: "Mar 20, 2025",
    lastModified: "5 days ago",
    selected: false,
  },
  {
    id: "5",
    name: "Asian Fusion",
    slug: "asian-fusion",
    description:
      "Modern interpretations of traditional Asian dishes combining flavors from different Asian cuisines.",
    image:
      "https://readdy.ai/api/search-image?query=asian%2520fusion%2520dishes%2520with%2520colorful%2520ingredients%2520and%2520presentation%2520modern%2520take%2520on%2520traditional%2520asian%2520cuisine%2520vibrant%2520food%2520styling%2520professional%2520lighting%2520high%2520resolution%2520appetizing%2520presentation%2520of%2520sushi%2520noodles%2520and%2520stir%2520fry%2520dishes&width=100&height=100&seq=12&orientation=squarish",
    status: "Inactive",
    recipeCount: 98,
    created: "Apr 2, 2025",
    lastModified: "2 weeks ago",
    selected: false,
  },
  {
    id: "6",
    name: "Breakfast",
    slug: "breakfast",
    description:
      "Morning meals including egg dishes, pancakes, waffles, breakfast sandwiches, and smoothie bowls.",
    image:
      "https://readdy.ai/api/search-image?query=breakfast%2520spread%2520with%2520pancakes%2520eggs%2520bacon%2520fresh%2520fruit%2520and%2520coffee%2520on%2520wooden%2520table%2520morning%2520sunlight%2520streaming%2520in%2520cozy%2520breakfast%2520setting%2520high%2520resolution%2520appetizing%2520presentation%2520of%2520morning%2520meal&width=100&height=100&seq=13&orientation=squarish",
    status: "Active",
    recipeCount: 112,
    created: "Apr 15, 2025",
    lastModified: "1 day ago",
    selected: false,
  },
  {
    id: "7",
    name: "Gluten-Free",
    slug: "gluten-free",
    description:
      "Recipes that exclude gluten-containing ingredients, suitable for those with celiac disease or gluten sensitivity.",
    image:
      "https://readdy.ai/api/search-image?query=gluten%2520free%2520ingredients%2520and%2520prepared%2520dishes%2520on%2520wooden%2520table%2520including%2520rice%2520flour%2520almond%2520flour%2520and%2520alternative%2520grains%2520bright%2520natural%2520lighting%2520high%2520resolution%2520appetizing%2520presentation%2520of%2520gluten%2520free%2520cuisine&width=100&height=100&seq=14&orientation=squarish",
    status: "Active",
    recipeCount: 87,
    created: "May 3, 2025",
    lastModified: "4 days ago",
    selected: false,
  },
  {
    id: "8",
    name: "Seafood",
    slug: "seafood",
    description:
      "Fish and shellfish recipes including grilled, baked, and raw preparations.",
    image:
      "https://readdy.ai/api/search-image?query=fresh%2520seafood%2520display%2520with%2520fish%2520shrimp%2520scallops%2520and%2520herbs%2520on%2520ice%2520with%2520lemon%2520slices%2520clean%2520professional%2520food%2520styling%2520bright%2520lighting%2520high%2520resolution%2520appetizing%2520presentation%2520of%2520ocean%2520cuisine&width=100&height=100&seq=15&orientation=squarish",
    status: "Active",
    recipeCount: 76,
    created: "May 18, 2025",
    lastModified: "1 week ago",
    selected: false,
  },
  {
    id: "9",
    name: "Slow Cooker",
    slug: "slow-cooker",
    description:
      "Set-it-and-forget-it recipes designed specifically for slow cookers and crockpots.",
    image:
      "https://readdy.ai/api/search-image?query=slow%2520cooker%2520with%2520hearty%2520stew%2520or%2520soup%2520bubbling%2520inside%2520surrounded%2520by%2520fresh%2520ingredients%2520warm%2520homey%2520kitchen%2520setting%2520soft%2520lighting%2520high%2520resolution%2520appetizing%2520presentation%2520of%2520comfort%2520food%2520cooking%2520process&width=100&height=100&seq=16&orientation=squarish",
    status: "Active",
    recipeCount: 64,
    created: "Jun 1, 2025",
    lastModified: "3 days ago",
    selected: false,
  },
  {
    id: "10",
    name: "Holiday & Seasonal",
    slug: "holiday-seasonal",
    description:
      "Special occasion recipes for holidays, celebrations, and seasonal ingredients.",
    image:
      "https://readdy.ai/api/search-image?query=festive%2520holiday%2520table%2520setting%2520with%2520seasonal%2520dishes%2520decorations%2520and%2520candles%2520warm%2520celebratory%2520atmosphere%2520elegant%2520presentation%2520high%2520resolution%2520appetizing%2520display%2520of%2520special%2520occasion%2520food%2520and%2520decor&width=100&height=100&seq=17&orientation=squarish",
    status: "Inactive",
    recipeCount: 93,
    created: "Jun 15, 2025",
    lastModified: "2 weeks ago",
    selected: false,
  },
  {
    id: "11",
    name: "Mediterranean",
    slug: "mediterranean",
    description:
      "Healthy dishes inspired by countries bordering the Mediterranean Sea, featuring olive oil, fresh vegetables, and seafood.",
    image:
      "https://readdy.ai/api/search-image?query=mediterranean%2520spread%2520with%2520hummus%2520olives%2520feta%2520fresh%2520vegetables%2520and%2520pita%2520bread%2520on%2520blue%2520table%2520bright%2520coastal%2520lighting%2520high%2520resolution%2520appetizing%2520presentation%2520of%2520healthy%2520mediterranean%2520diet%2520foods&width=100&height=100&seq=18&orientation=squarish",
    status: "Active",
    recipeCount: 118,
    created: "Jun 28, 2025",
    lastModified: "6 days ago",
    selected: false,
  },
  {
    id: "12",
    name: "Soups & Stews",
    slug: "soups-stews",
    description:
      "Warming bowls of comfort food, from light broths to hearty stews and chowders.",
    image:
      "https://readdy.ai/api/search-image?query=steaming%2520hot%2520soup%2520in%2520rustic%2520bowl%2520with%2520fresh%2520bread%2520and%2520herbs%2520on%2520wooden%2520table%2520cozy%2520warm%2520atmosphere%2520soft%2520lighting%2520high%2520resolution%2520appetizing%2520presentation%2520of%2520homemade%2520comfort%2520food&width=100&height=100&seq=19&orientation=squarish",
    status: "Active",
    recipeCount: 82,
    created: "Jul 10, 2025",
    lastModified: "2 days ago",
    selected: false,
  },
]);
// Toggle functions
const toggleSidebar = () => {
  isMobileSidebarOpen.value = !isMobileSidebarOpen.value;
};
const toggleUserMenu = () => {
  showUserMenu.value = !showUserMenu.value;
};
const toggleStatusFilter = () => {
  showStatusFilter.value = !showStatusFilter.value;
  showRecipeCountFilter.value = false;
};
const toggleRecipeCountFilter = () => {
  showRecipeCountFilter.value = !showRecipeCountFilter.value;
  showStatusFilter.value = false;
};
const toggleCategoryActions = (index: number) => {
  activeCategoryActions.value =
    activeCategoryActions.value === index ? null : index;
};
const toggleBulkActions = () => {
  showBulkActions.value = !showBulkActions.value;
};
// Filter functions
const filterByStatus = (status: string) => {
  statusFilter.value = status;
  showStatusFilter.value = false;
  if (status !== "All") {
    const existingIndex = activeFilters.value.findIndex((filter) =>
      filter.includes("Status:"),
    );
    if (existingIndex !== -1) {
      activeFilters.value[existingIndex] = `Status: ${status}`;
    } else {
      activeFilters.value.push(`Status: ${status}`);
    }
  } else {
    removeFilterByType("Status:");
  }
  currentPage.value = 1;
};
const sortByRecipeCount = (sort: string) => {
  recipeCountSort.value = sort;
  showRecipeCountFilter.value = false;
  if (sort !== "All") {
    const existingIndex = activeFilters.value.findIndex((filter) =>
      filter.includes("Recipe Count:"),
    );
    if (existingIndex !== -1) {
      activeFilters.value[existingIndex] = `Recipe Count: ${sort}`;
    } else {
      activeFilters.value.push(`Recipe Count: ${sort}`);
    }
  } else {
    removeFilterByType("Recipe Count:");
  }
  currentPage.value = 1;
};
const removeFilter = (index: number) => {
  const filter = activeFilters.value[index];
  activeFilters.value.splice(index, 1);
  if (filter.includes("Status:")) {
    statusFilter.value = "All";
  } else if (filter.includes("Recipe Count:")) {
    recipeCountSort.value = "All";
  }
  currentPage.value = 1;
};
const removeFilterByType = (type: string) => {
  const index = activeFilters.value.findIndex((filter) =>
    filter.includes(type),
  );
  if (index !== -1) {
    activeFilters.value.splice(index, 1);
  }
};
const clearFilters = () => {
  activeFilters.value = [];
  statusFilter.value = "All";
  recipeCountSort.value = "All";
  searchQuery.value = "";
  currentPage.value = 1;
};
// Category CRUD operations
const openAddCategoryModal = () => {
  editMode.value = false;
  currentCategory.value = {
    id: "",
    name: "",
    slug: "",
    description: "",
    image: "",
    status: "Active",
    recipeCount: 0,
    created: "",
    lastModified: "",
  };
  categoryStatusActive.value = true;
  showCategoryModal.value = true;
};
const editCategory = (category: any) => {
  editMode.value = true;
  currentCategory.value = { ...category };
  categoryStatusActive.value = category.status === "Active";
  showCategoryModal.value = true;
};
const saveCategory = () => {
  const now = new Date().toLocaleDateString("en-US", {
    month: "short",
    day: "numeric",
    year: "numeric",
  });
  currentCategory.value.status = categoryStatusActive.value
    ? "Active"
    : "Inactive";
  if (editMode.value) {
    // Update existing category
    const index = categories.value.findIndex(
      (c) => c.id === currentCategory.value.id,
    );
    if (index !== -1) {
      currentCategory.value.lastModified = "Just now";
      categories.value[index] = { ...currentCategory.value };
    }
  } else {
    // Add new category
    const newId = (
      Math.max(...categories.value.map((c) => parseInt(c.id))) + 1
    ).toString();
    const newCategory = {
      ...currentCategory.value,
      id: newId,
      created: now,
      lastModified: "Just now",
      selected: false,
      image:
        "https://readdy.ai/api/search-image?query=generic%2520food%2520category%2520placeholder%2520image%2520with%2520simple%2520food%2520icons%2520on%2520light%2520background%2520minimal%2520clean%2520design%2520high%2520resolution%2520professional%2520food%2520category%2520representation&width=100&height=100&seq=20&orientation=squarish",
    };
    categories.value.push(newCategory);
  }
  closeCategoryModal();
};
const closeCategoryModal = () => {
  showCategoryModal.value = false;
};
const confirmDelete = (category: any) => {
  categoryToDelete.value = category;
  bulkDeleteMode.value = false;
  showDeleteModal.value = true;
};
const confirmBulkDelete = () => {
  bulkDeleteMode.value = true;
  showDeleteModal.value = true;
  showBulkActions.value = false;
};
const deleteCategory = () => {
  if (bulkDeleteMode.value) {
    // Delete selected categories
    categories.value = categories.value.filter((c) => !c.selected);
  } else if (categoryToDelete.value) {
    // Delete single category
    categories.value = categories.value.filter(
      (c) => c.id !== categoryToDelete.value.id,
    );
  }
  closeDeleteModal();
};
const closeDeleteModal = () => {
  showDeleteModal.value = false;
  categoryToDelete.value = null;
  bulkDeleteMode.value = false;
};
// Bulk actions
const bulkActivate = () => {
  categories.value.forEach((category) => {
    if (category.selected) {
      category.status = "Active";
      category.lastModified = "Just now";
    }
  });
  showBulkActions.value = false;
};
const bulkDeactivate = () => {
  categories.value.forEach((category) => {
    if (category.selected) {
      category.status = "Inactive";
      category.lastModified = "Just now";
    }
  });
  showBulkActions.value = false;
};
const bulkExport = () => {
  // In a real application, this would trigger an export process
  alert("Exporting selected categories...");
  showBulkActions.value = false;
};
// Selection functions
const toggleSelectAll = (event: Event) => {
  const checked = (event.target as HTMLInputElement).checked;
  categories.value.forEach((category) => {
    category.selected = checked;
  });
};
const clearSelection = () => {
  categories.value.forEach((category) => {
    category.selected = false;
  });
};
// Computed properties
const filteredCategories = computed(() => {
  let result = [...categories.value];
  // Apply search filter
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase();
    result = result.filter(
      (category) =>
        category.name.toLowerCase().includes(query) ||
        category.description.toLowerCase().includes(query) ||
        category.slug.toLowerCase().includes(query),
    );
  }
  // Apply status filter
  if (statusFilter.value !== "All") {
    result = result.filter(
      (category) => category.status === statusFilter.value,
    );
  }
  // Apply recipe count sort
  if (recipeCountSort.value === "Highest") {
    result.sort((a, b) => b.recipeCount - a.recipeCount);
  } else if (recipeCountSort.value === "Lowest") {
    result.sort((a, b) => a.recipeCount - b.recipeCount);
  }
  // Pagination
  const startIndex =
    (currentPage.value - 1) * parseInt(perPage.value.toString());
  const endIndex = startIndex + parseInt(perPage.value.toString());
  return result.slice(startIndex, endIndex);
});
const totalCategories = computed(() => {
  let result = [...categories.value];
  // Apply search filter
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase();
    result = result.filter(
      (category) =>
        category.name.toLowerCase().includes(query) ||
        category.description.toLowerCase().includes(query) ||
        category.slug.toLowerCase().includes(query),
    );
  }
  // Apply status filter
  if (statusFilter.value !== "All") {
    result = result.filter(
      (category) => category.status === statusFilter.value,
    );
  }
  return result.length;
});
const totalPages = computed(() => {
  return Math.ceil(totalCategories.value / parseInt(perPage.value.toString()));
});
const displayedPages = computed(() => {
  const pages = [];
  const maxVisiblePages = 5;
  if (totalPages.value <= maxVisiblePages) {
    // Show all pages
    for (let i = 1; i <= totalPages.value; i++) {
      pages.push(i);
    }
  } else {
    // Always show first page
    pages.push(1);
    // Calculate start and end of visible pages
    let startPage = Math.max(
      2,
      currentPage.value - Math.floor(maxVisiblePages / 2),
    );
    let endPage = Math.min(
      totalPages.value - 1,
      startPage + maxVisiblePages - 3,
    );
    // Adjust if we're near the end
    if (endPage === totalPages.value - 1) {
      startPage = Math.max(2, endPage - (maxVisiblePages - 3));
    }
    // Add ellipsis after first page if needed
    if (startPage > 2) {
      pages.push("...");
    }
    // Add visible pages
    for (let i = startPage; i <= endPage; i++) {
      pages.push(i);
    }
    // Add ellipsis before last page if needed
    if (endPage < totalPages.value - 1) {
      pages.push("...");
    }
    // Always show last page
    pages.push(totalPages.value);
  }
  return pages;
});
const paginationStart = computed(() => {
  return totalCategories.value === 0
    ? 0
    : (currentPage.value - 1) * parseInt(perPage.value.toString()) + 1;
});
const paginationEnd = computed(() => {
  return Math.min(
    currentPage.value * parseInt(perPage.value.toString()),
    totalCategories.value,
  );
});
const hasSelectedItems = computed(() => {
  return categories.value.some((category) => category.selected);
});
const selectedCount = computed(() => {
  return categories.value.filter((category) => category.selected).length;
});
const allSelected = computed(() => {
  return (
    categories.value.length > 0 &&
    categories.value.every((category) => category.selected)
  );
});
// Pagination functions
const prevPage = () => {
  if (currentPage.value > 1) {
    currentPage.value--;
  }
};
const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    currentPage.value++;
  }
};
const goToPage = (page: number) => {
  currentPage.value = page;
};
onMounted(() => {
  // Close dropdowns when clicking outside
  document.addEventListener("click", (e) => {
    const target = e.target as HTMLElement;
    if (showUserMenu.value && !target.closest(".user-menu")) {
      showUserMenu.value = false;
    }
    if (showStatusFilter.value && !target.closest(".status-filter")) {
      showStatusFilter.value = false;
    }
    if (
      showRecipeCountFilter.value &&
      !target.closest(".recipe-count-filter")
    ) {
      showRecipeCountFilter.value = false;
    }
    if (
      activeCategoryActions.value !== null &&
      !target.closest(".category-actions")
    ) {
      activeCategoryActions.value = null;
    }
    if (showBulkActions.value && !target.closest(".bulk-actions")) {
      showBulkActions.value = false;
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
