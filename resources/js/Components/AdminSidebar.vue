<template>
    <div
        class="flex flex-col md:w-72 md:fixed md:inset-y-0 bg-white border-r border-slate-100 z-20 shadow-[10px_0_40px_rgba(0,0,0,0.02)]"
    >
        <div class="flex-1 flex flex-col min-h-0">
            <!-- Logo Section -->
            <Link
                :href="route('home')"
                class="flex items-center h-24 px-8 mb-4 group"
            >
                <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center shadow-md border border-slate-100/50 transition-transform group-hover:scale-110 p-2 shrink-0">
                    <img
                        src="/images/logo.png"
                        alt="Family Recipe Logo"
                        class="w-full h-full object-contain"
                    />
                </div>
                <div class="ml-4">
                    <h1 class="text-xl font-black text-slate-900 tracking-tighter">
                        Family<span class="text-emerald-600">Recipe</span>
                    </h1>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Admin Panel</p>
                </div>
            </Link>

            <!-- Navigation Menu -->
            <nav 
                ref="sidebarNav"
                @scroll="handleScroll"
                class="flex-1 px-4 pb-8 space-y-1 overflow-y-auto custom-scrollbar"
            >
                <div v-for="(item, idx) in menuItems" :key="item.name">
                    <!-- Separator for logical groups -->
                    <div v-if="idx === 1" class="px-4 mt-5 mb-1.5 text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Navigation</div>
                    <div v-if="idx === 11" class="px-4 mt-5 mb-1.5 text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Utilisateurs</div>
                    <div v-if="idx === 14" class="px-4 mt-5 mb-1.5 text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Système</div>

                    <Link
                        :href="item.route"
                        :class="[
                            route().current(item.route_name)
                                ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-500/20'
                                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900',
                            'flex items-center px-4 py-2.5 text-xs font-semibold rounded-xl cursor-pointer transition-all duration-300',
                        ]"
                    >
                        <div 
                            :class="[
                                route().current(item.route_name) ? 'bg-white/20' : 'bg-slate-100',
                                'w-7 h-7 rounded-lg flex items-center justify-center mr-3 transition-colors shrink-0'
                            ]"
                        >
                            <i :class="[item.icon, 'text-[10px]']"></i>
                        </div>
                        <span class="truncate">{{ item.name }}</span>
                        <i v-if="route().current(item.route_name)" class="fas fa-chevron-right ml-auto text-[9px] opacity-50"></i>
                    </Link>
                </div>
            </nav>

            <!-- Footer Sidebar -->
            <div class="p-6 border-t border-slate-50">
                <div class="bg-slate-50 rounded-2xl p-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-slate-200 flex items-center justify-center text-slate-400">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-xs font-black text-slate-900 truncate">S. Florian</p>
                        <p class="text-[10px] font-bold text-slate-400">Super Admin</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

const logoUrl = "/images/logo.png";
const sidebarNav = ref(null);

const handleScroll = (e) => {
    sessionStorage.setItem("admin-sidebar-scroll", e.target.scrollTop);
};

onMounted(() => {
    if (sidebarNav.value) {
        const savedScroll = sessionStorage.getItem("admin-sidebar-scroll");
        if (savedScroll) {
            sidebarNav.value.scrollTop = parseInt(savedScroll, 10);
        }
    }
});

const menuItems = [
    {
        name: "Tableau de Bord",
        icon: "fas fa-chart-pie",
        route: route("admin.dashboard"),
        route_name: "admin.dashboard",
    },
    {
        name: "Gestion des Recettes",
        icon: "fas fa-utensils",
        route: route("admin.recipes"),
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
        name: "Niveaux de Difficulté",
        icon: "fas fa-signal",
        route: route("admin.difficulties"),
        route_name: "admin.difficulties",
    },
    {
        name: "Gestion des Budgets",
        icon: "fas fa-euro-sign",
        route: route("admin.prices"),
        route_name: "admin.prices",
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
        name: "Gestion des Ustensiles",
        icon: "fas fa-blender",
        route: route("admin.ustensiles"),
        route_name: "admin.ustensiles",
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
        route: route("admin.groups"),
        route_name: "admin.groups",
    },
    {
        name: "Avis & Commentaires",
        icon: "fas fa-comments",
        route: route("admin.reviews"),
        route_name: "admin.reviews",
    },
    {
        name: "Configuration du Site",
        icon: "fas fa-cogs",
        route: route("admin.settings"),
        route_name: "admin.settings",
    },
];
</script>
