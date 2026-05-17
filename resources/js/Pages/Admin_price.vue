<template>
    <AdminLayout>
        <div class="py-6">
            <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-8 flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Gestion des Budgets</h1>
                        <p class="mt-1 text-sm text-gray-500">Gérez les différentes fourchettes de prix des recettes.</p>
                    </div>
                    <button @click="openCreateModal" class="bg-emerald-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-emerald-700 transition-colors flex items-center">
                        <i class="fas fa-plus mr-2"></i> Nouveau Niveau de Prix
                    </button>
                </div>

                <!-- Content Table -->
                <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-gray-100">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Budget / Prix</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="price in prices" :key="price.id">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ price.nom }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button @click="openEditModal(price)" class="text-indigo-600 hover:text-indigo-900 mr-4 cursor-pointer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button @click="confirmDelete(price)" class="text-red-600 hover:text-red-900 cursor-pointer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="prices.length === 0">
                                <td colspan="2" class="px-6 py-12 text-center text-gray-500">
                                    Aucun niveau de prix trouvé.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div v-if="showModal" class="premium-modal-backdrop" @click.self="showModal = false">
            <div class="premium-modal-content max-w-md p-6 bg-white rounded-3xl shadow-2xl relative">
                <button @click="showModal = false" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
                
                <h3 class="text-2xl font-black text-slate-900 mb-6">
                    {{ isEditing ? 'Modifier le niveau de prix' : 'Nouveau niveau de prix' }}
                </h3>
                
                <div class="space-y-5">
                    <div>
                        <label class="premium-label">Nom (ex: Bon marché, $$$)</label>
                        <input v-model="form.nom" type="text" class="premium-input" placeholder="Ex: Luxueux" />
                    </div>
                </div>

                <div class="flex gap-3 mt-8">
                    <button @click="showModal = false" class="premium-button-secondary flex-1">
                        Annuler
                    </button>
                    <button @click="submitForm" class="premium-button-primary flex-1">
                        {{ isEditing ? 'Mettre à jour' : 'Ajouter' }}
                    </button>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref, reactive } from "vue";
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
    prices: Array
});

const showModal = ref(false);
const isEditing = ref(false);
const editingId = ref(null);

const form = reactive({
    nom: ""
});

const openCreateModal = () => {
    isEditing.value = false;
    form.nom = "";
    showModal.value = true;
};

const openEditModal = (price) => {
    isEditing.value = true;
    editingId.value = price.id;
    form.nom = price.nom;
    showModal.value = true;
};

const submitForm = () => {
    if (isEditing.value) {
        router.put(route('admin.prices.update', editingId.value), form, {
            onSuccess: () => { showModal.value = false; }
        });
    } else {
        router.post(route('admin.prices.store'), form, {
            onSuccess: () => { showModal.value = false; }
        });
    }
};

const confirmDelete = (price) => {
    if (confirm(`Voulez-vous vraiment supprimer ce niveau de prix "${price.nom}" ?`)) {
        router.delete(route('admin.prices.destroy', price.id));
    }
};
</script>
