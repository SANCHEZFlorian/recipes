<!-- The exported code uses Tailwind CSS. Install Tailwind CSS in your dev environment to ensure all styles work. -->
<template>
  <div class="min-h-screen flex flex-col bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
      <div
        class="container mx-auto px-4 py-3 flex items-center justify-between"
      >
        <!-- Logo -->
        <div class="flex items-center">
          <img :src="logoUrl" alt="Family Recipe" class="h-10 w-auto" />
          <h1 class="ml-2 text-xl font-bold text-emerald-600">Family Recipe</h1>
        </div>
        <!-- Search Bar (Desktop) -->
        <div class="hidden md:flex flex-1 max-w-xl mx-6">
          <div class="relative w-full">
            <input
              type="text"
              v-model="searchQuery"
              placeholder="Search for recipes..."
              class="w-full pl-10 pr-4 py-2 rounded-full border-gray-300 border focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
            />
            <i
              class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
            ></i>
          </div>
        </div>
        <!-- Navigation -->
        <div class="flex items-center space-x-4">
          <!-- Mobile Menu Button -->
          <button
            @click="isMobileMenuOpen = !isMobileMenuOpen"
            class="md:hidden text-gray-600 hover:text-emerald-600 cursor-pointer"
          >
            <i class="fas fa-bars text-xl"></i>
          </button>
          <!-- Desktop Navigation -->
          <nav class="hidden md:flex items-center space-x-6">
            <a href="#" class="text-gray-600 hover:text-emerald-600 font-medium"
              >Home</a
            >
            <a href="#" class="text-gray-600 hover:text-emerald-600 font-medium"
              >Explore</a
            >
            <a
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/f38dd480-ba33-4d9d-bc8d-5bd46a89fbc6"
              data-readdy="true"
              class="text-gray-600 hover:text-emerald-600 font-medium"
              >Categories</a
            >
            <!-- Notification Bell (For Authenticated Users) -->
            <div v-if="isAuthenticated" class="relative">
              <button
                class="text-gray-600 hover:text-emerald-600 cursor-pointer"
                @click="toggleNotifications"
              >
                <i class="fas fa-bell text-xl"></i>
                <span
                  v-if="unreadNotifications > 0"
                  class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"
                >
                  {{ unreadNotifications }}
                </span>
              </button>
              <!-- Notifications Dropdown -->
              <div
                v-if="showNotifications"
                class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg py-1 z-50"
              >
                <div class="px-4 py-2 border-b border-gray-100">
                  <h3 class="font-semibold text-gray-700">Notifications</h3>
                </div>
                <div
                  v-if="notifications.length === 0"
                  class="px-4 py-3 text-gray-500 text-sm"
                >
                  No new notifications
                </div>
                <div v-else class="max-h-80 overflow-y-auto">
                  <div
                    v-for="(notification, index) in notifications"
                    :key="index"
                    class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100 last:border-0"
                  >
                    <p class="text-sm text-gray-700">
                      {{ notification.message }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                      {{ notification.time }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <!-- User Menu (For Authenticated Users) -->
            <div v-if="isAuthenticated" class="relative">
              <button
                @click="toggleUserMenu"
                class="flex items-center space-x-2 cursor-pointer"
              >
                <img
                  :src="currentUser.avatar"
                  alt="Profile"
                  class="h-8 w-8 rounded-full object-cover"
                />
                <span class="text-gray-700 font-medium"
                  >{{ currentUser.name }}</span
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
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                  >My Profile</a
                >
                <a
                  href="#"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                  >My Recipes</a
                >
                <a
                  href="#"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                  >Favorites</a
                >
                <a
                  href="#"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                  >My Groups</a
                >
                <div v-if="isAdmin" class="border-t border-gray-100">
                  <a
                    href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >Admin Dashboard</a
                  >
                </div>
                <div class="border-t border-gray-100">
                  <a
                    href="#"
                    @click.prevent="logout"
                    class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
                    >Logout</a
                  >
                </div>
              </div>
            </div>
            <!-- Auth Buttons (For Guests) -->
            <div v-else class="flex items-center space-x-3">
              <button
                @click="openLoginModal"
                class="text-emerald-600 hover:text-emerald-700 font-medium cursor-pointer whitespace-nowrap !rounded-button"
              >
                Login
              </button>
              <button
                @click="openRegisterModal"
                class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-full font-medium cursor-pointer whitespace-nowrap !rounded-button"
              >
                Register
              </button>
            </div>
          </nav>
        </div>
      </div>
      <!-- Mobile Search Bar -->
      <div class="md:hidden px-4 pb-3">
        <div class="relative w-full">
          <input
            type="text"
            v-model="searchQuery"
            placeholder="Search for recipes..."
            class="w-full pl-10 pr-4 py-2 rounded-full border-gray-300 border focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
          />
          <i
            class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
          ></i>
        </div>
      </div>
    </header>
    <!-- Mobile Menu -->
    <div
      v-if="isMobileMenuOpen"
      class="md:hidden bg-white shadow-lg fixed inset-0 z-40 pt-16"
    >
      <div class="p-4">
        <nav class="flex flex-col space-y-4">
          <a
            href="#"
            class="text-gray-700 hover:text-emerald-600 font-medium py-2 border-b border-gray-100"
            >Home</a
          >
          <a
            href="#"
            class="text-gray-700 hover:text-emerald-600 font-medium py-2 border-b border-gray-100"
            >Explore</a
          >
          <a
            href="#"
            class="text-gray-700 hover:text-emerald-600 font-medium py-2 border-b border-gray-100"
            >Categories</a
          >
          <div v-if="isAuthenticated" class="pt-2">
            <div
              class="flex items-center space-x-3 py-2 border-b border-gray-100"
            >
              <img
                :src="currentUser.avatar"
                alt="Profile"
                class="h-10 w-10 rounded-full object-cover"
              />
              <div>
                <p class="font-medium text-gray-800">{{ currentUser.name }}</p>
                <p class="text-sm text-gray-500">{{ currentUser.email }}</p>
              </div>
            </div>
            <a
              href="#"
              class="block py-2 text-gray-700 hover:text-emerald-600 border-b border-gray-100"
              >My Profile</a
            >
            <a
              href="#"
              class="block py-2 text-gray-700 hover:text-emerald-600 border-b border-gray-100"
              >My Recipes</a
            >
            <a
              href="#"
              class="block py-2 text-gray-700 hover:text-emerald-600 border-b border-gray-100"
              >Favorites</a
            >
            <a
              href="#"
              class="block py-2 text-gray-700 hover:text-emerald-600 border-b border-gray-100"
              >My Groups</a
            >
            <a
              href="#"
              class="block py-2 text-gray-700 hover:text-emerald-600 border-b border-gray-100"
              >Notifications
              <span
                v-if="unreadNotifications > 0"
                class="bg-red-500 text-white text-xs rounded-full px-2 py-0.5 ml-2"
                >{{ unreadNotifications }}</span
              ></a
            >
            <a
              href="#"
              v-if="isAdmin"
              class="block py-2 text-gray-700 hover:text-emerald-600 border-b border-gray-100"
              >Admin Dashboard</a
            >
            <a
              href="#"
              @click.prevent="logout"
              class="block py-2 text-red-600 hover:text-red-700 border-b border-gray-100"
              >Logout</a
            >
          </div>
          <div v-else class="flex flex-col space-y-3 pt-4">
            <button
              @click="openLoginModal"
              class="bg-white border border-emerald-600 text-emerald-600 px-4 py-2 rounded-full font-medium w-full cursor-pointer whitespace-nowrap !rounded-button"
            >
              Login
            </button>
            <button
              @click="openRegisterModal"
              class="bg-emerald-600 text-white px-4 py-2 rounded-full font-medium w-full cursor-pointer whitespace-nowrap !rounded-button"
            >
              Register
            </button>
          </div>
        </nav>
      </div>
      <button
        @click="isMobileMenuOpen = false"
        class="absolute top-4 right-4 text-gray-500 hover:text-gray-700"
      >
        <i class="fas fa-times text-xl"></i>
      </button>
    </div>
    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-6 flex">
      <!-- Filters Sidebar -->
      <aside class="hidden md:block w-64 pr-6">
        <div class="bg-white rounded-lg shadow-sm p-4 sticky top-24">
          <h2 class="font-bold text-lg text-gray-800 mb-4">Filters</h2>
          <!-- Category Filter -->
          <div class="mb-6">
            <h3 class="font-medium text-gray-700 mb-2">Category</h3>
            <div class="relative">
              <select
                v-model="filters.category"
                class="w-full p-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
              >
                <option value="">All Categories</option>
                <option
                  v-for="category in categories"
                  :key="category.id"
                  :value="category.id"
                >
                  {{ category.name }}
                </option>
              </select>
              <div
                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
              >
                <i class="fas fa-chevron-down text-xs"></i>
              </div>
            </div>
          </div>
          <!-- Season Filter -->
          <div class="mb-6">
            <h3 class="font-medium text-gray-700 mb-2">Season</h3>
            <div class="grid grid-cols-2 gap-2">
              <div
                v-for="season in seasons"
                :key="season.id"
                class="flex items-center"
              >
                <input
                  type="checkbox"
                  :id="`season-${season.id}`"
                  :value="season.id"
                  v-model="filters.seasons"
                  class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded"
                />
                <label
                  :for="`season-${season.id}`"
                  class="ml-2 text-sm text-gray-700"
                  >{{ season.name }}</label
                >
              </div>
            </div>
          </div>
          <!-- Price Range Filter -->
          <div class="mb-6">
            <h3 class="font-medium text-gray-700 mb-2">Price Range</h3>
            <div class="px-2">
              <input
                type="range"
                v-model="filters.priceRange"
                min="1"
                max="5"
                step="1"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
              />
              <div class="flex justify-between text-xs text-gray-500 mt-1">
                <span>$</span>
                <span>$$</span>
                <span>$$$</span>
                <span>$$$$</span>
                <span>$$$$$</span>
              </div>
            </div>
          </div>
          <!-- Cooking Time Filter -->
          <div class="mb-6">
            <h3 class="font-medium text-gray-700 mb-2">Cooking Time</h3>
            <div class="space-y-2">
              <div
                v-for="time in cookingTimes"
                :key="time.id"
                class="flex items-center"
              >
                <input
                  type="checkbox"
                  :id="`time-${time.id}`"
                  :value="time.id"
                  v-model="filters.cookingTimes"
                  class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded"
                />
                <label
                  :for="`time-${time.id}`"
                  class="ml-2 text-sm text-gray-700"
                  >{{ time.name }}</label
                >
              </div>
            </div>
          </div>
          <!-- Difficulty Filter -->
          <div class="mb-6">
            <h3 class="font-medium text-gray-700 mb-2">Difficulty</h3>
            <div class="space-y-2">
              <div
                v-for="difficulty in difficulties"
                :key="difficulty.id"
                class="flex items-center"
              >
                <input
                  type="checkbox"
                  :id="`difficulty-${difficulty.id}`"
                  :value="difficulty.id"
                  v-model="filters.difficulties"
                  class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded"
                />
                <label
                  :for="`difficulty-${difficulty.id}`"
                  class="ml-2 text-sm text-gray-700"
                  >{{ difficulty.name }}</label
                >
              </div>
            </div>
          </div>
          <!-- Ingredients Filter -->
          <div class="mb-4">
            <h3 class="font-medium text-gray-700 mb-2">Ingredients</h3>
            <div class="relative">
              <input
                type="text"
                v-model="ingredientInput"
                @keydown.enter="addIngredientFilter"
                placeholder="Add ingredient..."
                class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
              />
              <button
                @click="addIngredientFilter"
                class="absolute right-2 top-1/2 -translate-y-1/2 text-emerald-600 cursor-pointer whitespace-nowrap !rounded-button"
              >
                <i class="fas fa-plus"></i>
              </button>
            </div>
            <div class="flex flex-wrap gap-2 mt-2">
              <div
                v-for="(ingredient, index) in filters.ingredients"
                :key="index"
                class="bg-emerald-100 text-emerald-800 text-xs px-2 py-1 rounded-full flex items-center"
              >
                <span>{{ ingredient }}</span>
                <button
                  @click="removeIngredientFilter(index)"
                  class="ml-1 text-emerald-600 hover:text-emerald-800 cursor-pointer whitespace-nowrap !rounded-button"
                >
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </div>
          <!-- Apply Filters Button -->
          <button
            @click="applyFilters"
            class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2 px-4 rounded-md cursor-pointer whitespace-nowrap !rounded-button"
          >
            Apply Filters
          </button>
        </div>
      </aside>
      <!-- Recipe List Content -->
      <div class="flex-grow">
        <!-- Mobile Filter Button -->
        <div class="md:hidden mb-4">
          <button
            @click="showMobileFilters = !showMobileFilters"
            class="w-full bg-white border border-gray-300 rounded-md py-2 px-4 flex items-center justify-between cursor-pointer whitespace-nowrap !rounded-button"
          >
            <span class="text-gray-700 font-medium">Filters</span>
            <i class="fas fa-filter text-gray-500"></i>
          </button>
        </div>
        <!-- Mobile Filters Modal -->
        <div
          v-if="showMobileFilters"
          class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        >
          <div
            class="bg-white rounded-lg w-full max-w-md max-h-[90vh] overflow-y-auto"
          >
            <div
              class="p-4 border-b border-gray-200 flex justify-between items-center"
            >
              <h2 class="font-bold text-lg text-gray-800">Filters</h2>
              <button
                @click="showMobileFilters = false"
                class="text-gray-500 hover:text-gray-700 cursor-pointer whitespace-nowrap !rounded-button"
              >
                <i class="fas fa-times"></i>
              </button>
            </div>
            <div class="p-4 space-y-6">
              <!-- Mobile Filter Content (Same as sidebar) -->
              <!-- Category Filter -->
              <div>
                <h3 class="font-medium text-gray-700 mb-2">Category</h3>
                <div class="relative">
                  <select
                    v-model="filters.category"
                    class="w-full p-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                  >
                    <option value="">All Categories</option>
                    <option
                      v-for="category in categories"
                      :key="category.id"
                      :value="category.id"
                    >
                      {{ category.name }}
                    </option>
                  </select>
                  <div
                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                  >
                    <i class="fas fa-chevron-down text-xs"></i>
                  </div>
                </div>
              </div>
              <!-- Season Filter -->
              <div>
                <h3 class="font-medium text-gray-700 mb-2">Season</h3>
                <div class="grid grid-cols-2 gap-2">
                  <div
                    v-for="season in seasons"
                    :key="season.id"
                    class="flex items-center"
                  >
                    <input
                      type="checkbox"
                      :id="`mobile-season-${season.id}`"
                      :value="season.id"
                      v-model="filters.seasons"
                      class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded"
                    />
                    <label
                      :for="`mobile-season-${season.id}`"
                      class="ml-2 text-sm text-gray-700"
                      >{{ season.name }}</label
                    >
                  </div>
                </div>
              </div>
              <!-- Price Range Filter -->
              <div>
                <h3 class="font-medium text-gray-700 mb-2">Price Range</h3>
                <div class="px-2">
                  <input
                    type="range"
                    v-model="filters.priceRange"
                    min="1"
                    max="5"
                    step="1"
                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                  />
                  <div class="flex justify-between text-xs text-gray-500 mt-1">
                    <span>$</span>
                    <span>$$</span>
                    <span>$$$</span>
                    <span>$$$$</span>
                    <span>$$$$$</span>
                  </div>
                </div>
              </div>
              <!-- Cooking Time Filter -->
              <div>
                <h3 class="font-medium text-gray-700 mb-2">Cooking Time</h3>
                <div class="space-y-2">
                  <div
                    v-for="time in cookingTimes"
                    :key="time.id"
                    class="flex items-center"
                  >
                    <input
                      type="checkbox"
                      :id="`mobile-time-${time.id}`"
                      :value="time.id"
                      v-model="filters.cookingTimes"
                      class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded"
                    />
                    <label
                      :for="`mobile-time-${time.id}`"
                      class="ml-2 text-sm text-gray-700"
                      >{{ time.name }}</label
                    >
                  </div>
                </div>
              </div>
              <!-- Difficulty Filter -->
              <div>
                <h3 class="font-medium text-gray-700 mb-2">Difficulty</h3>
                <div class="space-y-2">
                  <div
                    v-for="difficulty in difficulties"
                    :key="difficulty.id"
                    class="flex items-center"
                  >
                    <input
                      type="checkbox"
                      :id="`mobile-difficulty-${difficulty.id}`"
                      :value="difficulty.id"
                      v-model="filters.difficulties"
                      class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded"
                    />
                    <label
                      :for="`mobile-difficulty-${difficulty.id}`"
                      class="ml-2 text-sm text-gray-700"
                      >{{ difficulty.name }}</label
                    >
                  </div>
                </div>
              </div>
              <!-- Ingredients Filter -->
              <div>
                <h3 class="font-medium text-gray-700 mb-2">Ingredients</h3>
                <div class="relative">
                  <input
                    type="text"
                    v-model="ingredientInput"
                    @keydown.enter="addIngredientFilter"
                    placeholder="Add ingredient..."
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                  />
                  <button
                    @click="addIngredientFilter"
                    class="absolute right-2 top-1/2 -translate-y-1/2 text-emerald-600 cursor-pointer whitespace-nowrap !rounded-button"
                  >
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
                <div class="flex flex-wrap gap-2 mt-2">
                  <div
                    v-for="(ingredient, index) in filters.ingredients"
                    :key="index"
                    class="bg-emerald-100 text-emerald-800 text-xs px-2 py-1 rounded-full flex items-center"
                  >
                    <span>{{ ingredient }}</span>
                    <button
                      @click="removeIngredientFilter(index)"
                      class="ml-1 text-emerald-600 hover:text-emerald-800 cursor-pointer whitespace-nowrap !rounded-button"
                    >
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="p-4 border-t border-gray-200">
              <button
                @click="applyFiltersAndCloseModal"
                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2 px-4 rounded-md cursor-pointer whitespace-nowrap !rounded-button"
              >
                Apply Filters
              </button>
            </div>
          </div>
        </div>
        <!-- Recipe List Header -->
        <div
          class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between"
        >
          <h1 class="text-2xl font-bold text-gray-800 mb-2 sm:mb-0">
            Discover Recipes
          </h1>
          <div class="flex items-center space-x-4">
            <div class="relative">
              <select
                v-model="sortBy"
                class="pl-3 pr-8 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
              >
                <option value="popular">Most Popular</option>
                <option value="recent">Most Recent</option>
                <option value="rating">Highest Rated</option>
                <option value="time">Quickest</option>
              </select>
              <div
                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
              >
                <i class="fas fa-chevron-down text-xs"></i>
              </div>
            </div>
            <div class="flex items-center space-x-2">
              <button
                @click="viewMode = 'grid'"
                :class="{'text-emerald-600': viewMode === 'grid', 'text-gray-400': viewMode !== 'grid'}"
                class="cursor-pointer whitespace-nowrap !rounded-button"
              >
                <i class="fas fa-th-large text-lg"></i>
              </button>
              <button
                @click="viewMode = 'list'"
                :class="{'text-emerald-600': viewMode === 'list', 'text-gray-400': viewMode !== 'list'}"
                class="cursor-pointer whitespace-nowrap !rounded-button"
              >
                <i class="fas fa-list text-lg"></i>
              </button>
            </div>
          </div>
        </div>
        <!-- Recipe Grid View -->
        <div
          v-if="viewMode === 'grid'"
          class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
        >
          <div
            v-for="recipe in recipes"
            :key="recipe.id"
            class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300"
          >
            <div class="relative">
              <img
                :src="recipe.image"
                :alt="recipe.title"
                class="w-full h-48 object-cover object-top"
              />
              <div class="absolute top-2 right-2">
                <button
                  v-if="isAuthenticated"
                  @click="toggleFavorite(recipe.id)"
                  :class="{'text-red-500': recipe.isFavorite, 'text-white': !recipe.isFavorite}"
                  class="bg-black bg-opacity-30 rounded-full p-2 hover:bg-opacity-40 cursor-pointer whitespace-nowrap !rounded-button"
                >
                  <i class="fas fa-heart"></i>
                </button>
              </div>
            </div>
            <div class="p-4">
              <div class="flex items-center justify-between mb-2">
                <div class="flex items-center">
                  <span class="text-yellow-500 mr-1"
                    ><i class="fas fa-star"></i
                  ></span>
                  <span class="text-sm font-medium text-gray-700"
                    >{{ recipe.rating }}</span
                  >
                  <span class="text-xs text-gray-500 ml-1"
                    >({{ recipe.reviewCount }})</span
                  >
                </div>
                <div class="flex items-center text-xs text-gray-500">
                  <i class="far fa-clock mr-1"></i>
                  <span>{{ recipe.cookingTime }}</span>
                </div>
              </div>
              <h2 class="text-lg font-bold text-gray-800 mb-2 line-clamp-1">
                {{ recipe.title }}
              </h2>
              <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                {{ recipe.description }}
              </p>
              <div class="flex flex-wrap gap-2 mb-3">
                <span
                  v-for="(tag, index) in recipe.tags.slice(0, 3)"
                  :key="index"
                  class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full"
                  >{{ tag }}</span
                >
                <span
                  v-if="recipe.tags.length > 3"
                  class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full"
                  >+{{ recipe.tags.length - 3 }}</span
                >
              </div>
              <div class="flex items-center justify-between">
                <div class="flex items-center">
                  <img
                    :src="recipe.author.avatar"
                    :alt="recipe.author.name"
                    class="h-6 w-6 rounded-full object-cover mr-2"
                  />
                  <span class="text-xs text-gray-700"
                    >{{ recipe.author.name }}</span
                  >
                </div>
                <div class="flex items-center">
                  <span
                    class="text-xs font-medium"
                    :class="getDifficultyColor(recipe.difficulty)"
                    >{{ recipe.difficulty }}</span
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Recipe List View -->
        <div v-else class="space-y-4">
          <div
            v-for="recipe in recipes"
            :key="recipe.id"
            class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300 flex flex-col sm:flex-row"
          >
            <div class="relative sm:w-1/3">
              <img
                :src="recipe.image"
                :alt="recipe.title"
                class="w-full h-48 sm:h-full object-cover object-top"
              />
              <div class="absolute top-2 right-2">
                <button
                  v-if="isAuthenticated"
                  @click="toggleFavorite(recipe.id)"
                  :class="{'text-red-500': recipe.isFavorite, 'text-white': !recipe.isFavorite}"
                  class="bg-black bg-opacity-30 rounded-full p-2 hover:bg-opacity-40 cursor-pointer whitespace-nowrap !rounded-button"
                >
                  <i class="fas fa-heart"></i>
                </button>
              </div>
            </div>
            <div class="p-4 sm:w-2/3">
              <div class="flex items-center justify-between mb-2">
                <div class="flex items-center">
                  <span class="text-yellow-500 mr-1"
                    ><i class="fas fa-star"></i
                  ></span>
                  <span class="text-sm font-medium text-gray-700"
                    >{{ recipe.rating }}</span
                  >
                  <span class="text-xs text-gray-500 ml-1"
                    >({{ recipe.reviewCount }})</span
                  >
                </div>
                <div class="flex items-center text-xs text-gray-500">
                  <i class="far fa-clock mr-1"></i>
                  <span>{{ recipe.cookingTime }}</span>
                </div>
              </div>
              <h2 class="text-lg font-bold text-gray-800 mb-2">
                {{ recipe.title }}
              </h2>
              <p class="text-sm text-gray-600 mb-3">{{ recipe.description }}</p>
              <div class="flex flex-wrap gap-2 mb-3">
                <span
                  v-for="(tag, index) in recipe.tags"
                  :key="index"
                  class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full"
                  >{{ tag }}</span
                >
              </div>
              <div class="flex items-center justify-between">
                <div class="flex items-center">
                  <img
                    :src="recipe.author.avatar"
                    :alt="recipe.author.name"
                    class="h-6 w-6 rounded-full object-cover mr-2"
                  />
                  <span class="text-xs text-gray-700"
                    >{{ recipe.author.name }}</span
                  >
                </div>
                <div class="flex items-center">
                  <span
                    class="text-xs font-medium"
                    :class="getDifficultyColor(recipe.difficulty)"
                    >{{ recipe.difficulty }}</span
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Load More Button -->
        <div class="mt-8 text-center">
          <button
            v-if="!isLoading && hasMoreRecipes"
            @click="loadMoreRecipes"
            class="bg-white border border-emerald-600 text-emerald-600 hover:bg-emerald-50 font-medium py-2 px-6 rounded-md cursor-pointer whitespace-nowrap !rounded-button"
          >
            Load More
          </button>
          <div v-if="isLoading" class="flex justify-center">
            <div
              class="animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-emerald-600"
            ></div>
          </div>
          <p
            v-if="!hasMoreRecipes && recipes.length > 0"
            class="text-gray-500 text-sm"
          >
            No more recipes to load
          </p>
        </div>
      </div>
    </main>
    <!-- Login Modal -->
    <div
      v-if="showLoginModal"
      class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
    >
      <div class="bg-white rounded-lg w-full max-w-md">
        <div class="p-6">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Login</h2>
            <button
              @click="closeLoginModal"
              class="text-gray-500 hover:text-gray-700 cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fas fa-times"></i>
            </button>
          </div>
          <form @submit.prevent="submitLogin">
            <div class="mb-4">
              <label
                for="email"
                class="block text-gray-700 text-sm font-medium mb-2"
                >Email</label
              >
              <input
                type="email"
                id="email"
                v-model="loginForm.email"
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                required
              />
            </div>
            <div class="mb-6">
              <label
                for="password"
                class="block text-gray-700 text-sm font-medium mb-2"
                >Password</label
              >
              <input
                type="password"
                id="password"
                v-model="loginForm.password"
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                required
              />
              <div class="flex justify-end mt-1">
                <a
                  href="#"
                  class="text-sm text-emerald-600 hover:text-emerald-700"
                  >Forgot password?</a
                >
              </div>
            </div>
            <button
              type="submit"
              class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-3 px-4 rounded-md cursor-pointer whitespace-nowrap !rounded-button"
              :disabled="isAuthLoading"
            >
              <span
                v-if="isAuthLoading"
                class="flex items-center justify-center"
              >
                <div
                  class="animate-spin rounded-full h-4 w-4 border-t-2 border-b-2 border-white mr-2"
                ></div>
                Logging in...
              </span>
              <span v-else>Login</span>
            </button>
          </form>
          <div class="mt-6 text-center">
            <p class="text-gray-600 text-sm">
              Don't have an account?
              <a
                @click.prevent="switchToRegister"
                href="#"
                class="text-emerald-600 hover:text-emerald-700 font-medium"
                >Register</a
              >
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- Register Modal -->
    <div
      v-if="showRegisterModal"
      class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
    >
      <div class="bg-white rounded-lg w-full max-w-md">
        <div class="p-6">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Create Account</h2>
            <button
              @click="closeRegisterModal"
              class="text-gray-500 hover:text-gray-700 cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fas fa-times"></i>
            </button>
          </div>
          <form @submit.prevent="submitRegister">
            <div class="mb-4">
              <label
                for="register-name"
                class="block text-gray-700 text-sm font-medium mb-2"
                >Full Name</label
              >
              <input
                type="text"
                id="register-name"
                v-model="registerForm.name"
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                required
              />
            </div>
            <div class="mb-4">
              <label
                for="register-email"
                class="block text-gray-700 text-sm font-medium mb-2"
                >Email</label
              >
              <input
                type="email"
                id="register-email"
                v-model="registerForm.email"
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                required
              />
            </div>
            <div class="mb-4">
              <label
                for="register-password"
                class="block text-gray-700 text-sm font-medium mb-2"
                >Password</label
              >
              <input
                type="password"
                id="register-password"
                v-model="registerForm.password"
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                required
              />
            </div>
            <div class="mb-6">
              <label
                for="register-password-confirm"
                class="block text-gray-700 text-sm font-medium mb-2"
                >Confirm Password</label
              >
              <input
                type="password"
                id="register-password-confirm"
                v-model="registerForm.passwordConfirmation"
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                required
              />
            </div>
            <button
              type="submit"
              class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-3 px-4 rounded-md cursor-pointer whitespace-nowrap !rounded-button"
              :disabled="isAuthLoading"
            >
              <span
                v-if="isAuthLoading"
                class="flex items-center justify-center"
              >
                <div
                  class="animate-spin rounded-full h-4 w-4 border-t-2 border-b-2 border-white mr-2"
                ></div>
                Creating account...
              </span>
              <span v-else>Register</span>
            </button>
          </form>
          <div class="mt-6 text-center">
            <p class="text-gray-600 text-sm">
              Already have an account?
              <a
                @click.prevent="switchToLogin"
                href="#"
                class="text-emerald-600 hover:text-emerald-700 font-medium"
                >Login</a
              >
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
      <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div>
            <div class="flex items-center mb-4">
              <img :src="logoUrl" alt="Family Recipe" class="h-8 w-auto" />
              <h2 class="ml-2 text-lg font-bold text-emerald-600">Family Recipe</h2>
            </div>
            <p class="text-gray-600 text-sm mb-4">
              Discover, create, and share delicious recipes from around the
              world.
            </p>
            <div class="flex space-x-4">
              <a href="#" class="text-gray-500 hover:text-emerald-600">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="text-gray-500 hover:text-emerald-600">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="text-gray-500 hover:text-emerald-600">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#" class="text-gray-500 hover:text-emerald-600">
                <i class="fab fa-pinterest-p"></i>
              </a>
            </div>
          </div>
          <div>
            <h3 class="font-bold text-gray-800 mb-4">Explore</h3>
            <ul class="space-y-2">
              <li>
                <a href="#" class="text-gray-600 hover:text-emerald-600 text-sm"
                  >Categories</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:text-emerald-600 text-sm"
                  >Popular Recipes</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:text-emerald-600 text-sm"
                  >Latest Recipes</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:text-emerald-600 text-sm"
                  >Seasonal Recipes</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:text-emerald-600 text-sm"
                  >Quick & Easy</a
                >
              </li>
            </ul>
          </div>
          <div>
            <h3 class="font-bold text-gray-800 mb-4">Company</h3>
            <ul class="space-y-2">
              <li>
                <a href="#" class="text-gray-600 hover:text-emerald-600 text-sm"
                  >About Us</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:text-emerald-600 text-sm"
                  >Contact</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:text-emerald-600 text-sm"
                  >Careers</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:text-emerald-600 text-sm"
                  >Press</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:text-emerald-600 text-sm"
                  >Blog</a
                >
              </li>
            </ul>
          </div>
          <div>
            <h3 class="font-bold text-gray-800 mb-4">Legal</h3>
            <ul class="space-y-2">
              <li>
                <a href="#" class="text-gray-600 hover:text-emerald-600 text-sm"
                  >Terms of Service</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:text-emerald-600 text-sm"
                  >Privacy Policy</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:text-emerald-600 text-sm"
                  >Cookie Policy</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:text-emerald-600 text-sm"
                  >Copyright</a
                >
              </li>
            </ul>
          </div>
        </div>
        <div
          class="border-t border-gray-200 mt-8 pt-6 flex flex-col md:flex-row justify-between items-center"
        >
          <p class="text-gray-600 text-sm mb-4 md:mb-0">
            &copy; 2025 Family Recipe. All rights reserved.
          </p>
          <div class="flex items-center space-x-4">
            <i class="fab fa-cc-visa text-gray-500 text-xl"></i>
            <i class="fab fa-cc-mastercard text-gray-500 text-xl"></i>
            <i class="fab fa-cc-paypal text-gray-500 text-xl"></i>
            <i class="fab fa-cc-apple-pay text-gray-500 text-xl"></i>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script lang="ts" setup>
import { ref, computed, onMounted } from "vue";
// Logo URL
const logoUrl =
  "https://readdy.ai/api/search-image?query=minimalist%20cooking%20logo%20with%20a%20chef%20hat%20and%20spoon%2C%20clean%20design%2C%20professional%2C%20modern%2C%20flat%20design%2C%20vector%20style%2C%20green%20color%20scheme%2C%20suitable%20for%20a%20cooking%20app&width=200&height=200&seq=1&orientation=squarish";
// Authentication State
const isAuthenticated = ref(false);
const isAdmin = ref(false);
const currentUser = ref({
  id: 1,
  name: "John Doe",
  email: "john@example.com",
  avatar:
    "https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20young%20man%20with%20short%20brown%20hair%20and%20friendly%20smile%2C%20neutral%20background%2C%20high%20quality%20portrait%20photo&width=100&height=100&seq=2&orientation=squarish",
});
// UI State
const isMobileMenuOpen = ref(false);
const showUserMenu = ref(false);
const showNotifications = ref(false);
const showMobileFilters = ref(false);
const viewMode = ref("grid");
const isLoading = ref(false);
const hasMoreRecipes = ref(true);
// Notifications
const unreadNotifications = ref(3);
const notifications = ref([
  {
    id: 1,
    message: "Sarah commented on your Italian Pasta recipe",
    time: "2 hours ago",
  },
  {
    id: 2,
    message: 'You were invited to join "Vegan Recipes" group',
    time: "1 day ago",
  },
  {
    id: 3,
    message: "Your Chocolate Cake recipe was featured in Weekly Picks",
    time: "3 days ago",
  },
]);
// Search and Filters
const searchQuery = ref("");
const sortBy = ref("popular");
const ingredientInput = ref("");
const filters = ref({
  category: "",
  seasons: [],
  priceRange: 3,
  cookingTimes: [],
  difficulties: [],
  ingredients: [],
});
// Auth Modals
const showLoginModal = ref(false);
const showRegisterModal = ref(false);
const isAuthLoading = ref(false);
const loginForm = ref({
  email: "",
  password: "",
});
const registerForm = ref({
  name: "",
  email: "",
  password: "",
  passwordConfirmation: "",
});
// Filter Options
const categories = ref([
  { id: 1, name: "Breakfast" },
  { id: 2, name: "Lunch" },
  { id: 3, name: "Dinner" },
  { id: 4, name: "Desserts" },
  { id: 5, name: "Appetizers" },
  { id: 6, name: "Drinks" },
  { id: 7, name: "Vegan" },
  { id: 8, name: "Vegetarian" },
]);
const seasons = ref([
  { id: 1, name: "Spring" },
  { id: 2, name: "Summer" },
  { id: 3, name: "Fall" },
  { id: 4, name: "Winter" },
]);
const cookingTimes = ref([
  { id: 1, name: "Under 15 minutes" },
  { id: 2, name: "15-30 minutes" },
  { id: 3, name: "30-60 minutes" },
  { id: 4, name: "Over 60 minutes" },
]);
const difficulties = ref([
  { id: 1, name: "Easy" },
  { id: 2, name: "Medium" },
  { id: 3, name: "Hard" },
]);
// Recipe Data
const recipes = ref([
  {
    id: 1,
    title: "Classic Margherita Pizza",
    description:
      "A traditional Italian pizza with fresh mozzarella, tomatoes, and basil on a crispy thin crust.",
    image:
      "https://readdy.ai/api/search-image?query=delicious%20homemade%20margherita%20pizza%20with%20fresh%20basil%2C%20mozzarella%20cheese%20and%20tomato%20sauce%20on%20wooden%20table%2C%20professional%20food%20photography%20with%20soft%20natural%20lighting%2C%20high%20resolution%2C%20appetizing%2C%20steam%20rising&width=600&height=400&seq=3&orientation=landscape",
    rating: 4.8,
    reviewCount: 124,
    cookingTime: "30 min",
    difficulty: "Easy",
    tags: ["Italian", "Pizza", "Vegetarian"],
    isFavorite: true,
    author: {
      name: "Maria Romano",
      avatar:
        "https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20woman%20chef%20with%20dark%20hair%20in%20chef%20uniform%2C%20neutral%20background%2C%20high%20quality%20portrait%20photo&width=100&height=100&seq=4&orientation=squarish",
    },
  },
  {
    id: 2,
    title: "Spicy Thai Green Curry",
    description:
      "Aromatic and spicy Thai green curry with coconut milk, vegetables, and your choice of protein.",
    image:
      "https://readdy.ai/api/search-image?query=thai%20green%20curry%20with%20vegetables%20and%20rice%20in%20a%20white%20bowl%2C%20vibrant%20colors%2C%20professional%20food%20photography%20with%20soft%20natural%20lighting%2C%20high%20resolution%2C%20appetizing%2C%20steam%20rising&width=600&height=400&seq=5&orientation=landscape",
    rating: 4.6,
    reviewCount: 89,
    cookingTime: "45 min",
    difficulty: "Medium",
    tags: ["Thai", "Spicy", "Curry"],
    isFavorite: false,
    author: {
      name: "Chai Siriporn",
      avatar:
        "https://readdy.ai/api/search-image?query=professional%20headshot%20of%20an%20asian%20woman%20with%20black%20hair%20and%20friendly%20smile%2C%20neutral%20background%2C%20high%20quality%20portrait%20photo&width=100&height=100&seq=6&orientation=squarish",
    },
  },
  {
    id: 3,
    title: "Classic French Croissants",
    description:
      "Buttery, flaky French croissants made from scratch. Perfect for breakfast or brunch.",
    image:
      "https://readdy.ai/api/search-image?query=freshly%20baked%20golden%20croissants%20on%20wooden%20board%20with%20cup%20of%20coffee%2C%20professional%20food%20photography%20with%20soft%20natural%20lighting%2C%20high%20resolution%2C%20appetizing%2C%20morning%20breakfast%20scene&width=600&height=400&seq=7&orientation=landscape",
    rating: 4.9,
    reviewCount: 156,
    cookingTime: "3 hrs",
    difficulty: "Hard",
    tags: ["French", "Pastry", "Breakfast"],
    isFavorite: true,
    author: {
      name: "Pierre Dubois",
      avatar:
        "https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20french%20male%20chef%20with%20beard%20in%20chef%20uniform%2C%20neutral%20background%2C%20high%20quality%20portrait%20photo&width=100&height=100&seq=8&orientation=squarish",
    },
  },
  {
    id: 4,
    title: "Homemade Beef Burgers",
    description:
      "Juicy homemade beef burgers with all the trimmings. Perfect for a weekend barbecue.",
    image:
      "https://readdy.ai/api/search-image?query=gourmet%20beef%20burger%20with%20cheese%2C%20lettuce%2C%20tomato%20on%20wooden%20board%2C%20professional%20food%20photography%20with%20soft%20natural%20lighting%2C%20high%20resolution%2C%20appetizing%2C%20juicy&width=600&height=400&seq=9&orientation=landscape",
    rating: 4.7,
    reviewCount: 112,
    cookingTime: "30 min",
    difficulty: "Easy",
    tags: ["American", "Burgers", "Beef"],
    isFavorite: false,
    author: {
      name: "Bobby Miller",
      avatar:
        "https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20male%20chef%20with%20glasses%20in%20casual%20attire%2C%20neutral%20background%2C%20high%20quality%20portrait%20photo&width=100&height=100&seq=10&orientation=squarish",
    },
  },
  {
    id: 5,
    title: "Vegetable Pad Thai",
    description:
      "A vegetarian version of the classic Thai street food dish with rice noodles, tofu, and vegetables.",
    image:
      "https://readdy.ai/api/search-image?query=vegetable%20pad%20thai%20with%20tofu%20in%20black%20plate%20with%20lime%20wedges%2C%20professional%20food%20photography%20with%20soft%20natural%20lighting%2C%20high%20resolution%2C%20appetizing%2C%20colorful&width=600&height=400&seq=11&orientation=landscape",
    rating: 4.5,
    reviewCount: 78,
    cookingTime: "25 min",
    difficulty: "Medium",
    tags: ["Thai", "Vegetarian", "Noodles"],
    isFavorite: true,
    author: {
      name: "Lisa Wong",
      avatar:
        "https://readdy.ai/api/search-image?query=professional%20headshot%20of%20an%20asian%20woman%20chef%20with%20short%20black%20hair%2C%20neutral%20background%2C%20high%20quality%20portrait%20photo&width=100&height=100&seq=12&orientation=squarish",
    },
  },
  {
    id: 6,
    title: "Chocolate Lava Cake",
    description:
      "Decadent chocolate cake with a molten chocolate center. Serve with ice cream for the perfect dessert.",
    image:
      "https://readdy.ai/api/search-image?query=chocolate%20lava%20cake%20with%20flowing%20melted%20chocolate%20center%20and%20vanilla%20ice%20cream%2C%20professional%20food%20photography%20with%20soft%20natural%20lighting%2C%20high%20resolution%2C%20appetizing%2C%20dessert&width=600&height=400&seq=13&orientation=landscape",
    rating: 4.9,
    reviewCount: 203,
    cookingTime: "20 min",
    difficulty: "Medium",
    tags: ["Dessert", "Chocolate", "Cake"],
    isFavorite: false,
    author: {
      name: "Emma Clark",
      avatar:
        "https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20female%20pastry%20chef%20with%20blonde%20hair%2C%20neutral%20background%2C%20high%20quality%20portrait%20photo&width=100&height=100&seq=14&orientation=squarish",
    },
  },
]);
// Methods
const toggleUserMenu = () => {
  showUserMenu.value = !showUserMenu.value;
  if (showUserMenu.value) {
    showNotifications.value = false;
  }
};
const toggleNotifications = () => {
  showNotifications.value = !showNotifications.value;
  if (showNotifications.value) {
    showUserMenu.value = false;
    unreadNotifications.value = 0;
  }
};
const toggleFavorite = (recipeId: number) => {
  const recipe = recipes.value.find((r) => r.id === recipeId);
  if (recipe) {
    recipe.isFavorite = !recipe.isFavorite;
  }
};
const getDifficultyColor = (difficulty: string) => {
  switch (difficulty) {
    case "Easy":
      return "text-green-600";
    case "Medium":
      return "text-yellow-600";
    case "Hard":
      return "text-red-600";
    default:
      return "text-gray-600";
  }
};
const addIngredientFilter = () => {
  if (
    ingredientInput.value.trim() &&
    !filters.value.ingredients.includes(ingredientInput.value.trim())
  ) {
    filters.value.ingredients.push(ingredientInput.value.trim());
    ingredientInput.value = "";
  }
};
const removeIngredientFilter = (index: number) => {
  filters.value.ingredients.splice(index, 1);
};
const applyFilters = () => {
  // Would make API call with filters
  console.log("Applying filters:", filters.value);
};
const applyFiltersAndCloseModal = () => {
  applyFilters();
  showMobileFilters.value = false;
};
const loadMoreRecipes = () => {
  isLoading.value = true;
  // Simulate API call
  setTimeout(() => {
    // Add more recipes
    const newRecipes = [
      {
        id: 7,
        title: "Fresh Spring Rolls",
        description:
          "Vietnamese fresh spring rolls with shrimp, herbs, and rice noodles. Served with peanut dipping sauce.",
        image:
          "https://readdy.ai/api/search-image?query=vietnamese%20fresh%20spring%20rolls%20with%20shrimp%20and%20vegetables%20with%20peanut%20sauce%2C%20professional%20food%20photography%20with%20soft%20natural%20lighting%2C%20high%20resolution%2C%20appetizing%2C%20colorful&width=600&height=400&seq=15&orientation=landscape",
        rating: 4.7,
        reviewCount: 92,
        cookingTime: "30 min",
        difficulty: "Medium",
        tags: ["Vietnamese", "Appetizer", "Healthy"],
        isFavorite: false,
        author: {
          name: "Minh Nguyen",
          avatar:
            "https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20vietnamese%20woman%20with%20long%20black%20hair%2C%20neutral%20background%2C%20high%20quality%20portrait%20photo&width=100&height=100&seq=16&orientation=squarish",
        },
      },
      {
        id: 8,
        title: "Classic Tiramisu",
        description:
          "Traditional Italian dessert with layers of coffee-soaked ladyfingers and mascarpone cream.",
        image:
          "https://readdy.ai/api/search-image?query=classic%20tiramisu%20dessert%20with%20cocoa%20powder%20on%20top%20in%20glass%20serving%20dish%2C%20professional%20food%20photography%20with%20soft%20natural%20lighting%2C%20high%20resolution%2C%20appetizing%2C%20italian%20dessert&width=600&height=400&seq=17&orientation=landscape",
        rating: 4.8,
        reviewCount: 145,
        cookingTime: "4 hrs",
        difficulty: "Medium",
        tags: ["Italian", "Dessert", "Coffee"],
        isFavorite: false,
        author: {
          name: "Giulia Rossi",
          avatar:
            "https://readdy.ai/api/search-image?query=professional%20headshot%20of%20an%20italian%20woman%20with%20brown%20hair%2C%20neutral%20background%2C%20high%20quality%20portrait%20photo&width=100&height=100&seq=18&orientation=squarish",
        },
      },
      {
        id: 9,
        title: "Homemade Chicken Ramen",
        description:
          "Flavorful chicken ramen with a rich broth, tender chicken, soft-boiled egg, and fresh vegetables.",
        image:
          "https://readdy.ai/api/search-image?query=japanese%20ramen%20soup%20with%20chicken%2C%20egg%2C%20green%20onions%20in%20black%20bowl%2C%20professional%20food%20photography%20with%20soft%20natural%20lighting%2C%20high%20resolution%2C%20appetizing%2C%20steam%20rising&width=600&height=400&seq=19&orientation=landscape",
        rating: 4.6,
        reviewCount: 108,
        cookingTime: "1.5 hrs",
        difficulty: "Medium",
        tags: ["Japanese", "Soup", "Noodles"],
        isFavorite: false,
        author: {
          name: "Kenji Tanaka",
          avatar:
            "https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20japanese%20male%20chef%20with%20glasses%2C%20neutral%20background%2C%20high%20quality%20portrait%20photo&width=100&height=100&seq=20&orientation=squarish",
        },
      },
    ];
    recipes.value = [...recipes.value, ...newRecipes];
    isLoading.value = false;
    // For demo purposes, set hasMoreRecipes to false after loading more
    hasMoreRecipes.value = false;
  }, 1500);
};
// Auth Methods
const openLoginModal = () => {
  showLoginModal.value = true;
  showRegisterModal.value = false;
};
const closeLoginModal = () => {
  showLoginModal.value = false;
  loginForm.value = {
    email: "",
    password: "",
  };
};
const openRegisterModal = () => {
  showRegisterModal.value = true;
  showLoginModal.value = false;
};
const closeRegisterModal = () => {
  showRegisterModal.value = false;
  registerForm.value = {
    name: "",
    email: "",
    password: "",
    passwordConfirmation: "",
  };
};
const switchToRegister = () => {
  showLoginModal.value = false;
  showRegisterModal.value = true;
};
const switchToLogin = () => {
  showRegisterModal.value = false;
  showLoginModal.value = true;
};
const submitLogin = () => {
  isAuthLoading.value = true;
  // Simulate API call
  setTimeout(() => {
    isAuthLoading.value = false;
    isAuthenticated.value = true;
    showLoginModal.value = false;
    // Reset form
    loginForm.value = {
      email: "",
      password: "",
    };
  }, 1500);
};
const submitRegister = () => {
  isAuthLoading.value = true;
  // Simulate API call
  setTimeout(() => {
    isAuthLoading.value = false;
    isAuthenticated.value = true;
    showRegisterModal.value = false;
    // Reset form
    registerForm.value = {
      name: "",
      email: "",
      password: "",
      passwordConfirmation: "",
    };
  }, 1500);
};
const logout = () => {
  // Simulate API call
  isAuthenticated.value = false;
  showUserMenu.value = false;
};
// Lifecycle
onMounted(() => {
  // Initialize data or make API calls
  document.addEventListener("click", (e) => {
    // Close dropdowns when clicking outside
    if (showUserMenu.value || showNotifications.value) {
      const target = e.target as HTMLElement;
      if (!target.closest(".user-menu") && !target.closest(".notifications")) {
        showUserMenu.value = false;
        showNotifications.value = false;
      }
    }
  });
});
</script>

<style scoped>
/* Custom styles */
input[type="range"]::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 16px;
  height: 16px;
  border-radius: 50%;
  background: #059669;
  cursor: pointer;
}
input[type="range"]::-moz-range-thumb {
  width: 16px;
  height: 16px;
  border-radius: 50%;
  background: #059669;
  cursor: pointer;
}
.line-clamp-1 {
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
