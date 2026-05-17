<template>
    <AdminLayout>
        <div class="py-6">
            <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-8 flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Gestion des Recettes</h1>
                        <p class="mt-1 text-sm text-gray-500">Modérez et gérez l'ensemble des recettes publiées sur la plateforme.</p>
                    </div>
                </div>

                <!-- Recipes Table -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recette</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Auteur</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="recipe in recipes.data" :key="recipe.id" :class="{'opacity-50 grayscale bg-slate-50/50': recipe.is_supprimer}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-emerald-100 flex-shrink-0 flex items-center justify-center text-emerald-600">
                                            <i class="fas fa-utensils text-lg"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ recipe.title }}</div>
                                            <div class="text-xs text-slate-500 font-medium">{{ recipe.portions }} portions</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <img :src="recipe.user?.avatar" class="w-6 h-6 rounded-full object-cover" />
                                        <span class="text-sm font-bold text-slate-600">{{ recipe.user?.username || 'Anonyme' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-500">
                                    {{ recipe.recette_type?.nom || 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span v-if="recipe.is_supprimer" class="px-2.5 py-1 inline-flex text-[10px] font-black uppercase tracking-wider rounded-lg bg-rose-100 text-rose-700">
                                        Supprimée
                                    </span>
                                    <span v-else :class="recipe.is_visible ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'" 
                                          class="px-2.5 py-1 inline-flex text-[10px] font-black uppercase tracking-wider rounded-lg">
                                        {{ recipe.is_visible ? 'Publique' : 'Privée' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-400">
                                    {{ new Date(recipe.created_at).toLocaleDateString() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button @click="toggleVisibility(recipe)" 
                                            class="text-emerald-600 hover:text-emerald-900 mr-3 cursor-pointer"
                                            :title="recipe.is_visible ? 'Rendre privée' : 'Rendre publique'">
                                        <i :class="recipe.is_visible ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                    </button>
                                    <button v-if="!recipe.is_supprimer" @click="confirmDelete(recipe)" 
                                            class="text-red-600 hover:text-red-900 cursor-pointer"
                                            title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="recipes.data.length === 0">
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    Aucune recette trouvée.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex justify-center">
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <Link v-for="(link, k) in recipes.links" :key="k"
                              :href="link.url || '#'"
                              v-html="link.label"
                              class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                              :class="[
                                  link.active ? 'z-10 bg-emerald-50 border-emerald-500 text-emerald-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                                  !link.url ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'
                              ]"
                        />
                    </nav>
                </div>
            </div>
        </div>

        <!-- Confirm Modal -->
        <PremiumConfirmModal 
            :show="showConfirmModal"
            title="Supprimer la recette"
            :message="'Voulez-vous vraiment marquer la recette ' + selectedRecipe?.title + ' comme supprimée ?'"
            @confirm="deleteRecipe"
            @close="showConfirmModal = false"
        />
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PremiumConfirmModal from "@/Components/PremiumConfirmModal.vue";

const props = defineProps({
    recipes: Object,
});

const showConfirmModal = ref(false);
const selectedRecipe = ref(null);

const toggleVisibility = (recipe) => {
    router.post(route('admin.recipes.toggle-visibility', recipe.id), {}, {
        preserveScroll: true,
    });
};

const confirmDelete = (recipe) => {
    selectedRecipe.value = recipe;
    showConfirmModal.value = true;
};

const deleteRecipe = () => {
    router.delete(route('admin.recipes.destroy', selectedRecipe.value.id), {
        preserveScroll: true,
        onSuccess: () => {
            showConfirmModal.value = false;
        }
    });
};
</script>
