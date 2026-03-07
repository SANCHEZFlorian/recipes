<template>
    <div class="flex h-screen bg-gray-50">
        <AdminSidebar />

        <!-- Main Content -->
        <div class="md:pl-64 flex flex-col flex-1">
            <!-- Top Header -->
            <header class="sticky top-0 z-10 bg-white shadow-sm">
                <div
                    class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8"
                >
                    <!-- Mobile Menu Button -->
                    <button
                        @click="isMobileSidebarOpen = true"
                        class="md:hidden text-gray-600 hover:text-emerald-600"
                    >
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <!-- Breadcrumb (Dynamic can be added later) -->
                    <div class="flex items-center text-sm text-gray-500">
                        <Link
                            :href="route('home')"
                            class="hover:text-emerald-600 cursor-pointer"
                            >Accueil</Link
                        >
                        <i
                            class="fas fa-chevron-right mx-2 text-xs text-gray-400"
                        ></i>
                        <span class="text-emerald-600 font-medium"
                            >Paramètres Admin</span
                        >
                    </div>

                    <!-- Right Header Items -->
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button
                                class="text-gray-600 hover:text-emerald-600 relative"
                            >
                                <i class="fas fa-bell text-xl"></i>
                                <span
                                    class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"
                                    >3</span
                                >
                            </button>
                        </div>

                        <!-- User Menu -->
                        <div class="flex items-center space-x-2">
                            <span
                                class="text-gray-700 font-medium hidden sm:inline-block"
                                >{{
                                    $page.props.auth.user?.name ??
                                    "Administrateur"
                                }}</span
                            >
                            <button
                                @click="logout"
                                class="text-red-600 text-sm"
                            >
                                Déconnexion
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto relative">
                <!-- Global Flash Notifications -->
                <transition
                    enter-active-class="transform ease-out duration-300 transition"
                    enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                    enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                    leave-active-class="transition ease-in duration-100"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <div v-if="$page.props.flash.success || $page.props.flash.error" class="fixed top-20 right-4 z-50 w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-lg pointer-events-auto ring-1 ring-black ring-opacity-5">
                        <div class="p-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <i v-if="$page.props.flash.success" class="fas fa-check-circle text-emerald-400 text-xl"></i>
                                    <i v-if="$page.props.flash.error" class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                                </div>
                                <div class="ml-3 w-0 flex-1 pt-0.5">
                                    <p class="text-sm font-medium" :class="$page.props.flash.success ? 'text-emerald-800' : 'text-red-800'">
                                        {{ $page.props.flash.success ? 'Succès' : 'Erreur' }}
                                    </p>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $page.props.flash.success || $page.props.flash.error }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>

                <slot />
            </main>
        </div>

        <!-- Mobile Sidebar (Simplified) -->
        <div
            v-if="isMobileSidebarOpen"
            class="fixed inset-0 z-40 md:hidden bg-gray-600 bg-opacity-75"
            @click="isMobileSidebarOpen = false"
        >
            <!-- Sidebar content again for mobile... simplified for now -->
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import AdminSidebar from "@/Components/AdminSidebar.vue";

const isMobileSidebarOpen = ref(false);
const page = usePage();

// Auto dismiss flash messages after 5 seconds
watch(() => page.props.flash, (flash) => {
    if (flash.success || flash.error) {
        setTimeout(() => {
            page.props.flash.success = null;
            page.props.flash.error = null;
        }, 5000);
    }
}, { deep: true });

const logout = () => {
    console.log("Admin logout");
};
</script>
