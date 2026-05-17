<template>
    <div class="flex h-screen bg-gray-50">
        <AdminSidebar class="hidden md:flex" />

        <!-- Main Content -->
        <div class="md:pl-72 flex flex-col flex-1">
            <!-- Top Header -->
            <header class="sticky top-0 z-10 bg-white/80 backdrop-blur-md border-b border-slate-100">
                <div
                    class="flex items-center justify-between h-20 px-8"
                >
                    <!-- Mobile Menu Button -->
                    <button
                        @click="isMobileSidebarOpen = true"
                        class="md:hidden text-slate-600 hover:text-emerald-600 p-2 rounded-xl hover:bg-slate-50 transition-colors"
                    >
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <!-- Breadcrumb -->
                    <div class="hidden md:flex items-center text-sm">
                        <Link
                            :href="route('home')"
                            class="text-slate-400 hover:text-emerald-600 font-bold transition-colors"
                            >Vitrine</Link
                        >
                        <i
                            class="fas fa-chevron-right mx-3 text-[10px] text-slate-300"
                        ></i>
                        <span class="text-slate-900 font-black tracking-tight"
                            >Administration</span
                        >
                    </div>

                    <!-- Right Header Items -->
                    <div class="flex items-center space-x-6">
                        <div class="relative">
                            <button
                                class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 transition-all relative"
                            >
                                <i class="fas fa-bell"></i>
                                <span
                                    class="absolute top-2 right-2 bg-rose-500 border-2 border-white text-[8px] font-black text-white rounded-full h-4 w-4 flex items-center justify-center"
                                    >3</span
                                >
                            </button>
                        </div>

                        <!-- User Menu -->
                        <div class="flex items-center gap-4 pl-6 border-l border-slate-100">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-black text-slate-900 leading-none">{{ $page.props.auth.user?.username ?? 'Administrateur' }}</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Super Admin</p>
                            </div>
                            <button
                                @click="logout"
                                class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-all"
                                title="Déconnexion"
                            >
                                <i class="fas fa-power-off"></i>
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

        <!-- Mobile Sidebar -->
        <transition
            enter-active-class="transition-opacity ease-linear duration-300"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition-opacity ease-linear duration-300"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div v-if="isMobileSidebarOpen" class="fixed inset-0 z-40 md:hidden overflow-hidden">
                <!-- Backdrop -->
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="isMobileSidebarOpen = false"></div>
                
                <!-- Sidebar content -->
                <transition
                    enter-active-class="transition ease-in-out duration-300 transform"
                    enter-from-class="-translate-x-full"
                    enter-to-class="translate-x-0"
                    leave-active-class="transition ease-in-out duration-300 transform"
                    leave-from-class="translate-x-0"
                    leave-to-class="-translate-x-full"
                >
                    <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white h-full shadow-2xl">
                        <div class="absolute top-0 right-0 -mr-12 pt-6">
                            <button @click="isMobileSidebarOpen = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white bg-white/10 text-white">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        <AdminSidebar @close="isMobileSidebarOpen = false" class="!flex !w-full !relative" />
                    </div>
                </transition>
            </div>
        </transition>
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
    router.post(route('logout'));
};
</script>
