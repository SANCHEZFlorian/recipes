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
              class="text-gray-600 hover:text-emerald-600 font-medium cursor-pointer"
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
                  href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/71985757-fc78-44cb-b477-8f5d692d152b"
                  data-readdy="true"
                  class="block px-4 py-2 text-sm text-emerald-600 font-medium hover:bg-gray-100 cursor-pointer"
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
                <a
                  href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/70699a77-6b77-4a4f-8e7c-1d864e6e5ccc"
                  data-readdy="true"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                  >My Groups</a
                >
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
            class="text-gray-700 hover:text-emerald-600 font-medium py-2 border-b border-gray-100 cursor-pointer"
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
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/71985757-fc78-44cb-b477-8f5d692d152b"
              data-readdy="true"
              class="block py-2 text-emerald-600 font-medium hover:text-emerald-700 border-b border-gray-100 cursor-pointer"
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
      <!-- Profile Header Section -->
      <div class="relative mb-8">
        <div class="w-full h-64 rounded-xl overflow-hidden">
          <img
            :src="profileCoverImage"
            alt="Profile Cover"
            class="w-full h-full object-cover object-top"
          />
        </div>
        <div class="absolute -bottom-16 left-8 md:left-12">
          <div class="relative">
            <img
              :src="userData.avatar"
              alt="Profile Picture"
              class="w-32 h-32 rounded-full border-4 border-white object-cover"
            />
            <button
              @click="openFileUpload"
              class="absolute bottom-0 right-0 bg-emerald-600 hover:bg-emerald-700 text-white p-2 rounded-full shadow-md cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fas fa-camera"></i>
            </button>
            <input
              type="file"
              ref="fileInput"
              @change="handleProfilePictureChange"
              class="hidden"
              accept="image/*"
            />
          </div>
        </div>
        <div class="absolute top-4 right-4 flex space-x-3">
          <button
            @click="toggleEditMode"
            class="bg-white/90 hover:bg-white backdrop-blur-sm px-4 py-2 rounded-full shadow-md text-emerald-600 hover:text-emerald-700 transition-colors font-medium flex items-center cursor-pointer whitespace-nowrap !rounded-button"
          >
            <i class="fas fa-edit mr-2"></i>
            <span>{{ isEditMode ? 'Cancel' : 'Edit Profile' }}</span>
          </button>
          <a
            href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/71985757-fc78-44cb-b477-8f5d692d152b"
            data-readdy="true"
            class="bg-white/90 hover:bg-white backdrop-blur-sm px-4 py-2 rounded-full shadow-md text-gray-700 hover:text-gray-900 transition-colors font-medium flex items-center cursor-pointer whitespace-nowrap !rounded-button"
          >
            <i class="fas fa-arrow-left mr-2"></i>
            <span>Back</span>
          </a>
        </div>
      </div>
      <!-- Profile Info Section -->
      <div
        class="pt-16 pb-6 flex flex-col md:flex-row md:items-end md:justify-between"
      >
        <div>
          <h1 class="text-3xl font-bold text-gray-800">{{ userData.name }}</h1>
          <p class="text-gray-600 mt-1">@{{ userData.username }}</p>
        </div>
        <div class="mt-4 md:mt-0 flex flex-wrap gap-3">
          <div
            class="bg-white rounded-lg px-4 py-2 shadow-sm flex items-center"
          >
            <i class="fas fa-utensils text-emerald-500 mr-2"></i>
            <div>
              <p class="text-xs text-gray-500">Recipes</p>
              <p class="text-sm font-semibold text-gray-800">
                {{ userData.stats.recipes }}
              </p>
            </div>
          </div>
          <div
            class="bg-white rounded-lg px-4 py-2 shadow-sm flex items-center"
          >
            <i class="fas fa-star text-emerald-500 mr-2"></i>
            <div>
              <p class="text-xs text-gray-500">Reviews</p>
              <p class="text-sm font-semibold text-gray-800">
                {{ userData.stats.reviews }}
              </p>
            </div>
          </div>
          <div
            class="bg-white rounded-lg px-4 py-2 shadow-sm flex items-center"
          >
            <i class="fas fa-heart text-emerald-500 mr-2"></i>
            <div>
              <p class="text-xs text-gray-500">Favorites</p>
              <p class="text-sm font-semibold text-gray-800">
                {{ userData.stats.favorites }}
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- Profile Tabs -->
      <div class="bg-white sticky top-16 z-30 shadow-sm rounded-lg mb-8">
        <div class="flex overflow-x-auto hide-scrollbar">
          <button
            v-for="tab in profileTabs"
            :key="tab.id"
            @click="activeTab = tab.id"
            :class="[
'px-6 py-4 whitespace-nowrap font-medium text-sm cursor-pointer !rounded-button',
activeTab === tab.id ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-gray-600 hover:text-emerald-600'
]"
          >
            <i :class="['mr-2', tab.icon]"></i>
            {{ tab.name }}
          </button>
        </div>
      </div>
      <!-- Tab Content -->
      <!-- Personal Info Tab -->
      <div v-if="activeTab === 'personal'" class="mb-12">
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
          <h2 class="text-xl font-bold text-gray-800 mb-6">
            Personal Information
          </h2>
          <div v-if="isEditMode">
            <!-- Edit Mode -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label
                  for="name"
                  class="block text-sm font-medium text-gray-700 mb-2"
                  >Full Name</label
                >
                <input
                  type="text"
                  id="name"
                  v-model="editedUserData.name"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                />
              </div>
              <div>
                <label
                  for="username"
                  class="block text-sm font-medium text-gray-700 mb-2"
                  >Username</label
                >
                <input
                  type="text"
                  id="username"
                  v-model="editedUserData.username"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                />
              </div>
              <div>
                <label
                  for="email"
                  class="block text-sm font-medium text-gray-700 mb-2"
                  >Email Address</label
                >
                <input
                  type="email"
                  id="email"
                  v-model="editedUserData.email"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                />
              </div>
              <div>
                <label
                  for="location"
                  class="block text-sm font-medium text-gray-700 mb-2"
                  >Location</label
                >
                <input
                  type="text"
                  id="location"
                  v-model="editedUserData.location"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                />
              </div>
              <div class="md:col-span-2">
                <label
                  for="bio"
                  class="block text-sm font-medium text-gray-700 mb-2"
                  >Bio</label
                >
                <textarea
                  id="bio"
                  v-model="editedUserData.bio"
                  rows="4"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                ></textarea>
              </div>
            </div>
            <div class="flex justify-end mt-6 space-x-3">
              <button
                @click="cancelEdit"
                class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
              >
                Cancel
              </button>
              <button
                @click="saveChanges"
                class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
              >
                Save Changes
              </button>
            </div>
          </div>
          <div v-else>
            <!-- View Mode -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <p class="text-sm text-gray-500 mb-1">Full Name</p>
                <p class="text-gray-800 font-medium">{{ userData.name }}</p>
              </div>
              <div>
                <p class="text-sm text-gray-500 mb-1">Username</p>
                <p class="text-gray-800 font-medium">
                  @{{ userData.username }}
                </p>
              </div>
              <div>
                <p class="text-sm text-gray-500 mb-1">Email Address</p>
                <p class="text-gray-800 font-medium">{{ userData.email }}</p>
              </div>
              <div>
                <p class="text-sm text-gray-500 mb-1">Location</p>
                <p class="text-gray-800 font-medium">{{ userData.location }}</p>
              </div>
              <div>
                <p class="text-sm text-gray-500 mb-1">Member Since</p>
                <p class="text-gray-800 font-medium">{{ userData.joinDate }}</p>
              </div>
              <div>
                <p class="text-sm text-gray-500 mb-1">Last Active</p>
                <p class="text-gray-800 font-medium">
                  {{ userData.lastActive }}
                </p>
              </div>
              <div class="md:col-span-2">
                <p class="text-sm text-gray-500 mb-1">Bio</p>
                <p class="text-gray-800">{{ userData.bio }}</p>
              </div>
            </div>
          </div>
        </div>
        <!-- Account Statistics -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
          <h2 class="text-xl font-bold text-gray-800 mb-6">
            Account Statistics
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-50 rounded-lg p-4">
              <div class="flex items-center mb-4">
                <div
                  class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center mr-3"
                >
                  <i class="fas fa-utensils text-emerald-600"></i>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Recipes Shared</p>
                  <p class="text-xl font-bold text-gray-800">
                    {{ userData.stats.recipes }}
                  </p>
                </div>
              </div>
              <div class="h-1.5 bg-gray-200 rounded-full overflow-hidden">
                <div
                  class="bg-emerald-500 h-full"
                  :style="{ width: `${(userData.stats.recipes / 100) * 100}%` }"
                ></div>
              </div>
              <p class="text-xs text-gray-500 mt-1">
                {{ Math.round((userData.stats.recipes / 100) * 100) }}% to next
                milestone
              </p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
              <div class="flex items-center mb-4">
                <div
                  class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center mr-3"
                >
                  <i class="fas fa-star text-emerald-600"></i>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Reviews Written</p>
                  <p class="text-xl font-bold text-gray-800">
                    {{ userData.stats.reviews }}
                  </p>
                </div>
              </div>
              <div class="h-1.5 bg-gray-200 rounded-full overflow-hidden">
                <div
                  class="bg-emerald-500 h-full"
                  :style="{ width: `${(userData.stats.reviews / 50) * 100}%` }"
                ></div>
              </div>
              <p class="text-xs text-gray-500 mt-1">
                {{ Math.round((userData.stats.reviews / 50) * 100) }}% to next
                milestone
              </p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
              <div class="flex items-center mb-4">
                <div
                  class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center mr-3"
                >
                  <i class="fas fa-heart text-emerald-600"></i>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Recipes Favorited</p>
                  <p class="text-xl font-bold text-gray-800">
                    {{ userData.stats.favorites }}
                  </p>
                </div>
              </div>
              <div class="h-1.5 bg-gray-200 rounded-full overflow-hidden">
                <div
                  class="bg-emerald-500 h-full"
                  :style="{ width: `${(userData.stats.favorites / 75) * 100}%` }"
                ></div>
              </div>
              <p class="text-xs text-gray-500 mt-1">
                {{ Math.round((userData.stats.favorites / 75) * 100) }}% to next
                milestone
              </p>
            </div>
          </div>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
            <div class="bg-gray-50 rounded-lg p-4 text-center">
              <p class="text-sm text-gray-500">Average Rating</p>
              <div class="flex justify-center mt-2">
                <div class="flex">
                  <i
                    v-for="star in 5"
                    :key="star"
                    :class="[
'text-sm',
star <= Math.floor(userData.stats.avgRating) ? 'fas fa-star text-amber-400' :
star - 0.5 <= userData.stats.avgRating ? 'fas fa-star-half-alt text-amber-400' : 'far fa-star text-gray-300'
]"
                  ></i>
                </div>
              </div>
              <p class="text-lg font-semibold text-gray-800 mt-1">
                {{ userData.stats.avgRating.toFixed(1) }}
              </p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4 text-center">
              <p class="text-sm text-gray-500">Total Views</p>
              <p class="text-lg font-semibold text-gray-800 mt-2">
                {{ userData.stats.views.toLocaleString() }}
              </p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4 text-center">
              <p class="text-sm text-gray-500">Followers</p>
              <p class="text-lg font-semibold text-gray-800 mt-2">
                {{ userData.stats.followers }}
              </p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4 text-center">
              <p class="text-sm text-gray-500">Following</p>
              <p class="text-lg font-semibold text-gray-800 mt-2">
                {{ userData.stats.following }}
              </p>
            </div>
          </div>
        </div>
        <!-- Recent Activity -->
        <div class="bg-white rounded-lg shadow-sm p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800">Recent Activity</h2>
            <button
              class="text-emerald-600 hover:text-emerald-700 text-sm font-medium flex items-center cursor-pointer whitespace-nowrap !rounded-button"
            >
              View All <i class="fas fa-chevron-right ml-1"></i>
            </button>
          </div>
          <div class="space-y-6">
            <div
              v-for="(activity, index) in recentActivity"
              :key="index"
              class="flex"
            >
              <div class="flex-shrink-0 mr-4">
                <div
                  class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center"
                >
                  <i :class="['text-emerald-600', activity.icon]"></i>
                </div>
              </div>
              <div class="flex-1">
                <div
                  class="flex flex-col sm:flex-row sm:justify-between sm:items-start"
                >
                  <div>
                    <p class="text-gray-800">{{ activity.text }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                      {{ activity.time }}
                    </p>
                  </div>
                  <a
                    v-if="activity.link"
                    :href="activity.link"
                    class="text-emerald-600 hover:text-emerald-700 text-sm mt-2 sm:mt-0 cursor-pointer"
                  >
                    View
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- My Recipes Tab -->
      <div v-if="activeTab === 'recipes'" class="mb-12">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold text-gray-800">My Recipes</h2>
          <button
            class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-full text-sm font-medium flex items-center cursor-pointer whitespace-nowrap !rounded-button"
          >
            <i class="fas fa-plus mr-2"></i>
            Add New Recipe
          </button>
        </div>
        <!-- Recipe Filters -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
          <div class="flex flex-wrap items-center gap-4">
            <div class="relative flex-grow max-w-md">
              <input
                type="text"
                placeholder="Search your recipes..."
                v-model="recipeSearchQuery"
                class="w-full pl-10 pr-4 py-2 rounded-full border-gray-300 border focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
              />
              <i
                class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
              ></i>
            </div>
            <div class="flex items-center space-x-2">
              <span class="text-sm text-gray-600">Sort by:</span>
              <select
                v-model="recipeSortOption"
                class="border border-gray-300 rounded-md text-sm p-2 focus:outline-none focus:ring-2 focus:ring-emerald-500"
              >
                <option value="newest">Newest First</option>
                <option value="oldest">Oldest First</option>
                <option value="popular">Most Popular</option>
                <option value="rating">Highest Rated</option>
              </select>
            </div>
            <div class="flex items-center space-x-2">
              <span class="text-sm text-gray-600">Status:</span>
              <select
                v-model="recipeStatusFilter"
                class="border border-gray-300 rounded-md text-sm p-2 focus:outline-none focus:ring-2 focus:ring-emerald-500"
              >
                <option value="all">All Recipes</option>
                <option value="published">Published</option>
                <option value="draft">Drafts</option>
              </select>
            </div>
          </div>
        </div>
        <!-- Recipes Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="recipe in userRecipes"
            :key="recipe.id"
            class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 cursor-pointer group"
          >
            <div class="relative h-48 overflow-hidden">
              <img
                :src="recipe.image"
                :alt="recipe.title"
                class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105"
              />
              <div class="absolute top-2 right-2 flex space-x-2">
                <span
                  v-if="recipe.status === 'draft'"
                  class="bg-gray-500 text-white text-xs px-2 py-1 rounded-full"
                >
                  Draft
                </span>
                <span
                  v-if="recipe.isNew"
                  class="bg-amber-500 text-white text-xs px-2 py-1 rounded-full"
                >
                  New
                </span>
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
                class="flex items-center justify-between text-sm text-gray-600 mb-3"
              >
                <div class="flex items-center">
                  <i class="far fa-clock mr-1"></i>
                  <span>{{ recipe.cookingTime }} min</span>
                </div>
                <div class="flex items-center">
                  <i class="fas fa-eye mr-1"></i>
                  <span>{{ recipe.views }}</span>
                </div>
              </div>
              <!-- Action Buttons -->
              <div class="flex justify-between mt-2">
                <button
                  class="text-emerald-600 hover:text-emerald-700 text-sm cursor-pointer whitespace-nowrap !rounded-button"
                >
                  <i class="fas fa-edit mr-1"></i> Edit
                </button>
                <button
                  class="text-gray-600 hover:text-gray-700 text-sm cursor-pointer whitespace-nowrap !rounded-button"
                >
                  <i class="fas fa-ellipsis-h"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- Empty State -->
        <div
          v-if="userRecipes.length === 0"
          class="bg-white rounded-lg shadow-sm p-8 text-center"
        >
          <div
            class="h-20 w-20 mx-auto mb-4 rounded-full bg-emerald-100 flex items-center justify-center"
          >
            <i class="fas fa-utensils text-emerald-600 text-2xl"></i>
          </div>
          <h3 class="text-lg font-semibold text-gray-800 mb-2">
            No recipes yet
          </h3>
          <p class="text-gray-600 mb-6">
            You haven't created any recipes yet. Start sharing your culinary
            creations with the world!
          </p>
          <button
            class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-full text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
          >
            <i class="fas fa-plus mr-2"></i>
            Create Your First Recipe
          </button>
        </div>
        <!-- Pagination -->
        <div v-if="userRecipes.length > 0" class="mt-8 flex justify-center">
          <div class="flex space-x-1">
            <button
              class="px-3 py-1 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fas fa-chevron-left"></i>
            </button>
            <button
              class="px-3 py-1 rounded-md border border-gray-300 bg-emerald-600 text-white cursor-pointer whitespace-nowrap !rounded-button"
            >
              1
            </button>
            <button
              class="px-3 py-1 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
            >
              2
            </button>
            <button
              class="px-3 py-1 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
            >
              3
            </button>
            <button
              class="px-3 py-1 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fas fa-chevron-right"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- Favorites Tab -->
      <div v-if="activeTab === 'favorites'" class="mb-12">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold text-gray-800">My Favorite Recipes</h2>
          <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-600">View:</span>
            <button
              @click="favoriteViewMode = 'grid'"
              :class="[
'p-2 rounded-md text-sm cursor-pointer whitespace-nowrap !rounded-button',
favoriteViewMode === 'grid' ? 'bg-emerald-100 text-emerald-600' : 'text-gray-600 hover:bg-gray-100'
]"
            >
              <i class="fas fa-th-large"></i>
            </button>
            <button
              @click="favoriteViewMode = 'list'"
              :class="[
'p-2 rounded-md text-sm cursor-pointer whitespace-nowrap !rounded-button',
favoriteViewMode === 'list' ? 'bg-emerald-100 text-emerald-600' : 'text-gray-600 hover:bg-gray-100'
]"
            >
              <i class="fas fa-list"></i>
            </button>
          </div>
        </div>
        <!-- Favorites Filter -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
          <div class="flex flex-wrap items-center gap-4">
            <div class="relative flex-grow max-w-md">
              <input
                type="text"
                placeholder="Search favorites..."
                v-model="favoriteSearchQuery"
                class="w-full pl-10 pr-4 py-2 rounded-full border-gray-300 border focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
              />
              <i
                class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
              ></i>
            </div>
            <div class="flex items-center space-x-2">
              <span class="text-sm text-gray-600">Category:</span>
              <select
                v-model="favoriteCategoryFilter"
                class="border border-gray-300 rounded-md text-sm p-2 focus:outline-none focus:ring-2 focus:ring-emerald-500"
              >
                <option value="all">All Categories</option>
                <option value="breakfast">Breakfast</option>
                <option value="lunch">Lunch</option>
                <option value="dinner">Dinner</option>
                <option value="dessert">Dessert</option>
              </select>
            </div>
          </div>
        </div>
        <!-- Grid View -->
        <div
          v-if="favoriteViewMode === 'grid'"
          class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
        >
          <div
            v-for="recipe in favoriteRecipes"
            :key="recipe.id"
            class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 cursor-pointer group"
          >
            <div class="relative h-48 overflow-hidden">
              <img
                :src="recipe.image"
                :alt="recipe.title"
                class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105"
              />
              <button
                @click.stop="toggleFavorite(recipe)"
                class="absolute top-2 right-2 bg-white/90 hover:bg-white backdrop-blur-sm p-2 rounded-full shadow-md text-red-500 transition-colors cursor-pointer whitespace-nowrap !rounded-button"
              >
                <i class="fas fa-heart"></i>
              </button>
            </div>
            <div class="p-4">
              <h3
                class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 hover:text-emerald-600 transition-colors"
              >
                {{ recipe.title }}
              </h3>
              <!-- Author -->
              <div class="flex items-center mb-3">
                <img
                  :src="recipe.authorAvatar"
                  alt="Author"
                  class="w-6 h-6 rounded-full object-cover mr-2"
                />
                <span class="text-xs text-gray-600"
                  >by
                  <span class="text-emerald-600"
                    >{{ recipe.author }}</span
                  ></span
                >
              </div>
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
        <!-- List View -->
        <div v-if="favoriteViewMode === 'list'" class="space-y-4">
          <div
            v-for="recipe in favoriteRecipes"
            :key="recipe.id"
            class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 cursor-pointer"
          >
            <div class="flex flex-col sm:flex-row">
              <div class="sm:w-48 h-48 sm:h-auto relative overflow-hidden">
                <img
                  :src="recipe.image"
                  :alt="recipe.title"
                  class="w-full h-full object-cover object-top"
                />
                <button
                  @click.stop="toggleFavorite(recipe)"
                  class="absolute top-2 right-2 bg-white/90 hover:bg-white backdrop-blur-sm p-2 rounded-full shadow-md text-red-500 transition-colors cursor-pointer whitespace-nowrap !rounded-button"
                >
                  <i class="fas fa-heart"></i>
                </button>
              </div>
              <div class="p-4 flex-1">
                <div class="flex justify-between items-start">
                  <div>
                    <h3
                      class="text-lg font-bold text-gray-800 mb-2 hover:text-emerald-600 transition-colors"
                    >
                      {{ recipe.title }}
                    </h3>
                    <!-- Author -->
                    <div class="flex items-center mb-3">
                      <img
                        :src="recipe.authorAvatar"
                        alt="Author"
                        class="w-6 h-6 rounded-full object-cover mr-2"
                      />
                      <span class="text-xs text-gray-600"
                        >by
                        <span class="text-emerald-600"
                          >{{ recipe.author }}</span
                        ></span
                      >
                    </div>
                  </div>
                  <div class="flex">
                    <i
                      v-for="star in 5"
                      :key="star"
                      :class="[
'text-sm',
star <= recipe.rating ? 'fas fa-star text-amber-400' : 'far fa-star text-gray-300'
]"
                    ></i>
                    <span class="text-xs text-gray-500 ml-2"
                      >({{ recipe.reviewCount }})</span
                    >
                  </div>
                </div>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                  {{ recipe.description }}
                </p>
                <div class="flex flex-wrap gap-2 mb-3">
                  <span
                    v-for="(tag, idx) in recipe.tags"
                    :key="idx"
                    class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-xs"
                  >
                    {{ tag }}
                  </span>
                </div>
                <div
                  class="flex items-center justify-between text-sm text-gray-600"
                >
                  <div class="flex space-x-4">
                    <div class="flex items-center">
                      <i class="far fa-clock mr-1"></i>
                      <span>{{ recipe.cookingTime }} min</span>
                    </div>
                    <div class="flex items-center">
                      <i class="fas fa-signal mr-1"></i>
                      <span>{{ recipe.difficulty }}</span>
                    </div>
                    <div class="flex items-center">
                      <i class="fas fa-calendar-alt mr-1"></i>
                      <span>{{ recipe.date }}</span>
                    </div>
                  </div>
                  <button
                    class="text-emerald-600 hover:text-emerald-700 cursor-pointer whitespace-nowrap !rounded-button"
                  >
                    View Recipe
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Empty State -->
        <div
          v-if="favoriteRecipes.length === 0"
          class="bg-white rounded-lg shadow-sm p-8 text-center"
        >
          <div
            class="h-20 w-20 mx-auto mb-4 rounded-full bg-emerald-100 flex items-center justify-center"
          >
            <i class="fas fa-heart text-emerald-600 text-2xl"></i>
          </div>
          <h3 class="text-lg font-semibold text-gray-800 mb-2">
            No favorites yet
          </h3>
          <p class="text-gray-600 mb-6">
            You haven't saved any recipes to your favorites yet. Explore recipes
            and save the ones you love!
          </p>
          <button
            class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-full text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
          >
            <i class="fas fa-search mr-2"></i>
            Explore Recipes
          </button>
        </div>
        <!-- Pagination -->
        <div v-if="favoriteRecipes.length > 0" class="mt-8 flex justify-center">
          <div class="flex space-x-1">
            <button
              class="px-3 py-1 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fas fa-chevron-left"></i>
            </button>
            <button
              class="px-3 py-1 rounded-md border border-gray-300 bg-emerald-600 text-white cursor-pointer whitespace-nowrap !rounded-button"
            >
              1
            </button>
            <button
              class="px-3 py-1 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
            >
              2
            </button>
            <button
              class="px-3 py-1 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
            >
              3
            </button>
            <button
              class="px-3 py-1 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fas fa-chevron-right"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- Reviews Tab -->
      <div v-if="activeTab === 'reviews'" class="mb-12">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold text-gray-800">My Reviews</h2>
          <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-600">Sort by:</span>
            <select
              v-model="reviewSortOption"
              class="border border-gray-300 rounded-md text-sm p-2 focus:outline-none focus:ring-2 focus:ring-emerald-500"
            >
              <option value="newest">Newest First</option>
              <option value="oldest">Oldest First</option>
              <option value="highest">Highest Rating</option>
              <option value="lowest">Lowest Rating</option>
            </select>
          </div>
        </div>
        <!-- Reviews List -->
        <div class="space-y-6">
          <div
            v-for="(review, index) in userReviews"
            :key="index"
            class="bg-white rounded-lg shadow-sm p-6"
          >
            <div class="flex items-start">
              <div class="flex-shrink-0 mr-4">
                <img
                  :src="review.recipeImage"
                  :alt="review.recipeTitle"
                  class="w-16 h-16 rounded-md object-cover"
                />
              </div>
              <div class="flex-1">
                <div
                  class="flex flex-col sm:flex-row sm:items-center sm:justify-between"
                >
                  <div>
                    <h3
                      class="font-semibold text-gray-800 hover:text-emerald-600 cursor-pointer"
                    >
                      {{ review.recipeTitle }}
                    </h3>
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
                  <div class="mt-2 sm:mt-0 flex space-x-2">
                    <button
                      class="text-emerald-600 hover:text-emerald-700 text-sm cursor-pointer whitespace-nowrap !rounded-button"
                    >
                      <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                    <button
                      class="text-red-500 hover:text-red-600 text-sm cursor-pointer whitespace-nowrap !rounded-button"
                    >
                      <i class="fas fa-trash-alt mr-1"></i> Delete
                    </button>
                  </div>
                </div>
                <h4 class="font-medium text-gray-800 mt-3">
                  {{ review.title }}
                </h4>
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
                      alt="Review image"
                      class="w-full h-full object-cover"
                    />
                  </div>
                </div>
                <!-- Author Response (if any) -->
                <div
                  v-if="review.response"
                  class="mt-4 bg-gray-50 p-3 rounded-md border-l-4 border-emerald-500"
                >
                  <p class="text-sm font-medium text-gray-800">
                    Response from {{ review.response.author }}
                  </p>
                  <p class="text-sm text-gray-700 mt-1">
                    {{ review.response.content }}
                  </p>
                  <p class="text-xs text-gray-500 mt-1">
                    {{ review.response.date }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Empty State -->
        <div
          v-if="userReviews.length === 0"
          class="bg-white rounded-lg shadow-sm p-8 text-center"
        >
          <div
            class="h-20 w-20 mx-auto mb-4 rounded-full bg-emerald-100 flex items-center justify-center"
          >
            <i class="fas fa-star text-emerald-600 text-2xl"></i>
          </div>
          <h3 class="text-lg font-semibold text-gray-800 mb-2">
            No reviews yet
          </h3>
          <p class="text-gray-600 mb-6">
            You haven't written any reviews yet. Share your thoughts on recipes
            you've tried!
          </p>
          <button
            class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-full text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
          >
            <i class="fas fa-search mr-2"></i>
            Find Recipes to Review
          </button>
        </div>
        <!-- Pagination -->
        <div v-if="userReviews.length > 0" class="mt-8 flex justify-center">
          <div class="flex space-x-1">
            <button
              class="px-3 py-1 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fas fa-chevron-left"></i>
            </button>
            <button
              class="px-3 py-1 rounded-md border border-gray-300 bg-emerald-600 text-white cursor-pointer whitespace-nowrap !rounded-button"
            >
              1
            </button>
            <button
              class="px-3 py-1 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
            >
              2
            </button>
            <button
              class="px-3 py-1 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-50 cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fas fa-chevron-right"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- Settings Tab -->
      <div v-if="activeTab === 'settings'" class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Account Settings</h2>
        <!-- Settings Navigation -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-8">
          <div class="flex flex-col md:flex-row">
            <div class="md:w-64 bg-gray-50 p-4 md:p-6">
              <div class="space-y-1">
                <button
                  v-for="(section, index) in settingsSections"
                  :key="index"
                  @click="activeSettingsSection = section.id"
                  :class="[
'w-full text-left px-4 py-2 rounded-md text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button',
activeSettingsSection === section.id ? 'bg-emerald-100 text-emerald-600' : 'text-gray-600 hover:bg-gray-100'
]"
                >
                  <i :class="['mr-3', section.icon]"></i>
                  {{ section.name }}
                </button>
              </div>
            </div>
            <div
              class="flex-1 p-6 border-t md:border-t-0 md:border-l border-gray-200"
            >
              <!-- Account Settings -->
              <div v-if="activeSettingsSection === 'account'">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                  Account Information
                </h3>
                <div class="space-y-6">
                  <div>
                    <label
                      for="settings-email"
                      class="block text-sm font-medium text-gray-700 mb-2"
                      >Email Address</label
                    >
                    <input
                      type="email"
                      id="settings-email"
                      v-model="settingsData.email"
                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                    />
                  </div>
                  <div>
                    <label
                      for="settings-username"
                      class="block text-sm font-medium text-gray-700 mb-2"
                      >Username</label
                    >
                    <input
                      type="text"
                      id="settings-username"
                      v-model="settingsData.username"
                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                    />
                  </div>
                  <div class="pt-4 border-t border-gray-200">
                    <h4 class="text-md font-medium text-gray-800 mb-4">
                      Change Password
                    </h4>
                    <div class="space-y-4">
                      <div>
                        <label
                          for="current-password"
                          class="block text-sm font-medium text-gray-700 mb-2"
                          >Current Password</label
                        >
                        <input
                          type="password"
                          id="current-password"
                          v-model="settingsData.currentPassword"
                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                        />
                      </div>
                      <div>
                        <label
                          for="new-password"
                          class="block text-sm font-medium text-gray-700 mb-2"
                          >New Password</label
                        >
                        <input
                          type="password"
                          id="new-password"
                          v-model="settingsData.newPassword"
                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                        />
                      </div>
                      <div>
                        <label
                          for="confirm-password"
                          class="block text-sm font-medium text-gray-700 mb-2"
                          >Confirm New Password</label
                        >
                        <input
                          type="password"
                          id="confirm-password"
                          v-model="settingsData.confirmPassword"
                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="flex justify-end">
                    <button
                      class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
                    >
                      Save Changes
                    </button>
                  </div>
                </div>
              </div>
              <!-- Privacy Settings -->
              <div v-if="activeSettingsSection === 'privacy'">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                  Privacy Settings
                </h3>
                <div class="space-y-6">
                  <div>
                    <h4 class="text-md font-medium text-gray-800 mb-3">
                      Profile Visibility
                    </h4>
                    <div class="space-y-3">
                      <div class="flex items-center">
                        <input
                          type="radio"
                          id="visibility-public"
                          v-model="settingsData.profileVisibility"
                          value="public"
                          class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300"
                        />
                        <label
                          for="visibility-public"
                          class="ml-3 text-sm text-gray-700"
                        >
                          <span class="font-medium">Public</span>
                          <p class="text-gray-500">
                            Anyone can view your profile and recipes
                          </p>
                        </label>
                      </div>
                      <div class="flex items-center">
                        <input
                          type="radio"
                          id="visibility-limited"
                          v-model="settingsData.profileVisibility"
                          value="limited"
                          class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300"
                        />
                        <label
                          for="visibility-limited"
                          class="ml-3 text-sm text-gray-700"
                        >
                          <span class="font-medium">Limited</span>
                          <p class="text-gray-500">
                            Only registered users can view your profile and
                            recipes
                          </p>
                        </label>
                      </div>
                      <div class="flex items-center">
                        <input
                          type="radio"
                          id="visibility-private"
                          v-model="settingsData.profileVisibility"
                          value="private"
                          class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300"
                        />
                        <label
                          for="visibility-private"
                          class="ml-3 text-sm text-gray-700"
                        >
                          <span class="font-medium">Private</span>
                          <p class="text-gray-500">
                            Only you and people you follow can view your profile
                            and recipes
                          </p>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="pt-4 border-t border-gray-200">
                    <h4 class="text-md font-medium text-gray-800 mb-3">
                      Activity Privacy
                    </h4>
                    <div class="space-y-3">
                      <div class="flex items-center justify-between">
                        <div>
                          <p class="text-sm font-medium text-gray-700">
                            Show my recipes in search results
                          </p>
                          <p class="text-xs text-gray-500">
                            Allow your recipes to appear in public search
                            results
                          </p>
                        </div>
                        <div
                          class="relative inline-block w-10 mr-2 align-middle select-none"
                        >
                          <input
                            type="checkbox"
                            id="toggle-search"
                            v-model="settingsData.showInSearch"
                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                          />
                          <label
                            for="toggle-search"
                            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                            :class="{ 'bg-emerald-500': settingsData.showInSearch }"
                          ></label>
                        </div>
                      </div>
                      <div class="flex items-center justify-between">
                        <div>
                          <p class="text-sm font-medium text-gray-700">
                            Show my activity feed
                          </p>
                          <p class="text-xs text-gray-500">
                            Allow others to see your recent activity
                          </p>
                        </div>
                        <div
                          class="relative inline-block w-10 mr-2 align-middle select-none"
                        >
                          <input
                            type="checkbox"
                            id="toggle-activity"
                            v-model="settingsData.showActivity"
                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                          />
                          <label
                            for="toggle-activity"
                            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                            :class="{ 'bg-emerald-500': settingsData.showActivity }"
                          ></label>
                        </div>
                      </div>
                      <div class="flex items-center justify-between">
                        <div>
                          <p class="text-sm font-medium text-gray-700">
                            Allow others to tag me
                          </p>
                          <p class="text-xs text-gray-500">
                            Allow other users to tag you in recipes and comments
                          </p>
                        </div>
                        <div
                          class="relative inline-block w-10 mr-2 align-middle select-none"
                        >
                          <input
                            type="checkbox"
                            id="toggle-tagging"
                            v-model="settingsData.allowTagging"
                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                          />
                          <label
                            for="toggle-tagging"
                            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                            :class="{ 'bg-emerald-500': settingsData.allowTagging }"
                          ></label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="flex justify-end">
                    <button
                      class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
                    >
                      Save Privacy Settings
                    </button>
                  </div>
                </div>
              </div>
              <!-- Notification Settings -->
              <div v-if="activeSettingsSection === 'notifications'">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                  Notification Settings
                </h3>
                <div class="space-y-6">
                  <div>
                    <h4 class="text-md font-medium text-gray-800 mb-3">
                      Email Notifications
                    </h4>
                    <div class="space-y-3">
                      <div class="flex items-center justify-between">
                        <div>
                          <p class="text-sm font-medium text-gray-700">
                            Recipe comments
                          </p>
                          <p class="text-xs text-gray-500">
                            When someone comments on your recipes
                          </p>
                        </div>
                        <div
                          class="relative inline-block w-10 mr-2 align-middle select-none"
                        >
                          <input
                            type="checkbox"
                            id="email-comments"
                            v-model="settingsData.emailNotifications.comments"
                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                          />
                          <label
                            for="email-comments"
                            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                            :class="{ 'bg-emerald-500': settingsData.emailNotifications.comments }"
                          ></label>
                        </div>
                      </div>
                      <div class="flex items-center justify-between">
                        <div>
                          <p class="text-sm font-medium text-gray-700">
                            Recipe ratings
                          </p>
                          <p class="text-xs text-gray-500">
                            When someone rates your recipes
                          </p>
                        </div>
                        <div
                          class="relative inline-block w-10 mr-2 align-middle select-none"
                        >
                          <input
                            type="checkbox"
                            id="email-ratings"
                            v-model="settingsData.emailNotifications.ratings"
                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                          />
                          <label
                            for="email-ratings"
                            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                            :class="{ 'bg-emerald-500': settingsData.emailNotifications.ratings }"
                          ></label>
                        </div>
                      </div>
                      <div class="flex items-center justify-between">
                        <div>
                          <p class="text-sm font-medium text-gray-700">
                            New followers
                          </p>
                          <p class="text-xs text-gray-500">
                            When someone follows you
                          </p>
                        </div>
                        <div
                          class="relative inline-block w-10 mr-2 align-middle select-none"
                        >
                          <input
                            type="checkbox"
                            id="email-followers"
                            v-model="settingsData.emailNotifications.followers"
                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                          />
                          <label
                            for="email-followers"
                            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                            :class="{ 'bg-emerald-500': settingsData.emailNotifications.followers }"
                          ></label>
                        </div>
                      </div>
                      <div class="flex items-center justify-between">
                        <div>
                          <p class="text-sm font-medium text-gray-700">
                            Weekly digest
                          </p>
                          <p class="text-xs text-gray-500">
                            Weekly summary of activity on your recipes
                          </p>
                        </div>
                        <div
                          class="relative inline-block w-10 mr-2 align-middle select-none"
                        >
                          <input
                            type="checkbox"
                            id="email-digest"
                            v-model="settingsData.emailNotifications.digest"
                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                          />
                          <label
                            for="email-digest"
                            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                            :class="{ 'bg-emerald-500': settingsData.emailNotifications.digest }"
                          ></label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="pt-4 border-t border-gray-200">
                    <h4 class="text-md font-medium text-gray-800 mb-3">
                      Push Notifications
                    </h4>
                    <div class="space-y-3">
                      <div class="flex items-center justify-between">
                        <div>
                          <p class="text-sm font-medium text-gray-700">
                            Recipe comments
                          </p>
                          <p class="text-xs text-gray-500">
                            When someone comments on your recipes
                          </p>
                        </div>
                        <div
                          class="relative inline-block w-10 mr-2 align-middle select-none"
                        >
                          <input
                            type="checkbox"
                            id="push-comments"
                            v-model="settingsData.pushNotifications.comments"
                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                          />
                          <label
                            for="push-comments"
                            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                            :class="{ 'bg-emerald-500': settingsData.pushNotifications.comments }"
                          ></label>
                        </div>
                      </div>
                      <div class="flex items-center justify-between">
                        <div>
                          <p class="text-sm font-medium text-gray-700">
                            Recipe ratings
                          </p>
                          <p class="text-xs text-gray-500">
                            When someone rates your recipes
                          </p>
                        </div>
                        <div
                          class="relative inline-block w-10 mr-2 align-middle select-none"
                        >
                          <input
                            type="checkbox"
                            id="push-ratings"
                            v-model="settingsData.pushNotifications.ratings"
                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                          />
                          <label
                            for="push-ratings"
                            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                            :class="{ 'bg-emerald-500': settingsData.pushNotifications.ratings }"
                          ></label>
                        </div>
                      </div>
                      <div class="flex items-center justify-between">
                        <div>
                          <p class="text-sm font-medium text-gray-700">
                            New followers
                          </p>
                          <p class="text-xs text-gray-500">
                            When someone follows you
                          </p>
                        </div>
                        <div
                          class="relative inline-block w-10 mr-2 align-middle select-none"
                        >
                          <input
                            type="checkbox"
                            id="push-followers"
                            v-model="settingsData.pushNotifications.followers"
                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                          />
                          <label
                            for="push-followers"
                            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
                            :class="{ 'bg-emerald-500': settingsData.pushNotifications.followers }"
                          ></label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="flex justify-end">
                    <button
                      class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
                    >
                      Save Notification Settings
                    </button>
                  </div>
                </div>
              </div>
              <!-- Account Danger Zone -->
              <div v-if="activeSettingsSection === 'danger'">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                  Danger Zone
                </h3>
                <div class="space-y-6">
                  <div class="bg-red-50 p-4 rounded-md border border-red-200">
                    <h4 class="text-md font-medium text-red-700 mb-2">
                      Delete Account
                    </h4>
                    <p class="text-sm text-red-600 mb-4">
                      This action is permanent and cannot be undone. All your
                      data, including recipes, reviews, and comments will be
                      permanently deleted.
                    </p>
                    <button
                      @click="showDeleteConfirmation = true"
                      class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
                    >
                      Delete My Account
                    </button>
                    <!-- Delete Confirmation Modal -->
                    <div
                      v-if="showDeleteConfirmation"
                      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                    >
                      <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">
                          Confirm Account Deletion
                        </h3>
                        <p class="text-gray-600 mb-6">
                          Are you sure you want to delete your account? This
                          action cannot be undone and all your data will be
                          permanently lost.
                        </p>
                        <div class="mb-4">
                          <label
                            for="delete-confirmation"
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Type "DELETE" to confirm</label
                          >
                          <input
                            type="text"
                            id="delete-confirmation"
                            v-model="deleteConfirmation"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 text-sm"
                            placeholder="DELETE"
                          />
                        </div>
                        <div class="flex justify-end space-x-3">
                          <button
                            @click="showDeleteConfirmation = false"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
                          >
                            Cancel
                          </button>
                          <button
                            @click="deleteAccount"
                            :disabled="deleteConfirmation !== 'DELETE'"
                            :class="[
'px-4 py-2 text-white rounded-md text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button',
deleteConfirmation === 'DELETE' ? 'bg-red-600 hover:bg-red-700' : 'bg-red-300 cursor-not-allowed'
]"
                          >
                            Permanently Delete Account
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div
                    class="bg-amber-50 p-4 rounded-md border border-amber-200"
                  >
                    <h4 class="text-md font-medium text-amber-700 mb-2">
                      Export Your Data
                    </h4>
                    <p class="text-sm text-amber-600 mb-4">
                      Download a copy of all your data, including recipes,
                      reviews, and account information.
                    </p>
                    <button
                      class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-md text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
                    >
                      Export Data
                    </button>
                  </div>
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
  </div>
</template>

<script lang="ts" setup>
import { ref, computed, onMounted } from "vue";
// Logo URL
const logoUrl =
  "https://readdy.ai/api/search-image?query=minimalist%2520cooking%2520logo%2520with%2520a%2520chef%2520hat%2520and%2520spoon%252C%2520clean%2520design%252C%2520professional%252C%2520modern%252C%2520flat%2520design%252C%2520vector%2520style%252C%2520green%2520color%2520scheme%252C%2520suitable%2520for%2520a%2520cooking%2520app&width=200&height=200&seq=1&orientation=squarish";
// Profile Cover Image
const profileCoverImage =
  "https://readdy.ai/api/search-image?query=beautiful%2520kitchen%2520background%2520with%2520soft%2520natural%2520lighting%252C%2520cooking%2520ingredients%2520artfully%2520arranged%2520on%2520a%2520wooden%2520table%252C%2520herbs%2520and%2520spices%2520visible%252C%2520blurred%2520background%2520with%2520kitchen%2520elements%252C%2520warm%2520inviting%2520atmosphere%252C%2520professional%2520food%2520photography%2520style%252C%2520high%2520resolution%2520panoramic%2520image&width=1200&height=400&seq=2&orientation=landscape";
// Authentication State
const isAuthenticated = ref(true);
const isAdmin = ref(false);
const currentUser = ref({
  id: 1,
  name: "John Doe",
  email: "john@example.com",
  avatar:
    "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520young%2520man%2520with%2520short%2520brown%2520hair%2520and%2520friendly%2520smile%252C%2520neutral%2520background%252C%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=3&orientation=squarish",
});
// UI State
const isMobileMenuOpen = ref(false);
const showUserMenu = ref(false);
const showNotifications = ref(false);
const searchQuery = ref("");
const isEditMode = ref(false);
const activeTab = ref("personal");
const fileInput = ref<HTMLInputElement | null>(null);
const favoriteViewMode = ref("grid");
const favoriteSearchQuery = ref("");
const favoriteCategoryFilter = ref("all");
const recipeSearchQuery = ref("");
const recipeSortOption = ref("newest");
const recipeStatusFilter = ref("all");
const reviewSortOption = ref("newest");
const activeSettingsSection = ref("account");
const showDeleteConfirmation = ref(false);
const deleteConfirmation = ref("");
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
// Profile Tabs
const profileTabs = [
  { id: "personal", name: "Personal Info", icon: "fas fa-user" },
  { id: "recipes", name: "My Recipes", icon: "fas fa-utensils" },
  { id: "favorites", name: "Favorites", icon: "fas fa-heart" },
  { id: "reviews", name: "Reviews", icon: "fas fa-star" },
  { id: "settings", name: "Settings", icon: "fas fa-cog" },
];
// Settings Sections
const settingsSections = [
  { id: "account", name: "Account", icon: "fas fa-user-circle" },
  { id: "privacy", name: "Privacy", icon: "fas fa-shield-alt" },
  { id: "notifications", name: "Notifications", icon: "fas fa-bell" },
  { id: "danger", name: "Danger Zone", icon: "fas fa-exclamation-triangle" },
];
// User Data
const userData = ref({
  id: 1,
  name: "John Doe",
  username: "johndoe",
  email: "john@example.com",
  location: "San Francisco, CA",
  bio: "Passionate home cook with a love for Italian cuisine and baking. I enjoy experimenting with new flavors and sharing my culinary adventures with the community. Follow me for simple, delicious recipes that anyone can make!",
  avatar:
    "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520young%2520man%2520with%2520short%2520brown%2520hair%2520and%2520friendly%2520smile%252C%2520neutral%2520background%252C%2520high%2520quality%2520portrait%2520photo&width=200&height=200&seq=4&orientation=squarish",
  joinDate: "June 2023",
  lastActive: "Today",
  stats: {
    recipes: 28,
    reviews: 42,
    favorites: 64,
    views: 12540,
    followers: 156,
    following: 89,
    avgRating: 4.7,
  },
});
// Edited User Data (for edit mode)
const editedUserData = ref({ ...userData.value });
// Recent Activity
const recentActivity = ref([
  {
    icon: "fas fa-utensils",
    text: "You published a new recipe: Lemon Garlic Butter Shrimp Pasta",
    time: "2 days ago",
    link: "#",
  },
  {
    icon: "fas fa-heart",
    text: "You favorited Spicy Thai Noodle Soup with Shrimp",
    time: "3 days ago",
    link: "https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/71985757-fc78-44cb-b477-8f5d692d152b",
  },
  {
    icon: "fas fa-star",
    text: "You gave a 5-star review to Classic Tiramisu",
    time: "5 days ago",
    link: "#",
  },
  {
    icon: "fas fa-comment",
    text: "You commented on Homemade Pizza Dough",
    time: "1 week ago",
    link: "#",
  },
  {
    icon: "fas fa-user-plus",
    text: "You started following Chef Emily Chen",
    time: "1 week ago",
    link: "#",
  },
]);
// User Recipes
const userRecipes = ref([
  {
    id: 1,
    title: "Lemon Garlic Butter Shrimp Pasta",
    image:
      "https://readdy.ai/api/search-image?query=lemon%2520garlic%2520butter%2520shrimp%2520pasta%2520with%2520fresh%2520herbs%2520on%2520a%2520white%2520plate%252C%2520creamy%2520sauce%2520visible%252C%2520garnished%2520with%2520parsley%2520and%2520lemon%2520wedges%252C%2520professional%2520food%2520photography%2520with%2520soft%2520natural%2520lighting%252C%2520high%2520resolution%252C%2520appetizing%2520presentation&width=600&height=400&seq=5&orientation=landscape",
    rating: 4.8,
    reviewCount: 32,
    cookingTime: 25,
    views: 1245,
    status: "published",
    isNew: true,
  },
  {
    id: 2,
    title: "Classic Homemade Margherita Pizza",
    image:
      "https://readdy.ai/api/search-image?query=homemade%2520margherita%2520pizza%2520with%2520fresh%2520basil%252C%2520mozzarella%2520and%2520tomatoes%2520on%2520a%2520wooden%2520board%252C%2520rustic%2520style%252C%2520professional%2520food%2520photography%2520with%2520soft%2520natural%2520lighting%252C%2520high%2520resolution%252C%2520appetizing%2520presentation&width=600&height=400&seq=6&orientation=landscape",
    rating: 4.6,
    reviewCount: 18,
    cookingTime: 40,
    views: 876,
    status: "published",
    isNew: false,
  },
  {
    id: 3,
    title: "Chocolate Lava Cake with Vanilla Ice Cream",
    image:
      "https://readdy.ai/api/search-image?query=chocolate%2520lava%2520cake%2520with%2520melting%2520center%2520and%2520vanilla%2520ice%2520cream%2520on%2520a%2520dark%2520plate%252C%2520dusted%2520with%2520powdered%2520sugar%252C%2520professional%2520food%2520photography%2520with%2520dramatic%2520lighting%252C%2520high%2520resolution%252C%2520appetizing%2520presentation&width=600&height=400&seq=7&orientation=landscape",
    rating: 4.9,
    reviewCount: 27,
    cookingTime: 30,
    views: 1532,
    status: "published",
    isNew: false,
  },
  {
    id: 4,
    title: "Mediterranean Quinoa Salad (Draft)",
    image:
      "https://readdy.ai/api/search-image?query=mediterranean%2520quinoa%2520salad%2520with%2520cucumber%252C%2520tomatoes%252C%2520feta%2520cheese%252C%2520olives%2520and%2520herbs%2520in%2520a%2520white%2520bowl%252C%2520professional%2520food%2520photography%2520with%2520bright%2520natural%2520lighting%252C%2520high%2520resolution%252C%2520appetizing%2520presentation&width=600&height=400&seq=8&orientation=landscape",
    rating: 0,
    reviewCount: 0,
    cookingTime: 20,
    views: 0,
    status: "draft",
    isNew: false,
  },
]);
// Favorite Recipes
const favoriteRecipes = ref([
  {
    id: 1,
    title: "Spicy Thai Noodle Soup with Shrimp",
    image:
      "https://readdy.ai/api/search-image?query=steaming%2520hot%2520spicy%2520thai%2520noodle%2520soup%2520with%2520shrimp%252C%2520fresh%2520herbs%252C%2520lime%252C%2520and%2520colorful%2520vegetables%2520in%2520a%2520beautiful%2520ceramic%2520bowl%2520on%2520a%2520dark%2520wooden%2520table%2520with%2520dramatic%2520lighting%252C%2520professional%2520food%2520photography%252C%2520high%2520resolution%252C%2520appetizing%2520presentation&width=600&height=400&seq=9&orientation=landscape",
    author: "Chef Emily Chen",
    authorAvatar:
      "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520female%2520asian%2520chef%2520with%2520shoulder%2520length%2520black%2520hair%2520and%2520friendly%2520smile%252C%2520neutral%2520background%252C%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=10&orientation=squarish",
    rating: 4.7,
    reviewCount: 156,
    cookingTime: 30,
    difficulty: "Medium",
    date: "June 1, 2025",
    description:
      "This Spicy Thai Noodle Soup with Shrimp is a flavor explosion in a bowl. The perfect balance of spicy, sour, sweet, and savory elements makes this soup irresistible.",
    tags: ["Thai", "Soup", "Seafood", "Spicy"],
  },
  {
    id: 2,
    title: "Classic Tiramisu",
    image:
      "https://readdy.ai/api/search-image?query=classic%2520tiramisu%2520in%2520a%2520glass%2520serving%2520dish%2520with%2520layers%2520of%2520mascarpone%2520cream%2520and%2520coffee-soaked%2520ladyfingers%252C%2520dusted%2520with%2520cocoa%2520powder%252C%2520professional%2520food%2520photography%2520with%2520soft%2520lighting%252C%2520high%2520resolution%252C%2520appetizing%2520presentation&width=600&height=400&seq=11&orientation=landscape",
    author: "Marco Rossi",
    authorAvatar:
      "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520an%2520italian%2520man%2520with%2520dark%2520hair%2520and%2520beard%252C%2520warm%2520smile%252C%2520neutral%2520background%252C%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=12&orientation=squarish",
    rating: 4.9,
    reviewCount: 87,
    cookingTime: 240,
    difficulty: "Medium",
    date: "May 15, 2025",
    description:
      "This authentic Italian tiramisu recipe features layers of coffee-soaked ladyfingers and creamy mascarpone filling. A classic dessert that's perfect for any occasion.",
    tags: ["Italian", "Dessert", "No-Bake", "Coffee"],
  },
  {
    id: 3,
    title: "Homemade Pizza Dough",
    image:
      "https://readdy.ai/api/search-image?query=homemade%2520pizza%2520dough%2520being%2520prepared%2520on%2520a%2520floured%2520wooden%2520surface%252C%2520hands%2520kneading%2520the%2520dough%252C%2520rustic%2520kitchen%2520setting%252C%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%252C%2520high%2520resolution%252C%2520process%2520shot&width=600&height=400&seq=13&orientation=landscape",
    author: "Sarah Johnson",
    authorAvatar:
      "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520young%2520woman%2520with%2520long%2520brown%2520hair%2520and%2520warm%2520smile%252C%2520natural%2520lighting%252C%2520neutral%2520background%252C%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=14&orientation=squarish",
    rating: 4.8,
    reviewCount: 124,
    cookingTime: 120,
    difficulty: "Easy",
    date: "May 10, 2025",
    description:
      "The perfect homemade pizza dough recipe that's easy to make and creates a chewy, crispy crust. Use it as a base for all your favorite pizza toppings.",
    tags: ["Italian", "Bread", "Basics", "Vegetarian"],
  },
]);
// User Reviews
const userReviews = ref([
  {
    recipeTitle: "Classic Tiramisu",
    recipeImage:
      "https://readdy.ai/api/search-image?query=classic%2520tiramisu%2520in%2520a%2520glass%2520serving%2520dish%2520with%2520layers%2520of%2520mascarpone%2520cream%2520and%2520coffee-soaked%2520ladyfingers%252C%2520dusted%2520with%2520cocoa%2520powder%252C%2520professional%2520food%2520photography%2520with%2520soft%2520lighting%252C%2520high%2520resolution%252C%2520appetizing%2520presentation&width=200&height=200&seq=15&orientation=squarish",
    rating: 5,
    date: "May 20, 2025",
    title: "Absolutely Incredible!",
    content:
      "This is the best tiramisu recipe I've ever tried! The instructions were clear and easy to follow, and the result was absolutely delicious. The balance of coffee and mascarpone was perfect, and it was a huge hit at my dinner party. Will definitely make again!",
    images: [
      "https://readdy.ai/api/search-image?query=homemade%2520tiramisu%2520on%2520a%2520dessert%2520plate%2520with%2520a%2520fork%252C%2520home%2520kitchen%2520setting%252C%2520natural%2520lighting%252C%2520amateur%2520food%2520photography%252C%2520authentic%2520home%2520cooking%2520result&width=200&height=200&seq=16&orientation=squarish",
    ],
    response: {
      author: "Marco Rossi",
      content:
        "Thank you so much for your kind review, John! I'm thrilled that you enjoyed the tiramisu and that it was a hit at your dinner party. It's always wonderful to hear when someone has success with one of my recipes!",
      date: "May 21, 2025",
    },
  },
  {
    recipeTitle: "Spicy Thai Noodle Soup with Shrimp",
    recipeImage:
      "https://readdy.ai/api/search-image?query=steaming%2520hot%2520spicy%2520thai%2520noodle%2520soup%2520with%2520shrimp%252C%2520fresh%2520herbs%252C%2520lime%252C%2520and%2520colorful%2520vegetables%2520in%2520a%2520beautiful%2520ceramic%2520bowl%252C%2520close-up%2520view%252C%2520professional%2520food%2520photography%252C%2520high%2520resolution%252C%2520appetizing%2520presentation&width=200&height=200&seq=17&orientation=squarish",
    rating: 4,
    date: "May 15, 2025",
    title: "Delicious but quite spicy!",
    content:
      "This soup has amazing flavor! I found it a bit too spicy as written, so I reduced the curry paste to 1 tbsp and it was perfect for my family. I also added some thinly sliced carrots for extra color and nutrition. Will definitely make again with these small adjustments.",
    images: [],
    response: null,
  },
  {
    recipeTitle: "Homemade Pizza Dough",
    recipeImage:
      "https://readdy.ai/api/search-image?query=homemade%2520pizza%2520dough%2520shaped%2520into%2520a%2520round%2520on%2520a%2520floured%2520wooden%2520surface%252C%2520ready%2520for%2520toppings%252C%2520professional%2520food%2520photography%2520with%2520natural%2520lighting%252C%2520high%2520resolution%252C%2520process%2520shot&width=200&height=200&seq=18&orientation=squarish",
    rating: 5,
    date: "May 5, 2025",
    title: "Never buying store-bought again!",
    content:
      "This pizza dough recipe is a game changer! So easy to make and the results are far better than anything store-bought. I let it rise overnight in the fridge as suggested in the notes and the flavor was incredible. My family now requests homemade pizza every weekend!",
    images: [
      "https://readdy.ai/api/search-image?query=homemade%2520pizza%2520with%2520various%2520toppings%2520on%2520a%2520wooden%2520pizza%2520peel%252C%2520just%2520baked%2520with%2520melted%2520cheese%252C%2520home%2520kitchen%2520setting%252C%2520natural%2520lighting%252C%2520amateur%2520food%2520photography%252C%2520authentic%2520home%2520cooking%2520result&width=200&height=200&seq=19&orientation=squarish",
    ],
    response: {
      author: "Sarah Johnson",
      content:
        "Thanks for the wonderful review, John! I'm so happy to hear that the overnight rise method worked well for you - it really does develop amazing flavor. Enjoy your weekend pizza traditions!",
      date: "May 6, 2025",
    },
  },
]);
// Settings Data
const settingsData = ref({
  email: "john@example.com",
  username: "johndoe",
  currentPassword: "",
  newPassword: "",
  confirmPassword: "",
  profileVisibility: "public",
  showInSearch: true,
  showActivity: true,
  allowTagging: true,
  emailNotifications: {
    comments: true,
    ratings: true,
    followers: true,
    digest: false,
  },
  pushNotifications: {
    comments: true,
    ratings: true,
    followers: true,
  },
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
const toggleEditMode = () => {
  if (isEditMode.value) {
    // Cancel edit mode
    cancelEdit();
  } else {
    // Enter edit mode
    editedUserData.value = { ...userData.value };
    isEditMode.value = true;
  }
};
const cancelEdit = () => {
  isEditMode.value = false;
  editedUserData.value = { ...userData.value };
};
const saveChanges = () => {
  // In a real app, this would send the data to the backend
  userData.value = { ...editedUserData.value };
  isEditMode.value = false;
  alert("Profile updated successfully!");
};
const openFileUpload = () => {
  if (fileInput.value) {
    fileInput.value.click();
  }
};
const handleProfilePictureChange = (event: Event) => {
  const target = event.target as HTMLInputElement;
  if (target.files && target.files.length > 0) {
    const file = target.files[0];
    // In a real app, this would upload the file to a server
    // For now, we'll just create a local URL
    const reader = new FileReader();
    reader.onload = (e) => {
      if (e.target && e.target.result) {
        userData.value.avatar = e.target.result as string;
        editedUserData.value.avatar = e.target.result as string;
      }
    };
    reader.readAsDataURL(file);
  }
};
const toggleFavorite = (recipe: any) => {
  // In a real app, this would update the backend
  // For now, we'll just remove it from the local array
  const index = favoriteRecipes.value.findIndex((r) => r.id === recipe.id);
  if (index !== -1) {
    favoriteRecipes.value.splice(index, 1);
  }
};
const deleteAccount = () => {
  if (deleteConfirmation.value === "DELETE") {
    // In a real app, this would send a request to delete the account
    alert("Account deleted successfully!");
    showDeleteConfirmation.value = false;
    // Redirect to home page or login page
  }
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
          "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520young%2520person%2520with%2520friendly%2520smile%252C%2520neutral%2520background%252C%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=20&orientation=squarish",
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
const openRegisterModal = () => {
  // This would open a registration modal
  alert("Registration modal would open here");
};
const logout = () => {
  isAuthenticated.value = false;
  showUserMenu.value = false;
};
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
/* Hide scrollbar for navigation */
.hide-scrollbar {
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}
.hide-scrollbar::-webkit-scrollbar {
  display: none; /* Chrome, Safari, Opera */
}
/* Line clamp for truncating text */
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
/* Toggle switch styling */
.toggle-checkbox {
  right: 0;
  z-index: 5;
  transition: all 0.3s;
}
.toggle-checkbox:checked {
  right: 0;
  transform: translateX(100%);
  border-color: #10b981;
}
.toggle-label {
  transition: background-color 0.3s;
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
