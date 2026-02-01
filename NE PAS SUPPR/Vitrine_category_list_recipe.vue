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
          <img :src="logoUrl" alt="CookBook" class="h-10 w-auto" />
          <h1 class="ml-2 text-xl font-bold text-emerald-600">CookBook</h1>
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
            class="md:hidden text-gray-600 hover:text-emerald-600 cursor-pointer whitespace-nowrap !rounded-button"
          >
            <i class="fas fa-bars text-xl"></i>
          </button>
          <!-- Desktop Navigation -->
          <nav class="hidden md:flex items-center space-x-6">
            <a
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/97eba44a-c18e-463b-bfda-25d0acaee609"
              data-readdy="true"
              class="text-gray-600 hover:text-emerald-600 font-medium cursor-pointer"
              >Home</a
            >
            <a
              href="#"
              class="text-gray-600 hover:text-emerald-600 font-medium cursor-pointer"
              >Explore</a
            >
            <a
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/f38dd480-ba33-4d9d-bc8d-5bd46a89fbc6"
              data-readdy="true"
              class="text-emerald-600 font-medium border-b-2 border-emerald-600 pb-1 cursor-pointer"
              >Categories</a
            >
            <!-- Notification Bell (For Authenticated Users) -->
            <div v-if="isAuthenticated" class="relative user-menu">
              <button
                class="text-gray-600 hover:text-emerald-600 cursor-pointer whitespace-nowrap !rounded-button"
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
                class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg py-1 z-50 notifications"
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
            <div v-if="isAuthenticated" class="relative user-menu">
              <button
                @click="toggleUserMenu"
                class="flex items-center space-x-2 cursor-pointer whitespace-nowrap !rounded-button"
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
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                  >My Profile</a
                >
                <a
                  href="#"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                  >My Recipes</a
                >
                <a
                  href="#"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                  >Favorites</a
                >
                <a
                  href="#"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                  >My Groups</a
                >
                <div v-if="isAdmin" class="border-t border-gray-100">
                  <a
                    href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                    >Admin Dashboard</a
                  >
                </div>
                <div class="border-t border-gray-100">
                  <a
                    href="#"
                    @click.prevent="logout"
                    class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 cursor-pointer"
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
            href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/97eba44a-c18e-463b-bfda-25d0acaee609"
            data-readdy="true"
            class="text-gray-700 hover:text-emerald-600 font-medium py-2 border-b border-gray-100 cursor-pointer"
            >Home</a
          >
          <a
            href="#"
            class="text-gray-700 hover:text-emerald-600 font-medium py-2 border-b border-gray-100 cursor-pointer"
            >Explore</a
          >
          <a
            href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/f38dd480-ba33-4d9d-bc8d-5bd46a89fbc6"
            data-readdy="true"
            class="text-emerald-600 font-medium py-2 border-b border-gray-100 cursor-pointer"
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
              class="block py-2 text-gray-700 hover:text-emerald-600 border-b border-gray-100 cursor-pointer"
              >My Profile</a
            >
            <a
              href="#"
              class="block py-2 text-gray-700 hover:text-emerald-600 border-b border-gray-100 cursor-pointer"
              >My Recipes</a
            >
            <a
              href="#"
              class="block py-2 text-gray-700 hover:text-emerald-600 border-b border-gray-100 cursor-pointer"
              >Favorites</a
            >
            <a
              href="#"
              class="block py-2 text-gray-700 hover:text-emerald-600 border-b border-gray-100 cursor-pointer"
              >My Groups</a
            >
            <a
              href="#"
              class="block py-2 text-gray-700 hover:text-emerald-600 border-b border-gray-100 cursor-pointer"
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
              class="block py-2 text-gray-700 hover:text-emerald-600 border-b border-gray-100 cursor-pointer"
              >Admin Dashboard</a
            >
            <a
              href="#"
              @click.prevent="logout"
              class="block py-2 text-red-600 hover:text-red-700 border-b border-gray-100 cursor-pointer"
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
        class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 cursor-pointer whitespace-nowrap !rounded-button"
      >
        <i class="fas fa-times text-xl"></i>
      </button>
    </div>
    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-6">
      <!-- Breadcrumb -->
      <div class="flex items-center text-sm text-gray-500 mb-6">
        <a
          href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/97eba44a-c18e-463b-bfda-25d0acaee609"
          data-readdy="true"
          class="hover:text-emerald-600 cursor-pointer"
          >Home</a
        >
        <i class="fas fa-chevron-right text-xs mx-2"></i>
        <a
          href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/f38dd480-ba33-4d9d-bc8d-5bd46a89fbc6"
          data-readdy="true"
          class="hover:text-emerald-600 cursor-pointer"
          >Categories</a
        >
        <i class="fas fa-chevron-right text-xs mx-2"></i>
        <span class="text-emerald-600 font-medium">Lunch Recipes</span>
      </div>
      <!-- Page Header -->
      <div class="flex items-center justify-between mb-8">
        <div>
          <h1 class="text-3xl font-bold text-gray-800 mb-2">Lunch Recipes</h1>
          <p class="text-gray-600">
            Discover delicious lunch recipes for any occasion, from quick
            weekday meals to weekend specials.
          </p>
        </div>
        <a
          href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/f38dd480-ba33-4d9d-bc8d-5bd46a89fbc6"
          data-readdy="true"
          class="hidden md:flex items-center text-emerald-600 hover:text-emerald-700 cursor-pointer"
        >
          <i class="fas fa-arrow-left mr-2"></i>
          Back to Categories
        </a>
      </div>
      <!-- Mobile Back Button -->
      <div class="md:hidden mb-6">
        <a
          href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/f38dd480-ba33-4d9d-bc8d-5bd46a89fbc6"
          data-readdy="true"
          class="flex items-center text-emerald-600 hover:text-emerald-700 cursor-pointer"
        >
          <i class="fas fa-arrow-left mr-2"></i>
          Back to Categories
        </a>
      </div>
      <!-- Filter Bar -->
      <div class="bg-white rounded-lg shadow-sm p-4 mb-8 overflow-x-auto">
        <div class="flex space-x-4 min-w-max">
          <!-- Meal Time Filter -->
          <div class="flex-shrink-0">
            <h3 class="text-sm font-medium text-gray-700 mb-2">Meal Time</h3>
            <div class="flex space-x-2">
              <button
                v-for="meal in mealTimeFilters"
                :key="meal.id"
                @click="toggleMealTimeFilter(meal.id)"
                :class="[
'px-3 py-1.5 rounded-full text-sm font-medium transition-colors cursor-pointer whitespace-nowrap !rounded-button',
selectedMealTimes.includes(meal.id)
? 'bg-emerald-600 text-white'
: 'bg-gray-100 text-gray-700 hover:bg-gray-200'
]"
              >
                {{ meal.name }}
              </button>
            </div>
          </div>
          <!-- Difficulty Filter -->
          <div class="flex-shrink-0">
            <h3 class="text-sm font-medium text-gray-700 mb-2">Difficulty</h3>
            <div class="flex space-x-2">
              <button
                v-for="difficulty in difficultyFilters"
                :key="difficulty.id"
                @click="toggleDifficultyFilter(difficulty.id)"
                :class="[
'px-3 py-1.5 rounded-full text-sm font-medium transition-colors cursor-pointer whitespace-nowrap !rounded-button',
selectedDifficulties.includes(difficulty.id)
? 'bg-emerald-600 text-white'
: 'bg-gray-100 text-gray-700 hover:bg-gray-200'
]"
              >
                {{ difficulty.name }}
              </button>
            </div>
          </div>
          <!-- Cooking Time Filter -->
          <div class="flex-shrink-0">
            <h3 class="text-sm font-medium text-gray-700 mb-2">Cooking Time</h3>
            <div class="flex space-x-2">
              <button
                v-for="time in cookingTimeFilters"
                :key="time.id"
                @click="toggleCookingTimeFilter(time.id)"
                :class="[
'px-3 py-1.5 rounded-full text-sm font-medium transition-colors cursor-pointer whitespace-nowrap !rounded-button',
selectedCookingTimes.includes(time.id)
? 'bg-emerald-600 text-white'
: 'bg-gray-100 text-gray-700 hover:bg-gray-200'
]"
              >
                {{ time.name }}
              </button>
            </div>
          </div>
          <!-- Clear Filters -->
          <div v-if="hasActiveFilters" class="flex-shrink-0 flex items-end">
            <button
              @click="clearAllFilters"
              class="px-3 py-1.5 text-sm text-emerald-600 hover:text-emerald-700 font-medium cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fas fa-times mr-1"></i>
              Clear Filters
            </button>
          </div>
        </div>
      </div>
      <!-- Recipes Grid -->
      <div
        v-if="filteredRecipes.length > 0"
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12"
      >
        <div
          v-for="recipe in paginatedRecipes"
          :key="recipe.id"
          class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 cursor-pointer group"
        >
          <div class="relative h-48 overflow-hidden">
            <img
              :src="recipe.image"
              :alt="recipe.title"
              class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105"
            />
            <div
              v-if="recipe.isFeatured"
              class="absolute top-2 left-2 bg-emerald-600 text-white text-xs px-2 py-1 rounded-full"
            >
              Featured
            </div>
            <div
              v-if="recipe.isNew"
              class="absolute top-2 right-2 bg-amber-500 text-white text-xs px-2 py-1 rounded-full"
            >
              New
            </div>
          </div>
          <div class="p-4">
            <a
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/71985757-fc78-44cb-b477-8f5d692d152b"
              data-readdy="true"
              class="block"
            >
              <h3
                class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 hover:text-emerald-600 transition-colors"
              >
                {{ recipe.title }}
              </h3>
            </a>
            <!-- Rating -->
            <div class="flex items-center mb-3">
              <div class="flex">
                <i
                  v-for="star in 5"
                  :key="star"
                  :class="[
'text-sm',
star <= recipe.rating ? 'fas fa-star text-amber-400' : 'far fa-star text-gray-300'
]"
                ></i>
              </div>
              <span class="text-xs text-gray-500 ml-2"
                >({{ recipe.reviewCount }})</span
              >
            </div>
            <!-- Recipe Info -->
            <div
              class="flex items-center justify-between text-sm text-gray-600"
            >
              <div class="flex items-center">
                <i class="far fa-clock mr-1"></i>
                <span>{{ recipe.cookingTime }} min</span>
              </div>
              <div class="flex items-center">
                <i class="fas fa-signal mr-1"></i>
                <span>{{ recipe.difficulty }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Empty State -->
      <div v-else class="bg-white rounded-lg shadow-sm p-8 text-center mb-12">
        <img
          :src="emptyStateImage"
          alt="No recipes found"
          class="w-48 h-48 mx-auto mb-6"
        />
        <h3 class="text-xl font-bold text-gray-800 mb-2">No recipes found</h3>
        <p class="text-gray-600 mb-6">
          We couldn't find any lunch recipes matching your filters. Try
          adjusting your filters or check back later for new recipes.
        </p>
        <button
          @click="clearAllFilters"
          class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-full font-medium cursor-pointer whitespace-nowrap !rounded-button"
        >
          Reset Filters
        </button>
      </div>
      <!-- Pagination -->
      <div
        v-if="filteredRecipes.length > 0"
        class="flex justify-center items-center mb-12"
      >
        <div class="flex space-x-2">
          <button
            @click="prevPage"
            :disabled="currentPage === 1"
            :class="[
'px-3 py-2 rounded-md text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button',
currentPage === 1
? 'bg-gray-100 text-gray-400 cursor-not-allowed'
: 'bg-white text-gray-700 hover:bg-gray-100'
]"
          >
            <i class="fas fa-chevron-left"></i>
          </button>
          <button
            v-for="page in displayedPages"
            :key="page"
            @click="goToPage(page)"
            :class="[
'px-3 py-2 rounded-md text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button',
currentPage === page
? 'bg-emerald-600 text-white'
: 'bg-white text-gray-700 hover:bg-gray-100'
]"
          >
            {{ page }}
          </button>
          <button
            @click="nextPage"
            :disabled="currentPage === totalPages"
            :class="[
'px-3 py-2 rounded-md text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button',
currentPage === totalPages
? 'bg-gray-100 text-gray-400 cursor-not-allowed'
: 'bg-white text-gray-700 hover:bg-gray-100'
]"
          >
            <i class="fas fa-chevron-right"></i>
          </button>
        </div>
      </div>
      <!-- Related Categories -->
      <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
          Related Categories
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div
            v-for="category in relatedCategories"
            :key="category.id"
            class="relative rounded-lg overflow-hidden h-48 group cursor-pointer"
          >
            <img
              :src="category.image"
              :alt="category.name"
              class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105"
            />
            <div
              class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent/30"
            ></div>
            <div class="absolute inset-0 flex flex-col justify-end p-6">
              <h3 class="text-white text-xl font-bold mb-2">
                {{ category.name }}
              </h3>
              <p class="text-white/90 text-sm mb-4">
                {{ category.description }}
              </p>
              <button
                class="bg-white/20 hover:bg-white/30 text-white backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium inline-flex items-center self-start cursor-pointer whitespace-nowrap !rounded-button"
              >
                Explore
                <i class="fas fa-arrow-right ml-2"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
      <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div>
            <div class="flex items-center mb-4">
              <img :src="logoUrl" alt="CookBook" class="h-8 w-auto" />
              <h2 class="ml-2 text-lg font-bold text-emerald-600">CookBook</h2>
            </div>
            <p class="text-gray-600 text-sm mb-4">
              Discover, create, and share delicious recipes from around the
              world.
            </p>
            <div class="flex space-x-4">
              <a
                href="#"
                class="text-gray-500 hover:text-emerald-600 cursor-pointer"
              >
                <i class="fab fa-facebook-f"></i>
              </a>
              <a
                href="#"
                class="text-gray-500 hover:text-emerald-600 cursor-pointer"
              >
                <i class="fab fa-twitter"></i>
              </a>
              <a
                href="#"
                class="text-gray-500 hover:text-emerald-600 cursor-pointer"
              >
                <i class="fab fa-instagram"></i>
              </a>
              <a
                href="#"
                class="text-gray-500 hover:text-emerald-600 cursor-pointer"
              >
                <i class="fab fa-pinterest-p"></i>
              </a>
            </div>
          </div>
          <div>
            <h3 class="font-bold text-gray-800 mb-4">Explore</h3>
            <ul class="space-y-2">
              <li>
                <a
                  href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/f38dd480-ba33-4d9d-bc8d-5bd46a89fbc6"
                  data-readdy="true"
                  class="text-gray-600 hover:text-emerald-600 text-sm cursor-pointer"
                  >Categories</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-600 hover:text-emerald-600 text-sm cursor-pointer"
                  >Popular Recipes</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-600 hover:text-emerald-600 text-sm cursor-pointer"
                  >Latest Recipes</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-600 hover:text-emerald-600 text-sm cursor-pointer"
                  >Seasonal Recipes</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-600 hover:text-emerald-600 text-sm cursor-pointer"
                  >Quick & Easy</a
                >
              </li>
            </ul>
          </div>
          <div>
            <h3 class="font-bold text-gray-800 mb-4">Company</h3>
            <ul class="space-y-2">
              <li>
                <a
                  href="#"
                  class="text-gray-600 hover:text-emerald-600 text-sm cursor-pointer"
                  >About Us</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-600 hover:text-emerald-600 text-sm cursor-pointer"
                  >Contact</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-600 hover:text-emerald-600 text-sm cursor-pointer"
                  >Careers</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-600 hover:text-emerald-600 text-sm cursor-pointer"
                  >Press</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-600 hover:text-emerald-600 text-sm cursor-pointer"
                  >Blog</a
                >
              </li>
            </ul>
          </div>
          <div>
            <h3 class="font-bold text-gray-800 mb-4">Legal</h3>
            <ul class="space-y-2">
              <li>
                <a
                  href="#"
                  class="text-gray-600 hover:text-emerald-600 text-sm cursor-pointer"
                  >Terms of Service</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-600 hover:text-emerald-600 text-sm cursor-pointer"
                  >Privacy Policy</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-600 hover:text-emerald-600 text-sm cursor-pointer"
                  >Cookie Policy</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-600 hover:text-emerald-600 text-sm cursor-pointer"
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
            &copy; 2025 CookBook. All rights reserved.
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
  "https://readdy.ai/api/search-image?query=minimalist%252520cooking%252520logo%252520with%252520a%252520chef%252520hat%252520and%252520spoon%25252C%252520clean%252520design%25252C%252520professional%25252C%252520modern%25252C%252520flat%252520design%25252C%252520vector%252520style%25252C%252520green%252520color%252520scheme%25252C%252520suitable%252520for%252520a%252520cooking%252520app&width=200&height=200&seq=1&orientation=squarish";
// Empty State Image
const emptyStateImage =
  "https://readdy.ai/api/search-image?query=cute%252520cooking%252520illustration%252520of%252520an%252520empty%252520plate%252520or%252520bowl%252520with%252520a%252520sad%252520face%25252C%252520minimalist%252520design%25252C%252520soft%252520colors%25252C%252520clean%252520background%25252C%252520simple%252520and%252520appealing%252520vector%252520style%25252C%252520suitable%252520for%252520no%252520results%252520found%252520page&width=400&height=400&seq=36&orientation=squarish";
// Authentication State
const isAuthenticated = ref(false);
const isAdmin = ref(false);
const currentUser = ref({
  id: 1,
  name: "John Doe",
  email: "john@example.com",
  avatar:
    "https://readdy.ai/api/search-image?query=professional%252520headshot%252520of%252520a%252520young%252520man%252520with%252520short%252520brown%252520hair%252520and%252520friendly%252520smile%25252C%252520neutral%252520background%25252C%252520high%252520quality%252520portrait%252520photo&width=100&height=100&seq=2&orientation=squarish",
});
// UI State
const isMobileMenuOpen = ref(false);
const showUserMenu = ref(false);
const showNotifications = ref(false);
const searchQuery = ref("");
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
// Filter Options
const mealTimeFilters = ref([
  { id: 1, name: "Breakfast" },
  { id: 2, name: "Lunch", default: true },
  { id: 3, name: "Dinner" },
]);
const difficultyFilters = ref([
  { id: 1, name: "Easy" },
  { id: 2, name: "Medium" },
  { id: 3, name: "Hard" },
]);
const cookingTimeFilters = ref([
  { id: 1, name: "< 15 min" },
  { id: 2, name: "15-30 min" },
  { id: 3, name: "30-45 min" },
  { id: 4, name: "45+ min" },
]);
// Selected Filters
const selectedMealTimes = ref([2]); // Default to Lunch
const selectedDifficulties = ref([]);
const selectedCookingTimes = ref([]);
// Recipes Data
const recipes = ref([
  {
    id: 1,
    title: "Mediterranean Quinoa Salad with Grilled Chicken",
    image:
      "https://readdy.ai/api/search-image?query=delicious%252520mediterranean%252520quinoa%252520salad%252520with%252520grilled%252520chicken%25252C%252520fresh%252520vegetables%25252C%252520feta%252520cheese%25252C%252520and%252520olives%252520in%252520a%252520white%252520bowl%252520on%252520a%252520light%252520wooden%252520table%252520with%252520natural%252520lighting%25252C%252520professional%252520food%252520photography%25252C%252520healthy%252520lunch%252520option&width=600&height=400&seq=40&orientation=landscape",
    rating: 4.8,
    reviewCount: 124,
    cookingTime: 25,
    difficulty: "Easy",
    mealTime: 2, // Lunch
    isFeatured: true,
    isNew: false,
  },
  {
    id: 2,
    title: "Avocado & Turkey Wrap with Spicy Mayo",
    image:
      "https://readdy.ai/api/search-image?query=fresh%252520avocado%252520and%252520turkey%252520wrap%252520with%252520spicy%252520mayo%25252C%252520lettuce%25252C%252520and%252520tomato%252520sliced%252520in%252520half%252520on%252520a%252520wooden%252520board%252520with%252520bright%252520natural%252520lighting%25252C%252520professional%252520food%252520photography%25252C%252520quick%252520lunch%252520option&width=600&height=400&seq=41&orientation=landscape",
    rating: 4.5,
    reviewCount: 98,
    cookingTime: 10,
    difficulty: "Easy",
    mealTime: 2, // Lunch
    isFeatured: false,
    isNew: true,
  },
  {
    id: 3,
    title: "Spicy Thai Noodle Soup with Shrimp",
    image:
      "https://readdy.ai/api/search-image?query=steaming%252520hot%252520spicy%252520thai%252520noodle%252520soup%252520with%252520shrimp%25252C%252520vegetables%25252C%252520herbs%25252C%252520and%252520lime%252520in%252520a%252520dark%252520bowl%252520on%252520a%252520rustic%252520table%252520with%252520moody%252520lighting%25252C%252520professional%252520food%252520photography%25252C%252520flavorful%252520lunch%252520option&width=600&height=400&seq=42&orientation=landscape",
    rating: 4.7,
    reviewCount: 156,
    cookingTime: 30,
    difficulty: "Medium",
    mealTime: 2, // Lunch
    isFeatured: false,
    isNew: false,
  },
  {
    id: 4,
    title: "Classic BLT Sandwich with Avocado",
    image:
      "https://readdy.ai/api/search-image?query=classic%252520BLT%252520sandwich%252520with%252520avocado%252520slices%25252C%252520crispy%252520bacon%25252C%252520fresh%252520lettuce%25252C%252520and%252520tomato%252520on%252520toasted%252520bread%252520cut%252520in%252520half%252520on%252520a%252520plate%252520with%252520bright%252520natural%252520lighting%25252C%252520professional%252520food%252520photography%25252C%252520simple%252520lunch%252520option&width=600&height=400&seq=43&orientation=landscape",
    rating: 4.6,
    reviewCount: 87,
    cookingTime: 15,
    difficulty: "Easy",
    mealTime: 2, // Lunch
    isFeatured: false,
    isNew: false,
  },
  {
    id: 5,
    title: "Roasted Vegetable & Hummus Wrap",
    image:
      "https://readdy.ai/api/search-image?query=colorful%252520roasted%252520vegetable%252520and%252520hummus%252520wrap%252520with%252520zucchini%25252C%252520bell%252520peppers%25252C%252520and%252520eggplant%252520in%252520a%252520whole%252520grain%252520tortilla%252520on%252520a%252520wooden%252520board%252520with%252520natural%252520lighting%25252C%252520professional%252520food%252520photography%25252C%252520vegetarian%252520lunch%252520option&width=600&height=400&seq=44&orientation=landscape",
    rating: 4.4,
    reviewCount: 76,
    cookingTime: 25,
    difficulty: "Easy",
    mealTime: 2, // Lunch
    isFeatured: false,
    isNew: false,
  },
  {
    id: 6,
    title: "Tuna Niçoise Salad with Dijon Vinaigrette",
    image:
      "https://readdy.ai/api/search-image?query=elegant%252520tuna%252520nicoise%252520salad%252520with%252520seared%252520tuna%25252C%252520green%252520beans%25252C%252520potatoes%25252C%252520eggs%25252C%252520olives%252520and%252520dijon%252520vinaigrette%252520on%252520a%252520white%252520plate%252520with%252520soft%252520natural%252520lighting%25252C%252520professional%252520food%252520photography%25252C%252520sophisticated%252520lunch%252520option&width=600&height=400&seq=45&orientation=landscape",
    rating: 4.9,
    reviewCount: 112,
    cookingTime: 35,
    difficulty: "Medium",
    mealTime: 2, // Lunch
    isFeatured: true,
    isNew: false,
  },
  {
    id: 7,
    title: "Chicken Caesar Wrap with Homemade Dressing",
    image:
      "https://readdy.ai/api/search-image?query=fresh%252520chicken%252520caesar%252520wrap%252520with%252520grilled%252520chicken%25252C%252520romaine%252520lettuce%25252C%252520parmesan%252520cheese%252520and%252520homemade%252520dressing%252520in%252520a%252520flour%252520tortilla%252520on%252520a%252520slate%252520board%252520with%252520bright%252520natural%252520lighting%25252C%252520professional%252520food%252520photography%25252C%252520popular%252520lunch%252520option&width=600&height=400&seq=46&orientation=landscape",
    rating: 4.6,
    reviewCount: 94,
    cookingTime: 20,
    difficulty: "Easy",
    mealTime: 2, // Lunch
    isFeatured: false,
    isNew: false,
  },
  {
    id: 8,
    title: "Butternut Squash Soup with Crispy Sage",
    image:
      "https://readdy.ai/api/search-image?query=creamy%252520butternut%252520squash%252520soup%252520with%252520crispy%252520sage%252520leaves%252520and%252520cream%252520swirl%252520in%252520a%252520rustic%252520bowl%252520with%252520bread%252520on%252520the%252520side%252520on%252520a%252520dark%252520wooden%252520table%252520with%252520moody%252520lighting%25252C%252520professional%252520food%252520photography%25252C%252520comforting%252520lunch%252520option&width=600&height=400&seq=47&orientation=landscape",
    rating: 4.7,
    reviewCount: 108,
    cookingTime: 40,
    difficulty: "Medium",
    mealTime: 2, // Lunch
    isFeatured: false,
    isNew: true,
  },
  {
    id: 9,
    title: "Falafel Bowl with Tahini Sauce",
    image:
      "https://readdy.ai/api/search-image?query=vibrant%252520falafel%252520bowl%252520with%252520crispy%252520chickpea%252520fritters%25252C%252520hummus%25252C%252520tabbouleh%25252C%252520pickled%252520vegetables%252520and%252520tahini%252520sauce%252520in%252520a%252520blue%252520bowl%252520on%252520a%252520light%252520wooden%252520table%252520with%252520bright%252520natural%252520lighting%25252C%252520professional%252520food%252520photography%25252C%252520middle%252520eastern%252520lunch%252520option&width=600&height=400&seq=48&orientation=landscape",
    rating: 4.8,
    reviewCount: 132,
    cookingTime: 35,
    difficulty: "Medium",
    mealTime: 2, // Lunch
    isFeatured: false,
    isNew: false,
  },
  {
    id: 10,
    title: "Gourmet Grilled Cheese with Caramelized Onions",
    image:
      "https://readdy.ai/api/search-image?query=gourmet%252520grilled%252520cheese%252520sandwich%252520with%252520melted%252520cheese%252520oozing%252520out%25252C%252520caramelized%252520onions%25252C%252520and%252520crispy%252520golden%252520bread%252520cut%252520in%252520half%252520on%252520a%252520wooden%252520board%252520with%252520warm%252520lighting%25252C%252520professional%252520food%252520photography%25252C%252520elevated%252520comfort%252520food%252520lunch%252520option&width=600&height=400&seq=49&orientation=landscape",
    rating: 4.5,
    reviewCount: 89,
    cookingTime: 20,
    difficulty: "Easy",
    mealTime: 2, // Lunch
    isFeatured: false,
    isNew: false,
  },
  {
    id: 11,
    title: "Poke Bowl with Sushi-Grade Tuna",
    image:
      "https://readdy.ai/api/search-image?query=fresh%252520poke%252520bowl%252520with%252520cubed%252520sushi-grade%252520tuna%25252C%252520avocado%25252C%252520cucumber%25252C%252520edamame%25252C%252520and%252520seaweed%252520on%252520rice%252520with%252520sesame%252520seeds%252520in%252520a%252520white%252520bowl%252520on%252520a%252520light%252520wooden%252520table%252520with%252520bright%252520natural%252520lighting%25252C%252520professional%252520food%252520photography%25252C%252520trendy%252520lunch%252520option&width=600&height=400&seq=50&orientation=landscape",
    rating: 4.9,
    reviewCount: 145,
    cookingTime: 25,
    difficulty: "Medium",
    mealTime: 2, // Lunch
    isFeatured: true,
    isNew: false,
  },
  {
    id: 12,
    title: "Caprese Panini with Balsamic Glaze",
    image:
      "https://readdy.ai/api/search-image?query=grilled%252520caprese%252520panini%252520with%252520fresh%252520mozzarella%25252C%252520tomatoes%25252C%252520basil%25252C%252520and%252520balsamic%252520glaze%252520with%252520grill%252520marks%252520on%252520the%252520bread%252520cut%252520in%252520half%252520on%252520a%252520wooden%252520board%252520with%252520natural%252520lighting%25252C%252520professional%252520food%252520photography%25252C%252520italian%252520lunch%252520option&width=600&height=400&seq=51&orientation=landscape",
    rating: 4.6,
    reviewCount: 97,
    cookingTime: 15,
    difficulty: "Easy",
    mealTime: 2, // Lunch
    isFeatured: false,
    isNew: true,
  },
]);
// Related Categories
const relatedCategories = ref([
  {
    id: 1,
    name: "Quick Lunches",
    description: "Ready in 20 minutes or less",
    image:
      "https://readdy.ai/api/search-image?query=assortment%252520of%252520quick%252520lunch%252520options%252520including%252520sandwiches%25252C%252520wraps%25252C%252520and%252520salads%252520arranged%252520on%252520a%252520wooden%252520table%252520with%252520bright%252520natural%252520lighting%25252C%252520professional%252520food%252520photography%25252C%252520fast%252520and%252520convenient%252520meal%252520ideas%252520for%252520busy%252520people&width=600&height=400&seq=52&orientation=landscape",
  },
  {
    id: 2,
    name: "Healthy Lunches",
    description: "Nutritious and delicious options",
    image:
      "https://readdy.ai/api/search-image?query=colorful%252520array%252520of%252520healthy%252520lunch%252520options%252520with%252520grain%252520bowls%25252C%252520vegetable-packed%252520salads%25252C%252520and%252520lean%252520protein%252520sources%252520on%252520a%252520light%252520background%252520with%252520bright%252520natural%252520lighting%25252C%252520professional%252520food%252520photography%25252C%252520nutritious%252520and%252520appealing%252520meal%252520ideas&width=600&height=400&seq=53&orientation=landscape",
  },
  {
    id: 3,
    name: "Meal Prep Lunches",
    description: "Make ahead for the work week",
    image:
      "https://readdy.ai/api/search-image?query=organized%252520meal%252520prep%252520containers%252520filled%252520with%252520portioned%252520lunches%252520including%252520proteins%25252C%252520vegetables%25252C%252520and%252520grains%252520arranged%252520neatly%252520on%252520a%252520clean%252520counter%252520with%252520bright%252520natural%252520lighting%25252C%252520professional%252520food%252520photography%25252C%252520weekly%252520lunch%252520preparation%252520for%252520busy%252520professionals&width=600&height=400&seq=54&orientation=landscape",
  },
]);
// Pagination
const itemsPerPage = 8;
const currentPage = ref(1);
// Computed Properties
const hasActiveFilters = computed(() => {
  return (
    selectedDifficulties.value.length > 0 ||
    selectedCookingTimes.value.length > 0 ||
    (selectedMealTimes.value.length > 0 && !selectedMealTimes.value.includes(2))
  );
});
const filteredRecipes = computed(() => {
  let result = [...recipes.value];
  // Apply meal time filter
  if (selectedMealTimes.value.length > 0) {
    result = result.filter((recipe) =>
      selectedMealTimes.value.includes(recipe.mealTime),
    );
  }
  // Apply difficulty filter
  if (selectedDifficulties.value.length > 0) {
    result = result.filter((recipe) => {
      const difficultyMap: Record<string, number> = {
        Easy: 1,
        Medium: 2,
        Hard: 3,
      };
      return selectedDifficulties.value.includes(
        difficultyMap[recipe.difficulty],
      );
    });
  }
  // Apply cooking time filter
  if (selectedCookingTimes.value.length > 0) {
    result = result.filter((recipe) => {
      const time = recipe.cookingTime;
      return selectedCookingTimes.value.some((filterID) => {
        if (filterID === 1) return time < 15;
        if (filterID === 2) return time >= 15 && time <= 30;
        if (filterID === 3) return time > 30 && time <= 45;
        if (filterID === 4) return time > 45;
        return false;
      });
    });
  }
  // Apply search query if present
  if (searchQuery.value.trim()) {
    const query = searchQuery.value.toLowerCase().trim();
    result = result.filter((recipe) =>
      recipe.title.toLowerCase().includes(query),
    );
  }
  return result;
});
const totalPages = computed(() => {
  return Math.ceil(filteredRecipes.value.length / itemsPerPage);
});
const paginatedRecipes = computed(() => {
  const startIndex = (currentPage.value - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  return filteredRecipes.value.slice(startIndex, endIndex);
});
const displayedPages = computed(() => {
  const total = totalPages.value;
  const current = currentPage.value;
  const pages = [];
  if (total <= 5) {
    // Show all pages if 5 or fewer
    for (let i = 1; i <= total; i++) {
      pages.push(i);
    }
  } else {
    // Always show first page
    pages.push(1);
    // Show dots or additional pages
    if (current > 3) {
      pages.push("...");
    }
    // Show current page and neighbors
    const start = Math.max(2, current - 1);
    const end = Math.min(total - 1, current + 1);
    for (let i = start; i <= end; i++) {
      if (i !== 1 && i !== total) {
        pages.push(i);
      }
    }
    // Show dots or additional pages
    if (current < total - 2) {
      pages.push("...");
    }
    // Always show last page
    pages.push(total);
  }
  return pages;
});
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
const toggleMealTimeFilter = (id: number) => {
  const index = selectedMealTimes.value.indexOf(id);
  if (index === -1) {
    selectedMealTimes.value.push(id);
  } else {
    selectedMealTimes.value.splice(index, 1);
  }
  currentPage.value = 1;
};
const toggleDifficultyFilter = (id: number) => {
  const index = selectedDifficulties.value.indexOf(id);
  if (index === -1) {
    selectedDifficulties.value.push(id);
  } else {
    selectedDifficulties.value.splice(index, 1);
  }
  currentPage.value = 1;
};
const toggleCookingTimeFilter = (id: number) => {
  const index = selectedCookingTimes.value.indexOf(id);
  if (index === -1) {
    selectedCookingTimes.value.push(id);
  } else {
    selectedCookingTimes.value.splice(index, 1);
  }
  currentPage.value = 1;
};
const clearAllFilters = () => {
  selectedMealTimes.value = [2]; // Reset to Lunch only
  selectedDifficulties.value = [];
  selectedCookingTimes.value = [];
  currentPage.value = 1;
};
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
  if (typeof page === "number") {
    currentPage.value = page;
  }
};
const logout = () => {
  isAuthenticated.value = false;
  showUserMenu.value = false;
};
// Lifecycle
onMounted(() => {
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
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
/* Hide number input arrows */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type="number"] {
  -moz-appearance: textfield;
}
</style>
