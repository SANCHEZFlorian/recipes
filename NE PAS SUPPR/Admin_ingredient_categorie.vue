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
            href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/f020ca5d-76a8-4b4b-8587-1e7cc939a0ed"
            data-readdy="true"
            class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg bg-emerald-50 text-emerald-700 cursor-pointer"
          >
            <i class="fas fa-carrot w-5 h-5 mr-3 text-emerald-600"></i>
            Ingredient Management
          </a>
          <div class="pl-8 mt-1">
            <a
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/b6d9bf3c-6e71-4b8a-8050-62a0d626260a"
              data-readdy="true"
              class="flex items-center px-3 py-2 text-sm font-medium rounded-lg bg-emerald-100 text-emerald-700 hover:bg-emerald-100 cursor-pointer"
            >
              <i class="fas fa-layer-group w-5 h-5 mr-3 text-emerald-600"></i>
              Ingredient Categories
            </a>
            <a
              href="#"
              class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
            >
              <i class="fas fa-tags w-5 h-5 mr-3 text-gray-500"></i>
              Category Tags
            </a>
            <a
              href="#"
              class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
            >
              <i class="fas fa-sitemap w-5 h-5 mr-3 text-gray-500"></i>
              Category Hierarchy
            </a>
          </div>
          <a
            href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/43e71165-096b-40be-8d15-7246ea575e8f"
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
            <a
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/f020ca5d-76a8-4b4b-8587-1e7cc939a0ed"
              data-readdy="true"
              class="hover:text-emerald-600 cursor-pointer"
              >Ingredient Management</a
            >
            <i class="fas fa-chevron-right mx-2 text-xs text-gray-400"></i>
            <span class="text-emerald-600 font-medium"
              >Ingredient Categories</span
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
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/f020ca5d-76a8-4b4b-8587-1e7cc939a0ed"
              data-readdy="true"
              class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg bg-emerald-50 text-emerald-700 cursor-pointer"
            >
              <i class="fas fa-carrot w-5 h-5 mr-3 text-emerald-600"></i>
              Ingredient Management
            </a>
            <a
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/b6d9bf3c-6e71-4b8a-8050-62a0d626260a"
              data-readdy="true"
              class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg bg-emerald-100 text-emerald-700 cursor-pointer"
            >
              <i class="fas fa-layer-group w-5 h-5 mr-3 text-emerald-600"></i>
              Ingredient Categories
            </a>
            <a
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/43e71165-096b-40be-8d15-7246ea575e8f"
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
                Ingredient Categories
              </h1>
              <p class="mt-1 text-sm text-gray-600">
                Create, organize, and manage categories for your ingredients
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
                    Category List
                  </h3>
                  <p class="mt-1 text-sm text-gray-500">
                    Manage categories and their hierarchical relationships
                  </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                  <button
                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                  >
                    <i class="fas fa-download mr-2"></i>
                    Export Categories
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
                        @click="toggleParentFilter"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        <i class="fas fa-sitemap mr-2"></i>
                        Hierarchy
                        <i class="fas fa-chevron-down ml-2"></i>
                      </button>
                      <div
                        v-if="showParentFilter"
                        class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10"
                      >
                        <div class="py-1">
                          <a
                            href="#"
                            @click.prevent="filterByParent('All')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >All Categories</a
                          >
                          <a
                            href="#"
                            @click.prevent="filterByParent('Root')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >Root Categories Only</a
                          >
                          <a
                            href="#"
                            @click.prevent="filterByParent('Children')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >Child Categories Only</a
                          >
                        </div>
                      </div>
                    </div>
                    <div class="relative inline-block text-left">
                      <button
                        @click="toggleUsageFilter"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        <i class="fas fa-chart-bar mr-2"></i>
                        Usage
                        <i class="fas fa-chevron-down ml-2"></i>
                      </button>
                      <div
                        v-if="showUsageFilter"
                        class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10"
                      >
                        <div class="py-1">
                          <a
                            href="#"
                            @click.prevent="filterByUsage('All')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >All</a
                          >
                          <a
                            href="#"
                            @click.prevent="filterByUsage('Used')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >In Use</a
                          >
                          <a
                            href="#"
                            @click.prevent="filterByUsage('Unused')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >Not In Use</a
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
                        Category Name
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
                        Parent Category
                      </th>
                      <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        Ingredients
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
                      <td class="px-6 py-4">
                        <div class="flex items-center">
                          <div
                            class="flex-shrink-0 h-10 w-10 rounded-md overflow-hidden"
                          >
                            <img
                              :src="category.image"
                              :alt="category.name"
                              class="h-10 w-10 object-cover"
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
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div
                          v-if="category.parentCategory"
                          class="text-sm text-gray-900"
                        >
                          {{ category.parentCategory }}
                        </div>
                        <div v-else class="text-sm text-gray-500">—</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                          {{ category.ingredientCount }}
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
                                  >View Ingredients</a
                                >
                                <a
                                  href="#"
                                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                                  >Add Subcategory</a
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
                            class="fas fa-folder-open text-gray-400 text-4xl mb-4"
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
                            @click.prevent="bulkChangeParent"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >Change Parent Category</a
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

            <!-- Category Hierarchy Visualization -->
            <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
              <div
                class="px-6 py-5 border-b border-gray-200 bg-white flex flex-col md:flex-row md:items-center md:justify-between gap-4"
              >
                <div class="flex-1">
                  <h3 class="text-lg font-medium text-gray-900">
                    Category Hierarchy
                  </h3>
                  <p class="mt-1 text-sm text-gray-500">
                    Visual representation of your category structure
                  </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                  <button
                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                  >
                    <i class="fas fa-expand-arrows-alt mr-2"></i>
                    Expand All
                  </button>
                  <button
                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                  >
                    <i class="fas fa-compress-arrows-alt mr-2"></i>
                    Collapse All
                  </button>
                </div>
              </div>
              <div class="p-6">
                <div class="hierarchy-tree">
                  <div
                    v-for="(rootCategory, index) in rootCategories"
                    :key="index"
                    class="mb-4"
                  >
                    <div
                      class="flex items-center p-3 bg-gray-50 rounded-md border border-gray-200"
                    >
                      <button
                        @click="toggleCategoryExpand(rootCategory.id)"
                        class="mr-2 w-6 h-6 flex items-center justify-center rounded-full bg-white border border-gray-300 text-gray-500 cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        <i
                          :class="[rootCategory.expanded ? 'fas fa-chevron-down' : 'fas fa-chevron-right']"
                        ></i>
                      </button>
                      <div
                        class="flex-shrink-0 h-8 w-8 rounded-md overflow-hidden mr-3"
                      >
                        <img
                          :src="rootCategory.image"
                          :alt="rootCategory.name"
                          class="h-8 w-8 object-cover"
                        />
                      </div>
                      <div class="flex-1">
                        <div class="text-sm font-medium text-gray-900">
                          {{ rootCategory.name }}
                        </div>
                        <div class="text-xs text-gray-500">
                          {{ rootCategory.ingredientCount }} ingredients
                        </div>
                      </div>
                      <div class="flex space-x-2">
                        <button
                          @click="editCategory(rootCategory)"
                          class="text-emerald-600 hover:text-emerald-900 cursor-pointer whitespace-nowrap !rounded-button"
                        >
                          <i class="fas fa-edit"></i>
                        </button>
                        <button
                          @click="addSubcategory(rootCategory)"
                          class="text-blue-600 hover:text-blue-900 cursor-pointer whitespace-nowrap !rounded-button"
                        >
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                    <div v-if="rootCategory.expanded" class="pl-8 mt-2">
                      <div
                        v-for="(child, childIndex) in rootCategory.children"
                        :key="childIndex"
                        class="mb-2"
                      >
                        <div
                          class="flex items-center p-3 bg-white rounded-md border border-gray-200"
                        >
                          <div
                            class="w-6 h-6 flex items-center justify-center mr-2"
                          >
                            <i
                              v-if="child.children && child.children.length > 0"
                              class="fas fa-level-down-alt text-gray-400 transform rotate-90"
                            ></i>
                          </div>
                          <div
                            class="flex-shrink-0 h-8 w-8 rounded-md overflow-hidden mr-3"
                          >
                            <img
                              :src="child.image"
                              :alt="child.name"
                              class="h-8 w-8 object-cover"
                            />
                          </div>
                          <div class="flex-1">
                            <div class="text-sm font-medium text-gray-900">
                              {{ child.name }}
                            </div>
                            <div class="text-xs text-gray-500">
                              {{ child.ingredientCount }} ingredients
                            </div>
                          </div>
                          <div class="flex space-x-2">
                            <button
                              @click="editCategory(child)"
                              class="text-emerald-600 hover:text-emerald-900 cursor-pointer whitespace-nowrap !rounded-button"
                            >
                              <i class="fas fa-edit"></i>
                            </button>
                            <button
                              @click="addSubcategory(child)"
                              class="text-blue-600 hover:text-blue-900 cursor-pointer whitespace-nowrap !rounded-button"
                            >
                              <i class="fas fa-plus"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Category Usage Stats -->
            <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
              <div class="px-6 py-5 border-b border-gray-200 bg-white">
                <h3 class="text-lg font-medium text-gray-900">
                  Category Usage Statistics
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                  Distribution of ingredients across categories
                </p>
              </div>
              <div class="p-6">
                <div class="h-80">
                  <div ref="categoryChart" class="w-full h-full"></div>
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
                    placeholder="e.g. Vegetables"
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
                    placeholder="e.g. vegetables"
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
                  <label
                    for="parent-category"
                    class="block text-sm font-medium text-gray-700"
                    >Parent Category</label
                  >
                  <select
                    id="parent-category"
                    v-model="currentCategory.parentCategory"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm rounded-md"
                  >
                    <option value="">None (Root Category)</option>
                    <option
                      v-for="category in availableParentCategories"
                      :key="category.id"
                      :value="category.name"
                    >
                      {{ category.name }}
                    </option>
                  </select>
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
                    >Category Icon</label
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
                  v-if="categoryToDelete && categoryToDelete.ingredientCount > 0"
                  class="mt-2 p-3 bg-amber-50 text-amber-800 rounded-md text-sm"
                >
                  <i class="fas fa-exclamation-circle mr-2"></i>
                  Warning: This category contains {{
                  categoryToDelete.ingredientCount }} ingredients. Deleting it
                  may affect ingredient organization.
                </div>
                <div
                  v-if="categoryToDelete && categoryToDelete.children && categoryToDelete.children.length > 0"
                  class="mt-2 p-3 bg-amber-50 text-amber-800 rounded-md text-sm"
                >
                  <i class="fas fa-exclamation-circle mr-2"></i>
                  Warning: This category has {{ categoryToDelete.children.length
                  }} subcategories that will also be deleted.
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

  <!-- Parent Category Change Modal -->
  <div
    v-if="showParentChangeModal"
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
        @click="closeParentChangeModal"
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
                Change Parent Category for Selected Categories
              </h3>
              <div class="mt-4">
                <label
                  for="bulk-parent"
                  class="block text-sm font-medium text-gray-700"
                  >Select Parent Category</label
                >
                <select
                  id="bulk-parent"
                  v-model="bulkParentValue"
                  class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm rounded-md"
                >
                  <option value="">None (Root Category)</option>
                  <option
                    v-for="category in availableParentCategories"
                    :key="category.id"
                    :value="category.name"
                  >
                    {{ category.name }}
                  </option>
                </select>
                <p class="mt-2 text-sm text-gray-500">
                  This will update the parent category for all {{ selectedCount
                  }} selected categories.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button
            @click="applyBulkParentChange"
            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:ml-3 sm:w-auto sm:text-sm cursor-pointer whitespace-nowrap !rounded-button"
          >
            Apply Changes
          </button>
          <button
            @click="closeParentChangeModal"
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
import * as echarts from "echarts";

// Logo and Avatar
const logoUrl =
  "https://readdy.ai/api/search-image?query=minimalist%2520cooking%2520logo%2520with%2520a%2520chef%2520hat%2520and%2520spoon%2520clean%2520design%2520professional%2520modern%2520flat%2520design%2520vector%2520style%2520green%2520color%2520scheme%2520suitable%2520for%2520a%2520cooking%2520app&width=200&height=200&seq=1&orientation=squarish";
const adminAvatar =
  "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520young%2520man%2520with%2520short%2520brown%2520hair%2520and%2520friendly%2520smile%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=2&orientation=squarish";

// UI State
const isMobileSidebarOpen = ref(false);
const showUserMenu = ref(false);
const showStatusFilter = ref(false);
const showParentFilter = ref(false);
const showUsageFilter = ref(false);
const activeCategoryActions = ref<number | null>(null);
const showCategoryModal = ref(false);
const showDeleteModal = ref(false);
const showBulkActions = ref(false);
const showParentChangeModal = ref(false);
const editMode = ref(false);
const bulkDeleteMode = ref(false);
const searchQuery = ref("");
const activeFilters = ref<string[]>([]);
const statusFilter = ref("All");
const parentFilter = ref("All");
const usageFilter = ref("All");
const currentPage = ref(1);
const perPage = ref(10);
const bulkParentValue = ref("");
const categoryChart = ref<HTMLElement | null>(null);
let chart: echarts.ECharts | null = null;

// Category being edited or deleted
const currentCategory = ref({
  id: "",
  name: "",
  slug: "",
  description: "",
  parentCategory: "",
  image: "",
  status: "Active",
  ingredientCount: 0,
  lastModified: "",
  children: [] as any[],
});

const categoryStatusActive = ref(true);
const categoryToDelete = ref<any>(null);

// Sample data for categories
const categories = ref([
  {
    id: "1",
    name: "Vegetables",
    slug: "vegetables",
    description: "All types of vegetables including fresh, frozen, and canned",
    parentCategory: "",
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=fresh%2520vegetables%2520assortment%2520on%2520white%2520background%2520vibrant%2520colors%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520various%2520types%2520of%2520vegetables%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=20&orientation=squarish",
    ingredientCount: 42,
    lastModified: "Jun 1, 2025",
    selected: false,
    expanded: true,
    children: [
      {
        id: "1-1",
        name: "Leafy Greens",
        slug: "leafy-greens",
        description: "Spinach, kale, lettuce, and other leafy vegetables",
        parentCategory: "Vegetables",
        status: "Active",
        image:
          "https://readdy.ai/api/search-image?query=fresh%2520leafy%2520greens%2520assortment%2520on%2520white%2520background%2520vibrant%2520green%2520color%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520various%2520types%2520of%2520leafy%2520vegetables%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=21&orientation=squarish",
        ingredientCount: 15,
        lastModified: "Jun 2, 2025",
        selected: false,
        children: [],
      },
      {
        id: "1-2",
        name: "Root Vegetables",
        slug: "root-vegetables",
        description: "Carrots, potatoes, beets, and other root vegetables",
        parentCategory: "Vegetables",
        status: "Active",
        image:
          "https://readdy.ai/api/search-image?query=fresh%2520root%2520vegetables%2520assortment%2520on%2520white%2520background%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520various%2520types%2520of%2520root%2520vegetables%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=22&orientation=squarish",
        ingredientCount: 12,
        lastModified: "Jun 3, 2025",
        selected: false,
        children: [],
      },
    ],
  },
  {
    id: "2",
    name: "Fruits",
    slug: "fruits",
    description: "All types of fruits including fresh, frozen, and dried",
    parentCategory: "",
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=fresh%2520fruits%2520assortment%2520on%2520white%2520background%2520vibrant%2520colors%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520various%2520types%2520of%2520fruits%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=23&orientation=squarish",
    ingredientCount: 38,
    lastModified: "Jun 4, 2025",
    selected: false,
    expanded: false,
    children: [
      {
        id: "2-1",
        name: "Berries",
        slug: "berries",
        description:
          "Strawberries, blueberries, raspberries, and other berries",
        parentCategory: "Fruits",
        status: "Active",
        image:
          "https://readdy.ai/api/search-image?query=fresh%2520berries%2520assortment%2520on%2520white%2520background%2520vibrant%2520colors%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520various%2520types%2520of%2520berries%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=24&orientation=squarish",
        ingredientCount: 10,
        lastModified: "Jun 5, 2025",
        selected: false,
        children: [],
      },
      {
        id: "2-2",
        name: "Citrus",
        slug: "citrus",
        description: "Lemons, limes, oranges, and other citrus fruits",
        parentCategory: "Fruits",
        status: "Active",
        image:
          "https://readdy.ai/api/search-image?query=fresh%2520citrus%2520fruits%2520assortment%2520on%2520white%2520background%2520vibrant%2520colors%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520various%2520types%2520of%2520citrus%2520fruits%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=25&orientation=squarish",
        ingredientCount: 8,
        lastModified: "Jun 6, 2025",
        selected: false,
        children: [],
      },
    ],
  },
  {
    id: "3",
    name: "Meats",
    slug: "meats",
    description: "All types of meats including beef, pork, poultry, and game",
    parentCategory: "",
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=various%2520raw%2520meats%2520on%2520white%2520background%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520different%2520cuts%2520of%2520meat%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=26&orientation=squarish",
    ingredientCount: 32,
    lastModified: "Jun 7, 2025",
    selected: false,
    expanded: false,
    children: [
      {
        id: "3-1",
        name: "Beef",
        slug: "beef",
        description: "Various cuts of beef",
        parentCategory: "Meats",
        status: "Active",
        image:
          "https://readdy.ai/api/search-image?query=raw%2520beef%2520cuts%2520on%2520white%2520background%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520different%2520cuts%2520of%2520beef%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=27&orientation=squarish",
        ingredientCount: 12,
        lastModified: "Jun 8, 2025",
        selected: false,
        children: [],
      },
      {
        id: "3-2",
        name: "Poultry",
        slug: "poultry",
        description: "Chicken, turkey, duck, and other poultry",
        parentCategory: "Meats",
        status: "Active",
        image:
          "https://readdy.ai/api/search-image?query=raw%2520poultry%2520meat%2520on%2520white%2520background%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520different%2520cuts%2520of%2520poultry%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=28&orientation=squarish",
        ingredientCount: 8,
        lastModified: "Jun 9, 2025",
        selected: false,
        children: [],
      },
    ],
  },
  {
    id: "4",
    name: "Seafood",
    slug: "seafood",
    description:
      "All types of seafood including fish, shellfish, and crustaceans",
    parentCategory: "",
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=fresh%2520seafood%2520assortment%2520on%2520white%2520background%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520various%2520types%2520of%2520seafood%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=29&orientation=squarish",
    ingredientCount: 25,
    lastModified: "Jun 10, 2025",
    selected: false,
    expanded: false,
    children: [],
  },
  {
    id: "5",
    name: "Dairy",
    slug: "dairy",
    description:
      "All dairy products including milk, cheese, yogurt, and butter",
    parentCategory: "",
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=dairy%2520products%2520assortment%2520on%2520white%2520background%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520various%2520dairy%2520products%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=30&orientation=squarish",
    ingredientCount: 28,
    lastModified: "Jun 11, 2025",
    selected: false,
    expanded: false,
    children: [],
  },
  {
    id: "6",
    name: "Grains",
    slug: "grains",
    description:
      "All grains and grain products including rice, pasta, and flour",
    parentCategory: "",
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=various%2520grains%2520and%2520cereals%2520on%2520white%2520background%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520different%2520types%2520of%2520grains%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=31&orientation=squarish",
    ingredientCount: 22,
    lastModified: "Jun 12, 2025",
    selected: false,
    expanded: false,
    children: [],
  },
  {
    id: "7",
    name: "Herbs & Spices",
    slug: "herbs-spices",
    description: "All herbs, spices, and seasonings",
    parentCategory: "",
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=various%2520herbs%2520and%2520spices%2520on%2520white%2520background%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520different%2520herbs%2520and%2520spices%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=32&orientation=squarish",
    ingredientCount: 45,
    lastModified: "Jun 13, 2025",
    selected: false,
    expanded: false,
    children: [],
  },
  {
    id: "8",
    name: "Oils & Vinegars",
    slug: "oils-vinegars",
    description: "All cooking oils, vinegars, and related products",
    parentCategory: "",
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=various%2520cooking%2520oils%2520and%2520vinegars%2520in%2520bottles%2520on%2520white%2520background%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=33&orientation=squarish",
    ingredientCount: 18,
    lastModified: "Jun 14, 2025",
    selected: false,
    expanded: false,
    children: [],
  },
  {
    id: "9",
    name: "Nuts & Seeds",
    slug: "nuts-seeds",
    description: "All nuts, seeds, and related products",
    parentCategory: "",
    status: "Inactive",
    image:
      "https://readdy.ai/api/search-image?query=various%2520nuts%2520and%2520seeds%2520on%2520white%2520background%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520different%2520types%2520of%2520nuts%2520and%2520seeds%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=34&orientation=squarish",
    ingredientCount: 15,
    lastModified: "Jun 15, 2025",
    selected: false,
    expanded: false,
    children: [],
  },
  {
    id: "10",
    name: "Legumes",
    slug: "legumes",
    description: "All beans, lentils, and other legumes",
    parentCategory: "",
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=various%2520legumes%2520beans%2520and%2520lentils%2520on%2520white%2520background%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520different%2520types%2520of%2520legumes%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=35&orientation=squarish",
    ingredientCount: 12,
    lastModified: "Jun 16, 2025",
    selected: false,
    expanded: false,
    children: [],
  },
  {
    id: "11",
    name: "Baking",
    slug: "baking",
    description: "All baking ingredients and supplies",
    parentCategory: "",
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=various%2520baking%2520ingredients%2520and%2520supplies%2520on%2520white%2520background%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520baking%2520ingredients%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=36&orientation=squarish",
    ingredientCount: 28,
    lastModified: "Jun 17, 2025",
    selected: false,
    expanded: false,
    children: [],
  },
  {
    id: "12",
    name: "Sweeteners",
    slug: "sweeteners",
    description: "All types of sugars, honey, and other sweeteners",
    parentCategory: "",
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=various%2520sweeteners%2520sugar%2520honey%2520and%2520syrups%2520on%2520white%2520background%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520different%2520sweeteners%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=37&orientation=squarish",
    ingredientCount: 10,
    lastModified: "Jun 18, 2025",
    selected: false,
    expanded: false,
    children: [],
  },
  {
    id: "13",
    name: "Condiments",
    slug: "condiments",
    description: "All sauces, dressings, and condiments",
    parentCategory: "",
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=various%2520condiments%2520sauces%2520and%2520dressings%2520on%2520white%2520background%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520different%2520condiments%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=38&orientation=squarish",
    ingredientCount: 32,
    lastModified: "Jun 19, 2025",
    selected: false,
    expanded: false,
    children: [],
  },
  {
    id: "14",
    name: "Beverages",
    slug: "beverages",
    description: "All types of drinks and beverage ingredients",
    parentCategory: "",
    status: "Inactive",
    image:
      "https://readdy.ai/api/search-image?query=various%2520beverages%2520and%2520drink%2520ingredients%2520on%2520white%2520background%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520different%2520beverages%2520perfect%2520for%2520food%2520category%2520icon&width=100&height=100&seq=39&orientation=squarish",
    ingredientCount: 20,
    lastModified: "Jun 20, 2025",
    selected: false,
    expanded: false,
    children: [],
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
  showParentFilter.value = false;
  showUsageFilter.value = false;
};

const toggleParentFilter = () => {
  showParentFilter.value = !showParentFilter.value;
  showStatusFilter.value = false;
  showUsageFilter.value = false;
};

const toggleUsageFilter = () => {
  showUsageFilter.value = !showUsageFilter.value;
  showStatusFilter.value = false;
  showParentFilter.value = false;
};

const toggleCategoryActions = (index: number) => {
  activeCategoryActions.value =
    activeCategoryActions.value === index ? null : index;
};

const toggleBulkActions = () => {
  showBulkActions.value = !showBulkActions.value;
};

const toggleCategoryExpand = (id: string) => {
  const findAndToggle = (categories: any[]) => {
    for (const category of categories) {
      if (category.id === id) {
        category.expanded = !category.expanded;
        return true;
      }
      if (category.children && category.children.length > 0) {
        if (findAndToggle(category.children)) {
          return true;
        }
      }
    }
    return false;
  };

  findAndToggle(categories.value);
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

const filterByParent = (parent: string) => {
  parentFilter.value = parent;
  showParentFilter.value = false;
  if (parent !== "All") {
    const existingIndex = activeFilters.value.findIndex((filter) =>
      filter.includes("Hierarchy:"),
    );
    if (existingIndex !== -1) {
      activeFilters.value[existingIndex] = `Hierarchy: ${parent}`;
    } else {
      activeFilters.value.push(`Hierarchy: ${parent}`);
    }
  } else {
    removeFilterByType("Hierarchy:");
  }
  currentPage.value = 1;
};

const filterByUsage = (usage: string) => {
  usageFilter.value = usage;
  showUsageFilter.value = false;
  if (usage !== "All") {
    const existingIndex = activeFilters.value.findIndex((filter) =>
      filter.includes("Usage:"),
    );
    if (existingIndex !== -1) {
      activeFilters.value[existingIndex] = `Usage: ${usage}`;
    } else {
      activeFilters.value.push(`Usage: ${usage}`);
    }
  } else {
    removeFilterByType("Usage:");
  }
  currentPage.value = 1;
};

const removeFilter = (index: number) => {
  const filter = activeFilters.value[index];
  activeFilters.value.splice(index, 1);
  if (filter.includes("Status:")) {
    statusFilter.value = "All";
  } else if (filter.includes("Hierarchy:")) {
    parentFilter.value = "All";
  } else if (filter.includes("Usage:")) {
    usageFilter.value = "All";
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
  parentFilter.value = "All";
  usageFilter.value = "All";
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
    parentCategory: "",
    image: "",
    status: "Active",
    ingredientCount: 0,
    lastModified: "",
    children: [],
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

const addSubcategory = (parentCategory: any) => {
  editMode.value = false;
  currentCategory.value = {
    id: "",
    name: "",
    slug: "",
    description: "",
    parentCategory: parentCategory.name,
    image: "",
    status: "Active",
    ingredientCount: 0,
    lastModified: "",
    children: [],
  };
  categoryStatusActive.value = true;
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
    const updateCategory = (categoryList: any[]) => {
      for (let i = 0; i < categoryList.length; i++) {
        if (categoryList[i].id === currentCategory.value.id) {
          categoryList[i] = {
            ...currentCategory.value,
            lastModified: "Just now",
            children: categoryList[i].children || [],
            expanded: categoryList[i].expanded || false,
          };
          return true;
        }
        if (categoryList[i].children && categoryList[i].children.length > 0) {
          if (updateCategory(categoryList[i].children)) {
            return true;
          }
        }
      }
      return false;
    };

    updateCategory(categories.value);
  } else {
    // Add new category
    const newId = Date.now().toString();
    const newCategory = {
      ...currentCategory.value,
      id: newId,
      lastModified: "Just now",
      selected: false,
      expanded: false,
      children: [],
    };

    if (!newCategory.image) {
      newCategory.image =
        "https://readdy.ai/api/search-image?query=generic%2520food%2520category%2520icon%2520with%2520simple%2520food%2520symbol%2520on%2520light%2520background%2520minimal%2520clean%2520design%2520high%2520resolution%2520professional%2520food%2520category%2520representation&width=100&height=100&seq=40&orientation=squarish";
    }

    if (newCategory.parentCategory) {
      // Add as child to parent category
      const addToParent = (categoryList: any[]) => {
        for (const category of categoryList) {
          if (category.name === newCategory.parentCategory) {
            if (!category.children) {
              category.children = [];
            }
            category.children.push(newCategory);
            return true;
          }
          if (category.children && category.children.length > 0) {
            if (addToParent(category.children)) {
              return true;
            }
          }
        }
        return false;
      };

      addToParent(categories.value);
    } else {
      // Add as root category
      categories.value.push(newCategory);
    }
  }

  closeCategoryModal();
  initChart(); // Refresh chart after changes
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
    const removeSelected = (categoryList: any[]): any[] => {
      return categoryList.filter((category) => {
        if (category.selected) {
          return false;
        }
        if (category.children && category.children.length > 0) {
          category.children = removeSelected(category.children);
        }
        return true;
      });
    };

    categories.value = removeSelected(categories.value);
  } else if (categoryToDelete.value) {
    // Delete single category
    const removeCategory = (categoryList: any[], id: string): boolean => {
      for (let i = 0; i < categoryList.length; i++) {
        if (categoryList[i].id === id) {
          categoryList.splice(i, 1);
          return true;
        }
        if (categoryList[i].children && categoryList[i].children.length > 0) {
          if (removeCategory(categoryList[i].children, id)) {
            return true;
          }
        }
      }
      return false;
    };

    removeCategory(categories.value, categoryToDelete.value.id);
  }

  closeDeleteModal();
  initChart(); // Refresh chart after changes
};

const closeDeleteModal = () => {
  showDeleteModal.value = false;
  categoryToDelete.value = null;
  bulkDeleteMode.value = false;
};

// Bulk actions
const bulkActivate = () => {
  const updateStatus = (categoryList: any[]) => {
    for (const category of categoryList) {
      if (category.selected) {
        category.status = "Active";
        category.lastModified = "Just now";
      }
      if (category.children && category.children.length > 0) {
        updateStatus(category.children);
      }
    }
  };

  updateStatus(categories.value);
  showBulkActions.value = false;
};

const bulkDeactivate = () => {
  const updateStatus = (categoryList: any[]) => {
    for (const category of categoryList) {
      if (category.selected) {
        category.status = "Inactive";
        category.lastModified = "Just now";
      }
      if (category.children && category.children.length > 0) {
        updateStatus(category.children);
      }
    }
  };

  updateStatus(categories.value);
  showBulkActions.value = false;
};

const bulkExport = () => {
  // In a real application, this would trigger an export process
  alert("Exporting selected categories...");
  showBulkActions.value = false;
};

const bulkChangeParent = () => {
  bulkParentValue.value = "";
  showParentChangeModal.value = true;
  showBulkActions.value = false;
};

const applyBulkParentChange = () => {
  const selectedCategories = getSelectedCategories(categories.value);

  // First remove selected categories from their current location
  const removeSelected = (categoryList: any[]): any[] => {
    return categoryList.filter((category) => {
      if (category.selected) {
        return false;
      }
      if (category.children && category.children.length > 0) {
        category.children = removeSelected(category.children);
      }
      return true;
    });
  };

  categories.value = removeSelected(categories.value);

  // Then add them to the new parent or as root categories
  if (bulkParentValue.value) {
    // Add to specified parent
    const addToParent = (categoryList: any[], selectedCats: any[]) => {
      for (const category of categoryList) {
        if (category.name === bulkParentValue.value) {
          if (!category.children) {
            category.children = [];
          }
          for (const selectedCat of selectedCats) {
            selectedCat.parentCategory = bulkParentValue.value;
            selectedCat.lastModified = "Just now";
            category.children.push(selectedCat);
          }
          return true;
        }
        if (category.children && category.children.length > 0) {
          if (addToParent(category.children, selectedCats)) {
            return true;
          }
        }
      }
      return false;
    };

    addToParent(categories.value, selectedCategories);
  } else {
    // Add as root categories
    for (const selectedCat of selectedCategories) {
      selectedCat.parentCategory = "";
      selectedCat.lastModified = "Just now";
      categories.value.push(selectedCat);
    }
  }

  closeParentChangeModal();
  initChart(); // Refresh chart after changes
};

const closeParentChangeModal = () => {
  showParentChangeModal.value = false;
};

// Helper function to get all selected categories
const getSelectedCategories = (categoryList: any[]): any[] => {
  let result: any[] = [];

  for (const category of categoryList) {
    if (category.selected) {
      const categoryCopy = { ...category, selected: false };
      result.push(categoryCopy);
    }
    if (category.children && category.children.length > 0) {
      result = result.concat(getSelectedCategories(category.children));
    }
  }

  return result;
};

// Selection functions
const toggleSelectAll = (event: Event) => {
  const checked = (event.target as HTMLInputElement).checked;

  const updateSelection = (categoryList: any[]) => {
    for (const category of categoryList) {
      category.selected = checked;
      if (category.children && category.children.length > 0) {
        updateSelection(category.children);
      }
    }
  };

  updateSelection(categories.value);
};

const clearSelection = () => {
  const updateSelection = (categoryList: any[]) => {
    for (const category of categoryList) {
      category.selected = false;
      if (category.children && category.children.length > 0) {
        updateSelection(category.children);
      }
    }
  };

  updateSelection(categories.value);
};

// Computed properties
const flattenedCategories = computed(() => {
  const result: any[] = [];

  const flatten = (categoryList: any[]) => {
    for (const category of categoryList) {
      result.push(category);
      if (category.children && category.children.length > 0) {
        flatten(category.children);
      }
    }
  };

  flatten(categories.value);
  return result;
});

const filteredCategories = computed(() => {
  let result = [...flattenedCategories.value];

  // Apply search filter
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase();
    result = result.filter(
      (category) =>
        category.name.toLowerCase().includes(query) ||
        category.description.toLowerCase().includes(query) ||
        category.slug.toLowerCase().includes(query) ||
        (category.parentCategory &&
          category.parentCategory.toLowerCase().includes(query)),
    );
  }

  // Apply status filter
  if (statusFilter.value !== "All") {
    result = result.filter(
      (category) => category.status === statusFilter.value,
    );
  }

  // Apply parent filter
  if (parentFilter.value !== "All") {
    if (parentFilter.value === "Root") {
      result = result.filter((category) => !category.parentCategory);
    } else if (parentFilter.value === "Children") {
      result = result.filter((category) => category.parentCategory);
    }
  }

  // Apply usage filter
  if (usageFilter.value !== "All") {
    if (usageFilter.value === "Used") {
      result = result.filter((category) => category.ingredientCount > 0);
    } else if (usageFilter.value === "Unused") {
      result = result.filter((category) => category.ingredientCount === 0);
    }
  }

  // Pagination
  const startIndex =
    (currentPage.value - 1) * parseInt(perPage.value.toString());
  const endIndex = startIndex + parseInt(perPage.value.toString());
  return result.slice(startIndex, endIndex);
});

const totalCategories = computed(() => {
  let result = [...flattenedCategories.value];

  // Apply search filter
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase();
    result = result.filter(
      (category) =>
        category.name.toLowerCase().includes(query) ||
        category.description.toLowerCase().includes(query) ||
        category.slug.toLowerCase().includes(query) ||
        (category.parentCategory &&
          category.parentCategory.toLowerCase().includes(query)),
    );
  }

  // Apply status filter
  if (statusFilter.value !== "All") {
    result = result.filter(
      (category) => category.status === statusFilter.value,
    );
  }

  // Apply parent filter
  if (parentFilter.value !== "All") {
    if (parentFilter.value === "Root") {
      result = result.filter((category) => !category.parentCategory);
    } else if (parentFilter.value === "Children") {
      result = result.filter((category) => category.parentCategory);
    }
  }

  // Apply usage filter
  if (usageFilter.value !== "All") {
    if (usageFilter.value === "Used") {
      result = result.filter((category) => category.ingredientCount > 0);
    } else if (usageFilter.value === "Unused") {
      result = result.filter((category) => category.ingredientCount === 0);
    }
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
  const hasSelected = (categoryList: any[]): boolean => {
    for (const category of categoryList) {
      if (category.selected) {
        return true;
      }
      if (category.children && category.children.length > 0) {
        if (hasSelected(category.children)) {
          return true;
        }
      }
    }
    return false;
  };

  return hasSelected(categories.value);
});

const selectedCount = computed(() => {
  let count = 0;

  const countSelected = (categoryList: any[]) => {
    for (const category of categoryList) {
      if (category.selected) {
        count++;
      }
      if (category.children && category.children.length > 0) {
        countSelected(category.children);
      }
    }
  };

  countSelected(categories.value);
  return count;
});

const allSelected = computed(() => {
  const allCats = flattenedCategories.value;
  return allCats.length > 0 && allCats.every((category) => category.selected);
});

const rootCategories = computed(() => {
  return categories.value.filter((category) => !category.parentCategory);
});

const availableParentCategories = computed(() => {
  // When editing, don't allow a category to be its own parent or child
  if (editMode.value) {
    const result: any[] = [];

    const addIfNotSelfOrChild = (categoryList: any[], currentId: string) => {
      for (const category of categoryList) {
        if (category.id !== currentId) {
          // Check if this category is not a child of the current category
          const isChild = isChildOf(category.id, currentId, categories.value);
          if (!isChild) {
            result.push(category);
          }
        }
        if (category.children && category.children.length > 0) {
          addIfNotSelfOrChild(category.children, currentId);
        }
      }
    };

    addIfNotSelfOrChild(categories.value, currentCategory.value.id);
    return result;
  }

  // When adding new, all categories can be parents
  return flattenedCategories.value;
});

// Helper function to check if a category is a child of another
const isChildOf = (
  categoryId: string,
  parentId: string,
  categoryList: any[],
): boolean => {
  for (const category of categoryList) {
    if (category.id === parentId) {
      if (category.children && category.children.length > 0) {
        for (const child of category.children) {
          if (child.id === categoryId) {
            return true;
          }
          if (child.children && child.children.length > 0) {
            if (isChildOf(categoryId, child.id, [child])) {
              return true;
            }
          }
        }
      }
    }
    if (category.children && category.children.length > 0) {
      if (isChildOf(categoryId, parentId, category.children)) {
        return true;
      }
    }
  }
  return false;
};

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

// Chart initialization
const initChart = () => {
  if (!categoryChart.value) return;

  if (chart) {
    chart.dispose();
  }

  chart = echarts.init(categoryChart.value);

  // Prepare data for chart
  const categoryNames: string[] = [];
  const ingredientCounts: number[] = [];
  const colors = [
    "#10B981", // emerald-600
    "#34D399", // emerald-400
    "#6EE7B7", // emerald-300
    "#A7F3D0", // emerald-200
    "#D1FAE5", // emerald-100
    "#059669", // emerald-700
    "#047857", // emerald-800
    "#064E3B", // emerald-900
    "#ECFDF5", // emerald-50
  ];

  // Get top categories by ingredient count
  const topCategories = [...rootCategories.value]
    .sort((a, b) => b.ingredientCount - a.ingredientCount)
    .slice(0, 8);

  topCategories.forEach((category) => {
    categoryNames.push(category.name);
    ingredientCounts.push(category.ingredientCount);
  });

  // Add "Other" category if needed
  const otherCount = rootCategories.value
    .filter((cat) => !topCategories.includes(cat))
    .reduce((sum, cat) => sum + cat.ingredientCount, 0);

  if (otherCount > 0) {
    categoryNames.push("Other");
    ingredientCounts.push(otherCount);
  }

  const option = {
    animation: false,
    tooltip: {
      trigger: "item",
      formatter: "{a} <br/>{b}: {c} ({d}%)",
    },
    legend: {
      orient: "vertical",
      right: 10,
      top: "center",
      data: categoryNames,
    },
    series: [
      {
        name: "Ingredient Count",
        type: "pie",
        radius: ["40%", "70%"],
        avoidLabelOverlap: false,
        itemStyle: {
          borderRadius: 10,
          borderColor: "#fff",
          borderWidth: 2,
        },
        label: {
          show: false,
          position: "center",
        },
        emphasis: {
          label: {
            show: true,
            fontSize: "18",
            fontWeight: "bold",
          },
        },
        labelLine: {
          show: false,
        },
        data: categoryNames.map((name, index) => ({
          value: ingredientCounts[index],
          name: name,
          itemStyle: {
            color: colors[index % colors.length],
          },
        })),
      },
    ],
  };

  chart.setOption(option);
};

onMounted(() => {
  // Initialize chart
  initChart();

  // Handle window resize for chart
  window.addEventListener("resize", () => {
    if (chart) {
      chart.resize();
    }
  });

  // Close dropdowns when clicking outside
  document.addEventListener("click", (e) => {
    const target = e.target as HTMLElement;

    if (showUserMenu.value && !target.closest(".user-menu")) {
      showUserMenu.value = false;
    }

    if (showStatusFilter.value && !target.closest(".status-filter")) {
      showStatusFilter.value = false;
    }

    if (showParentFilter.value && !target.closest(".parent-filter")) {
      showParentFilter.value = false;
    }

    if (showUsageFilter.value && !target.closest(".usage-filter")) {
      showUsageFilter.value = false;
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

/* Hierarchy Tree Styles */
.hierarchy-tree {
  position: relative;
}

.hierarchy-tree::before {
  content: "";
  position: absolute;
  top: 0;
  bottom: 0;
  left: 10px;
  width: 2px;
  background-color: #e5e7eb;
  z-index: 0;
}
</style>
