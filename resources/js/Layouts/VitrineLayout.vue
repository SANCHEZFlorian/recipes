<template>
    <div
        class="min-h-screen flex flex-col bg-gray-50/50 selection:bg-emerald-200 selection:text-emerald-900 font-sans text-gray-900"
    >
        <VitrineNavbar
            @toggle-mobile-menu="isMobileMenuOpen = !isMobileMenuOpen"
            @open-login="showLoginModal = true"
            @open-register="showRegisterModal = true"
            @logout="logout"
        />

        <!-- Mobile Menu Overlay -->
        <transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="opacity-0 -translate-y-2"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 -translate-y-2"
        >
            <div
                v-if="isMobileMenuOpen"
                class="md:hidden fixed inset-x-0 top-16 bg-white/95 backdrop-blur-md shadow-2xl border-b border-gray-100 z-40 p-4"
            >
                <nav class="flex flex-col gap-2">
                    <Link
                        :href="route('home')"
                        class="px-4 py-3 rounded-xl font-medium text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 transition-colors"
                    >
                        Découvrir
                    </Link>
                    <Link
                        :href="route('categories.list')"
                        class="px-4 py-3 rounded-xl font-medium text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 transition-colors"
                    >
                        Catégories
                    </Link>

                    <div class="h-px bg-gray-100 my-2"></div>

                    <template v-if="$page.props.auth.user">
                        <div class="px-4 py-3 flex items-center gap-3">
                            <img
                                :src="
                                    'https://ui-avatars.com/api/?name=' +
                                    encodeURIComponent(
                                        $page.props.auth.user.name,
                                    ) +
                                    '&background=10b981&color=fff'
                                "
                                class="w-10 h-10 rounded-full"
                            />
                            <div>
                                <div class="font-bold text-gray-900">
                                    {{ $page.props.auth.user.name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $page.props.auth.user.email }}
                                </div>
                            </div>
                        </div>
                        <template v-if="$page.props.auth.user.is_admin">
                            <Link
                                :href="route('admin.ingredients')"
                                class="px-4 py-3 rounded-xl font-medium text-amber-600 hover:bg-amber-50 transition-colors"
                            >
                                Administration
                            </Link>
                        </template>
                        <Link
                            :href="route('profile')"
                            class="px-4 py-3 rounded-xl font-medium text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 transition-colors"
                        >
                            Mon Profil
                        </Link>
                        <button
                            @click="logout"
                            class="px-4 py-3 rounded-xl font-medium text-left text-red-600 hover:bg-red-50 transition-colors w-full"
                        >
                            Déconnexion
                        </button>
                    </template>
                    <template v-else>
                        <button
                            @click="openModal('login')"
                            class="px-4 py-3 rounded-xl font-medium text-center text-emerald-600 bg-emerald-50 hover:bg-emerald-100 transition-colors w-full"
                        >
                            Connexion
                        </button>
                        <button
                            @click="openModal('register')"
                            class="px-4 py-3 rounded-xl font-medium text-center text-white bg-emerald-600 hover:bg-emerald-700 transition-colors w-full shadow-md shadow-emerald-600/20"
                        >
                            S'inscrire
                        </button>
                    </template>
                </nav>
            </div>
        </transition>

        <!-- Main Content -->
        <main class="flex-grow flex flex-col">
            <slot />
        </main>

        <!-- Minimal Footer -->
        <footer class="bg-white border-t border-gray-100 py-12 mt-auto">
            <div class="max-w-[1520px] mx-auto px-2 sm:px-4 lg:px-8">
                <div
                    class="flex flex-col md:flex-row items-center justify-between gap-6"
                >
                    <div
                        class="flex items-center gap-2 grayscale items-center justify-center opacity-60"
                    >
                        <div
                            class="h-8 w-8 bg-gray-800 text-white rounded-lg flex items-center justify-center font-bold text-lg"
                        >
                            FR
                        </div>
                        <span
                            class="text-xl font-black text-gray-800 tracking-tight"
                            >Family Recipe</span
                        >
                    </div>
                    <p class="text-gray-500 text-sm font-medium">
                        &copy; 2026 Family Recipe. Recettes partagées avec amour.
                    </p>
                    <div class="flex gap-4 text-gray-400">
                        <a
                            href="#"
                            class="hover:text-emerald-600 transition-colors"
                            ><svg
                                class="w-5 h-5"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"
                                /></svg
                        ></a>
                        <a
                            href="#"
                            class="hover:text-emerald-600 transition-colors"
                            ><svg
                                class="w-5 h-5"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"
                                /></svg
                        ></a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Modals -->
        <LoginModal
            :show="showLoginModal"
            @close="showLoginModal = false"
            @switch-to-register="
                showLoginModal = false;
                showRegisterModal = true;
            "
        />
        <RegisterModal
            :show="showRegisterModal"
            @close="showRegisterModal = false"
            @switch-to-login="
                showRegisterModal = false;
                showLoginModal = true;
            "
        />
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { Link, router } from "@inertiajs/vue3";
import VitrineNavbar from "@/Components/VitrineNavbar.vue";
import LoginModal from "@/Components/LoginModal.vue";
import RegisterModal from "@/Components/RegisterModal.vue";

const isMobileMenuOpen = ref(false);
const showLoginModal = ref(false);
const showRegisterModal = ref(false);

const openModal = (type) => {
    isMobileMenuOpen.value = false;
    if (type === "login") showLoginModal.value = true;
    if (type === "register") showRegisterModal.value = true;
};

const logout = () => {
    isMobileMenuOpen.value = false;
    router.post(route("logout"));
};

onMounted(() => {
    const params = new URLSearchParams(window.location.search);
    if (params.has("login")) {
        showLoginModal.value = true;
        // Clean up URL without refreshing
        const url = new URL(window.location);
        url.searchParams.delete("login");
        window.history.replaceState({}, "", url);
    }
});
</script>
