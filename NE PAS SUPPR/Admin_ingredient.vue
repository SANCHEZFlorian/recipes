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
            href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/f020ca5d-76a8-4b4b-8587-1e7cc939a0ed"
            data-readdy="true"
            class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg bg-emerald-50 text-emerald-700 cursor-pointer"
          >
            <i class="fas fa-carrot w-5 h-5 mr-3 text-emerald-600"></i>
            Ingredient Management
          </a>
          <div class="pl-8 mt-1">
            <a
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/e0edf785-1f19-493d-afbc-9228ae444714"
              data-readdy="true"
              class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
            >
              <i class="fas fa-layer-group w-5 h-5 mr-3 text-gray-500"></i>
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
            <span class="text-emerald-600 font-medium"
              >Ingredient Management</span
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
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/f020ca5d-76a8-4b4b-8587-1e7cc939a0ed"
              data-readdy="true"
              class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg bg-emerald-50 text-emerald-700 cursor-pointer"
            >
              <i class="fas fa-carrot w-5 h-5 mr-3 text-emerald-600"></i>
              Ingredient Management
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
                Ingredient Management
              </h1>
              <p class="mt-1 text-sm text-gray-600">
                Create, organize, and manage ingredients for recipe creation
              </p>
            </div>
            <!-- Ingredient Management Content -->
            <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
              <!-- Header with Actions -->
              <div
                class="px-6 py-5 border-b border-gray-200 bg-white flex flex-col md:flex-row md:items-center md:justify-between gap-4"
              >
                <div class="flex-1">
                  <h3 class="text-lg font-medium text-gray-900">
                    Recipe Ingredients
                  </h3>
                  <p class="mt-1 text-sm text-gray-500">
                    Manage ingredients and their nutritional information
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
                    @click="openAddIngredientModal"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 cursor-pointer whitespace-nowrap !rounded-button"
                  >
                    <i class="fas fa-plus mr-2"></i>
                    Add Ingredient
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
                      placeholder="Search ingredients..."
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
                        @click="toggleCategoryFilter"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        <i class="fas fa-tags mr-2"></i>
                        Category
                        <i class="fas fa-chevron-down ml-2"></i>
                      </button>
                      <div
                        v-if="showCategoryFilter"
                        class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10"
                      >
                        <div class="py-1 max-h-60 overflow-y-auto">
                          <a
                            href="#"
                            @click.prevent="filterByCategory('All')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >All Categories</a
                          >
                          <a
                            href="#"
                            v-for="(category, index) in categories"
                            :key="index"
                            @click.prevent="filterByCategory(category)"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >{{ category }}</a
                          >
                        </div>
                      </div>
                    </div>
                    <div class="relative inline-block text-left">
                      <button
                        @click="toggleUnitFilter"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        <i class="fas fa-balance-scale mr-2"></i>
                        Unit
                        <i class="fas fa-chevron-down ml-2"></i>
                      </button>
                      <div
                        v-if="showUnitFilter"
                        class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10"
                      >
                        <div class="py-1">
                          <a
                            href="#"
                            @click.prevent="filterByUnit('All')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >All Units</a
                          >
                          <a
                            href="#"
                            v-for="(unit, index) in units"
                            :key="index"
                            @click.prevent="filterByUnit(unit)"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >{{ unit }}</a
                          >
                        </div>
                      </div>
                    </div>
                    <div class="relative inline-block text-left">
                      <button
                        @click="toggleNutritionalFilter"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        <i class="fas fa-heartbeat mr-2"></i>
                        Nutritional Info
                        <i class="fas fa-chevron-down ml-2"></i>
                      </button>
                      <div
                        v-if="showNutritionalFilter"
                        class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10"
                      >
                        <div class="py-1">
                          <a
                            href="#"
                            @click.prevent="filterByNutritionalInfo('All')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >All</a
                          >
                          <a
                            href="#"
                            @click.prevent="filterByNutritionalInfo('Available')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >Available</a
                          >
                          <a
                            href="#"
                            @click.prevent="filterByNutritionalInfo('Not Available')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >Not Available</a
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
              <!-- Ingredients Table -->
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
                        Ingredient
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
                        Measurement Unit
                      </th>
                      <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        Nutritional Info
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
                      v-for="(ingredient, index) in filteredIngredients"
                      :key="index"
                      class="hover:bg-gray-50"
                    >
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                          <input
                            type="checkbox"
                            v-model="ingredient.selected"
                            class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded"
                          />
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                          <div class="flex-shrink-0 h-10 w-10">
                            <img
                              :src="ingredient.image"
                              :alt="ingredient.name"
                              class="h-10 w-10 rounded-md object-cover"
                            />
                          </div>
                          <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                              {{ ingredient.name }}
                            </div>
                            <div class="text-xs text-gray-500">
                              {{ ingredient.slug }}
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                          {{ ingredient.category }}
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                          {{ ingredient.unit }}
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span
                          :class="[
'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
ingredient.nutritionalInfo ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'
]"
                        >
                          {{ ingredient.nutritionalInfo ? 'Available' : 'Not
                          Available' }}
                        </span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span
                          :class="[
'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
ingredient.status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'
]"
                        >
                          {{ ingredient.status }}
                        </span>
                      </td>
                      <td
                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                      >
                        {{ ingredient.created }}
                      </td>
                      <td
                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                      >
                        {{ ingredient.lastModified }}
                      </td>
                      <td
                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                      >
                        <div class="flex justify-end space-x-2">
                          <button
                            @click="editIngredient(ingredient)"
                            class="text-emerald-600 hover:text-emerald-900 cursor-pointer whitespace-nowrap !rounded-button"
                          >
                            <i class="fas fa-edit"></i>
                          </button>
                          <button
                            @click="confirmDelete(ingredient)"
                            class="text-red-600 hover:text-red-900 cursor-pointer whitespace-nowrap !rounded-button"
                          >
                            <i class="fas fa-trash-alt"></i>
                          </button>
                          <div class="relative">
                            <button
                              @click="toggleIngredientActions(index)"
                              class="text-gray-500 hover:text-gray-700 cursor-pointer whitespace-nowrap !rounded-button"
                            >
                              <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div
                              v-if="activeIngredientActions === index"
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
                                  {{ ingredient.status === 'Active' ?
                                  'Deactivate' : 'Activate' }}
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr v-if="filteredIngredients.length === 0">
                      <td colspan="9" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                          <i
                            class="fas fa-search text-gray-400 text-4xl mb-4"
                          ></i>
                          <h3 class="text-lg font-medium text-gray-900 mb-1">
                            No ingredients found
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
                            @click.prevent="bulkChangeCategory"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >Change Category</a
                          >
                          <a
                            href="#"
                            @click.prevent="bulkChangeUnit"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                            >Update Unit</a
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
                      <span class="font-medium">{{ totalIngredients }}</span>
                      ingredients
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
  <!-- Add/Edit Ingredient Modal -->
  <div
    v-if="showIngredientModal"
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
        @click="closeIngredientModal"
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
                {{ editMode ? 'Edit Ingredient' : 'Add New Ingredient' }}
              </h3>
              <div class="mt-4 space-y-4">
                <div>
                  <label
                    for="ingredient-name"
                    class="block text-sm font-medium text-gray-700"
                    >Ingredient Name</label
                  >
                  <input
                    type="text"
                    id="ingredient-name"
                    v-model="currentIngredient.name"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    placeholder="e.g. Fresh Tomatoes"
                  />
                </div>
                <div>
                  <label
                    for="ingredient-slug"
                    class="block text-sm font-medium text-gray-700"
                    >Slug</label
                  >
                  <input
                    type="text"
                    id="ingredient-slug"
                    v-model="currentIngredient.slug"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    placeholder="e.g. fresh-tomatoes"
                  />
                </div>
                <div>
                  <label
                    for="ingredient-category"
                    class="block text-sm font-medium text-gray-700"
                    >Category</label
                  >
                  <select
                    id="ingredient-category"
                    v-model="currentIngredient.category"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm rounded-md"
                  >
                    <option
                      v-for="(category, index) in categories"
                      :key="index"
                      :value="category"
                    >
                      {{ category }}
                    </option>
                  </select>
                </div>
                <div>
                  <label
                    for="ingredient-unit"
                    class="block text-sm font-medium text-gray-700"
                    >Measurement Unit</label
                  >
                  <select
                    id="ingredient-unit"
                    v-model="currentIngredient.unit"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm rounded-md"
                  >
                    <option
                      v-for="(unit, index) in units"
                      :key="index"
                      :value="unit"
                    >
                      {{ unit }}
                    </option>
                  </select>
                </div>
                <div>
                  <div class="flex items-center justify-between">
                    <label class="block text-sm font-medium text-gray-700"
                      >Nutritional Information</label
                    >
                    <div
                      class="relative inline-block w-10 mr-2 align-middle select-none"
                    >
                      <input
                        type="checkbox"
                        id="nutritional-info"
                        v-model="hasNutritionalInfo"
                        class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer"
                      />
                      <label
                        for="nutritional-info"
                        class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                      ></label>
                    </div>
                  </div>
                  <div
                    v-if="hasNutritionalInfo"
                    class="mt-3 grid grid-cols-2 gap-3"
                  >
                    <div>
                      <label
                        for="calories"
                        class="block text-sm font-medium text-gray-700"
                        >Calories</label
                      >
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <input
                          type="number"
                          id="calories"
                          v-model="nutritionalValues.calories"
                          class="focus:ring-emerald-500 focus:border-emerald-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                          placeholder="0"
                        />
                        <span
                          class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"
                        >
                          kcal
                        </span>
                      </div>
                    </div>
                    <div>
                      <label
                        for="protein"
                        class="block text-sm font-medium text-gray-700"
                        >Protein</label
                      >
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <input
                          type="number"
                          id="protein"
                          v-model="nutritionalValues.protein"
                          class="focus:ring-emerald-500 focus:border-emerald-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                          placeholder="0"
                        />
                        <span
                          class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"
                        >
                          g
                        </span>
                      </div>
                    </div>
                    <div>
                      <label
                        for="carbs"
                        class="block text-sm font-medium text-gray-700"
                        >Carbs</label
                      >
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <input
                          type="number"
                          id="carbs"
                          v-model="nutritionalValues.carbs"
                          class="focus:ring-emerald-500 focus:border-emerald-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                          placeholder="0"
                        />
                        <span
                          class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"
                        >
                          g
                        </span>
                      </div>
                    </div>
                    <div>
                      <label
                        for="fat"
                        class="block text-sm font-medium text-gray-700"
                        >Fat</label
                      >
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <input
                          type="number"
                          id="fat"
                          v-model="nutritionalValues.fat"
                          class="focus:ring-emerald-500 focus:border-emerald-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                          placeholder="0"
                        />
                        <span
                          class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"
                        >
                          g
                        </span>
                      </div>
                    </div>
                  </div>
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
                        id="ingredient-status"
                        v-model="ingredientStatusActive"
                        class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer"
                      />
                      <label
                        for="ingredient-status"
                        class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                      ></label>
                    </div>
                    <span class="text-sm text-gray-700"
                      >{{ ingredientStatusActive ? 'Active' : 'Inactive'
                      }}</span
                    >
                  </div>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700"
                    >Ingredient Image</label
                  >
                  <div class="mt-2 flex items-center">
                    <div
                      class="flex-shrink-0 h-16 w-16 bg-gray-100 rounded-md overflow-hidden"
                    >
                      <img
                        v-if="currentIngredient.image"
                        :src="currentIngredient.image"
                        alt="Ingredient preview"
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
            @click="saveIngredient"
            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:ml-3 sm:w-auto sm:text-sm cursor-pointer whitespace-nowrap !rounded-button"
          >
            {{ editMode ? 'Save Changes' : 'Add Ingredient' }}
          </button>
          <button
            @click="closeIngredientModal"
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
                {{ bulkDeleteMode ? 'Delete Selected Ingredients' : 'Delete
                Ingredient' }}
              </h3>
              <div class="mt-2">
                <p class="text-sm text-gray-500">
                  {{ bulkDeleteMode ? `Are you sure you want to delete the
                  ${selectedCount} selected ingredients? This action cannot be
                  undone.` : `Are you sure you want to delete
                  "${ingredientToDelete?.name}"? This action cannot be undone.`
                  }}
                </p>
                <div
                  v-if="ingredientToDelete && ingredientToDelete.recipeCount > 0"
                  class="mt-2 p-3 bg-amber-50 text-amber-800 rounded-md text-sm"
                >
                  <i class="fas fa-exclamation-circle mr-2"></i>
                  Warning: This ingredient is used in {{
                  ingredientToDelete.recipeCount }} recipes. Deleting it may
                  affect recipe preparation.
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button
            @click="deleteIngredient"
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
  <!-- Bulk Category Change Modal -->
  <div
    v-if="showCategoryChangeModal"
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
        @click="closeCategoryChangeModal"
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
                Change Category for Selected Ingredients
              </h3>
              <div class="mt-4">
                <label
                  for="bulk-category"
                  class="block text-sm font-medium text-gray-700"
                  >Select Category</label
                >
                <select
                  id="bulk-category"
                  v-model="bulkCategoryValue"
                  class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm rounded-md"
                >
                  <option
                    v-for="(category, index) in categories"
                    :key="index"
                    :value="category"
                  >
                    {{ category }}
                  </option>
                </select>
                <p class="mt-2 text-sm text-gray-500">
                  This will update the category for all {{ selectedCount }}
                  selected ingredients.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button
            @click="applyBulkCategoryChange"
            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:ml-3 sm:w-auto sm:text-sm cursor-pointer whitespace-nowrap !rounded-button"
          >
            Apply Changes
          </button>
          <button
            @click="closeCategoryChangeModal"
            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm cursor-pointer whitespace-nowrap !rounded-button"
          >
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Bulk Unit Change Modal -->
  <div
    v-if="showUnitChangeModal"
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
        @click="closeUnitChangeModal"
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
                Update Measurement Unit for Selected Ingredients
              </h3>
              <div class="mt-4">
                <label
                  for="bulk-unit"
                  class="block text-sm font-medium text-gray-700"
                  >Select Measurement Unit</label
                >
                <select
                  id="bulk-unit"
                  v-model="bulkUnitValue"
                  class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm rounded-md"
                >
                  <option
                    v-for="(unit, index) in units"
                    :key="index"
                    :value="unit"
                  >
                    {{ unit }}
                  </option>
                </select>
                <p class="mt-2 text-sm text-gray-500">
                  This will update the measurement unit for all {{ selectedCount
                  }} selected ingredients.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button
            @click="applyBulkUnitChange"
            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:ml-3 sm:w-auto sm:text-sm cursor-pointer whitespace-nowrap !rounded-button"
          >
            Apply Changes
          </button>
          <button
            @click="closeUnitChangeModal"
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
const showCategoryFilter = ref(false);
const showUnitFilter = ref(false);
const showNutritionalFilter = ref(false);
const activeIngredientActions = ref<number | null>(null);
const showIngredientModal = ref(false);
const showDeleteModal = ref(false);
const showBulkActions = ref(false);
const showCategoryChangeModal = ref(false);
const showUnitChangeModal = ref(false);
const editMode = ref(false);
const bulkDeleteMode = ref(false);
const searchQuery = ref("");
const activeFilters = ref<string[]>([]);
const statusFilter = ref("All");
const categoryFilter = ref("All");
const unitFilter = ref("All");
const nutritionalInfoFilter = ref("All");
const currentPage = ref(1);
const perPage = ref(10);
const bulkCategoryValue = ref("");
const bulkUnitValue = ref("");
// Available categories and units
const categories = ref([
  "Vegetables",
  "Fruits",
  "Meats",
  "Seafood",
  "Dairy",
  "Grains",
  "Herbs & Spices",
  "Oils & Vinegars",
  "Nuts & Seeds",
  "Legumes",
  "Baking",
  "Sweeteners",
  "Condiments",
  "Beverages",
]);
const units = ref([
  "Grams (g)",
  "Kilograms (kg)",
  "Ounces (oz)",
  "Pounds (lb)",
  "Milliliters (ml)",
  "Liters (L)",
  "Teaspoons (tsp)",
  "Tablespoons (tbsp)",
  "Cups",
  "Pieces",
  "Slices",
  "Cloves",
  "Pinch",
  "Bunch",
  "To taste",
]);
// Ingredient being edited or deleted
const currentIngredient = ref({
  id: "",
  name: "",
  slug: "",
  category: "Vegetables",
  unit: "Grams (g)",
  nutritionalInfo: false,
  status: "Active",
  image: "",
  recipeCount: 0,
  created: "",
  lastModified: "",
});
const ingredientStatusActive = ref(true);
const hasNutritionalInfo = ref(false);
const nutritionalValues = ref({
  calories: 0,
  protein: 0,
  carbs: 0,
  fat: 0,
});
const ingredientToDelete = ref<any>(null);
// Sample data for ingredients
const ingredients = ref([
  {
    id: "1",
    name: "Fresh Tomatoes",
    slug: "fresh-tomatoes",
    category: "Vegetables",
    unit: "Grams (g)",
    nutritionalInfo: true,
    nutritionalDetails: {
      calories: 18,
      protein: 0.9,
      carbs: 3.9,
      fat: 0.2,
    },
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=fresh%2520ripe%2520tomatoes%2520on%2520white%2520background%2520vibrant%2520red%2520color%2520clean%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520texture%2520and%2520details%2520of%2520the%2520vegetable&width=100&height=100&seq=3&orientation=squarish",
    recipeCount: 42,
    created: "Jan 15, 2025",
    lastModified: "2 days ago",
    selected: false,
  },
  {
    id: "2",
    name: "Chicken Breast",
    slug: "chicken-breast",
    category: "Meats",
    unit: "Grams (g)",
    nutritionalInfo: true,
    nutritionalDetails: {
      calories: 165,
      protein: 31,
      carbs: 0,
      fat: 3.6,
    },
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=raw%2520chicken%2520breast%2520fillet%2520on%2520white%2520background%2520clean%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520texture%2520and%2520details%2520of%2520the%2520meat%2520perfect%2520for%2520ingredient%2520database&width=100&height=100&seq=4&orientation=squarish",
    recipeCount: 78,
    created: "Jan 20, 2025",
    lastModified: "1 week ago",
    selected: false,
  },
  {
    id: "3",
    name: "Extra Virgin Olive Oil",
    slug: "extra-virgin-olive-oil",
    category: "Oils & Vinegars",
    unit: "Milliliters (ml)",
    nutritionalInfo: true,
    nutritionalDetails: {
      calories: 884,
      protein: 0,
      carbs: 0,
      fat: 100,
    },
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=bottle%2520of%2520extra%2520virgin%2520olive%2520oil%2520with%2520olives%2520on%2520white%2520background%2520clean%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520the%2520golden%2520green%2520liquid%2520perfect%2520for%2520ingredient%2520database&width=100&height=100&seq=5&orientation=squarish",
    recipeCount: 126,
    created: "Feb 5, 2025",
    lastModified: "3 days ago",
    selected: false,
  },
  {
    id: "4",
    name: "Basmati Rice",
    slug: "basmati-rice",
    category: "Grains",
    unit: "Grams (g)",
    nutritionalInfo: true,
    nutritionalDetails: {
      calories: 356,
      protein: 6.6,
      carbs: 79,
      fat: 0.6,
    },
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=basmati%2520rice%2520grains%2520on%2520white%2520background%2520clean%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520the%2520long%2520slender%2520grains%2520perfect%2520for%2520ingredient%2520database&width=100&height=100&seq=6&orientation=squarish",
    recipeCount: 56,
    created: "Feb 12, 2025",
    lastModified: "5 days ago",
    selected: false,
  },
  {
    id: "5",
    name: "Fresh Basil",
    slug: "fresh-basil",
    category: "Herbs & Spices",
    unit: "Grams (g)",
    nutritionalInfo: true,
    nutritionalDetails: {
      calories: 23,
      protein: 3.2,
      carbs: 2.7,
      fat: 0.6,
    },
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=fresh%2520basil%2520leaves%2520on%2520white%2520background%2520vibrant%2520green%2520color%2520clean%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520texture%2520and%2520details%2520of%2520the%2520herb%2520perfect%2520for%2520ingredient%2520database&width=100&height=100&seq=7&orientation=squarish",
    recipeCount: 89,
    created: "Feb 18, 2025",
    lastModified: "1 day ago",
    selected: false,
  },
  {
    id: "6",
    name: "Parmesan Cheese",
    slug: "parmesan-cheese",
    category: "Dairy",
    unit: "Grams (g)",
    nutritionalInfo: true,
    nutritionalDetails: {
      calories: 431,
      protein: 38,
      carbs: 3.2,
      fat: 29,
    },
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=parmesan%2520cheese%2520block%2520and%2520grated%2520on%2520white%2520background%2520clean%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520texture%2520and%2520details%2520perfect%2520for%2520ingredient%2520database&width=100&height=100&seq=8&orientation=squarish",
    recipeCount: 67,
    created: "Mar 2, 2025",
    lastModified: "4 days ago",
    selected: false,
  },
  {
    id: "7",
    name: "Garlic",
    slug: "garlic",
    category: "Vegetables",
    unit: "Cloves",
    nutritionalInfo: true,
    nutritionalDetails: {
      calories: 4.5,
      protein: 0.2,
      carbs: 1,
      fat: 0,
    },
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=garlic%2520bulb%2520and%2520cloves%2520on%2520white%2520background%2520clean%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520texture%2520and%2520details%2520perfect%2520for%2520ingredient%2520database&width=100&height=100&seq=9&orientation=squarish",
    recipeCount: 112,
    created: "Mar 10, 2025",
    lastModified: "2 days ago",
    selected: false,
  },
  {
    id: "8",
    name: "Salmon Fillet",
    slug: "salmon-fillet",
    category: "Seafood",
    unit: "Grams (g)",
    nutritionalInfo: true,
    nutritionalDetails: {
      calories: 208,
      protein: 20,
      carbs: 0,
      fat: 13,
    },
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=fresh%2520raw%2520salmon%2520fillet%2520on%2520white%2520background%2520vibrant%2520pink%2520color%2520clean%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520texture%2520and%2520details%2520perfect%2520for%2520ingredient%2520database&width=100&height=100&seq=10&orientation=squarish",
    recipeCount: 43,
    created: "Mar 15, 2025",
    lastModified: "1 week ago",
    selected: false,
  },
  {
    id: "9",
    name: "Quinoa",
    slug: "quinoa",
    category: "Grains",
    unit: "Grams (g)",
    nutritionalInfo: true,
    nutritionalDetails: {
      calories: 368,
      protein: 14,
      carbs: 64,
      fat: 6,
    },
    status: "Inactive",
    image:
      "https://readdy.ai/api/search-image?query=quinoa%2520grains%2520on%2520white%2520background%2520clean%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520texture%2520and%2520details%2520perfect%2520for%2520ingredient%2520database&width=100&height=100&seq=11&orientation=squarish",
    recipeCount: 32,
    created: "Mar 22, 2025",
    lastModified: "2 weeks ago",
    selected: false,
  },
  {
    id: "10",
    name: "Honey",
    slug: "honey",
    category: "Sweeteners",
    unit: "Milliliters (ml)",
    nutritionalInfo: true,
    nutritionalDetails: {
      calories: 304,
      protein: 0.3,
      carbs: 82,
      fat: 0,
    },
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=jar%2520of%2520golden%2520honey%2520with%2520honey%2520dipper%2520on%2520white%2520background%2520clean%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520texture%2520and%2520details%2520perfect%2520for%2520ingredient%2520database&width=100&height=100&seq=12&orientation=squarish",
    recipeCount: 58,
    created: "Apr 5, 2025",
    lastModified: "3 days ago",
    selected: false,
  },
  {
    id: "11",
    name: "Avocado",
    slug: "avocado",
    category: "Fruits",
    unit: "Pieces",
    nutritionalInfo: true,
    nutritionalDetails: {
      calories: 160,
      protein: 2,
      carbs: 8.5,
      fat: 14.7,
    },
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=whole%2520and%2520halved%2520avocado%2520on%2520white%2520background%2520clean%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520texture%2520and%2520details%2520perfect%2520for%2520ingredient%2520database&width=100&height=100&seq=13&orientation=squarish",
    recipeCount: 47,
    created: "Apr 12, 2025",
    lastModified: "6 days ago",
    selected: false,
  },
  {
    id: "12",
    name: "Black Pepper",
    slug: "black-pepper",
    category: "Herbs & Spices",
    unit: "Grams (g)",
    nutritionalInfo: false,
    status: "Active",
    image:
      "https://readdy.ai/api/search-image?query=black%2520peppercorns%2520and%2520ground%2520black%2520pepper%2520on%2520white%2520background%2520clean%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%2520high%2520resolution%2520image%2520showing%2520texture%2520and%2520details%2520perfect%2520for%2520ingredient%2520database&width=100&height=100&seq=14&orientation=squarish",
    recipeCount: 152,
    created: "Apr 20, 2025",
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
  showCategoryFilter.value = false;
  showUnitFilter.value = false;
  showNutritionalFilter.value = false;
};
const toggleCategoryFilter = () => {
  showCategoryFilter.value = !showCategoryFilter.value;
  showStatusFilter.value = false;
  showUnitFilter.value = false;
  showNutritionalFilter.value = false;
};
const toggleUnitFilter = () => {
  showUnitFilter.value = !showUnitFilter.value;
  showStatusFilter.value = false;
  showCategoryFilter.value = false;
  showNutritionalFilter.value = false;
};
const toggleNutritionalFilter = () => {
  showNutritionalFilter.value = !showNutritionalFilter.value;
  showStatusFilter.value = false;
  showCategoryFilter.value = false;
  showUnitFilter.value = false;
};
const toggleIngredientActions = (index: number) => {
  activeIngredientActions.value =
    activeIngredientActions.value === index ? null : index;
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
const filterByCategory = (category: string) => {
  categoryFilter.value = category;
  showCategoryFilter.value = false;
  if (category !== "All") {
    const existingIndex = activeFilters.value.findIndex((filter) =>
      filter.includes("Category:"),
    );
    if (existingIndex !== -1) {
      activeFilters.value[existingIndex] = `Category: ${category}`;
    } else {
      activeFilters.value.push(`Category: ${category}`);
    }
  } else {
    removeFilterByType("Category:");
  }
  currentPage.value = 1;
};
const filterByUnit = (unit: string) => {
  unitFilter.value = unit;
  showUnitFilter.value = false;
  if (unit !== "All") {
    const existingIndex = activeFilters.value.findIndex((filter) =>
      filter.includes("Unit:"),
    );
    if (existingIndex !== -1) {
      activeFilters.value[existingIndex] = `Unit: ${unit}`;
    } else {
      activeFilters.value.push(`Unit: ${unit}`);
    }
  } else {
    removeFilterByType("Unit:");
  }
  currentPage.value = 1;
};
const filterByNutritionalInfo = (value: string) => {
  nutritionalInfoFilter.value = value;
  showNutritionalFilter.value = false;
  if (value !== "All") {
    const existingIndex = activeFilters.value.findIndex((filter) =>
      filter.includes("Nutritional Info:"),
    );
    if (existingIndex !== -1) {
      activeFilters.value[existingIndex] = `Nutritional Info: ${value}`;
    } else {
      activeFilters.value.push(`Nutritional Info: ${value}`);
    }
  } else {
    removeFilterByType("Nutritional Info:");
  }
  currentPage.value = 1;
};
const removeFilter = (index: number) => {
  const filter = activeFilters.value[index];
  activeFilters.value.splice(index, 1);
  if (filter.includes("Status:")) {
    statusFilter.value = "All";
  } else if (filter.includes("Category:")) {
    categoryFilter.value = "All";
  } else if (filter.includes("Unit:")) {
    unitFilter.value = "All";
  } else if (filter.includes("Nutritional Info:")) {
    nutritionalInfoFilter.value = "All";
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
  categoryFilter.value = "All";
  unitFilter.value = "All";
  nutritionalInfoFilter.value = "All";
  searchQuery.value = "";
  currentPage.value = 1;
};
// Ingredient CRUD operations
const openAddIngredientModal = () => {
  editMode.value = false;
  currentIngredient.value = {
    id: "",
    name: "",
    slug: "",
    category: "Vegetables",
    unit: "Grams (g)",
    nutritionalInfo: false,
    status: "Active",
    image: "",
    recipeCount: 0,
    created: "",
    lastModified: "",
  };
  ingredientStatusActive.value = true;
  hasNutritionalInfo.value = false;
  nutritionalValues.value = {
    calories: 0,
    protein: 0,
    carbs: 0,
    fat: 0,
  };
  showIngredientModal.value = true;
};
const editIngredient = (ingredient: any) => {
  editMode.value = true;
  currentIngredient.value = { ...ingredient };
  ingredientStatusActive.value = ingredient.status === "Active";
  hasNutritionalInfo.value = ingredient.nutritionalInfo;
  if (ingredient.nutritionalInfo && ingredient.nutritionalDetails) {
    nutritionalValues.value = { ...ingredient.nutritionalDetails };
  } else {
    nutritionalValues.value = {
      calories: 0,
      protein: 0,
      carbs: 0,
      fat: 0,
    };
  }
  showIngredientModal.value = true;
};
const saveIngredient = () => {
  const now = new Date().toLocaleDateString("en-US", {
    month: "short",
    day: "numeric",
    year: "numeric",
  });
  currentIngredient.value.status = ingredientStatusActive.value
    ? "Active"
    : "Inactive";
  currentIngredient.value.nutritionalInfo = hasNutritionalInfo.value;
  if (hasNutritionalInfo.value) {
    (currentIngredient.value as any).nutritionalDetails = {
      ...nutritionalValues.value,
    };
  }
  if (editMode.value) {
    // Update existing ingredient
    const index = ingredients.value.findIndex(
      (i) => i.id === currentIngredient.value.id,
    );
    if (index !== -1) {
      currentIngredient.value.lastModified = "Just now";
      ingredients.value[index] = { ...currentIngredient.value };
    }
  } else {
    // Add new ingredient
    const newId = (
      Math.max(...ingredients.value.map((i) => parseInt(i.id))) + 1
    ).toString();
    const newIngredient = {
      ...currentIngredient.value,
      id: newId,
      created: now,
      lastModified: "Just now",
      selected: false,
      image:
        "https://readdy.ai/api/search-image?query=generic%2520food%2520ingredient%2520placeholder%2520image%2520with%2520simple%2520food%2520icon%2520on%2520light%2520background%2520minimal%2520clean%2520design%2520high%2520resolution%2520professional%2520food%2520ingredient%2520representation&width=100&height=100&seq=15&orientation=squarish",
      recipeCount: 0,
    };
    ingredients.value.push(newIngredient);
  }
  closeIngredientModal();
};
const closeIngredientModal = () => {
  showIngredientModal.value = false;
};
const confirmDelete = (ingredient: any) => {
  ingredientToDelete.value = ingredient;
  bulkDeleteMode.value = false;
  showDeleteModal.value = true;
};
const confirmBulkDelete = () => {
  bulkDeleteMode.value = true;
  showDeleteModal.value = true;
  showBulkActions.value = false;
};
const deleteIngredient = () => {
  if (bulkDeleteMode.value) {
    // Delete selected ingredients
    ingredients.value = ingredients.value.filter((i) => !i.selected);
  } else if (ingredientToDelete.value) {
    // Delete single ingredient
    ingredients.value = ingredients.value.filter(
      (i) => i.id !== ingredientToDelete.value.id,
    );
  }
  closeDeleteModal();
};
const closeDeleteModal = () => {
  showDeleteModal.value = false;
  ingredientToDelete.value = null;
  bulkDeleteMode.value = false;
};
// Bulk actions
const bulkActivate = () => {
  ingredients.value.forEach((ingredient) => {
    if (ingredient.selected) {
      ingredient.status = "Active";
      ingredient.lastModified = "Just now";
    }
  });
  showBulkActions.value = false;
};
const bulkDeactivate = () => {
  ingredients.value.forEach((ingredient) => {
    if (ingredient.selected) {
      ingredient.status = "Inactive";
      ingredient.lastModified = "Just now";
    }
  });
  showBulkActions.value = false;
};
const bulkExport = () => {
  // In a real application, this would trigger an export process
  alert("Exporting selected ingredients...");
  showBulkActions.value = false;
};
const bulkChangeCategory = () => {
  bulkCategoryValue.value = categories.value[0];
  showCategoryChangeModal.value = true;
  showBulkActions.value = false;
};
const bulkChangeUnit = () => {
  bulkUnitValue.value = units.value[0];
  showUnitChangeModal.value = true;
  showBulkActions.value = false;
};
const applyBulkCategoryChange = () => {
  ingredients.value.forEach((ingredient) => {
    if (ingredient.selected) {
      ingredient.category = bulkCategoryValue.value;
      ingredient.lastModified = "Just now";
    }
  });
  closeCategoryChangeModal();
};
const applyBulkUnitChange = () => {
  ingredients.value.forEach((ingredient) => {
    if (ingredient.selected) {
      ingredient.unit = bulkUnitValue.value;
      ingredient.lastModified = "Just now";
    }
  });
  closeUnitChangeModal();
};
const closeCategoryChangeModal = () => {
  showCategoryChangeModal.value = false;
};
const closeUnitChangeModal = () => {
  showUnitChangeModal.value = false;
};
// Selection functions
const toggleSelectAll = (event: Event) => {
  const checked = (event.target as HTMLInputElement).checked;
  ingredients.value.forEach((ingredient) => {
    ingredient.selected = checked;
  });
};
const clearSelection = () => {
  ingredients.value.forEach((ingredient) => {
    ingredient.selected = false;
  });
};
// Computed properties
const filteredIngredients = computed(() => {
  let result = [...ingredients.value];
  // Apply search filter
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase();
    result = result.filter(
      (ingredient) =>
        ingredient.name.toLowerCase().includes(query) ||
        ingredient.category.toLowerCase().includes(query) ||
        ingredient.unit.toLowerCase().includes(query) ||
        ingredient.slug.toLowerCase().includes(query),
    );
  }
  // Apply status filter
  if (statusFilter.value !== "All") {
    result = result.filter(
      (ingredient) => ingredient.status === statusFilter.value,
    );
  }
  // Apply category filter
  if (categoryFilter.value !== "All") {
    result = result.filter(
      (ingredient) => ingredient.category === categoryFilter.value,
    );
  }
  // Apply unit filter
  if (unitFilter.value !== "All") {
    result = result.filter(
      (ingredient) => ingredient.unit === unitFilter.value,
    );
  }
  // Apply nutritional info filter
  if (nutritionalInfoFilter.value !== "All") {
    result = result.filter(
      (ingredient) =>
        (nutritionalInfoFilter.value === "Available" &&
          ingredient.nutritionalInfo) ||
        (nutritionalInfoFilter.value === "Not Available" &&
          !ingredient.nutritionalInfo),
    );
  }
  // Pagination
  const startIndex =
    (currentPage.value - 1) * parseInt(perPage.value.toString());
  const endIndex = startIndex + parseInt(perPage.value.toString());
  return result.slice(startIndex, endIndex);
});
const totalIngredients = computed(() => {
  let result = [...ingredients.value];
  // Apply search filter
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase();
    result = result.filter(
      (ingredient) =>
        ingredient.name.toLowerCase().includes(query) ||
        ingredient.category.toLowerCase().includes(query) ||
        ingredient.unit.toLowerCase().includes(query) ||
        ingredient.slug.toLowerCase().includes(query),
    );
  }
  // Apply status filter
  if (statusFilter.value !== "All") {
    result = result.filter(
      (ingredient) => ingredient.status === statusFilter.value,
    );
  }
  // Apply category filter
  if (categoryFilter.value !== "All") {
    result = result.filter(
      (ingredient) => ingredient.category === categoryFilter.value,
    );
  }
  // Apply unit filter
  if (unitFilter.value !== "All") {
    result = result.filter(
      (ingredient) => ingredient.unit === unitFilter.value,
    );
  }
  // Apply nutritional info filter
  if (nutritionalInfoFilter.value !== "All") {
    result = result.filter(
      (ingredient) =>
        (nutritionalInfoFilter.value === "Available" &&
          ingredient.nutritionalInfo) ||
        (nutritionalInfoFilter.value === "Not Available" &&
          !ingredient.nutritionalInfo),
    );
  }
  return result.length;
});
const totalPages = computed(() => {
  return Math.ceil(totalIngredients.value / parseInt(perPage.value.toString()));
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
  return totalIngredients.value === 0
    ? 0
    : (currentPage.value - 1) * parseInt(perPage.value.toString()) + 1;
});
const paginationEnd = computed(() => {
  return Math.min(
    currentPage.value * parseInt(perPage.value.toString()),
    totalIngredients.value,
  );
});
const hasSelectedItems = computed(() => {
  return ingredients.value.some((ingredient) => ingredient.selected);
});
const selectedCount = computed(() => {
  return ingredients.value.filter((ingredient) => ingredient.selected).length;
});
const allSelected = computed(() => {
  return (
    ingredients.value.length > 0 &&
    ingredients.value.every((ingredient) => ingredient.selected)
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
    if (showCategoryFilter.value && !target.closest(".category-filter")) {
      showCategoryFilter.value = false;
    }
    if (showUnitFilter.value && !target.closest(".unit-filter")) {
      showUnitFilter.value = false;
    }
    if (showNutritionalFilter.value && !target.closest(".nutritional-filter")) {
      showNutritionalFilter.value = false;
    }
    if (
      activeIngredientActions.value !== null &&
      !target.closest(".ingredient-actions")
    ) {
      activeIngredientActions.value = null;
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
