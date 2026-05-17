<template>
    <AdminLayout>
        <div class="py-6">
            <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-8 flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Gestion des Groupes</h1>
                        <p class="mt-1 text-sm text-gray-500">Gérez les groupes familiaux et leurs accès.</p>
                    </div>
                </div>

                <!-- Groups Table -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Groupe</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Membres</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de création</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="group in groups.data" :key="group.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-emerald-100 flex-shrink-0 flex items-center justify-center text-emerald-600">
                                            <i class="fas fa-user-friends text-lg"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ group.nom }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ group.membres_count }} membres
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ new Date(group.created_at).toLocaleDateString() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button @click="confirmDelete(group)" 
                                            class="text-red-600 hover:text-red-900 cursor-pointer"
                                            title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="groups.data.length === 0">
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                    Aucun groupe trouvé.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex justify-center">
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <Link v-for="(link, k) in groups.links" :key="k"
                              :href="link.url || '#'"
                              v-html="link.label"
                              class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                              :class="[
                                  link.active ? 'z-10 bg-purple-50 border-purple-500 text-purple-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
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
            title="Supprimer le groupe"
            :message="'Voulez-vous vraiment supprimer le groupe familial ' + selectedGroup?.nom + ' ? Cette action est irréversible.'"
            @confirm="deleteGroup"
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
    groups: Object,
});

const showConfirmModal = ref(false);
const selectedGroup = ref(null);

const confirmDelete = (group) => {
    selectedGroup.value = group;
    showConfirmModal.value = true;
};

const deleteGroup = () => {
    router.delete(route('admin.groups.destroy', selectedGroup.value.id), {
        preserveScroll: true,
        onSuccess: () => {
            showConfirmModal.value = false;
        }
    });
};
</script>
