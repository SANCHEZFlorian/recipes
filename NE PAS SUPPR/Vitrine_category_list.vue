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
              href="#"
              class="text-emerald-600 font-medium border-b-2 border-emerald-600 pb-1 cursor-pointer"
              >Categories</a
            >
            <!-- Notification Bell (For Authenticated Users) -->
            <div v-if="isAuthenticated" class="relative">
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
            href="#"
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
        <span class="text-emerald-600 font-medium">Categories</span>
      </div>
      <!-- Page Header -->
      <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Recipe Categories</h1>
        <p class="text-gray-600">
          Browse our collection of recipe categories to find exactly what you're
          looking for.
        </p>
      </div>
      <!-- Search and Filter Bar -->
      <div class="bg-white rounded-lg shadow-sm p-4 mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
          <div class="relative flex-grow mb-4 md:mb-0">
            <input
              type="text"
              v-model="categorySearchQuery"
              placeholder="Search categories..."
              class="w-full pl-10 pr-4 py-2 rounded-full border-gray-300 border focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
            />
            <i
              class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
            ></i>
          </div>
          <div class="relative">
            <select
              v-model="categorySort"
              class="pl-3 pr-8 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
            >
              <option value="popular">Most Popular</option>
              <option value="az">A-Z</option>
              <option value="za">Z-A</option>
              <option value="recipes">Most Recipes</option>
            </select>
            <div
              class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
            >
              <i class="fas fa-chevron-down text-xs"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- Categories Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        <div
          v-for="category in filteredCategories"
          :key="category.id"
          class="group cursor-pointer"
        >
          <div
            class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 h-full"
          >
            <div class="relative h-48 overflow-hidden">
              <img
                :src="category.image"
                :alt="category.name"
                class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105"
              />
              <div
                class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"
              ></div>
              <div
                class="absolute bottom-0 left-0 right-0 p-4 flex justify-between items-end"
              >
                <h3 class="text-white text-xl font-bold">
                  {{ category.name }}
                </h3>
                <span
                  class="bg-black/30 text-white text-sm px-2 py-1 rounded-full"
                  >{{ category.recipeCount }} recipes</span
                >
              </div>
            </div>
            <div class="p-4">
              <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                {{ category.description }}
              </p>
              <div class="flex justify-between items-center">
                <div class="flex items-center text-sm text-gray-500">
                  <i class="fas fa-utensils mr-2"></i>
                  <span>{{ category.type }}</span>
                </div>
                <a
                  href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/e474d072-568c-4389-b215-1b8c7ecc29f5"
                  data-readdy="true"
                  class="text-emerald-600 hover:text-emerald-700 font-medium text-sm flex items-center cursor-pointer whitespace-nowrap !rounded-button"
                >
                  View Recipes
                  <i class="fas fa-arrow-right ml-1"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Featured Categories Section -->
      <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
          Featured Collections
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div
            v-for="collection in featuredCollections"
            :key="collection.id"
            class="relative rounded-lg overflow-hidden h-64 group cursor-pointer"
          >
            <img
              :src="collection.image"
              :alt="collection.name"
              class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105"
            />
            <div
              class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent/30"
            ></div>
            <div class="absolute inset-0 flex flex-col justify-end p-6">
              <h3 class="text-white text-xl font-bold mb-2">
                {{ collection.name }}
              </h3>
              <p class="text-white/90 text-sm mb-4">
                {{ collection.description }}
              </p>
              <button
                class="bg-white/20 hover:bg-white/30 text-white backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium inline-flex items-center self-start cursor-pointer whitespace-nowrap !rounded-button"
              >
                Explore Collection
                <i class="fas fa-arrow-right ml-2"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Popular Categories -->
      <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
          Popular Categories
        </h2>
        <div class="flex flex-wrap gap-4">
          <a
            v-for="tag in popularTags"
            :key="tag.id"
            href="#"
            class="bg-white border border-gray-200 hover:border-emerald-500 hover:bg-emerald-50 text-gray-700 hover:text-emerald-600 px-4 py-2 rounded-full text-sm font-medium transition-colors cursor-pointer whitespace-nowrap !rounded-button"
          >
            <i :class="tag.icon + ' mr-2'"></i>
            {{ tag.name }}
          </a>
        </div>
      </div>
      <!-- Newsletter Section -->
      <div class="bg-emerald-50 rounded-lg p-8 mb-12">
        <div
          class="flex flex-col md:flex-row md:items-center md:justify-between"
        >
          <div class="mb-6 md:mb-0 md:mr-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Stay Updated</h2>
            <p class="text-gray-600">
              Subscribe to our newsletter to get weekly recipe updates and
              cooking tips.
            </p>
          </div>
          <div class="flex-shrink-0 w-full md:w-auto">
            <div class="flex">
              <input
                type="email"
                placeholder="Your email address"
                class="w-full md:w-64 px-4 py-2 rounded-l-lg border-gray-300 border focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
              />
              <button
                class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-r-lg font-medium cursor-pointer whitespace-nowrap !rounded-button"
              >
                Subscribe
              </button>
            </div>
          </div>
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
                  class="text-sm text-emerald-600 hover:text-emerald-700 cursor-pointer"
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
                class="text-emerald-600 hover:text-emerald-700 font-medium cursor-pointer"
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
                class="text-emerald-600 hover:text-emerald-700 font-medium cursor-pointer"
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
                  href="#"
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
  "https://readdy.ai/api/search-image?query=minimalist%2520cooking%2520logo%2520with%2520a%2520chef%2520hat%2520and%2520spoon%252C%2520clean%2520design%252C%2520professional%252C%2520modern%252C%2520flat%2520design%252C%2520vector%2520style%252C%2520green%2520color%2520scheme%252C%2520suitable%2520for%2520a%2520cooking%2520app&width=200&height=200&seq=1&orientation=squarish";
// Authentication State
const isAuthenticated = ref(false);
const isAdmin = ref(false);
const currentUser = ref({
  id: 1,
  name: "John Doe",
  email: "john@example.com",
  avatar:
    "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520young%2520man%2520with%2520short%2520brown%2520hair%2520and%2520friendly%2520smile%252C%2520neutral%2520background%252C%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=2&orientation=squarish",
});
// UI State
const isMobileMenuOpen = ref(false);
const showUserMenu = ref(false);
const showNotifications = ref(false);
const isLoading = ref(false);
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
const categorySearchQuery = ref("");
const categorySort = ref("popular");
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
// Categories Data
const categories = ref([
  {
    id: 1,
    name: "Breakfast",
    description:
      "Start your day right with our collection of breakfast recipes, from quick and easy to weekend brunch ideas.",
    image:
      "https://readdy.ai/api/search-image?query=delicious%2520breakfast%2520spread%2520with%2520pancakes%252C%2520eggs%252C%2520bacon%252C%2520and%2520fresh%2520fruit%2520on%2520a%2520wooden%2520table%2520with%2520natural%2520light%2520streaming%2520in%252C%2520professional%2520food%2520photography%252C%2520morning%2520atmosphere%252C%2520inviting%2520and%2520appetizing&width=600&height=400&seq=21&orientation=landscape",
    recipeCount: 128,
    type: "Meal Type",
  },
  {
    id: 2,
    name: "Lunch",
    description:
      "Quick, easy and delicious lunch recipes perfect for busy weekdays or relaxed weekend meals.",
    image:
      "https://readdy.ai/api/search-image?query=fresh%2520lunch%2520spread%2520with%2520sandwiches%252C%2520salad%252C%2520and%2520soup%2520on%2520a%2520wooden%2520table%2520with%2520natural%2520light%2520streaming%2520in%252C%2520professional%2520food%2520photography%252C%2520midday%2520meal%252C%2520colorful%2520and%2520appetizing&width=600&height=400&seq=22&orientation=landscape",
    recipeCount: 156,
    type: "Meal Type",
  },
  {
    id: 3,
    name: "Dinner",
    description:
      "Discover delicious dinner recipes for any occasion, from quick weeknight meals to special celebrations.",
    image:
      "https://readdy.ai/api/search-image?query=elegant%2520dinner%2520spread%2520with%2520roasted%2520meat%252C%2520vegetables%252C%2520and%2520side%2520dishes%2520on%2520a%2520wooden%2520table%2520with%2520warm%2520lighting%252C%2520professional%2520food%2520photography%252C%2520evening%2520meal%252C%2520sophisticated%2520and%2520appetizing&width=600&height=400&seq=23&orientation=landscape",
    recipeCount: 214,
    type: "Meal Type",
  },
  {
    id: 4,
    name: "Desserts",
    description:
      "Indulge your sweet tooth with our collection of dessert recipes, from quick and easy to showstopping creations.",
    image:
      "https://readdy.ai/api/search-image?query=beautiful%2520dessert%2520spread%2520with%2520cakes%252C%2520pastries%252C%2520and%2520chocolates%2520on%2520an%2520elegant%2520table%2520with%2520soft%2520lighting%252C%2520professional%2520food%2520photography%252C%2520sweet%2520treats%252C%2520decadent%2520and%2520appetizing&width=600&height=400&seq=24&orientation=landscape",
    recipeCount: 189,
    type: "Course",
  },
  {
    id: 5,
    name: "Italian",
    description:
      "Authentic Italian recipes from pasta and pizza to risotto and tiramisu. Bring the taste of Italy to your kitchen.",
    image:
      "https://readdy.ai/api/search-image?query=authentic%2520italian%2520food%2520spread%2520with%2520pasta%252C%2520pizza%252C%2520and%2520antipasti%2520on%2520a%2520rustic%2520wooden%2520table%2520with%2520warm%2520lighting%252C%2520professional%2520food%2520photography%252C%2520mediterranean%2520cuisine%252C%2520homemade%2520and%2520appetizing&width=600&height=400&seq=25&orientation=landscape",
    recipeCount: 142,
    type: "Cuisine",
  },
  {
    id: 6,
    name: "Asian",
    description:
      "Explore the diverse flavors of Asian cuisine with recipes from China, Japan, Thailand, Vietnam and more.",
    image:
      "https://readdy.ai/api/search-image?query=colorful%2520asian%2520food%2520spread%2520with%2520stir%2520fry%252C%2520sushi%252C%2520and%2520noodle%2520dishes%2520on%2520a%2520dark%2520table%2520with%2520dramatic%2520lighting%252C%2520professional%2520food%2520photography%252C%2520eastern%2520cuisine%252C%2520vibrant%2520and%2520appetizing&width=600&height=400&seq=26&orientation=landscape",
    recipeCount: 167,
    type: "Cuisine",
  },
  {
    id: 7,
    name: "Vegetarian",
    description:
      "Delicious meat-free recipes that prove vegetarian food is far from boring. Perfect for vegetarians or meat-free days.",
    image:
      "https://readdy.ai/api/search-image?query=vibrant%2520vegetarian%2520food%2520spread%2520with%2520salads%252C%2520roasted%2520vegetables%252C%2520and%2520plant-based%2520dishes%2520on%2520a%2520light%2520wooden%2520table%2520with%2520natural%2520lighting%252C%2520professional%2520food%2520photography%252C%2520healthy%2520cuisine%252C%2520colorful%2520and%2520appetizing&width=600&height=400&seq=27&orientation=landscape",
    recipeCount: 183,
    type: "Diet",
  },
  {
    id: 8,
    name: "Vegan",
    description:
      "Plant-based recipes that are both delicious and satisfying. Perfect for vegans or those looking to reduce animal products.",
    image:
      "https://readdy.ai/api/search-image?query=creative%2520vegan%2520food%2520spread%2520with%2520plant-based%2520proteins%252C%2520vegetables%252C%2520and%2520dairy-free%2520dishes%2520on%2520a%2520modern%2520table%2520with%2520bright%2520lighting%252C%2520professional%2520food%2520photography%252C%2520plant-based%2520cuisine%252C%2520innovative%2520and%2520appetizing&width=600&height=400&seq=28&orientation=landscape",
    recipeCount: 145,
    type: "Diet",
  },
  {
    id: 9,
    name: "Gluten-Free",
    description:
      "Delicious recipes without gluten that everyone will enjoy, from naturally gluten-free dishes to adapted classics.",
    image:
      "https://readdy.ai/api/search-image?query=appetizing%2520gluten-free%2520food%2520spread%2520with%2520alternative%2520grains%252C%2520vegetables%252C%2520and%2520specially%2520prepared%2520dishes%2520on%2520a%2520rustic%2520table%2520with%2520soft%2520lighting%252C%2520professional%2520food%2520photography%252C%2520allergen-free%2520cuisine%252C%2520wholesome%2520and%2520appetizing&width=600&height=400&seq=29&orientation=landscape",
    recipeCount: 112,
    type: "Diet",
  },
  {
    id: 10,
    name: "Quick & Easy",
    description:
      "Delicious recipes that are ready in 30 minutes or less. Perfect for busy weeknights when time is short.",
    image:
      "https://readdy.ai/api/search-image?query=quick%2520and%2520easy%2520food%2520spread%2520with%2520simple%2520dishes%252C%2520one-pot%2520meals%252C%2520and%2520fast%2520recipes%2520on%2520a%2520casual%2520table%2520with%2520bright%2520lighting%252C%2520professional%2520food%2520photography%252C%2520convenient%2520cuisine%252C%2520practical%2520and%2520appetizing&width=600&height=400&seq=30&orientation=landscape",
    recipeCount: 178,
    type: "Cooking Time",
  },
  {
    id: 11,
    name: "Baking",
    description:
      "From bread and cakes to cookies and pastries, our baking recipes will help you create delicious homemade treats.",
    image:
      "https://readdy.ai/api/search-image?query=beautiful%2520baked%2520goods%2520spread%2520with%2520bread%252C%2520pastries%252C%2520and%2520cakes%2520on%2520a%2520floured%2520wooden%2520table%2520with%2520warm%2520lighting%252C%2520professional%2520food%2520photography%252C%2520homemade%2520baking%252C%2520artisanal%2520and%2520appetizing&width=600&height=400&seq=31&orientation=landscape",
    recipeCount: 156,
    type: "Cooking Method",
  },
  {
    id: 12,
    name: "Grilling",
    description:
      "Master the art of grilling with our collection of recipes for the barbecue, from meat and fish to vegetables and fruit.",
    image:
      "https://readdy.ai/api/search-image?query=sizzling%2520grilled%2520food%2520spread%2520with%2520meats%252C%2520vegetables%252C%2520and%2520seafood%2520on%2520a%2520smoking%2520grill%2520with%2520outdoor%2520lighting%252C%2520professional%2520food%2520photography%252C%2520barbecue%2520cuisine%252C%2520smoky%2520and%2520appetizing&width=600&height=400&seq=32&orientation=landscape",
    recipeCount: 98,
    type: "Cooking Method",
  },
]);
// Featured Collections
const featuredCollections = ref([
  {
    id: 1,
    name: "Summer Grilling",
    description: "Perfect recipes for outdoor cooking and barbecues",
    image:
      "https://readdy.ai/api/search-image?query=outdoor%2520summer%2520barbecue%2520scene%2520with%2520grilled%2520meats%2520and%2520vegetables%252C%2520people%2520enjoying%2520food%2520in%2520background%252C%2520warm%2520evening%2520sunlight%252C%2520professional%2520photography%252C%2520vibrant%2520colors%252C%2520festive%2520atmosphere&width=600&height=400&seq=33&orientation=landscape",
  },
  {
    id: 2,
    name: "Healthy Meal Prep",
    description: "Time-saving recipes for nutritious weekly meal planning",
    image:
      "https://readdy.ai/api/search-image?query=organized%2520meal%2520prep%2520containers%2520with%2520healthy%2520balanced%2520meals%252C%2520variety%2520of%2520colorful%2520vegetables%2520and%2520proteins%252C%2520clean%2520white%2520background%252C%2520professional%2520photography%252C%2520bright%2520natural%2520lighting%252C%2520health-focused&width=600&height=400&seq=34&orientation=landscape",
  },
  {
    id: 3,
    name: "Global Street Food",
    description: "Authentic street food recipes from around the world",
    image:
      "https://readdy.ai/api/search-image?query=vibrant%2520international%2520street%2520food%2520market%2520with%2520diverse%2520food%2520stalls%252C%2520colorful%2520dishes%2520from%2520different%2520cultures%252C%2520atmospheric%2520evening%2520lighting%2520with%2520lanterns%252C%2520professional%2520photography%252C%2520bustling%2520environment&width=600&height=400&seq=35&orientation=landscape",
  },
]);
// Popular Tags
const popularTags = ref([
  { id: 1, name: "Breakfast", icon: "fas fa-coffee" },
  { id: 2, name: "Dinner", icon: "fas fa-utensils" },
  { id: 3, name: "Vegetarian", icon: "fas fa-seedling" },
  { id: 4, name: "Quick & Easy", icon: "fas fa-clock" },
  { id: 5, name: "Italian", icon: "fas fa-pizza-slice" },
  { id: 6, name: "Desserts", icon: "fas fa-cookie" },
  { id: 7, name: "Healthy", icon: "fas fa-heartbeat" },
  { id: 8, name: "Baking", icon: "fas fa-bread-slice" },
]);
// Computed Properties
const filteredCategories = computed(() => {
  let result = [...categories.value];
  // Apply search filter
  if (categorySearchQuery.value) {
    const query = categorySearchQuery.value.toLowerCase();
    result = result.filter(
      (category) =>
        category.name.toLowerCase().includes(query) ||
        category.description.toLowerCase().includes(query) ||
        category.type.toLowerCase().includes(query),
    );
  }
  // Apply sort
  switch (categorySort.value) {
    case "az":
      result.sort((a, b) => a.name.localeCompare(b.name));
      break;
    case "za":
      result.sort((a, b) => b.name.localeCompare(a.name));
      break;
    case "recipes":
      result.sort((a, b) => b.recipeCount - a.recipeCount);
      break;
    case "popular":
    default:
      // Assume current order is by popularity
      break;
  }
  return result;
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
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
