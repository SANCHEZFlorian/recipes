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
          <!-- Admin Settings Button (Desktop) -->
          <a
            v-if="isAdmin"
            href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/43e71165-096b-40be-8d15-7246ea575e8f"
            data-readdy="true"
            class="hidden md:flex items-center space-x-1 bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1.5 rounded-lg text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
          >
            <i class="fas fa-cogs"></i>
            <span>Admin Settings</span>
          </a>
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
                  href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/2b100150-41fb-4e0e-a800-4ea3fcbbe9f1"
                  data-readdy="true"
                  class="block px-4 py-2 text-sm text-emerald-600 font-medium hover:bg-gray-100 cursor-pointer"
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
            <!-- Admin Settings Button (Mobile) -->
            <button
              v-if="isAdmin"
              @click="openAdminSettings"
              class="flex items-center space-x-2 w-full py-2 px-4 text-gray-700 hover:bg-gray-100 border-b border-gray-100 cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fas fa-cogs"></i>
              <span>Admin Settings</span>
            </button>
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
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/2b100150-41fb-4e0e-a800-4ea3fcbbe9f1"
              data-readdy="true"
              class="block py-2 text-emerald-600 font-medium hover:text-emerald-700 border-b border-gray-100 cursor-pointer"
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
              href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/43e71165-096b-40be-8d15-7246ea575e8f"
              data-readdy="true"
              v-if="isAdmin"
              class="block py-2 text-gray-700 hover:text-emerald-600 border-b border-gray-100 cursor-pointer"
              >Admin Settings</a
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
      <!-- Page Header with Breadcrumb -->
      <div class="mb-8">
        <div
          class="flex flex-col md:flex-row md:items-center md:justify-between"
        >
          <div>
            <div class="flex items-center text-sm text-gray-500 mb-2">
              <a
                href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/97eba44a-c18e-463b-bfda-25d0acaee609"
                data-readdy="true"
                class="hover:text-emerald-600 cursor-pointer"
                >Home</a
              >
              <i class="fas fa-chevron-right mx-2 text-xs text-gray-400"></i>
              <a
                href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/2b100150-41fb-4e0e-a800-4ea3fcbbe9f1"
                data-readdy="true"
                class="text-emerald-600 font-medium cursor-pointer"
                >My Groups</a
              >
            </div>
            <h1 class="text-3xl font-bold text-gray-800">My Groups</h1>
            <p class="text-gray-600 mt-1">
              Manage your cooking communities and collaborations
            </p>
          </div>
          <div class="mt-4 md:mt-0">
            <button
              @click="showCreateGroupModal = true"
              class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium flex items-center shadow-sm cursor-pointer whitespace-nowrap !rounded-button"
            >
              <i class="fas fa-plus mr-2"></i>
              Create New Group
            </button>
          </div>
        </div>
      </div>
      <!-- Filters and Search -->
      <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
        <div class="flex flex-col md:flex-row md:items-center gap-4">
          <div class="relative flex-grow">
            <input
              type="text"
              v-model="groupSearchQuery"
              placeholder="Search your groups..."
              class="w-full pl-10 pr-4 py-2.5 rounded-lg border-gray-300 border focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
            />
            <i
              class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
            ></i>
          </div>
          <div class="flex flex-wrap items-center gap-4">
            <div class="flex items-center space-x-2">
              <span class="text-sm text-gray-600">Status:</span>
              <div class="flex bg-gray-100 rounded-lg p-1">
                <button
                  v-for="status in statusFilters"
                  :key="status.value"
                  @click="currentStatusFilter = status.value"
                  :class="[
'px-3 py-1.5 text-sm rounded-md cursor-pointer whitespace-nowrap !rounded-button',
currentStatusFilter === status.value ? 'bg-white text-emerald-600 shadow-sm font-medium' : 'text-gray-600 hover:text-gray-800'
]"
                >
                  {{ status.label }}
                </button>
              </div>
            </div>
            <div class="flex items-center space-x-2">
              <span class="text-sm text-gray-600">Sort by:</span>
              <select
                v-model="sortOption"
                class="border border-gray-300 rounded-lg text-sm p-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white"
              >
                <option value="recent">Most Recent</option>
                <option value="alphabetical">Alphabetical</option>
                <option value="members">Most Members</option>
                <option value="active">Most Active</option>
              </select>
            </div>
            <div class="flex items-center space-x-2">
              <span class="text-sm text-gray-600">View:</span>
              <div class="flex bg-gray-100 rounded-lg p-1">
                <button
                  @click="viewMode = 'grid'"
                  :class="[
'p-2 rounded-md cursor-pointer whitespace-nowrap !rounded-button',
viewMode === 'grid' ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-600 hover:text-gray-800'
]"
                >
                  <i class="fas fa-th-large"></i>
                </button>
                <button
                  @click="viewMode = 'list'"
                  :class="[
'p-2 rounded-md cursor-pointer whitespace-nowrap !rounded-button',
viewMode === 'list' ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-600 hover:text-gray-800'
]"
                >
                  <i class="fas fa-list"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Groups Display -->
      <!-- Grid View -->
      <div
        v-if="viewMode === 'grid'"
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
      >
        <div
          v-for="group in filteredGroups"
          :key="group.id"
          class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 group"
        >
          <div class="relative h-48 overflow-hidden">
            <img
              :src="group.coverImage"
              :alt="group.name"
              class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105"
            />
            <div
              class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"
            ></div>
            <div class="absolute bottom-0 left-0 right-0 p-4">
              <div class="flex justify-between items-end">
                <div>
                  <span
                    :class="[
'inline-block px-2 py-1 rounded-full text-xs font-medium mb-2',
group.type === 'public' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'
]"
                  >
                    {{ group.type === 'public' ? 'Public' : 'Private' }}
                  </span>
                  <h3 class="text-lg font-bold text-white">{{ group.name }}</h3>
                </div>
                <div class="flex space-x-2">
                  <div class="relative">
                    <button
                      @click="toggleGroupSettings(group.id)"
                      class="bg-white/90 hover:bg-white p-1.5 rounded-full text-gray-700 hover:text-gray-900 transition-colors cursor-pointer whitespace-nowrap !rounded-button"
                    >
                      <i class="fas fa-cog"></i>
                    </button>
                    <div
                      v-if="activeGroupSettings === group.id"
                      class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg py-1 z-50"
                    >
                      <a
                        href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                      >
                        <i class="fas fa-sliders-h mr-2"></i> Group Settings
                      </a>
                      <a
                        href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                      >
                        <i class="fas fa-users mr-2"></i> Manage Members
                      </a>
                      <a
                        href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                      >
                        <i class="fas fa-bell mr-2"></i> Notification
                        Preferences
                      </a>
                      <template
                        v-if="group.role === 'admin' || group.role === 'owner'"
                      >
                        <div class="border-t border-gray-100 my-1"></div>
                        <a
                          href="#"
                          @click.prevent="openInviteMembersModal(group)"
                          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                        >
                          <i class="fas fa-user-plus mr-2"></i> Invite Members
                        </a>
                        <a
                          href="#"
                          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                        >
                          <i class="fas fa-lock mr-2"></i> Group Privacy
                          Settings
                        </a>
                      </template>
                      <div class="border-t border-gray-100 my-1"></div>
                      <a
                        href="#"
                        class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 cursor-pointer"
                      >
                        <i class="fas fa-sign-out-alt mr-2"></i> Leave Group
                      </a>
                    </div>
                  </div>
                  <button
                    v-if="group.role === 'owner' || group.role === 'admin'"
                    @click="openEditModal(group)"
                    class="bg-white/90 hover:bg-white p-1.5 rounded-full text-gray-700 hover:text-gray-900 transition-colors cursor-pointer whitespace-nowrap !rounded-button"
                  >
                    <i class="fas fa-edit"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="p-4">
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-center">
                <i class="fas fa-users text-emerald-500 mr-2"></i>
                <span class="text-sm text-gray-600"
                  >{{ group.memberCount }} members</span
                >
              </div>
              <span
                :class="[
'text-xs font-medium px-2 py-1 rounded-full',
group.role === 'owner' ? 'bg-purple-100 text-purple-700' :
group.role === 'admin' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700'
]"
              >
                {{ group.role.charAt(0).toUpperCase() + group.role.slice(1) }}
              </span>
            </div>
            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
              {{ group.description }}
            </p>
            <div
              class="flex items-center justify-between text-sm text-gray-500"
            >
              <div class="flex items-center">
                <i class="far fa-calendar-alt mr-1"></i>
                <span>{{ group.lastActivity }}</span>
              </div>
              <a
                href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/2b100150-41fb-4e0e-a800-4ea3fcbbe9f1"
                data-readdy="true"
                class="text-emerald-600 hover:text-emerald-700 font-medium cursor-pointer"
                >View</a
              >
            </div>
          </div>
        </div>
      </div>
      <!-- List View -->
      <div v-if="viewMode === 'list'" class="space-y-4">
        <div
          v-for="group in filteredGroups"
          :key="group.id"
          class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300"
        >
          <div class="flex flex-col sm:flex-row">
            <div class="sm:w-64 h-48 sm:h-auto relative overflow-hidden">
              <img
                :src="group.coverImage"
                :alt="group.name"
                class="w-full h-full object-cover object-top"
              />
              <div
                class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent sm:bg-gradient-to-r"
              ></div>
              <div class="absolute bottom-0 left-0 right-0 p-3 sm:hidden">
                <span
                  :class="[
'inline-block px-2 py-1 rounded-full text-xs font-medium',
group.type === 'public' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'
]"
                >
                  {{ group.type === 'public' ? 'Public' : 'Private' }}
                </span>
              </div>
            </div>
            <div class="p-4 flex-1">
              <div
                class="flex flex-col sm:flex-row sm:items-start sm:justify-between"
              >
                <div>
                  <div class="flex items-center mb-2">
                    <h3 class="text-xl font-bold text-gray-800 mr-3">
                      {{ group.name }}
                    </h3>
                    <span
                      :class="[
'hidden sm:inline-block px-2 py-1 rounded-full text-xs font-medium',
group.type === 'public' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'
]"
                    >
                      {{ group.type === 'public' ? 'Public' : 'Private' }}
                    </span>
                  </div>
                  <div class="flex items-center mb-3">
                    <i class="fas fa-users text-emerald-500 mr-2"></i>
                    <span class="text-sm text-gray-600 mr-4"
                      >{{ group.memberCount }} members</span
                    >
                    <span
                      :class="[
'text-xs font-medium px-2 py-1 rounded-full',
group.role === 'owner' ? 'bg-purple-100 text-purple-700' :
group.role === 'admin' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700'
]"
                    >
                      {{ group.role.charAt(0).toUpperCase() +
                      group.role.slice(1) }}
                    </span>
                  </div>
                </div>
                <div class="flex space-x-2 mt-2 sm:mt-0">
                  <button
                    class="text-gray-600 hover:text-gray-800 p-1.5 rounded-md hover:bg-gray-100 cursor-pointer whitespace-nowrap !rounded-button"
                  >
                    <i class="fas fa-cog"></i>
                  </button>
                  <button
                    v-if="group.role === 'owner' || group.role === 'admin'"
                    class="text-gray-600 hover:text-gray-800 p-1.5 rounded-md hover:bg-gray-100 cursor-pointer whitespace-nowrap !rounded-button"
                  >
                    <i class="fas fa-edit"></i>
                  </button>
                </div>
              </div>
              <p class="text-gray-600 text-sm mb-4">{{ group.description }}</p>
              <div class="flex flex-wrap gap-2 mb-4">
                <span
                  v-for="(tag, idx) in group.tags"
                  :key="idx"
                  class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-xs"
                >
                  {{ tag }}
                </span>
              </div>
              <div class="flex items-center justify-between text-sm">
                <div class="flex space-x-4">
                  <div class="flex items-center text-gray-500">
                    <i class="far fa-calendar-alt mr-1"></i>
                    <span>{{ group.lastActivity }}</span>
                  </div>
                  <div class="flex items-center text-gray-500">
                    <i class="fas fa-utensils mr-1"></i>
                    <span>{{ group.recipeCount }} recipes</span>
                  </div>
                  <div class="flex items-center text-gray-500">
                    <i class="far fa-calendar mr-1"></i>
                    <span>{{ group.upcomingEvents }} upcoming events</span>
                  </div>
                </div>
                <a
                  href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/2b100150-41fb-4e0e-a800-4ea3fcbbe9f1"
                  data-readdy="true"
                  class="text-emerald-600 hover:text-emerald-700 font-medium cursor-pointer"
                  >View Group</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Empty State -->
      <div
        v-if="filteredGroups.length === 0"
        class="bg-white rounded-lg shadow-sm p-8 text-center"
      >
        <div
          class="h-24 w-24 mx-auto mb-6 rounded-full bg-emerald-100 flex items-center justify-center"
        >
          <i class="fas fa-users text-emerald-600 text-3xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">
          No groups found
        </h3>
        <p class="text-gray-600 mb-6 max-w-md mx-auto">
          {{ userGroups.length === 0 ? "You haven't joined any cooking groups
          yet. Create your own group or browse existing ones to connect with
          other food enthusiasts!" : "No groups match your current filters. Try
          adjusting your search criteria." }}
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
          <button
            @click="showCreateGroupModal = true"
            class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
          >
            <i class="fas fa-plus mr-2"></i>
            Create New Group
          </button>
          <button
            @click="showBrowseGroupsModal = true"
            class="bg-white border border-emerald-600 text-emerald-600 hover:bg-emerald-50 px-5 py-2.5 rounded-lg text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
          >
            <i class="fas fa-search mr-2"></i>
            Browse Groups
          </button>
        </div>
      </div>
      <!-- Suggested Groups Section -->
      <div v-if="userGroups.length > 0" class="mt-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Suggested Groups</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="group in suggestedGroups"
            :key="group.id"
            class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 group"
          >
            <div class="relative h-48 overflow-hidden">
              <img
                :src="group.coverImage"
                :alt="group.name"
                class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105"
              />
              <div
                class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"
              ></div>
              <div class="absolute bottom-0 left-0 right-0 p-4">
                <div class="flex justify-between items-end">
                  <div>
                    <span
                      class="inline-block px-2 py-1 rounded-full text-xs font-medium mb-2 bg-emerald-100 text-emerald-700"
                    >
                      {{ group.type === 'public' ? 'Public' : 'Private' }}
                    </span>
                    <h3 class="text-lg font-bold text-white">
                      {{ group.name }}
                    </h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="p-4">
              <div class="flex items-center mb-3">
                <i class="fas fa-users text-emerald-500 mr-2"></i>
                <span class="text-sm text-gray-600"
                  >{{ group.memberCount }} members</span
                >
              </div>
              <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                {{ group.description }}
              </p>
              <div class="flex flex-wrap gap-2 mb-4">
                <span
                  v-for="(tag, idx) in group.tags.slice(0, 3)"
                  :key="idx"
                  class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-xs"
                >
                  {{ tag }}
                </span>
              </div>
              <button
                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2 rounded-lg text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
              >
                Join Group
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Recent Activity Section -->
      <div v-if="userGroups.length > 0" class="mt-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
          Recent Group Activity
        </h2>
        <div class="bg-white rounded-lg shadow-sm p-6">
          <div class="space-y-6">
            <div
              v-for="(activity, index) in groupActivities"
              :key="index"
              class="flex"
            >
              <div class="flex-shrink-0 mr-4">
                <img
                  :src="activity.userAvatar"
                  alt="User"
                  class="h-10 w-10 rounded-full object-cover"
                />
              </div>
              <div class="flex-1">
                <div
                  class="flex flex-col sm:flex-row sm:justify-between sm:items-start"
                >
                  <div>
                    <p class="text-gray-800">
                      <span class="font-medium">{{ activity.userName }}</span>
                      {{ activity.action }}
                      <span class="text-emerald-600"
                        >{{ activity.groupName }}</span
                      >
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                      {{ activity.time }}
                    </p>
                  </div>
                  <a
                    href="https://readdy.ai/home/a1c8fb84-7142-4eb7-b429-6f756f61dbf6/2b100150-41fb-4e0e-a800-4ea3fcbbe9f1"
                    data-readdy="true"
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
      <!-- Upcoming Events Section -->
      <div v-if="userGroups.length > 0" class="mt-12 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
          Upcoming Group Events
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="event in upcomingEvents"
            :key="event.id"
            class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300"
          >
            <div class="relative">
              <img
                :src="event.image"
                :alt="event.title"
                class="w-full h-40 object-cover object-top"
              />
              <div
                class="absolute top-0 left-0 bg-emerald-600 text-white px-3 py-1.5 rounded-br-lg"
              >
                <div class="text-center">
                  <span class="block text-sm font-bold"
                    >{{ event.date.split(' ')[1] }}</span
                  >
                  <span class="block text-xs"
                    >{{ event.date.split(' ')[0] }}</span
                  >
                </div>
              </div>
            </div>
            <div class="p-4">
              <div class="flex items-center text-xs text-gray-500 mb-2">
                <i class="fas fa-users mr-1"></i>
                <span>{{ event.groupName }}</span>
                <span class="mx-2">•</span>
                <i class="far fa-clock mr-1"></i>
                <span>{{ event.time }}</span>
              </div>
              <h3 class="text-lg font-bold text-gray-800 mb-2">
                {{ event.title }}
              </h3>
              <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                {{ event.description }}
              </p>
              <div class="flex items-center justify-between">
                <div class="flex -space-x-2">
                  <img
                    v-for="(attendee, idx) in event.attendees.slice(0, 3)"
                    :key="idx"
                    :src="attendee.avatar"
                    :alt="attendee.name"
                    class="h-8 w-8 rounded-full border-2 border-white object-cover"
                  />
                  <div
                    v-if="event.attendees.length > 3"
                    class="h-8 w-8 rounded-full bg-gray-200 border-2 border-white flex items-center justify-center text-xs text-gray-600 font-medium"
                  >
                    +{{ event.attendees.length - 3 }}
                  </div>
                </div>
                <button
                  class="text-emerald-600 hover:text-emerald-700 text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
                >
                  RSVP
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Create Group Modal -->
    <div
      v-if="showCreateGroupModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
    >
      <div
        class="bg-white rounded-lg w-full max-w-2xl mx-auto relative"
        @click.stop
      >
        <button
          @click="showCreateGroupModal = false"
          class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 cursor-pointer whitespace-nowrap !rounded-button"
        >
          <i class="fas fa-times"></i>
        </button>
        <div class="p-6">
          <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Create New Group
          </h2>
          <form @submit.prevent="createGroup">
            <div class="space-y-6">
              <div>
                <label
                  for="group-name"
                  class="block text-sm font-medium text-gray-700 mb-2"
                  >Group Name*</label
                >
                <input
                  type="text"
                  id="group-name"
                  v-model="newGroup.name"
                  class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                  required
                />
              </div>
              <div>
                <label
                  for="group-description"
                  class="block text-sm font-medium text-gray-700 mb-2"
                  >Description*</label
                >
                <textarea
                  id="group-description"
                  v-model="newGroup.description"
                  rows="4"
                  class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                  required
                ></textarea>
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label
                    for="group-type"
                    class="block text-sm font-medium text-gray-700 mb-2"
                    >Privacy Setting*</label
                  >
                  <div class="space-y-2">
                    <div class="flex items-center">
                      <input
                        type="radio"
                        id="type-public"
                        v-model="newGroup.type"
                        value="public"
                        class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300"
                      />
                      <label
                        for="type-public"
                        class="ml-3 text-sm text-gray-700"
                      >
                        <span class="font-medium">Public</span>
                        <p class="text-gray-500">
                          Anyone can see and join the group
                        </p>
                      </label>
                    </div>
                    <div class="flex items-center">
                      <input
                        type="radio"
                        id="type-private"
                        v-model="newGroup.type"
                        value="private"
                        class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300"
                      />
                      <label
                        for="type-private"
                        class="ml-3 text-sm text-gray-700"
                      >
                        <span class="font-medium">Private</span>
                        <p class="text-gray-500">
                          Only members can see content, requires approval to
                          join
                        </p>
                      </label>
                    </div>
                  </div>
                </div>
                <div>
                  <label
                    for="group-tags"
                    class="block text-sm font-medium text-gray-700 mb-2"
                    >Tags (comma separated)</label
                  >
                  <input
                    type="text"
                    id="group-tags"
                    v-model="newGroup.tags"
                    placeholder="Italian, Baking, Vegetarian"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                  />
                </div>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2"
                  >Group Cover Image</label
                >
                <div
                  class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center"
                >
                  <div v-if="newGroup.coverImage" class="mb-4">
                    <img
                      :src="newGroup.coverImage"
                      alt="Cover preview"
                      class="h-40 mx-auto object-cover rounded-lg"
                    />
                  </div>
                  <div class="space-y-2">
                    <button
                      type="button"
                      class="text-emerald-600 hover:text-emerald-700 text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
                    >
                      <i class="fas fa-upload mr-1"></i> Upload Image
                    </button>
                    <p class="text-xs text-gray-500">
                      Recommended size: 1200 x 400 pixels
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex justify-end mt-8 space-x-3">
              <button
                type="button"
                @click="showCreateGroupModal = false"
                class="px-4 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
              >
                Cancel
              </button>
              <button
                type="submit"
                class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
              >
                Create Group
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Edit Group Modal -->
    <div
      v-if="showEditGroupModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
    >
      <div
        class="bg-white rounded-lg w-full max-w-2xl mx-auto relative"
        @click.stop
      >
        <button
          @click="showEditGroupModal = false"
          class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 cursor-pointer whitespace-nowrap !rounded-button"
        >
          <i class="fas fa-times"></i>
        </button>
        <div class="p-6">
          <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Group</h2>
          <form @submit.prevent="saveGroupChanges">
            <div class="space-y-6">
              <div>
                <label
                  for="edit-group-name"
                  class="block text-sm font-medium text-gray-700 mb-2"
                  >Group Name*</label
                >
                <input
                  type="text"
                  id="edit-group-name"
                  v-model="editingGroup.name"
                  class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                  required
                />
              </div>
              <div>
                <label
                  for="edit-group-description"
                  class="block text-sm font-medium text-gray-700 mb-2"
                  >Description*</label
                >
                <textarea
                  id="edit-group-description"
                  v-model="editingGroup.description"
                  rows="4"
                  class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                  required
                ></textarea>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2"
                  >Privacy Setting*</label
                >
                <div class="space-y-2">
                  <div class="flex items-center">
                    <input
                      type="radio"
                      id="edit-type-public"
                      v-model="editingGroup.type"
                      value="public"
                      class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300"
                    />
                    <label
                      for="edit-type-public"
                      class="ml-3 text-sm text-gray-700"
                    >
                      <span class="font-medium">Public</span>
                      <p class="text-gray-500">
                        Anyone can see and join the group
                      </p>
                    </label>
                  </div>
                  <div class="flex items-center">
                    <input
                      type="radio"
                      id="edit-type-private"
                      v-model="editingGroup.type"
                      value="private"
                      class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300"
                    />
                    <label
                      for="edit-type-private"
                      class="ml-3 text-sm text-gray-700"
                    >
                      <span class="font-medium">Private</span>
                      <p class="text-gray-500">
                        Only members can see content, requires approval to join
                      </p>
                    </label>
                  </div>
                </div>
              </div>
              <div>
                <label
                  for="edit-group-tags"
                  class="block text-sm font-medium text-gray-700 mb-2"
                  >Tags (comma separated)</label
                >
                <input
                  type="text"
                  id="edit-group-tags"
                  v-model="editingGroup.tags"
                  placeholder="Italian, Baking, Vegetarian"
                  class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
                />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2"
                  >Group Cover Image</label
                >
                <div
                  class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center"
                >
                  <div v-if="editingGroup.coverImage" class="mb-4">
                    <img
                      :src="editingGroup.coverImage"
                      alt="Cover preview"
                      class="h-40 mx-auto object-cover rounded-lg"
                    />
                  </div>
                  <div class="space-y-2">
                    <button
                      type="button"
                      class="text-emerald-600 hover:text-emerald-700 text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
                    >
                      <i class="fas fa-upload mr-1"></i> Upload Image
                    </button>
                    <p class="text-xs text-gray-500">
                      Recommended size: 1200 x 400 pixels
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex justify-end mt-8 space-x-3">
              <button
                type="button"
                @click="showEditGroupModal = false"
                class="px-4 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
              >
                Cancel
              </button>
              <button
                type="submit"
                class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
              >
                Save Changes
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Invite Members Modal -->
    <div
      v-if="showInviteMembersModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
    >
      <div
        class="bg-white rounded-lg w-full max-w-2xl mx-auto relative"
        @click.stop
      >
        <button
          @click="showInviteMembersModal = false"
          class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 cursor-pointer whitespace-nowrap !rounded-button"
        >
          <i class="fas fa-times"></i>
        </button>
        <div class="p-6">
          <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Invite Members to {{ selectedGroup?.name }}
          </h2>
          <div class="mb-6">
            <div class="relative">
              <input
                type="text"
                v-model="inviteSearchQuery"
                placeholder="Search users to invite..."
                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
              />
              <i
                class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
              ></i>
            </div>
          </div>
          <div
            class="max-h-96 overflow-y-auto border border-gray-200 rounded-lg mb-6"
          >
            <div
              v-for="user in filteredUsers"
              :key="user.id"
              class="flex items-center p-4 border-b border-gray-200 last:border-0"
            >
              <input
                type="checkbox"
                :id="'user-' + user.id"
                v-model="selectedUsers"
                :value="user.id"
                class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded"
              />
              <label
                :for="'user-' + user.id"
                class="flex items-center ml-3 cursor-pointer flex-1"
              >
                <img
                  :src="user.avatar"
                  :alt="user.name"
                  class="h-10 w-10 rounded-full object-cover"
                />
                <div class="ml-3">
                  <p class="text-sm font-medium text-gray-800">
                    {{ user.name }}
                  </p>
                  <p class="text-xs text-gray-500">{{ user.email }}</p>
                </div>
              </label>
            </div>
          </div>
          <div class="flex justify-between items-center">
            <p class="text-sm text-gray-600">
              {{ selectedUsers.length }} users selected
            </p>
            <div class="flex space-x-3">
              <button
                @click="showInviteMembersModal = false"
                class="px-4 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
              >
                Cancel
              </button>
              <button
                @click="sendInvites"
                :disabled="selectedUsers.length === 0"
                :class="[
'px-4 py-2.5 rounded-lg text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button',
selectedUsers.length === 0
? 'bg-gray-300 text-gray-500 cursor-not-allowed'
: 'bg-emerald-600 hover:bg-emerald-700 text-white'
]"
              >
                Send Invites
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Browse Groups Modal -->
    <div
      v-if="showBrowseGroupsModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
    >
      <div
        class="bg-white rounded-lg w-full max-w-4xl mx-auto relative"
        @click.stop
      >
        <button
          @click="showBrowseGroupsModal = false"
          class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 cursor-pointer whitespace-nowrap !rounded-button"
        >
          <i class="fas fa-times"></i>
        </button>
        <div class="p-6">
          <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Browse Cooking Groups
          </h2>
          <div class="mb-6">
            <div class="relative">
              <input
                type="text"
                v-model="browseSearchQuery"
                placeholder="Search for cooking groups..."
                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"
              />
              <i
                class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
              ></i>
            </div>
          </div>
          <div class="flex flex-wrap gap-2 mb-6">
            <button
              v-for="category in groupCategories"
              :key="category"
              @click="toggleCategoryFilter(category)"
              :class="[
'px-3 py-1.5 rounded-full text-sm cursor-pointer whitespace-nowrap !rounded-button',
selectedCategories.includes(category)
? 'bg-emerald-100 text-emerald-700 border border-emerald-200'
: 'bg-gray-100 text-gray-700 hover:bg-gray-200 border border-transparent'
]"
            >
              {{ category }}
            </button>
          </div>
          <div class="max-h-96 overflow-y-auto">
            <div
              v-for="group in browsableGroups"
              :key="group.id"
              class="flex items-center p-4 border-b border-gray-200 last:border-0"
            >
              <img
                :src="group.coverImage"
                :alt="group.name"
                class="h-16 w-16 rounded-lg object-cover mr-4"
              />
              <div class="flex-1">
                <div class="flex items-center">
                  <h3 class="font-bold text-gray-800">{{ group.name }}</h3>
                  <span
                    :class="[
'ml-2 inline-block px-2 py-0.5 rounded-full text-xs font-medium',
group.type === 'public' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'
]"
                  >
                    {{ group.type === 'public' ? 'Public' : 'Private' }}
                  </span>
                </div>
                <div class="flex items-center text-xs text-gray-500 mt-1">
                  <span>{{ group.memberCount }} members</span>
                  <span class="mx-1">•</span>
                  <span>{{ group.recipeCount }} recipes</span>
                </div>
                <p class="text-sm text-gray-600 mt-1 line-clamp-1">
                  {{ group.description }}
                </p>
              </div>
              <button
                class="ml-4 px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
              >
                Join
              </button>
            </div>
          </div>
          <div class="mt-6 text-center">
            <button
              class="text-emerald-600 hover:text-emerald-700 text-sm font-medium cursor-pointer whitespace-nowrap !rounded-button"
            >
              Load More Groups
            </button>
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
  "https://readdy.ai/api/search-image?query=minimalist%2520cooking%2520logo%2520with%2520a%2520chef%2520hat%2520and%2520spoon%2520clean%2520design%2520professional%2520modern%2520flat%2520design%2520vector%2520style%2520green%2520color%2520scheme%2520suitable%2520for%2520a%2520cooking%2520app&width=200&height=200&seq=1&orientation=squarish";
// Authentication State
const isAuthenticated = ref(true);
const isAdmin = ref(true);
const currentUser = ref({
  id: 1,
  name: "John Doe",
  email: "john@example.com",
  avatar:
    "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520young%2520man%2520with%2520short%2520brown%2520hair%2520and%2520friendly%2520smile%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=3&orientation=squarish",
});
// UI State
const isMobileMenuOpen = ref(false);
const showUserMenu = ref(false);
const showNotifications = ref(false);
const activeGroupSettings = ref<number | null>(null);
const searchQuery = ref("");
const groupSearchQuery = ref("");
const viewMode = ref("grid");
const currentStatusFilter = ref("all");
const sortOption = ref("recent");
const showCreateGroupModal = ref(false);
const showEditGroupModal = ref(false);
const showBrowseGroupsModal = ref(false);
const showInviteMembersModal = ref(false);
const browseSearchQuery = ref("");
const selectedCategories = ref<string[]>([]);
const inviteSearchQuery = ref("");
const selectedUsers = ref<number[]>([]);
const selectedGroup = ref<any>(null);
// Available users for invites
const availableUsers = ref([
  {
    id: 1,
    name: "Sarah Johnson",
    email: "sarah.j@example.com",
    avatar:
      "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520young%2520woman%2520with%2520long%2520brown%2520hair%2520and%2520warm%2520smile%2520natural%2520lighting%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=51&orientation=squarish",
  },
  {
    id: 2,
    name: "Michael Chen",
    email: "m.chen@example.com",
    avatar:
      "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520middle%2520aged%2520man%2520with%2520glasses%2520and%2520friendly%2520expression%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=52&orientation=squarish",
  },
  {
    id: 3,
    name: "Emily Rodriguez",
    email: "emily.r@example.com",
    avatar:
      "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520young%2520woman%2520with%2520curly%2520hair%2520and%2520bright%2520smile%2520natural%2520lighting%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=53&orientation=squarish",
  },
  {
    id: 4,
    name: "David Kim",
    email: "d.kim@example.com",
    avatar:
      "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520young%2520asian%2520man%2520with%2520short%2520black%2520hair%2520and%2520friendly%2520smile%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=54&orientation=squarish",
  },
  {
    id: 5,
    name: "Lisa Wong",
    email: "l.wong@example.com",
    avatar:
      "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520middle%2520aged%2520asian%2520woman%2520with%2520shoulder%2520length%2520hair%2520and%2520warm%2520smile%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=55&orientation=squarish",
  },
]);
// Computed property for filtered users
const filteredUsers = computed(() => {
  if (!inviteSearchQuery.value) return availableUsers.value;
  const query = inviteSearchQuery.value.toLowerCase();
  return availableUsers.value.filter(
    (user) =>
      user.name.toLowerCase().includes(query) ||
      user.email.toLowerCase().includes(query),
  );
});
const editingGroup = ref({
  id: 0,
  name: "",
  description: "",
  type: "public",
  tags: "",
  coverImage: "",
});
// Notifications
const unreadNotifications = ref(3);
const notifications = ref([
  {
    id: 1,
    message: 'Sarah invited you to join "Baking Enthusiasts" group',
    time: "2 hours ago",
  },
  {
    id: 2,
    message: 'New recipe shared in "Italian Cuisine" group',
    time: "1 day ago",
  },
  {
    id: 3,
    message:
      'Upcoming event: Virtual Cooking Class in "Vegetarian Recipes" group',
    time: "3 days ago",
  },
]);
// Status Filters
const statusFilters = [
  { label: "All Groups", value: "all" },
  { label: "Active", value: "active" },
  { label: "Archived", value: "archived" },
];
// New Group Form
const newGroup = ref({
  name: "",
  description: "",
  type: "public",
  tags: "",
  coverImage:
    "https://readdy.ai/api/search-image?query=group%2520of%2520diverse%2520people%2520cooking%2520together%2520in%2520a%2520modern%2520kitchen%2520sharing%2520recipes%2520and%2520techniques%2520warm%2520lighting%2520collaborative%2520atmosphere%2520high%2520quality%2520lifestyle%2520photography%2520showing%2520community%2520and%2520friendship%2520through%2520food&width=800&height=400&seq=21&orientation=landscape",
});
// User Groups
const userGroups = ref([
  {
    id: 1,
    name: "Italian Cuisine Lovers",
    description:
      "A community dedicated to authentic Italian cooking techniques, recipes, and traditions. Share your favorite pasta dishes, pizza recipes, and more!",
    coverImage:
      "https://readdy.ai/api/search-image?query=italian%2520cuisine%2520ingredients%2520on%2520rustic%2520wooden%2520table%2520with%2520pasta%2520tomatoes%2520basil%2520olive%2520oil%2520parmesan%2520cheese%2520and%2520garlic%2520warm%2520mediterranean%2520lighting%2520authentic%2520food%2520photography%2520high%2520resolution%2520appetizing%2520presentation&width=800&height=400&seq=22&orientation=landscape",
    memberCount: 128,
    type: "public",
    role: "admin",
    lastActivity: "Today",
    recipeCount: 87,
    upcomingEvents: 2,
    tags: ["Italian", "Pasta", "Mediterranean", "Pizza"],
  },
  {
    id: 2,
    name: "Baking Enthusiasts",
    description:
      "For all baking lovers! Share your recipes for bread, cakes, pastries, and all things baked. Discuss techniques, troubleshoot problems, and showcase your creations.",
    coverImage:
      "https://readdy.ai/api/search-image?query=freshly%2520baked%2520bread%2520and%2520pastries%2520on%2520a%2520wooden%2520table%2520with%2520flour%2520rolling%2520pin%2520and%2520baking%2520ingredients%2520warm%2520cozy%2520bakery%2520atmosphere%2520soft%2520natural%2520lighting%2520high%2520resolution%2520appetizing%2520presentation%2520of%2520homemade%2520baked%2520goods&width=800&height=400&seq=23&orientation=landscape",
    memberCount: 256,
    type: "public",
    role: "member",
    lastActivity: "Yesterday",
    recipeCount: 143,
    upcomingEvents: 1,
    tags: ["Baking", "Bread", "Pastry", "Desserts"],
  },
  {
    id: 3,
    name: "Vegetarian Recipes",
    description:
      "A group for sharing delicious vegetarian and plant-based recipes. From quick weeknight meals to elaborate dinner party dishes, all vegetarian cooking welcome!",
    coverImage:
      "https://readdy.ai/api/search-image?query=colorful%2520vegetarian%2520food%2520spread%2520with%2520fresh%2520vegetables%2520legumes%2520grains%2520and%2520herbs%2520on%2520a%2520table%2520vibrant%2520healthy%2520meal%2520preparation%2520bright%2520natural%2520lighting%2520high%2520resolution%2520appetizing%2520presentation%2520of%2520plant%2520based%2520cuisine&width=800&height=400&seq=24&orientation=landscape",
    memberCount: 189,
    type: "public",
    role: "member",
    lastActivity: "2 days ago",
    recipeCount: 112,
    upcomingEvents: 0,
    tags: ["Vegetarian", "Plant-based", "Healthy", "Sustainable"],
  },
  {
    id: 4,
    name: "Family Meal Planning",
    description:
      "Planning and preparing meals for families. Share kid-friendly recipes, meal prep tips, and strategies for getting dinner on the table efficiently.",
    coverImage:
      "https://readdy.ai/api/search-image?query=family%2520gathered%2520around%2520dining%2520table%2520with%2520homemade%2520meal%2520parents%2520and%2520children%2520enjoying%2520dinner%2520together%2520warm%2520home%2520atmosphere%2520natural%2520lighting%2520high%2520resolution%2520lifestyle%2520photography%2520showing%2520family%2520mealtime%2520and%2520food%2520sharing&width=800&height=400&seq=25&orientation=landscape",
    memberCount: 142,
    type: "private",
    role: "owner",
    lastActivity: "3 days ago",
    recipeCount: 76,
    upcomingEvents: 1,
    tags: ["Family", "Meal Planning", "Kid-friendly", "Quick Meals"],
  },
  {
    id: 5,
    name: "Asian Fusion Cooking",
    description:
      "Explore the diverse flavors of Asian cuisine and creative fusion dishes. Share recipes that blend techniques and ingredients from different Asian culinary traditions.",
    coverImage:
      "https://readdy.ai/api/search-image?query=asian%2520fusion%2520dishes%2520with%2520colorful%2520ingredients%2520and%2520presentation%2520modern%2520take%2520on%2520traditional%2520asian%2520cuisine%2520vibrant%2520food%2520styling%2520professional%2520lighting%2520high%2520resolution%2520appetizing%2520presentation%2520of%2520sushi%2520noodles%2520and%2520stir%2520fry%2520dishes&width=800&height=400&seq=26&orientation=landscape",
    memberCount: 98,
    type: "public",
    role: "member",
    lastActivity: "1 week ago",
    recipeCount: 64,
    upcomingEvents: 0,
    tags: ["Asian", "Fusion", "International", "Spicy"],
  },
]);
// Suggested Groups
const suggestedGroups = ref([
  {
    id: 101,
    name: "Dessert Lovers",
    description:
      "For those with a sweet tooth! Share and discover recipes for cakes, cookies, ice creams, and all types of desserts from around the world.",
    coverImage:
      "https://readdy.ai/api/search-image?query=assortment%2520of%2520beautiful%2520desserts%2520on%2520elegant%2520display%2520cakes%2520pastries%2520chocolates%2520and%2520fruit%2520tarts%2520with%2520artistic%2520presentation%2520professional%2520patisserie%2520photography%2520with%2520soft%2520lighting%2520high%2520resolution%2520tempting%2520sweet%2520treats&width=800&height=400&seq=27&orientation=landscape",
    memberCount: 312,
    type: "public",
    tags: ["Desserts", "Baking", "Sweet", "Pastry"],
  },
  {
    id: 102,
    name: "Healthy Meal Prep",
    description:
      "Tips, recipes, and strategies for preparing healthy meals in advance. Focus on nutritious ingredients and efficient cooking methods.",
    coverImage:
      "https://readdy.ai/api/search-image?query=healthy%2520meal%2520prep%2520containers%2520with%2520balanced%2520portions%2520of%2520proteins%2520vegetables%2520and%2520grains%2520organized%2520food%2520preparation%2520for%2520the%2520week%2520bright%2520clean%2520photography%2520high%2520resolution%2520nutritious%2520and%2520colorful%2520prepared%2520meals&width=800&height=400&seq=28&orientation=landscape",
    memberCount: 278,
    type: "public",
    tags: ["Healthy", "Meal Prep", "Nutrition", "Fitness"],
  },
  {
    id: 103,
    name: "International Street Food",
    description:
      "Discover and share authentic street food recipes from around the world. From tacos to dumplings, explore the diverse flavors of global street cuisine.",
    coverImage:
      "https://readdy.ai/api/search-image?query=vibrant%2520international%2520street%2520food%2520market%2520with%2520diverse%2520food%2520stalls%2520serving%2520global%2520cuisines%2520colorful%2520authentic%2520dishes%2520from%2520around%2520the%2520world%2520atmospheric%2520market%2520lighting%2520high%2520resolution%2520appetizing%2520presentation%2520of%2520street%2520food%2520variety&width=800&height=400&seq=29&orientation=landscape",
    memberCount: 156,
    type: "public",
    tags: ["Street Food", "International", "Authentic", "Global"],
  },
]);
// Group Activities
const groupActivities = ref([
  {
    userAvatar:
      "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520young%2520woman%2520with%2520long%2520brown%2520hair%2520and%2520warm%2520smile%2520natural%2520lighting%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=30&orientation=squarish",
    userName: "Sarah Johnson",
    action: "shared a new recipe in",
    groupName: "Baking Enthusiasts",
    time: "2 hours ago",
  },
  {
    userAvatar:
      "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520middle%2520aged%2520man%2520with%2520glasses%2520and%2520friendly%2520expression%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=31&orientation=squarish",
    userName: "Michael Chen",
    action: "scheduled a new event in",
    groupName: "Italian Cuisine Lovers",
    time: "Yesterday",
  },
  {
    userAvatar:
      "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520young%2520woman%2520with%2520curly%2520hair%2520and%2520bright%2520smile%2520natural%2520lighting%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=32&orientation=squarish",
    userName: "Emily Rodriguez",
    action: "joined",
    groupName: "Vegetarian Recipes",
    time: "2 days ago",
  },
  {
    userAvatar: currentUser.value.avatar,
    userName: "You",
    action: "created a new discussion in",
    groupName: "Family Meal Planning",
    time: "3 days ago",
  },
]);
// Upcoming Events
const upcomingEvents = ref([
  {
    id: 201,
    title: "Virtual Italian Pasta Making Class",
    description:
      "Learn to make authentic Italian pasta from scratch with Chef Marco. We'll cover different pasta shapes and classic sauces.",
    image:
      "https://readdy.ai/api/search-image?query=hands%2520making%2520fresh%2520pasta%2520dough%2520on%2520a%2520floured%2520wooden%2520surface%2520traditional%2520italian%2520cooking%2520process%2520close%2520up%2520of%2520pasta%2520making%2520technique%2520natural%2520kitchen%2520lighting%2520high%2520resolution%2520authentic%2520culinary%2520process%2520shot&width=600&height=300&seq=33&orientation=landscape",
    date: "Jun 15",
    time: "6:00 PM - 8:00 PM",
    groupName: "Italian Cuisine Lovers",
    attendees: [
      { name: "John Doe", avatar: currentUser.value.avatar },
      {
        name: "Sarah Johnson",
        avatar:
          "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520young%2520woman%2520with%2520long%2520brown%2520hair%2520and%2520warm%2520smile%2520natural%2520lighting%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=34&orientation=squarish",
      },
      {
        name: "Michael Chen",
        avatar:
          "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520middle%2520aged%2520man%2520with%2520glasses%2520and%2520friendly%2520expression%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=35&orientation=squarish",
      },
      {
        name: "Emily Rodriguez",
        avatar:
          "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520young%2520woman%2520with%2520curly%2520hair%2520and%2520bright%2520smile%2520natural%2520lighting%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=36&orientation=squarish",
      },
      {
        name: "David Kim",
        avatar:
          "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520young%2520asian%2520man%2520with%2520short%2520black%2520hair%2520and%2520friendly%2520smile%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=37&orientation=squarish",
      },
    ],
  },
  {
    id: 202,
    title: "Sourdough Bread Workshop",
    description:
      "Master the art of sourdough bread making. We'll cover starter maintenance, dough handling, and baking techniques.",
    image:
      "https://readdy.ai/api/search-image?query=freshly%2520baked%2520sourdough%2520bread%2520with%2520beautiful%2520crust%2520and%2520scoring%2520patterns%2520artisanal%2520bread%2520on%2520wooden%2520board%2520with%2520flour%2520dusting%2520warm%2520bakery%2520lighting%2520high%2520resolution%2520appetizing%2520presentation%2520of%2520homemade%2520bread&width=600&height=300&seq=38&orientation=landscape",
    date: "Jun 18",
    time: "10:00 AM - 1:00 PM",
    groupName: "Baking Enthusiasts",
    attendees: [
      {
        name: "Sarah Johnson",
        avatar:
          "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520young%2520woman%2520with%2520long%2520brown%2520hair%2520and%2520warm%2520smile%2520natural%2520lighting%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=39&orientation=squarish",
      },
      {
        name: "Lisa Wong",
        avatar:
          "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520middle%2520aged%2520asian%2520woman%2520with%2520shoulder%2520length%2520hair%2520and%2520warm%2520smile%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=40&orientation=squarish",
      },
      {
        name: "Robert Taylor",
        avatar:
          "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520an%2520older%2520man%2520with%2520gray%2520hair%2520and%2520friendly%2520expression%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=41&orientation=squarish",
      },
    ],
  },
  {
    id: 203,
    title: "Family-Friendly Meal Planning Session",
    description:
      "Join us to plan a week's worth of family meals together. We'll share tips for pleasing picky eaters and efficient prep strategies.",
    image:
      "https://readdy.ai/api/search-image?query=organized%2520meal%2520planning%2520session%2520with%2520recipe%2520cards%2520calendar%2520and%2520shopping%2520list%2520planning%2520tools%2520for%2520family%2520meals%2520bright%2520clean%2520workspace%2520high%2520resolution%2520lifestyle%2520photography%2520of%2520meal%2520planning%2520process&width=600&height=300&seq=42&orientation=landscape",
    date: "Jun 20",
    time: "7:00 PM - 8:30 PM",
    groupName: "Family Meal Planning",
    attendees: [
      { name: "John Doe", avatar: currentUser.value.avatar },
      {
        name: "Jessica Martinez",
        avatar:
          "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520latina%2520woman%2520with%2520dark%2520hair%2520and%2520warm%2520smile%2520natural%2520lighting%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=43&orientation=squarish",
      },
      {
        name: "Thomas Wilson",
        avatar:
          "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520middle%2520aged%2520african%2520american%2520man%2520with%2520friendly%2520expression%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=44&orientation=squarish",
      },
      {
        name: "Amanda Lee",
        avatar:
          "https://readdy.ai/api/search-image?query=professional%2520headshot%2520of%2520a%2520young%2520asian%2520woman%2520with%2520long%2520black%2520hair%2520and%2520friendly%2520smile%2520neutral%2520background%2520high%2520quality%2520portrait%2520photo&width=100&height=100&seq=45&orientation=squarish",
      },
    ],
  },
]);
// Group Categories for Browse Modal
const groupCategories = [
  "Italian",
  "Baking",
  "Vegetarian",
  "Asian",
  "Desserts",
  "Healthy",
  "Quick Meals",
  "Meal Prep",
  "International",
  "Seafood",
  "Grilling",
  "Breakfast",
  "Drinks",
  "Holiday",
];
// Browsable Groups
const browsableGroups = ref([
  {
    id: 301,
    name: "Dessert Lovers",
    description:
      "For those with a sweet tooth! Share and discover recipes for cakes, cookies, ice creams, and all types of desserts from around the world.",
    coverImage:
      "https://readdy.ai/api/search-image?query=assortment%2520of%2520beautiful%2520desserts%2520on%2520elegant%2520display%2520cakes%2520pastries%2520chocolates%2520and%2520fruit%2520tarts%2520with%2520artistic%2520presentation%2520professional%2520patisserie%2520photography%2520with%2520soft%2520lighting%2520high%2520resolution%2520tempting%2520sweet%2520treats&width=200&height=200&seq=46&orientation=squarish",
    memberCount: 312,
    recipeCount: 187,
    type: "public",
  },
  {
    id: 302,
    name: "Healthy Meal Prep",
    description:
      "Tips, recipes, and strategies for preparing healthy meals in advance. Focus on nutritious ingredients and efficient cooking methods.",
    coverImage:
      "https://readdy.ai/api/search-image?query=healthy%2520meal%2520prep%2520containers%2520with%2520balanced%2520portions%2520of%2520proteins%2520vegetables%2520and%2520grains%2520organized%2520food%2520preparation%2520for%2520the%2520week%2520bright%2520clean%2520photography%2520high%2520resolution%2520nutritious%2520and%2520colorful%2520prepared%2520meals&width=200&height=200&seq=47&orientation=squarish",
    memberCount: 278,
    recipeCount: 156,
    type: "public",
  },
  {
    id: 303,
    name: "International Street Food",
    description:
      "Discover and share authentic street food recipes from around the world. From tacos to dumplings, explore the diverse flavors of global street cuisine.",
    coverImage:
      "https://readdy.ai/api/search-image?query=vibrant%2520international%2520street%2520food%2520market%2520with%2520diverse%2520food%2520stalls%2520serving%2520global%2520cuisines%2520colorful%2520authentic%2520dishes%2520from%2520around%2520the%2520world%2520atmospheric%2520market%2520lighting%2520high%2520resolution%2520appetizing%2520presentation%2520of%2520street%2520food%2520variety&width=200&height=200&seq=48&orientation=squarish",
    memberCount: 156,
    recipeCount: 98,
    type: "public",
  },
  {
    id: 304,
    name: "Seafood Specialties",
    description:
      "A group dedicated to all things seafood. Share recipes for fish, shellfish, and other seafood dishes from coastal cuisines around the world.",
    coverImage:
      "https://readdy.ai/api/search-image?query=fresh%2520seafood%2520display%2520with%2520fish%2520shrimp%2520mussels%2520and%2520other%2520shellfish%2520on%2520ice%2520with%2520lemon%2520and%2520herbs%2520professional%2520food%2520photography%2520with%2520blue%2520tones%2520high%2520resolution%2520appetizing%2520presentation%2520of%2520raw%2520seafood&width=200&height=200&seq=49&orientation=squarish",
    memberCount: 124,
    recipeCount: 76,
    type: "public",
  },
  {
    id: 305,
    name: "Cocktails & Mocktails",
    description:
      "Mix it up with creative drink recipes! Share your favorite cocktails, mocktails, smoothies, and other beverages for all occasions.",
    coverImage:
      "https://readdy.ai/api/search-image?query=elegant%2520cocktails%2520in%2520beautiful%2520glassware%2520with%2520creative%2520garnishes%2520and%2520presentation%2520colorful%2520drinks%2520on%2520bar%2520counter%2520with%2520atmospheric%2520lighting%2520high%2520resolution%2520professional%2520beverage%2520photography%2520of%2520stylish%2520mixed%2520drinks&width=200&height=200&seq=50&orientation=squarish",
    memberCount: 189,
    recipeCount: 112,
    type: "private",
  },
]);
// Computed Properties
const filteredGroups = computed(() => {
  let result = [...userGroups.value];
  // Apply search filter
  if (groupSearchQuery.value) {
    const query = groupSearchQuery.value.toLowerCase();
    result = result.filter(
      (group) =>
        group.name.toLowerCase().includes(query) ||
        group.description.toLowerCase().includes(query),
    );
  }
  // Apply status filter
  if (currentStatusFilter.value !== "all") {
    // In a real app, we would filter by active/archived status
    // For this demo, we'll just show all groups for any filter
  }
  // Apply sort
  switch (sortOption.value) {
    case "alphabetical":
      result.sort((a, b) => a.name.localeCompare(b.name));
      break;
    case "members":
      result.sort((a, b) => b.memberCount - a.memberCount);
      break;
    case "active":
      // In a real app, we would sort by activity level
      // For this demo, we'll just use the lastActivity field as a proxy
      result.sort((a, b) => {
        if (a.lastActivity === "Today") return -1;
        if (b.lastActivity === "Today") return 1;
        if (a.lastActivity === "Yesterday") return -1;
        if (b.lastActivity === "Yesterday") return 1;
        return 0;
      });
      break;
    case "recent":
    default:
      // Already in the desired order
      break;
  }
  return result;
});
// Methods
const toggleUserMenu = () => {
  showUserMenu.value = !showUserMenu.value;
  if (showUserMenu.value) {
    showNotifications.value = false;
    activeGroupSettings.value = null;
  }
};
const toggleGroupSettings = (groupId: number) => {
  activeGroupSettings.value =
    activeGroupSettings.value === groupId ? null : groupId;
  showUserMenu.value = false;
  showNotifications.value = false;
};
const toggleNotifications = () => {
  showNotifications.value = !showNotifications.value;
  if (showNotifications.value) {
    showUserMenu.value = false;
    unreadNotifications.value = 0;
  }
};
const createGroup = () => {
  // In a real app, this would send the data to the backend
  // For now, we'll just add it to our local array
  const newGroupObj = {
    id: userGroups.value.length + 100,
    name: newGroup.value.name,
    description: newGroup.value.description,
    coverImage: newGroup.value.coverImage,
    memberCount: 1,
    type: newGroup.value.type,
    role: "owner",
    lastActivity: "Just now",
    recipeCount: 0,
    upcomingEvents: 0,
    tags: newGroup.value.tags.split(",").map((tag) => tag.trim()),
  };
  userGroups.value.unshift(newGroupObj);
  // Reset form and close modal
  newGroup.value = {
    name: "",
    description: "",
    type: "public",
    tags: "",
    coverImage:
      "https://readdy.ai/api/search-image?query=group%2520of%2520diverse%2520people%2520cooking%2520together%2520in%2520a%2520modern%2520kitchen%2520sharing%2520recipes%2520and%2520techniques%2520warm%2520lighting%2520collaborative%2520atmosphere%2520high%2520quality%2520lifestyle%2520photography%2520showing%2520community%2520and%2520friendship%2520through%2520food&width=800&height=400&seq=21&orientation=landscape",
  };
  showCreateGroupModal.value = false;
};
const openEditModal = (group: any) => {
  editingGroup.value = {
    id: group.id,
    name: group.name,
    description: group.description,
    type: group.type,
    tags: group.tags.join(", "),
    coverImage: group.coverImage,
  };
  showEditGroupModal.value = true;
};
const saveGroupChanges = () => {
  const groupIndex = userGroups.value.findIndex(
    (g) => g.id === editingGroup.value.id,
  );
  if (groupIndex !== -1) {
    const updatedGroup = {
      ...userGroups.value[groupIndex],
      name: editingGroup.value.name,
      description: editingGroup.value.description,
      type: editingGroup.value.type,
      coverImage: editingGroup.value.coverImage,
      tags: editingGroup.value.tags.split(",").map((tag) => tag.trim()),
      lastActivity: "Just now",
    };
    userGroups.value[groupIndex] = updatedGroup;
  }
  showEditGroupModal.value = false;
};
const toggleCategoryFilter = (category: string) => {
  const index = selectedCategories.value.indexOf(category);
  if (index === -1) {
    selectedCategories.value.push(category);
  } else {
    selectedCategories.value.splice(index, 1);
  }
};
const openInviteMembersModal = (group: any) => {
  selectedGroup.value = group;
  selectedUsers.value = [];
  showInviteMembersModal.value = true;
  activeGroupSettings.value = null;
};
const sendInvites = () => {
  // In a real app, this would send invites to the selected users
  // For now, we'll just show a success message and close the modal
  alert(`Invites sent to ${selectedUsers.value.length} users`);
  showInviteMembersModal.value = false;
  selectedUsers.value = [];
};
const openLoginModal = () => {
  // This would open a login modal
  alert("Login modal would open here");
};
const openRegisterModal = () => {
  // This would open a registration modal
  alert("Registration modal would open here");
};
const logout = () => {
  isAuthenticated.value = false;
  showUserMenu.value = false;
};
const openAdminSettings = () => {
  // Here you would typically navigate to the admin settings page
  // For now, we'll just show an alert
  alert("Opening admin settings panel");
};
onMounted(() => {
  document.addEventListener("click", (e) => {
    // Close dropdowns when clicking outside
    const target = e.target as HTMLElement;
    if (showUserMenu.value || showNotifications.value) {
      if (!target.closest(".user-menu") && !target.closest(".notifications")) {
        showUserMenu.value = false;
        showNotifications.value = false;
      }
    }
    if (
      activeGroupSettings.value !== null &&
      !target.closest(".fas.fa-cog") &&
      !target.closest(".group-settings-dropdown")
    ) {
      activeGroupSettings.value = null;
    }
  });
});
</script>

<style scoped>
/* Line clamp for truncating text */
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
