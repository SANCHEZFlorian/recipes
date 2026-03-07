<template>
    <header
        class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100"
    >
        <div
            class="max-w-[1520px] mx-auto px-2 sm:px-4 lg:px-8 h-16 flex items-center justify-between"
        >
            <!-- Brand Logo -->
            <Link :href="route('home')" class="flex items-center gap-3 group">
                <div
                    class="h-10 w-10 flex items-center justify-center group-hover:scale-105 transition-transform"
                >
                    <img
                        src="/images/logo.png"
                        alt="CookBook Logo"
                        class="h-full w-full object-contain drop-shadow-sm"
                    />
                </div>
                <span
                    class="text-xl font-black text-gray-900 tracking-tight leading-none pt-1"
                    >Cook<span class="text-emerald-600">Book</span></span
                >
            </Link>

            <!-- Desktop Nav Links -->
            <nav class="hidden md:flex items-center gap-8 h-full">
                <!-- Random Recipe -->
                <Link
                    :href="route('recipe.random')"
                    class="flex items-center gap-1.5 text-sm font-semibold text-gray-500 hover:text-emerald-600 transition-colors h-full border-b-2 border-transparent hover:border-emerald-600 group"
                >
                    <svg
                        class="w-4 h-4 text-emerald-500 group-hover:animate-spin-slow"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"
                        />
                    </svg>
                    Au Hasard
                </Link>

                <!-- Complex Recipes Dropdown -->
                <div class="relative h-full flex items-center group/recipes">
                    <button
                        class="text-sm font-semibold text-gray-500 group-hover/recipes:text-emerald-600 transition-colors h-full border-b-2 border-transparent group-hover/recipes:border-emerald-600 flex items-center gap-1"
                    >
                        Recettes
                        <svg
                            class="w-4 h-4 transition-transform group-hover/recipes:rotate-180"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>
                    </button>

                    <!-- Mega Menu Dropdown -->
                    <div
                        class="absolute top-full left-1/2 -translate-x-1/2 w-[600px] bg-white rounded-2xl shadow-2xl shadow-emerald-900/10 border border-gray-100 opacity-0 invisible group-hover/recipes:opacity-100 group-hover/recipes:visible transition-all duration-300 origin-top overflow-hidden grid grid-cols-2 pt-2"
                    >
                        <!-- Categories Column -->
                        <div class="p-6 bg-gray-50/50 border-r border-gray-100">
                            <h3
                                class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4"
                            >
                                Catégories
                            </h3>
                            <ul class="space-y-3">
                                <li
                                    v-for="cat in sliceCategories(0, 5)"
                                    :key="cat.id"
                                >
                                    <Link
                                        :href="
                                            route('category.show', {
                                                id: cat.id,
                                            })
                                        "
                                        class="text-sm font-medium text-gray-700 hover:text-emerald-600 flex items-center gap-2 group/link"
                                    >
                                        <span
                                            class="w-1.5 h-1.5 rounded-full bg-emerald-200 group-hover/link:bg-emerald-500 transition-colors"
                                        ></span>
                                        {{ cat.nom }}
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        :href="route('categories.list')"
                                        class="text-sm font-bold text-emerald-600 hover:text-emerald-700 mt-2 inline-block"
                                    >
                                        Voir toutes les catégories &rarr;
                                    </Link>
                                </li>
                            </ul>
                        </div>

                        <!-- Types Column -->
                        <div class="p-6">
                            <h3
                                class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4"
                            >
                                Types de plats
                            </h3>
                            <ul class="space-y-3">
                                <li
                                    v-for="type in sliceTypes(0, 5)"
                                    :key="type.id"
                                >
                                    <Link
                                        href="#"
                                        class="text-sm font-medium text-gray-700 hover:text-emerald-600 flex items-center gap-2 group/link"
                                    >
                                        {{ type.nom }}
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <Link
                    :href="route('categories.list')"
                    :class="[
                        'text-sm font-semibold transition-colors flex items-center h-full border-b-2',
                        route().current('categories.list')
                            ? 'text-emerald-600 border-emerald-600'
                            : 'text-gray-500 border-transparent hover:border-emerald-600 hover:text-emerald-600',
                    ]"
                >
                    Catégories
                </Link>
            </nav>

            <!-- Actions -->
            <div class="flex items-center gap-4">
                <!-- Mobile Menu Toggle -->
                <button
                    @click="$emit('toggle-mobile-menu')"
                    class="md:hidden p-2 text-gray-500 hover:text-emerald-600 transition-colors"
                >
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"
                        ></path>
                    </svg>
                </button>

                <div class="hidden md:block w-px h-6 bg-gray-200"></div>

                <!-- Auth / Profile -->
                <div
                    v-if="!$page.props.auth.user"
                    class="hidden md:flex items-center gap-3"
                >
                    <button
                        @click="$emit('open-login')"
                        class="text-sm font-medium text-gray-600 hover:text-emerald-600 transition-colors px-3 py-2"
                    >
                        Connexion
                    </button>
                    <button
                        @click="$emit('open-register')"
                        class="text-sm font-medium bg-emerald-600 text-white px-5 py-2.5 rounded-full shadow-md shadow-emerald-600/20 hover:bg-emerald-700 hover:shadow-lg transition-all active:scale-95"
                    >
                        S'inscrire
                    </button>
                </div>

                <div
                    v-else
                    class="hidden md:flex items-center relative group h-16"
                >
                    <button
                        class="flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-emerald-600 transition-colors focus:outline-none h-full"
                    >
                        <img
                            :src="
                                'https://ui-avatars.com/api/?name=' +
                                encodeURIComponent($page.props.auth.user.name) +
                                '&background=10b981&color=fff'
                            "
                            class="w-8 h-8 rounded-full border-2 border-transparent group-hover:border-emerald-200 transition-all"
                        />
                        <span>{{ $page.props.auth.user.name }}</span>
                        <svg
                            class="w-4 h-4 text-gray-400 group-hover:text-emerald-500 transition-transform group-hover:rotate-180"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>
                    </button>
                    <!-- Dropdown -->
                    <div
                        class="absolute right-0 top-full mt-1 w-56 bg-white rounded-xl shadow-xl shadow-gray-200/50 border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 origin-top overflow-hidden z-50"
                    >
                        <div class="p-1.5">
                            <Link
                                :href="route('profile')"
                                class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors"
                            >
                                <svg
                                    class="w-4 h-4 text-gray-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    />
                                </svg>
                                Mon Profil
                            </Link>

                            <Link
                                :href="route('groups')"
                                class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors"
                            >
                                <svg
                                    class="w-4 h-4 text-gray-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                    />
                                </svg>
                                Mes Groupes
                            </Link>

                            <Link
                                v-if="$page.props.auth && $page.props.auth.user && $page.props.auth.user.is_admin"
                                :href="route('admin.ingredients')"
                                class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors"
                            >
                                <svg
                                    class="w-4 h-4 text-gray-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                </svg>
                                Administration
                            </Link>

                            <div class="h-px bg-gray-100 my-1"></div>

                            <button
                                @click="$emit('logout')"
                                class="flex items-center gap-3 w-full text-left px-3 py-2.5 text-sm font-medium text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors"
                            >
                                <svg
                                    class="w-4 h-4 text-red-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                    />
                                </svg>
                                Déconnexion
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

defineEmits(["toggle-mobile-menu", "open-login", "open-register", "logout"]);

const page = usePage();

// Helper functions for safe slice
const sliceCategories = (start, end) => {
    return page.props.categories ? page.props.categories.slice(start, end) : [];
};

const sliceTypes = (start, end) => {
    return page.props.types ? page.props.types.slice(start, end) : [];
};
</script>
