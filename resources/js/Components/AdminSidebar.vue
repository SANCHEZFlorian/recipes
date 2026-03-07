<template>
    <div
        class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 bg-white shadow-md z-10"
    >
        <div class="flex-1 flex flex-col min-h-0 border-r border-gray-200">
            <!-- Logo -->
            <Link
                :href="route('home')"
                class="flex items-center h-16 px-4 border-b border-gray-200"
            >
                <img :src="logoUrl" alt="CookBook" class="h-10 w-auto" />
                <h1 class="ml-2 text-xl font-bold text-emerald-600">
                    CookBook
                </h1>
            </Link>
            <!-- Navigation Menu -->
            <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
                <Link
                    v-for="item in menuItems"
                    :key="item.name"
                    :href="item.route"
                    :class="[
                        route().current(item.route_name)
                            ? 'bg-emerald-50 text-emerald-700'
                            : 'text-gray-600 hover:bg-gray-100',
                        'flex items-center px-3 py-2.5 text-sm font-medium rounded-lg cursor-pointer',
                    ]"
                >
                    <i
                        :class="[
                            item.icon,
                            route().current(item.route_name)
                                ? 'text-emerald-600'
                                : 'text-gray-500',
                            'w-5 h-5 mr-3',
                        ]"
                    ></i>
                    {{ item.name }}
                </Link>
            </nav>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const logoUrl =
    "https://ui-avatars.com/api/?name=Recipe&background=random&color=fff";

const menuItems = [
    {
        name: "Tableau de Bord",
        icon: "fas fa-chart-pie",
        route: "#",
        route_name: "admin.dashboard",
    },
    {
        name: "Gestion des Recettes",
        icon: "fas fa-utensils",
        route: "#",
        route_name: "admin.recipes",
    },
    {
        name: "Gestion des Ingrédients",
        icon: "fas fa-carrot",
        route: route("admin.ingredients"),
        route_name: "admin.ingredients",
    },
    {
        name: "Gestion des Catégories",
        icon: "fas fa-tags",
        route: route("admin.categories"),
        route_name: "admin.categories",
    },
    {
        name: "Types de Plats",
        icon: "fi fi-rr-concierge-bell",
        route: route("admin.recipe-types"),
        route_name: "admin.recipe-types",
    },
    {
        name: "Types de Cuisson",
        icon: "fi fi-rr-fire",
        route: route("admin.cooking-types"),
        route_name: "admin.cooking-types",
    },
    {
        name: "Types d'Ingrédients",
        icon: "fas fa-list",
        route: route("admin.ingredient-categories"),
        route_name: "admin.ingredient-categories",
    },
    {
        name: "Gestion des Mesures",
        icon: "fas fa-balance-scale",
        route: route("admin.measurements"),
        route_name: "admin.measurements",
    },
    {
        name: "Gestion des Utilisateurs",
        icon: "fas fa-users",
        route: route("admin.users"),
        route_name: "admin.users",
    },
    {
        name: "Gestion des Groupes",
        icon: "fas fa-user-friends",
        route: "#",
        route_name: "admin.groups",
    },
    {
        name: "Configuration du Site",
        icon: "fas fa-cogs",
        route: route("admin.settings"),
        route_name: "admin.settings",
    },
];
</script>
