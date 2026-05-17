<template>
    <AdminLayout>
        <div class="py-10">
            <div class="max-w-[1520px] mx-auto px-6 sm:px-8 lg:px-10">
                <!-- Page Header -->
                <div class="mb-10">
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight">Tableau de Bord</h1>
                    <p class="mt-2 text-base text-slate-500 font-medium">Aperçu global de l'activité de votre plateforme culinaire.</p>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 mb-10">
                    <!-- Users Stat -->
                    <Link :href="route('admin.users')" class="bg-white rounded-3xl p-8 border border-slate-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-xl hover:-translate-y-1 transition-all group">
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 transition-colors group-hover:bg-indigo-600 group-hover:text-white">
                                <i class="fas fa-users text-2xl"></i>
                            </div>
                            <span class="text-[10px] font-black text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-lg uppercase tracking-wider">Total</span>
                        </div>
                        <div class="text-3xl font-black text-slate-900">{{ stats.total_users }}</div>
                        <div class="text-sm font-bold text-slate-400 mt-2">Utilisateurs actifs</div>
                    </Link>

                    <!-- Recipes Stat -->
                    <Link :href="route('admin.recipes')" class="bg-white rounded-3xl p-8 border border-slate-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-xl hover:-translate-y-1 transition-all group">
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 transition-colors group-hover:bg-emerald-600 group-hover:text-white">
                                <i class="fas fa-utensils text-2xl"></i>
                            </div>
                            <span class="text-[10px] font-black text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg uppercase tracking-wider">Total</span>
                        </div>
                        <div class="text-3xl font-black text-slate-900">{{ stats.total_recipes }}</div>
                        <div class="text-sm font-bold text-slate-400 mt-2">Recettes partagées</div>
                    </Link>

                    <!-- Groups Stat -->
                    <Link :href="route('admin.groups')" class="bg-white rounded-3xl p-8 border border-slate-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-xl hover:-translate-y-1 transition-all group">
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 transition-colors group-hover:bg-purple-600 group-hover:text-white">
                                <i class="fas fa-user-friends text-2xl"></i>
                            </div>
                            <span class="text-[10px] font-black text-purple-600 bg-purple-50 px-2.5 py-1 rounded-lg uppercase tracking-wider">Total</span>
                        </div>
                        <div class="text-3xl font-black text-slate-900">{{ stats.total_groups }}</div>
                        <div class="text-sm font-bold text-slate-400 mt-2">Groupes privés</div>
                    </Link>

                    <!-- Reviews Stat -->
                    <Link :href="route('admin.reviews')" class="bg-white rounded-3xl p-8 border border-slate-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-xl hover:-translate-y-1 transition-all group">
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 transition-colors group-hover:bg-amber-600 group-hover:text-white">
                                <i class="fas fa-star text-2xl"></i>
                            </div>
                            <span class="text-[10px] font-black text-amber-600 bg-amber-50 px-2.5 py-1 rounded-lg uppercase tracking-wider">Total</span>
                        </div>
                        <div class="text-3xl font-black text-slate-900">{{ stats.total_reviews }}</div>
                        <div class="text-sm font-bold text-slate-400 mt-2">Avis recueillis</div>
                    </Link>

                    <!-- Pending Stat -->
                    <Link :href="route('admin.ingredients')" class="bg-white rounded-3xl p-8 border border-slate-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-xl hover:-translate-y-1 transition-all group">
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-14 h-14 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-600 transition-colors group-hover:bg-rose-600 group-hover:text-white">
                                <i class="fas fa-carrot text-2xl"></i>
                            </div>
                            <span class="text-[10px] font-black text-rose-600 bg-rose-50 px-2.5 py-1 rounded-lg uppercase tracking-wider">Alerte</span>
                        </div>
                        <div class="text-3xl font-black text-slate-900">{{ stats.pending_ingredients }}</div>
                        <div class="text-sm font-bold text-slate-400 mt-2">À certifier</div>
                    </Link>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <!-- Recent Recipes -->
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] overflow-hidden">
                        <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                            <h3 class="text-xl font-black text-slate-900 tracking-tight">Dernières Recettes</h3>
                            <Link :href="route('admin.recipes')" class="text-emerald-600 text-sm font-black hover:bg-emerald-50 px-4 py-2 rounded-xl transition-colors">Tout voir</Link>
                        </div>
                        <div class="divide-y divide-slate-50">
                            <div v-for="recipe in recent_recipes" :key="recipe.id" class="p-6 hover:bg-slate-50/50 transition-colors flex items-center group">
                                <div class="h-14 w-14 rounded-2xl bg-slate-100 flex-shrink-0 flex items-center justify-center text-slate-400 group-hover:bg-white group-hover:shadow-sm transition-all">
                                    <i class="fas fa-utensils text-lg"></i>
                                </div>
                                <div class="ml-5 flex-1 overflow-hidden">
                                    <h4 class="text-sm font-black text-slate-900 truncate">{{ recipe.title }}</h4>
                                    <p class="text-xs font-bold text-slate-400 mt-1">
                                        Par <span class="text-slate-600">{{ recipe.user?.username }}</span> • {{ new Date(recipe.created_at).toLocaleDateString() }}
                                    </p>
                                </div>
                                <div class="text-right ml-4">
                                    <span class="px-2.5 py-1 inline-flex text-[10px] font-black uppercase tracking-wider rounded-lg" 
                                          :class="recipe.is_visible ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500'">
                                        {{ recipe.is_visible ? 'Visible' : 'Privé' }}
                                    </span>
                                </div>
                            </div>
                            <div v-if="recent_recipes.length === 0" class="p-12 text-center text-slate-400 font-medium italic">
                                Aucune recette enregistrée récemment.
                            </div>
                        </div>
                    </div>

                    <!-- Recent Users -->
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] overflow-hidden">
                        <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                            <h3 class="text-xl font-black text-slate-900 tracking-tight">Nouveaux Membres</h3>
                            <Link :href="route('admin.users')" class="text-emerald-600 text-sm font-black hover:bg-emerald-50 px-4 py-2 rounded-xl transition-colors">Tout voir</Link>
                        </div>
                        <div class="divide-y divide-slate-50">
                            <div v-for="user in recent_users" :key="user.id" class="p-6 hover:bg-slate-50/50 transition-colors flex items-center group">
                                <div class="h-12 w-12 rounded-2xl bg-emerald-50 flex-shrink-0 flex items-center justify-center text-emerald-600 font-black group-hover:bg-emerald-600 group-hover:text-white transition-all shadow-inner">
                                    {{ user.username.charAt(0).toUpperCase() }}
                                </div>
                                <div class="ml-5 flex-1 overflow-hidden">
                                    <h4 class="text-sm font-black text-slate-900 truncate">{{ user.username }}</h4>
                                    <p class="text-xs font-bold text-slate-400 mt-1 truncate">{{ user.email }}</p>
                                </div>
                                <div class="ml-4">
                                    <span v-if="user.is_admin" class="px-2.5 py-1 inline-flex text-[10px] font-black uppercase tracking-wider rounded-lg bg-indigo-100 text-indigo-700">
                                        Admin
                                    </span>
                                    <span v-else class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Membre</span>
                                </div>
                            </div>
                            <div v-if="recent_users.length === 0" class="p-12 text-center text-slate-400 font-medium italic">
                                Pas de nouvelles inscriptions ce jour.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
    stats: Object,
    recent_recipes: Array,
    recent_users: Array
});
</script>
