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
                  href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/2b100150-41fb-4e0e-a800-4ea3fcbbe9f1"
                  data-readdy="true"
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
                @click="showLoginModal = true"
                class="text-emerald-600 hover:text-emerald-700 font-medium cursor-pointer whitespace-nowrap !rounded-button"
              >
                Login
              </button>
              <!-- Login Modal -->
              <div
                v-if="showLoginModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
              >
                <div
                  class="bg-white rounded-lg w-full max-w-md mx-4 relative"
                  @click.stop
                >
                  <!-- Close button -->
                  <button
                    @click="showLoginModal = false"
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 cursor-pointer whitespace-nowrap !rounded-button"
                  >
                    <i class="fas fa-times"></i>
                  </button>
                  <!-- Modal content -->
                  <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">
                      Login to Family Recipe
                    </h2>
                    <form @submit.prevent="handleLogin" id="loginForm">
                      <!-- Email/Username field -->
                      <div class="mb-4">
                        <label
                          for="loginEmail"
                          class="block text-sm font-medium text-gray-700 mb-2"
                          >Email or Username</label
                        >
                        <input
                          type="text"
                          id="loginEmail"
                          v-model="loginForm.email"
                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                          required
                        />
                      </div>
                      <!-- Password field -->
                      <div class="mb-4">
                        <label
                          for="loginPassword"
                          class="block text-sm font-medium text-gray-700 mb-2"
                          >Password</label
                        >
                        <div class="relative">
                          <input
                            :type="showPassword ? 'text' : 'password'"
                            id="loginPassword"
                            v-model="loginForm.password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                            required
                          />
                          <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 cursor-pointer whitespace-nowrap !rounded-button"
                          >
                            <i
                              :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"
                            ></i>
                          </button>
                        </div>
                      </div>
                      <!-- Remember me checkbox -->
                      <div class="flex items-center mb-4">
                        <input
                          type="checkbox"
                          id="loginRemember"
                          v-model="loginForm.remember"
                          class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded"
                        />
                        <label
                          for="loginRemember"
                          class="ml-2 text-sm text-gray-700"
                          >Remember me</label
                        >
                      </div>
                      <!-- Login button -->
                      <button
                        type="submit"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2 rounded-md font-medium mb-4 cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        Login
                      </button>
                    </form>
                    <!-- Additional links -->
                    <div class="text-center">
                      <a
                        href="#"
                        @click.prevent="handleForgotPassword"
                        class="text-sm text-emerald-600 hover:text-emerald-700"
                        >Forgot password?</a
                      >
                      <p class="mt-4 text-sm text-gray-600">
                        Don't have an account?
                        <a
                          href="#"
                          @click.prevent="switchToRegister"
                          class="text-emerald-600 hover:text-emerald-700 font-medium"
                          >Register</a
                        >
                      </p>
                    </div>
                  </div>
                </div>
              </div>
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
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/2b100150-41fb-4e0e-a800-4ea3fcbbe9f1"
              data-readdy="true"
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
        <a
          href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/e474d072-568c-4389-b215-1b8c7ecc29f5"
          data-readdy="true"
          class="hover:text-emerald-600 cursor-pointer"
          >Lunch Recipes</a
        >
        <i class="fas fa-chevron-right text-xs mx-2"></i>
        <span class="text-emerald-600 font-medium"
          >Spicy Thai Noodle Soup with Shrimp</span
        >
      </div>
      <!-- Back Button (Mobile) -->
      <div class="md:hidden mb-6">
        <a
          href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/e474d072-568c-4389-b215-1b8c7ecc29f5"
          data-readdy="true"
          class="flex items-center text-emerald-600 hover:text-emerald-700 cursor-pointer"
        >
          <i class="fas fa-arrow-left mr-2"></i>
          Back to Lunch Recipes
        </a>
      </div>
      <!-- Recipe Hero Section -->
      <div class="relative mb-8">
        <div class="w-full h-96 md:h-[500px] rounded-xl overflow-hidden">
          <img
            :src="recipeData.heroImage"
            alt="Spicy Thai Noodle Soup with Shrimp"
            class="w-full h-full object-cover object-top"
          />
        </div>
        <!-- Quick Action Buttons (Desktop) -->
        <div class="hidden md:flex absolute top-4 right-4 space-x-3">
          <button
            @click="toggleFavorite"
            class="bg-white/90 hover:bg-white backdrop-blur-sm p-3 rounded-full shadow-md text-gray-700 hover:text-emerald-600 transition-colors cursor-pointer whitespace-nowrap !rounded-button"
          >
            <i
              :class="['fas fa-heart text-lg', isFavorite ? 'text-red-500' : 'text-gray-400']"
            ></i>
          </button>
          <button
            @click="toggleShareMenu"
            class="bg-white/90 hover:bg-white backdrop-blur-sm p-3 rounded-full shadow-md text-gray-700 hover:text-emerald-600 transition-colors cursor-pointer whitespace-nowrap !rounded-button"
          >
            <i class="fas fa-share-alt text-lg"></i>
          </button>
          <button
            @click="printRecipe"
            class="bg-white/90 hover:bg-white backdrop-blur-sm p-3 rounded-full shadow-md text-gray-700 hover:text-emerald-600 transition-colors cursor-pointer whitespace-nowrap !rounded-button"
          >
            <i class="fas fa-print text-lg"></i>
          </button>
        </div>
        <!-- Share Menu (if open) -->
        <div
          v-if="showShareMenu"
          class="absolute top-16 right-4 bg-white rounded-lg shadow-lg p-4 z-10"
        >
          <h4 class="text-sm font-semibold text-gray-700 mb-3">
            Share this recipe
          </h4>
          <div class="flex space-x-3">
            <a
              href="#"
              class="bg-[#3b5998] text-white p-2 rounded-full cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fab fa-facebook-f text-sm"></i>
            </a>
            <a
              href="#"
              class="bg-[#1da1f2] text-white p-2 rounded-full cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fab fa-twitter text-sm"></i>
            </a>
            <a
              href="#"
              class="bg-[#0077b5] text-white p-2 rounded-full cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fab fa-linkedin-in text-sm"></i>
            </a>
            <a
              href="#"
              class="bg-[#25D366] text-white p-2 rounded-full cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fab fa-whatsapp text-sm"></i>
            </a>
            <a
              href="#"
              class="bg-[#bd081c] text-white p-2 rounded-full cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fab fa-pinterest-p text-sm"></i>
            </a>
          </div>
          <div class="mt-3 relative">
            <input
              type="text"
              :value="recipeUrl"
              readonly
              class="w-full pr-10 pl-3 py-2 text-xs border border-gray-300 rounded-md bg-gray-50"
            />
            <button
              @click="copyToClipboard"
              class="absolute right-2 top-1/2 -translate-y-1/2 text-emerald-600 hover:text-emerald-700 cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fas fa-copy"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- Recipe Header -->
      <div class="mb-8">
        <div class="flex justify-between items-start">
          <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">
              Spicy Thai Noodle Soup with Shrimp
            </h1>
            <!-- Rating -->
            <div class="flex items-center mb-4">
              <div class="flex">
                <i
                  v-for="star in 5"
                  :key="star"
                  :class="[
'text-lg',
star <= Math.floor(recipeData.rating) ? 'fas fa-star text-amber-400' :
star - 0.5 <= recipeData.rating ? 'fas fa-star-half-alt text-amber-400' : 'far fa-star text-gray-300'
]"
                ></i>
              </div>
              <span class="text-sm text-gray-600 ml-2"
                >{{ recipeData.rating }} ({{ recipeData.reviewCount }}
                reviews)</span
              >
            </div>
            <!-- Author Info -->
            <div class="flex items-center mb-4">
              <img
                :src="recipeData.author.avatar"
                alt="Chef Avatar"
                class="w-10 h-10 rounded-full object-cover"
              />
              <div class="ml-3">
                <p class="text-sm font-medium text-gray-800">
                  Recipe by
                  <span class="text-emerald-600"
                    >{{ recipeData.author.name }}</span
                  >
                </p>
                <p class="text-xs text-gray-500">
                  Published on {{ recipeData.publishDate }}
                </p>
              </div>
            </div>
          </div>
          <!-- Back Button (Desktop) -->
          <a
            href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/e474d072-568c-4389-b215-1b8c7ecc29f5"
            data-readdy="true"
            class="hidden md:flex items-center text-emerald-600 hover:text-emerald-700 cursor-pointer"
          >
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Lunch Recipes
          </a>
        </div>
        <!-- Recipe Quick Info -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
          <div class="bg-white rounded-lg p-4 shadow-sm">
            <div class="flex items-center">
              <i class="far fa-clock text-emerald-500 text-xl"></i>
              <div class="ml-3">
                <p class="text-xs text-gray-500">Total Time</p>
                <p class="text-sm font-semibold text-gray-800">
                  {{ recipeData.totalTime }} mins
                </p>
              </div>
            </div>
          </div>
          <div class="bg-white rounded-lg p-4 shadow-sm">
            <div class="flex items-center">
              <i class="fas fa-utensils text-emerald-500 text-xl"></i>
              <div class="ml-3">
                <p class="text-xs text-gray-500">Difficulty</p>
                <p class="text-sm font-semibold text-gray-800">
                  {{ recipeData.difficulty }}
                </p>
              </div>
            </div>
          </div>
          <div class="bg-white rounded-lg p-4 shadow-sm">
            <div class="flex items-center">
              <i class="fas fa-fire text-emerald-500 text-xl"></i>
              <div class="ml-3">
                <p class="text-xs text-gray-500">Calories</p>
                <p class="text-sm font-semibold text-gray-800">
                  {{ recipeData.calories }} kcal
                </p>
              </div>
            </div>
          </div>
          <div class="bg-white rounded-lg p-4 shadow-sm">
            <div class="flex items-center">
              <i class="fas fa-users text-emerald-500 text-xl"></i>
              <div class="ml-3 flex items-center">
                <p class="text-xs text-gray-500 mr-2">Servings</p>
                <div class="flex items-center">
                  <button
                    @click="decreaseServings"
                    :disabled="servings <= 1"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 w-6 h-6 rounded-full flex items-center justify-center cursor-pointer whitespace-nowrap !rounded-button"
                  >
                    <i class="fas fa-minus text-xs"></i>
                  </button>
                  <span class="mx-2 text-sm font-semibold text-gray-800"
                    >{{ servings }}</span
                  >
                  <button
                    @click="increaseServings"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 w-6 h-6 rounded-full flex items-center justify-center cursor-pointer whitespace-nowrap !rounded-button"
                  >
                    <i class="fas fa-plus text-xs"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Recipe Description -->
      <div class="bg-white rounded-lg p-6 shadow-sm mb-8">
        <p class="text-gray-700 leading-relaxed">
          {{ recipeData.description }}
        </p>
        <!-- Tags -->
        <div class="flex flex-wrap gap-2 mt-4">
          <span
            v-for="tag in recipeData.tags"
            :key="tag"
            class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium"
          >
            {{ tag }}
          </span>
        </div>
      </div>
      <!-- Quick Action Buttons (Mobile) -->
      <div class="flex md:hidden justify-between mb-8">
        <button
          @click="toggleFavorite"
          class="flex-1 mr-2 bg-white shadow-sm py-3 rounded-lg flex items-center justify-center text-gray-700 hover:text-emerald-600 cursor-pointer whitespace-nowrap !rounded-button"
        >
          <i
            :class="['fas fa-heart mr-2', isFavorite ? 'text-red-500' : 'text-gray-400']"
          ></i>
          <span>{{ isFavorite ? 'Saved' : 'Save' }}</span>
        </button>
        <button
          @click="toggleShareMenu"
          class="flex-1 mx-2 bg-white shadow-sm py-3 rounded-lg flex items-center justify-center text-gray-700 hover:text-emerald-600 cursor-pointer whitespace-nowrap !rounded-button"
        >
          <i class="fas fa-share-alt mr-2"></i>
          <span>Share</span>
        </button>
        <button
          @click="printRecipe"
          class="flex-1 ml-2 bg-white shadow-sm py-3 rounded-lg flex items-center justify-center text-gray-700 hover:text-emerald-600 cursor-pointer whitespace-nowrap !rounded-button"
        >
          <i class="fas fa-print mr-2"></i>
          <span>Print</span>
        </button>
      </div>
      <!-- Recipe Content Navigation -->
      <div class="bg-white sticky top-16 z-30 shadow-sm rounded-lg mb-8">
        <div class="flex overflow-x-auto hide-scrollbar">
          <button
            v-for="section in recipeSections"
            :key="section.id"
            @click="scrollToSection(section.id)"
            :class="[
'px-4 py-3 whitespace-nowrap font-medium text-sm cursor-pointer !rounded-button',
activeSection === section.id ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-gray-600 hover:text-emerald-600'
]"
          >
            {{ section.name }}
          </button>
        </div>
      </div>
      <!-- Ingredients Section -->
      <div id="ingredients" ref="ingredientsSection" class="mb-12">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold text-gray-800">Ingredients</h2>
          <button
            @click="addAllToShoppingList"
            class="text-emerald-600 hover:text-emerald-700 text-sm font-medium flex items-center cursor-pointer whitespace-nowrap !rounded-button"
          >
            <i class="fas fa-shopping-basket mr-2"></i>
            Add all to shopping list
          </button>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6">
          <div
            v-for="(group, index) in recipeData.ingredients"
            :key="index"
            class="mb-6 last:mb-0"
          >
            <h3
              v-if="group.group"
              class="text-lg font-semibold text-gray-800 mb-3"
            >
              {{ group.group }}
            </h3>
            <ul class="space-y-3">
              <li
                v-for="(ingredient, idx) in group.items"
                :key="idx"
                class="flex items-start"
              >
                <div class="flex-shrink-0 mt-0.5">
                  <input
                    type="checkbox"
                    :id="`ingredient-${index}-${idx}`"
                    class="h-5 w-5 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"
                  />
                </div>
                <label
                  :for="`ingredient-${index}-${idx}`"
                  class="ml-3 text-gray-700 cursor-pointer"
                >
                  <span class="font-medium"
                    >{{ calculateAmount(ingredient.amount, ingredient.unit)
                    }}</span
                  >
                  {{ ingredient.name }}
                  <span
                    v-if="ingredient.notes"
                    class="text-gray-500 text-sm italic"
                  >
                    ({{ ingredient.notes }})</span
                  >
                </label>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Instructions Section -->
      <div id="instructions" ref="instructionsSection" class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Instructions</h2>
        <div class="bg-white rounded-lg shadow-sm p-6">
          <div
            v-for="(group, index) in recipeData.instructions"
            :key="index"
            class="mb-8 last:mb-0"
          >
            <h3
              v-if="group.group"
              class="text-lg font-semibold text-gray-800 mb-4"
            >
              {{ group.group }}
            </h3>
            <ol class="space-y-6">
              <li v-for="(step, idx) in group.steps" :key="idx" class="flex">
                <div class="flex-shrink-0 mr-4">
                  <div
                    class="h-8 w-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold"
                  >
                    {{ idx + 1 }}
                  </div>
                </div>
                <div class="flex-1">
                  <p class="text-gray-700">{{ step.instruction }}</p>
                  <!-- Step Image (if available) -->
                  <div
                    v-if="step.image"
                    class="mt-4 rounded-lg overflow-hidden"
                  >
                    <img
                      :src="step.image"
                      :alt="`Step ${idx + 1}`"
                      class="w-full h-auto"
                    />
                  </div>
                  <!-- Step Tip (if available) -->
                  <div
                    v-if="step.tip"
                    class="mt-4 bg-amber-50 border-l-4 border-amber-400 p-4 rounded-r-lg"
                  >
                    <div class="flex">
                      <i class="fas fa-lightbulb text-amber-500 mr-3 mt-1"></i>
                      <p class="text-sm text-amber-800">{{ step.tip }}</p>
                    </div>
                  </div>
                </div>
              </li>
            </ol>
          </div>
        </div>
      </div>
      <!-- Nutrition Section -->
      <div id="nutrition" ref="nutritionSection" class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
          Nutrition Information
        </h2>
        <div class="bg-white rounded-lg shadow-sm p-6">
          <p class="text-sm text-gray-500 mb-4">
            * Percent Daily Values are based on a 2,000 calorie diet. Your daily
            values may be higher or lower depending on your calorie needs.
          </p>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div
              v-for="nutrient in recipeData.nutrition"
              :key="nutrient.name"
              class="border border-gray-200 rounded-lg p-4"
            >
              <p class="text-sm text-gray-500">{{ nutrient.name }}</p>
              <p class="text-xl font-semibold text-gray-800">
                {{ nutrient.amount }}{{ nutrient.unit }}
              </p>
              <div
                v-if="nutrient.dailyValue"
                class="mt-2 h-1.5 bg-gray-200 rounded-full overflow-hidden"
              >
                <div
                  class="bg-emerald-500 h-full"
                  :style="{ width: `${nutrient.dailyValue}%` }"
                ></div>
              </div>
              <p v-if="nutrient.dailyValue" class="text-xs text-gray-500 mt-1">
                {{ nutrient.dailyValue }}% Daily Value
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- Tips Section -->
      <div id="tips" ref="tipsSection" class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
          Cooking Tips & Notes
        </h2>
        <div class="bg-white rounded-lg shadow-sm p-6">
          <div class="space-y-6">
            <div
              v-for="(tip, index) in recipeData.tips"
              :key="index"
              class="flex"
            >
              <div class="flex-shrink-0 mr-4">
                <div
                  class="h-8 w-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center"
                >
                  <i :class="tip.icon"></i>
                </div>
              </div>
              <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                  {{ tip.title }}
                </h3>
                <p class="text-gray-700">{{ tip.content }}</p>
              </div>
            </div>
          </div>
          <!-- Storage Info -->
          <div class="mt-8 pt-6 border-t border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">
              Storage & Reheating
            </h3>
            <p class="text-gray-700 mb-4">{{ recipeData.storage }}</p>
          </div>
        </div>
      </div>
      <!-- Reviews Section -->
      <div id="reviews" ref="reviewsSection" class="mb-12">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold text-gray-800">Reviews</h2>
          <button
            @click="showReviewForm = !showReviewForm"
            class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-full text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
          >
            <i class="fas fa-star mr-2"></i>
            Write a Review
          </button>
        </div>
        <!-- Review Form -->
        <div
          v-if="showReviewForm"
          class="bg-white rounded-lg shadow-sm p-6 mb-6"
        >
          <h3 class="text-lg font-semibold text-gray-800 mb-4">
            Write Your Review
          </h3>
          <!-- Rating Input -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2"
              >Your Rating</label
            >
            <div class="flex">
              <button
                v-for="star in 5"
                :key="star"
                @click="reviewRating = star"
                @mouseover="hoverRating = star"
                @mouseleave="hoverRating = 0"
                class="text-2xl cursor-pointer whitespace-nowrap !rounded-button"
                :class="[
star <= (hoverRating || reviewRating) ? 'text-amber-400' : 'text-gray-300'
]"
              >
                <i class="fas fa-star"></i>
              </button>
            </div>
          </div>
          <!-- Review Title -->
          <div class="mb-4">
            <label
              for="review-title"
              class="block text-sm font-medium text-gray-700 mb-2"
              >Review Title</label
            >
            <input
              type="text"
              id="review-title"
              v-model="reviewTitle"
              placeholder="Summarize your experience"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
            />
          </div>
          <!-- Review Content -->
          <div class="mb-4">
            <label
              for="review-content"
              class="block text-sm font-medium text-gray-700 mb-2"
              >Your Review</label
            >
            <textarea
              id="review-content"
              v-model="reviewContent"
              rows="4"
              placeholder="Share your experience with this recipe"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
            ></textarea>
          </div>
          <!-- Form Actions -->
          <div class="flex justify-end space-x-3">
            <button
              @click="showReviewForm = false"
              class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
            >
              Cancel
            </button>
            <button
              @click="submitReview"
              class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
            >
              Submit Review
            </button>
          </div>
        </div>
        <!-- Reviews List -->
        <div class="bg-white rounded-lg shadow-sm p-6">
          <!-- Review Summary -->
          <div
            class="flex flex-col md:flex-row md:items-center mb-6 pb-6 border-b border-gray-100"
          >
            <div class="flex-1 mb-4 md:mb-0">
              <div class="flex items-baseline">
                <span class="text-4xl font-bold text-gray-800"
                  >{{ recipeData.rating }}</span
                >
                <span class="text-lg text-gray-600 ml-2">out of 5</span>
              </div>
              <div class="flex mt-2">
                <i
                  v-for="star in 5"
                  :key="star"
                  :class="[
'text-lg',
star <= Math.floor(recipeData.rating) ? 'fas fa-star text-amber-400' :
star - 0.5 <= recipeData.rating ? 'fas fa-star-half-alt text-amber-400' : 'far fa-star text-gray-300'
]"
                ></i>
              </div>
              <p class="text-sm text-gray-500 mt-1">
                {{ recipeData.reviewCount }} reviews
              </p>
            </div>
            <!-- Rating Breakdown -->
            <div class="flex-1">
              <div
                v-for="i in 5"
                :key="i"
                class="flex items-center mb-1 last:mb-0"
              >
                <div class="flex items-center mr-3 w-16 justify-end">
                  <span class="text-xs text-gray-600 mr-1">{{ 6 - i }}</span>
                  <i class="fas fa-star text-xs text-amber-400"></i>
                </div>
                <div
                  class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden"
                >
                  <div
                    class="bg-amber-400 h-full"
                    :style="{ width: `${recipeData.ratingBreakdown[5 - i]}%` }"
                  ></div>
                </div>
                <span class="text-xs text-gray-500 ml-3 w-8"
                  >{{ recipeData.ratingBreakdown[5 - i] }}%</span
                >
              </div>
            </div>
          </div>
          <!-- Individual Reviews -->
          <div v-if="recipeData.reviews.length > 0">
            <div
              v-for="(review, index) in recipeData.reviews"
              :key="index"
              class="mb-6 pb-6 border-b border-gray-100 last:mb-0 last:pb-0 last:border-0"
            >
              <div class="flex items-start">
                <img
                  :src="review.avatar"
                  :alt="review.name"
                  class="w-10 h-10 rounded-full object-cover"
                />
                <div class="ml-4 flex-1">
                  <div
                    class="flex flex-col sm:flex-row sm:items-center sm:justify-between"
                  >
                    <div>
                      <h4 class="font-semibold text-gray-800">
                        {{ review.name }}
                      </h4>
                      <div class="flex items-center mt-1">
                        <div class="flex">
                          <i
                            v-for="star in 5"
                            :key="star"
                            :class="[
'text-sm',
star <= review.rating ? 'fas fa-star text-amber-400' : 'far fa-star text-gray-300'
]"
                          ></i>
                        </div>
                        <span class="text-xs text-gray-500 ml-2"
                          >{{ review.date }}</span
                        >
                      </div>
                    </div>
                    <div class="mt-2 sm:mt-0">
                      <button
                        class="text-gray-500 hover:text-emerald-600 text-sm cursor-pointer whitespace-nowrap !rounded-button"
                      >
                        <i class="far fa-flag mr-1"></i>
                        Report
                      </button>
                    </div>
                  </div>
                  <h5 class="font-medium text-gray-800 mt-3">
                    {{ review.title }}
                  </h5>
                  <p class="text-gray-700 mt-2">{{ review.content }}</p>
                  <!-- Review Images (if any) -->
                  <div
                    v-if="review.images && review.images.length > 0"
                    class="mt-3 flex space-x-2"
                  >
                    <div
                      v-for="(image, imgIndex) in review.images"
                      :key="imgIndex"
                      class="w-16 h-16 rounded-md overflow-hidden"
                    >
                      <img
                        :src="image"
                        alt="User review image"
                        class="w-full h-full object-cover"
                      />
                    </div>
                  </div>
                  <!-- Review Actions -->
                  <div class="mt-3 flex items-center">
                    <button
                      class="text-gray-500 hover:text-emerald-600 text-sm flex items-center cursor-pointer whitespace-nowrap !rounded-button"
                    >
                      <i class="far fa-thumbs-up mr-1"></i>
                      Helpful ({{ review.helpfulCount }})
                    </button>
                    <span class="mx-2 text-gray-300">|</span>
                    <button
                      class="text-gray-500 hover:text-emerald-600 text-sm cursor-pointer whitespace-nowrap !rounded-button"
                    >
                      <i class="far fa-comment mr-1"></i>
                      Reply
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- No Reviews State -->
          <div v-else class="text-center py-8">
            <i class="far fa-comment-dots text-gray-300 text-4xl"></i>
            <p class="text-gray-500 mt-3">
              No reviews yet. Be the first to review this recipe!
            </p>
          </div>
          <!-- Load More Reviews Button -->
          <div
            v-if="recipeData.reviews.length > 0 && recipeData.reviewCount > recipeData.reviews.length"
            class="mt-6 text-center"
          >
            <button
              class="text-emerald-600 hover:text-emerald-700 font-medium cursor-pointer whitespace-nowrap !rounded-button"
            >
              Load More Reviews
            </button>
          </div>
        </div>
      </div>
      <!-- Related Recipes Section -->
      <div id="related" ref="relatedSection" class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
          You Might Also Like
        </h2>
        <div
          class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
        >
          <div
            v-for="recipe in relatedRecipes"
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
                v-if="recipe.isNew"
                class="absolute top-2 right-2 bg-amber-500 text-white text-xs px-2 py-1 rounded-full"
              >
                New
              </div>
            </div>
            <div class="p-4">
              <h3
                class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 hover:text-emerald-600 transition-colors"
              >
                {{ recipe.title }}
              </h3>
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
      </div>
    </main>
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
    <!-- Jump to Recipe Button (Fixed) -->
    <button
      @click="scrollToSection('ingredients')"
      class="fixed bottom-6 right-6 bg-emerald-600 hover:bg-emerald-700 text-white rounded-full shadow-lg p-4 z-40 cursor-pointer whitespace-nowrap !rounded-button"
    >
      <i class="fas fa-arrow-down mr-2"></i>
      Jump to Recipe
    </button>
  </div>
</template>

<script lang="ts" setup>
import { ref, computed, onMounted, onUnmounted } from "vue";
// Logo URL
const logoUrl =
  "https://readdy.ai/api/search-image?query=minimalist%25252520cooking%25252520logo%25252520with%25252520a%25252520chef%25252520hat%25252520and%25252520spoon%2525252C%25252520clean%25252520design%2525252C%25252520professional%2525252C%25252520modern%2525252C%25252520flat%25252520design%2525252C%25252520vector%25252520style%2525252C%25252520green%25252520color%25252520scheme%2525252C%25252520suitable%25252520for%25252520a%25252520cooking%25252520app&width=200&height=200&seq=1&orientation=squarish";
// Authentication State
const isAuthenticated = ref(false);
const isAdmin = ref(false);
const currentUser = ref({
  id: 1,
  name: "John Doe",
  email: "john@example.com",
  avatar:
    "https://readdy.ai/api/search-image?query=professional%25252520headshot%25252520of%25252520a%25252520young%25252520man%25252520with%25252520short%25252520brown%25252520hair%25252520and%25252520friendly%25252520smile%2525252C%25252520neutral%25252520background%2525252C%25252520high%25252520quality%25252520portrait%25252520photo&width=100&height=100&seq=2&orientation=squarish",
});
// UI State
const isMobileMenuOpen = ref(false);
const showUserMenu = ref(false);
const showNotifications = ref(false);
const searchQuery = ref("");
const showShareMenu = ref(false);
const isFavorite = ref(false);
const servings = ref(4);
const activeSection = ref("ingredients");
const showReviewForm = ref(false);
// Review Form State
const reviewRating = ref(0);
const hoverRating = ref(0);
const reviewTitle = ref("");
const reviewContent = ref("");
// Recipe URL for sharing
const recipeUrl =
  "https://Family Recipe.example.com/recipes/spicy-thai-noodle-soup-with-shrimp";
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
// Recipe Sections for Navigation
const recipeSections = [
  { id: "ingredients", name: "Ingredients" },
  { id: "instructions", name: "Instructions" },
  { id: "nutrition", name: "Nutrition" },
  { id: "tips", name: "Tips & Notes" },
  { id: "reviews", name: "Reviews" },
  { id: "related", name: "Related Recipes" },
];
// Section Refs
const ingredientsSection = ref<HTMLElement | null>(null);
const instructionsSection = ref<HTMLElement | null>(null);
const nutritionSection = ref<HTMLElement | null>(null);
const tipsSection = ref<HTMLElement | null>(null);
const reviewsSection = ref<HTMLElement | null>(null);
const relatedSection = ref<HTMLElement | null>(null);
// Recipe Data
const recipeData = ref({
  id: 3,
  title: "Spicy Thai Noodle Soup with Shrimp",
  heroImage:
    "https://readdy.ai/api/search-image?query=steaming%25252520hot%25252520spicy%25252520thai%25252520noodle%25252520soup%25252520with%25252520shrimp%2525252C%25252520fresh%25252520herbs%2525252C%25252520lime%2525252C%25252520and%25252520colorful%25252520vegetables%25252520in%25252520a%25252520beautiful%25252520ceramic%25252520bowl%25252520on%25252520a%25252520dark%25252520wooden%25252520table%25252520with%25252520dramatic%25252520lighting%2525252C%25252520professional%25252520food%25252520photography%2525252C%25252520high%25252520resolution%2525252C%25252520appetizing%25252520presentation&width=1200&height=800&seq=100&orientation=landscape",
  description:
    "This Spicy Thai Noodle Soup with Shrimp is a flavor explosion in a bowl. The perfect balance of spicy, sour, sweet, and savory elements makes this soup irresistible. Rice noodles, plump shrimp, and fresh vegetables swim in a fragrant lemongrass and coconut broth that will transport you straight to Thailand. Ready in just 30 minutes, it's perfect for a quick weeknight dinner or impressive weekend meal.",
  author: {
    name: "Chef Emily Chen",
    avatar:
      "https://readdy.ai/api/search-image?query=professional%25252520headshot%25252520of%25252520a%25252520female%25252520asian%25252520chef%25252520with%25252520shoulder%25252520length%25252520black%25252520hair%25252520and%25252520friendly%25252520smile%2525252C%25252520neutral%25252520background%2525252C%25252520high%25252520quality%25252520portrait%25252520photo&width=100&height=100&seq=101&orientation=squarish",
  },
  publishDate: "June 1, 2025",
  rating: 4.7,
  reviewCount: 156,
  prepTime: 15,
  cookTime: 15,
  totalTime: 30,
  difficulty: "Medium",
  calories: 420,
  tags: [
    "Thai",
    "Soup",
    "Seafood",
    "Spicy",
    "Quick",
    "Dinner",
    "Lunch",
    "Gluten-Free Option",
  ],
  ingredients: [
    {
      group: "For the Broth",
      items: [
        { name: "coconut milk", amount: 1, unit: "can (14 oz)" },
        { name: "chicken or vegetable broth", amount: 4, unit: "cups" },
        {
          name: "lemongrass stalks, bruised and cut into 4-inch pieces",
          amount: 2,
          unit: "",
        },
        { name: "fresh ginger, sliced", amount: 2, unit: "inches" },
        { name: "Thai red curry paste", amount: 2, unit: "tablespoons" },
        { name: "fish sauce", amount: 2, unit: "tablespoons" },
        { name: "brown sugar", amount: 1, unit: "tablespoon" },
        { name: "lime juice", amount: 2, unit: "tablespoons" },
      ],
    },
    {
      group: "For the Soup",
      items: [
        { name: "rice noodles", amount: 8, unit: "oz" },
        { name: "large shrimp, peeled and deveined", amount: 1, unit: "lb" },
        { name: "red bell pepper, thinly sliced", amount: 1, unit: "" },
        { name: "shiitake mushrooms, sliced", amount: 4, unit: "oz" },
        {
          name: "baby bok choy, quartered",
          amount: 2,
          unit: "",
          notes: "or other leafy greens",
        },
      ],
    },
    {
      group: "For Garnish",
      items: [
        { name: "fresh cilantro leaves", amount: 0.5, unit: "cup" },
        { name: "Thai basil leaves", amount: 0.25, unit: "cup" },
        { name: "green onions, thinly sliced", amount: 3, unit: "" },
        { name: "lime wedges", amount: 1, unit: "lime" },
        {
          name: "red chili, thinly sliced",
          amount: 1,
          unit: "",
          notes: "optional, for extra heat",
        },
        { name: "bean sprouts", amount: 1, unit: "cup", notes: "optional" },
      ],
    },
  ],
  instructions: [
    {
      group: "Prepare the Broth",
      steps: [
        {
          instruction:
            "In a large pot, combine coconut milk and broth. Add lemongrass, ginger, and bring to a gentle simmer over medium heat.",
          tip: "For a more intense flavor, lightly smash the lemongrass with the back of a knife before adding it to release more oils.",
        },
        {
          instruction:
            "Stir in the red curry paste, fish sauce, and brown sugar. Simmer for 10 minutes to allow the flavors to meld.",
          image:
            "https://readdy.ai/api/search-image?query=thai%25252520soup%25252520broth%25252520simmering%25252520in%25252520a%25252520pot%25252520with%25252520lemongrass%25252520and%25252520ginger%25252520visible%2525252C%25252520steam%25252520rising%2525252C%25252520rich%25252520red-orange%25252520color%2525252C%25252520wooden%25252520spoon%25252520stirring%2525252C%25252520professional%25252520food%25252520photography%2525252C%25252520cooking%25252520process%25252520shot&width=800&height=500&seq=102&orientation=landscape",
        },
        {
          instruction:
            "Remove the lemongrass and ginger pieces from the broth using a slotted spoon.",
        },
      ],
    },
    {
      group: "Prepare the Noodles",
      steps: [
        {
          instruction:
            "While the broth is simmering, prepare the rice noodles according to package instructions. Usually, this involves soaking in hot water until softened.",
          tip: "To prevent the noodles from becoming too soft, soak them until they're almost done but still slightly firm. They'll finish cooking in the hot soup.",
        },
        {
          instruction:
            "Drain the noodles and rinse under cold water to stop the cooking process. Set aside.",
        },
      ],
    },
    {
      group: "Assemble the Soup",
      steps: [
        {
          instruction:
            "Add the sliced bell peppers and mushrooms to the simmering broth. Cook for 2-3 minutes until slightly softened.",
        },
        {
          instruction:
            "Add the shrimp to the broth and cook for about 2 minutes until they just start to turn pink.",
          image:
            "https://readdy.ai/api/search-image?query=raw%25252520shrimp%25252520being%25252520added%25252520to%25252520a%25252520simmering%25252520thai%25252520soup%25252520broth%25252520with%25252520vegetables%25252520visible%2525252C%25252520steam%25252520rising%2525252C%25252520cooking%25252520process%25252520shot%2525252C%25252520professional%25252520food%25252520photography%2525252C%25252520close-up%25252520detail&width=800&height=500&seq=103&orientation=landscape",
        },
        {
          instruction:
            "Add the bok choy and cook for another minute until the greens are wilted and the shrimp are fully cooked.",
          tip: "Shrimp cook very quickly. They're done as soon as they turn completely pink and opaque. Overcooking will make them tough.",
        },
        {
          instruction:
            "Stir in the lime juice and taste the broth. Adjust seasonings if needed with more fish sauce (for saltiness), brown sugar (for sweetness), or lime juice (for sourness).",
        },
      ],
    },
    {
      group: "Serve",
      steps: [
        {
          instruction:
            "Place a portion of the prepared rice noodles in each serving bowl.",
        },
        {
          instruction:
            "Ladle the hot soup with shrimp and vegetables over the noodles.",
          image:
            "https://readdy.ai/api/search-image?query=steaming%25252520hot%25252520thai%25252520soup%25252520being%25252520ladled%25252520over%25252520rice%25252520noodles%25252520in%25252520a%25252520beautiful%25252520ceramic%25252520bowl%2525252C%25252520shrimp%25252520and%25252520colorful%25252520vegetables%25252520visible%2525252C%25252520steam%25252520rising%2525252C%25252520professional%25252520food%25252520photography%2525252C%25252520serving%25252520process&width=800&height=500&seq=104&orientation=landscape",
        },
        {
          instruction:
            "Garnish generously with cilantro, Thai basil, green onions, and bean sprouts if using. Serve with lime wedges and sliced chili on the side.",
        },
      ],
    },
  ],
  nutrition: [
    { name: "Calories", amount: 420, unit: "kcal", dailyValue: 21 },
    { name: "Protein", amount: 28, unit: "g", dailyValue: 56 },
    { name: "Carbohydrates", amount: 45, unit: "g", dailyValue: 15 },
    { name: "Fat", amount: 16, unit: "g", dailyValue: 25 },
    { name: "Saturated Fat", amount: 12, unit: "g", dailyValue: 60 },
    { name: "Fiber", amount: 3, unit: "g", dailyValue: 12 },
    { name: "Sugar", amount: 5, unit: "g", dailyValue: null },
    { name: "Sodium", amount: 980, unit: "mg", dailyValue: 41 },
  ],
  tips: [
    {
      title: "Ingredient Substitutions",
      content:
        "No lemongrass? Use 1 tablespoon of lemon zest instead. Vegetarian? Replace shrimp with tofu and use vegetable broth. For a gluten-free version, ensure your fish sauce and curry paste are certified gluten-free.",
      icon: "fas fa-exchange-alt",
    },
    {
      title: "Adjusting the Heat Level",
      content:
        "This soup is moderately spicy as written. For a milder version, reduce the curry paste to 1 tablespoon. For extra heat, add more curry paste or fresh chilis. Remember, you can always add more heat, but you can't take it away!",
      icon: "fas fa-fire-alt",
    },
    {
      title: "Make Ahead Tips",
      content:
        "The broth can be made up to 2 days ahead and stored in the refrigerator. When ready to serve, reheat the broth and continue with adding the vegetables and shrimp. Prepare the noodles just before serving for the best texture.",
      icon: "fas fa-clock",
    },
    {
      title: "Wine Pairing",
      content:
        "This spicy, aromatic soup pairs beautifully with an off-dry Riesling or Gewürztraminer. The slight sweetness in these wines helps balance the heat of the dish while complementing the complex flavors.",
      icon: "fas fa-wine-glass-alt",
    },
  ],
  storage:
    "Store leftover soup and noodles separately in airtight containers in the refrigerator for up to 2 days. Reheat the soup gently on the stovetop until hot. The noodles will absorb liquid as they sit, so you may need to add a splash of broth when reheating. For best results, consider storing the broth with vegetables and shrimp separately from the noodles, and combine them only when reheating.",
  ratingBreakdown: [70, 20, 8, 1, 1],
  reviews: [
    {
      name: "Sarah Johnson",
      avatar:
        "https://readdy.ai/api/search-image?query=portrait%25252520of%25252520a%25252520young%25252520woman%25252520with%25252520long%25252520brown%25252520hair%25252520and%25252520warm%25252520smile%2525252C%25252520natural%25252520lighting%2525252C%25252520neutral%25252520background%2525252C%25252520professional%25252520headshot%2525252C%25252520high%25252520quality&width=100&height=100&seq=105&orientation=squarish",
      rating: 5,
      date: "May 28, 2025",
      title: "Absolutely incredible flavors!",
      content:
        "This soup is phenomenal! The balance of flavors is perfect - spicy, tangy, and rich all at once. I added extra mushrooms because I love them, and it worked beautifully. My family has already requested I make it again this weekend!",
      helpfulCount: 24,
      images: [
        "https://readdy.ai/api/search-image?query=homemade%25252520thai%25252520soup%25252520in%25252520a%25252520white%25252520bowl%25252520with%25252520shrimp%25252520and%25252520herbs%25252520visible%2525252C%25252520home%25252520kitchen%25252520setting%2525252C%25252520natural%25252520lighting%2525252C%25252520amateur%25252520food%25252520photography%2525252C%25252520authentic%25252520home%25252520cooking%25252520result&width=200&height=200&seq=106&orientation=squarish",
      ],
    },
    {
      name: "Michael Rodriguez",
      avatar:
        "https://readdy.ai/api/search-image?query=portrait%25252520of%25252520a%25252520middle-aged%25252520hispanic%25252520man%25252520with%25252520short%25252520dark%25252520hair%25252520and%25252520glasses%2525252C%25252520friendly%25252520expression%2525252C%25252520neutral%25252520background%2525252C%25252520professional%25252520headshot%2525252C%25252520high%25252520quality&width=100&height=100&seq=107&orientation=squarish",
      rating: 4,
      date: "May 25, 2025",
      title: "Great recipe with a few tweaks",
      content:
        "This soup has amazing flavor! I found it a bit too spicy as written, so I reduced the curry paste to 1 tbsp and it was perfect for my family. I also added some thinly sliced carrots for extra color and nutrition. Will definitely make again.",
      helpfulCount: 18,
      images: [],
    },
    {
      name: "Emma Wilson",
      avatar:
        "https://readdy.ai/api/search-image?query=portrait%25252520of%25252520a%25252520young%25252520woman%25252520with%25252520blonde%25252520hair%25252520in%25252520a%25252520ponytail%2525252C%25252520bright%25252520smile%2525252C%25252520natural%25252520lighting%2525252C%25252520neutral%25252520background%2525252C%25252520professional%25252520headshot%2525252C%25252520high%25252520quality&width=100&height=100&seq=108&orientation=squarish",
      rating: 5,
      date: "May 20, 2025",
      title: "Restaurant quality at home!",
      content:
        "I've tried many Thai soup recipes and this is by far the best! The broth is so flavorful and aromatic. I couldn't find Thai basil so I used regular basil and it was still delicious. My husband said it was better than our local Thai restaurant!",
      helpfulCount: 32,
      images: [
        "https://readdy.ai/api/search-image?query=homemade%25252520thai%25252520soup%25252520with%25252520shrimp%25252520in%25252520a%25252520decorative%25252520bowl%25252520with%25252520chopsticks%25252520on%25252520the%25252520side%2525252C%25252520home%25252520dining%25252520table%25252520setting%2525252C%25252520natural%25252520lighting%2525252C%25252520amateur%25252520food%25252520photography%2525252C%25252520authentic%25252520result&width=200&height=200&seq=109&orientation=squarish",
      ],
    },
  ],
});
// Related Recipes
const relatedRecipes = [
  {
    id: 1,
    title: "Tom Yum Soup with Chicken",
    image:
      "https://readdy.ai/api/search-image?query=hot%25252520and%25252520sour%25252520tom%25252520yum%25252520soup%25252520with%25252520chicken%2525252C%25252520mushrooms%2525252C%25252520and%25252520herbs%25252520in%25252520a%25252520dark%25252520bowl%25252520on%25252520a%25252520wooden%25252520table%25252520with%25252520dramatic%25252520lighting%2525252C%25252520professional%25252520food%25252520photography%2525252C%25252520thai%25252520cuisine%2525252C%25252520appetizing%25252520presentation&width=600&height=400&seq=110&orientation=landscape",
    rating: 4.6,
    reviewCount: 98,
    cookingTime: 25,
    difficulty: "Medium",
    isNew: false,
  },
  {
    id: 2,
    title: "Coconut Curry Noodle Bowl",
    image:
      "https://readdy.ai/api/search-image?query=creamy%25252520coconut%25252520curry%25252520noodle%25252520bowl%25252520with%25252520colorful%25252520vegetables%25252520and%25252520herbs%25252520in%25252520a%25252520white%25252520bowl%25252520on%25252520a%25252520light%25252520wooden%25252520table%25252520with%25252520bright%25252520natural%25252520lighting%2525252C%25252520professional%25252520food%25252520photography%2525252C%25252520asian%25252520fusion%25252520cuisine%2525252C%25252520appetizing%25252520presentation&width=600&height=400&seq=111&orientation=landscape",
    rating: 4.8,
    reviewCount: 112,
    cookingTime: 30,
    difficulty: "Easy",
    isNew: true,
  },
  {
    id: 3,
    title: "Garlic Butter Shrimp Pasta",
    image:
      "https://readdy.ai/api/search-image?query=garlic%25252520butter%25252520shrimp%25252520pasta%25252520with%25252520parsley%25252520and%25252520lemon%25252520on%25252520a%25252520white%25252520plate%25252520on%25252520a%25252520light%25252520wooden%25252520table%25252520with%25252520bright%25252520natural%25252520lighting%2525252C%25252520professional%25252520food%25252520photography%2525252C%25252520italian%25252520cuisine%2525252C%25252520appetizing%25252520presentation&width=600&height=400&seq=112&orientation=landscape",
    rating: 4.7,
    reviewCount: 145,
    cookingTime: 20,
    difficulty: "Easy",
    isNew: false,
  },
  {
    id: 4,
    title: "Vietnamese Pho Soup",
    image:
      "https://readdy.ai/api/search-image?query=traditional%25252520vietnamese%25252520pho%25252520soup%25252520with%25252520beef%2525252C%25252520rice%25252520noodles%2525252C%25252520bean%25252520sprouts%2525252C%25252520and%25252520herbs%25252520in%25252520a%25252520large%25252520bowl%25252520with%25252520chopsticks%25252520on%25252520a%25252520dark%25252520wooden%25252520table%2525252C%25252520professional%25252520food%25252520photography%2525252C%25252520vietnamese%25252520cuisine%2525252C%25252520appetizing%25252520presentation&width=600&height=400&seq=113&orientation=landscape",
    rating: 4.9,
    reviewCount: 178,
    cookingTime: 45,
    difficulty: "Medium",
    isNew: false,
  },
];
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
const toggleShareMenu = () => {
  showShareMenu.value = !showShareMenu.value;
};
const toggleFavorite = () => {
  isFavorite.value = !isFavorite.value;
};
const increaseServings = () => {
  servings.value++;
};
const decreaseServings = () => {
  if (servings.value > 1) {
    servings.value--;
  }
};
const calculateAmount = (amount: number, unit: string) => {
  const scaledAmount = (amount * servings.value) / 4;
  // Format the amount to avoid too many decimal places
  let formattedAmount;
  if (Number.isInteger(scaledAmount)) {
    formattedAmount = scaledAmount;
  } else {
    // Convert to fraction for common cooking measurements
    if (scaledAmount === 0.25) return "¼";
    if (scaledAmount === 0.5) return "½";
    if (scaledAmount === 0.75) return "¾";
    if (scaledAmount === 1.25) return "1¼";
    if (scaledAmount === 1.5) return "1½";
    if (scaledAmount === 1.75) return "1¾";
    if (scaledAmount === 2.25) return "2¼";
    if (scaledAmount === 2.5) return "2½";
    if (scaledAmount === 2.75) return "2¾";
    // Otherwise round to 1 decimal place
    formattedAmount = scaledAmount.toFixed(1).replace(/\.0$/, "");
  }
  return formattedAmount;
};
const scrollToSection = (sectionId: string) => {
  const sectionMap: Record<string, HTMLElement | null> = {
    ingredients: ingredientsSection.value,
    instructions: instructionsSection.value,
    nutrition: nutritionSection.value,
    tips: tipsSection.value,
    reviews: reviewsSection.value,
    related: relatedSection.value,
  };
  const section = sectionMap[sectionId];
  if (section) {
    // Calculate offset for sticky header
    const headerHeight = 120; // Approximate header height
    const yOffset = -headerHeight;
    const y =
      section.getBoundingClientRect().top + window.pageYOffset + yOffset;
    window.scrollTo({ top: y, behavior: "smooth" });
    activeSection.value = sectionId;
  }
};
const checkActiveSection = () => {
  const sectionMap: Record<string, HTMLElement | null> = {
    ingredients: ingredientsSection.value,
    instructions: instructionsSection.value,
    nutrition: nutritionSection.value,
    tips: tipsSection.value,
    reviews: reviewsSection.value,
    related: relatedSection.value,
  };
  // Get current scroll position with a buffer for the header
  const scrollPosition = window.scrollY + 150;
  // Find which section is currently in view
  for (const [id, element] of Object.entries(sectionMap)) {
    if (element) {
      const offsetTop = element.offsetTop;
      const offsetBottom = offsetTop + element.offsetHeight;
      if (scrollPosition >= offsetTop && scrollPosition < offsetBottom) {
        activeSection.value = id;
        break;
      }
    }
  }
};
const addAllToShoppingList = () => {
  // This would add all ingredients to a shopping list feature
  alert("All ingredients added to your shopping list!");
};
const printRecipe = () => {
  window.print();
};
const copyToClipboard = () => {
  navigator.clipboard.writeText(recipeUrl);
  alert("Recipe URL copied to clipboard!");
};
const submitReview = () => {
  if (reviewRating.value === 0) {
    alert("Please select a rating");
    return;
  }
  if (!reviewTitle.value.trim()) {
    alert("Please enter a review title");
    return;
  }
  if (!reviewContent.value.trim()) {
    alert("Please enter your review");
    return;
  }
  // This would submit the review to the backend
  alert("Thank you for your review!");
  // Reset form
  reviewRating.value = 0;
  reviewTitle.value = "";
  reviewContent.value = "";
  showReviewForm.value = false;
};
// Login form state
const showLoginModal = ref(false);
const showPassword = ref(false);
const loginForm = ref({
  email: "",
  password: "",
  remember: false,
});
const handleLogin = () => {
  // Simulate API call delay
  setTimeout(() => {
    // Check if email and password match our fake account
    if (
      loginForm.value.email === "demo@Family Recipe.com" &&
      loginForm.value.password === "demo123"
    ) {
      // Update authentication state
      isAuthenticated.value = true;
      currentUser.value = {
        id: 1,
        name: "Demo User",
        email: "demo@Family Recipe.com",
        avatar:
          "https://readdy.ai/api/search-image?query=professional%25252520headshot%25252520of%25252520a%25252520young%25252520person%25252520with%25252520friendly%25252520smile%2525252C%25252520neutral%25252520background%2525252C%25252520high%25252520quality%25252520portrait%25252520photo&width=100&height=100&seq=2&orientation=squarish",
      };
      showLoginModal.value = false;
      // Reset form
      loginForm.value = {
        email: "",
        password: "",
        remember: false,
      };
    } else {
      // Show error message for invalid credentials
      alert("Invalid email or password. Try demo@Family Recipe.com / demo123");
    }
  }, 500);
};
const handleForgotPassword = () => {
  // Handle forgot password logic
  console.log("Forgot password clicked");
};
const switchToRegister = () => {
  showLoginModal.value = false;
  openRegisterModal();
};
// Close modal when clicking outside
const closeModalOnOutsideClick = (e: MouseEvent) => {
  const target = e.target as HTMLElement;
  if (target.classList.contains("bg-black")) {
    showLoginModal.value = false;
  }
};
onMounted(() => {
  document.addEventListener("click", closeModalOnOutsideClick);
});
onUnmounted(() => {
  document.removeEventListener("click", closeModalOnOutsideClick);
});
const openRegisterModal = () => {
  // This would open a registration modal
  alert("Registration modal would open here");
};
const logout = () => {
  isAuthenticated.value = false;
  showUserMenu.value = false;
};
// Lifecycle Hooks
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
    // Close share menu when clicking outside
    if (showShareMenu.value) {
      const target = e.target as HTMLElement;
      if (
        !target.closest(".share-menu") &&
        !target.classList.contains("fa-share-alt")
      ) {
        showShareMenu.value = false;
      }
    }
  });
  // Add scroll event listener to track active section
  window.addEventListener("scroll", checkActiveSection);
  // Initial check for active section
  checkActiveSection();
});
onUnmounted(() => {
  window.removeEventListener("scroll", checkActiveSection);
});
</script>

<style scoped>
/* Prevent body scroll when modal is open */
:global(body.modal-open) {
  overflow: hidden;
}
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
/* Hide scrollbar for navigation */
.hide-scrollbar {
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}
.hide-scrollbar::-webkit-scrollbar {
  display: none; /* Chrome, Safari, Opera */
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
/* Print styles */
@media print {
  header,
  footer,
  button,
  .sticky,
  #reviews,
  #related {
    display: none !important;
  }
  main {
    padding: 0 !important;
  }
  body {
    font-size: 12pt;
  }
  h1 {
    font-size: 18pt;
    margin-bottom: 10pt;
  }
  h2 {
    font-size: 16pt;
    margin-top: 15pt;
    margin-bottom: 10pt;
  }
  .no-print {
    display: none !important;
  }
}
</style>
