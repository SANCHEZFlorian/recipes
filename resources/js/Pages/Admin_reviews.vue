<template>
    <AdminLayout>
        <div class="py-6">
            <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Modération des Avis & Commentaires</h1>
                    <p class="mt-1 text-sm text-gray-500">Gérez les retours utilisateurs et modérez les contenus.</p>
                </div>

                <!-- Tabs -->
                <div class="mb-6 border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <button 
                            @click="changeTab('avis')"
                            :class="[currentTab === 'avis' ? 'border-emerald-500 text-emerald-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm cursor-pointer']"
                        >
                            Avis & Notes
                        </button>
                        <button 
                            @click="changeTab('comments')"
                            :class="[currentTab === 'comments' ? 'border-emerald-500 text-emerald-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm cursor-pointer']"
                        >
                            Commentaires Simple
                        </button>
                    </nav>
                </div>

                <!-- Content Table -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Auteur</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recette</th>
                                <th v-if="currentTab === 'avis'" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Note</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contenu</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="item in data.data" :key="item.id">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ item.user?.username || 'Utilisateur inconnu' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ item.recette?.title || 'Recette supprimée' }}
                                </td>
                                <td v-if="currentTab === 'avis'" class="px-6 py-4 whitespace-nowrap text-sm text-amber-500 font-bold">
                                    <i class="fas fa-star mr-1"></i>{{ item.note }}/5
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                    {{ item.commentaire }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ new Date(item.created_at).toLocaleDateString() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button @click="confirmDelete(item)" 
                                            class="text-red-600 hover:text-red-900 cursor-pointer"
                                            title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="data.data.length === 0">
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    Aucun contenu à modérer dans cette section.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex justify-center">
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <Link v-for="(link, k) in data.links" :key="k"
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
            title="Supprimer le contenu"
            :message="'Êtes-vous sûr de vouloir supprimer cet ' + (currentTab === 'avis' ? 'avis' : 'commentaire') + ' ?'"
            @confirm="deleteItem"
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
    data: Object,
    currentTab: String
});

const showConfirmModal = ref(false);
const selectedItem = ref(null);

const changeTab = (tab) => {
    router.get(route('admin.reviews'), { tab: tab }, { preserveState: true });
};

const confirmDelete = (item) => {
    selectedItem.value = item;
    showConfirmModal.value = true;
};

const deleteItem = () => {
    const deleteRoute = props.currentTab === 'avis' 
        ? route('admin.reviews.avis.destroy', selectedItem.value.id) 
        : route('admin.reviews.comments.destroy', selectedItem.value.id);
        
    router.delete(deleteRoute, {
        preserveScroll: true,
        onSuccess: () => {
            showConfirmModal.value = false;
        }
    });
};
</script>
