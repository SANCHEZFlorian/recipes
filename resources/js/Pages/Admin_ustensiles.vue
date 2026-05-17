<template>
    <AdminLayout>
        <div class="py-6">
            <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-8 flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Gestion des Ustensiles</h1>
                        <p class="mt-1 text-sm text-gray-500">Gérez la liste des outils de cuisine disponibles.</p>
                    </div>
                    <button @click="openCreateModal" class="bg-emerald-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-emerald-700 transition-colors flex items-center">
                        <i class="fas fa-plus mr-2"></i> Nouvel Ustensile
                    </button>
                </div>

                <!-- Ustensiles Table -->
                <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-gray-100">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icône</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="ustensile in ustensiles" :key="ustensile.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="h-10 w-10 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                                        <i :class="ustensile.icone || 'fas fa-blender'"></i>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ ustensile.nom }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button @click="openEditModal(ustensile)" class="text-indigo-600 hover:text-indigo-900 mr-4 cursor-pointer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button @click="confirmDelete(ustensile)" class="text-red-600 hover:text-red-900 cursor-pointer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="ustensiles.length === 0">
                                <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                    Aucun ustensile trouvé.
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
                    {{ isEditing ? 'Modifier l\'ustensile' : 'Nouvel ustensile' }}
                </h3>
                
                <div class="space-y-5">
                    <div>
                        <label class="premium-label">Nom</label>
                        <input v-model="form.nom" type="text" class="premium-input" placeholder="Ex: Mixeur plongeant" />
                    </div>
                    <div>
                        <label class="premium-label">Icône (FontAwesome class)</label>
                        <input v-model="form.icone" type="text" class="premium-input" placeholder="Ex: fas fa-blender" />
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
    ustensiles: Array
});

const showModal = ref(false);
const isEditing = ref(false);
const editingId = ref(null);

const form = reactive({
    nom: "",
    icone: ""
});

const openCreateModal = () => {
    isEditing.value = false;
    form.nom = "";
    form.icone = "fas fa-blender";
    showModal.value = true;
};

const openEditModal = (ustensile) => {
    isEditing.value = true;
    editingId.value = ustensile.id;
    form.nom = ustensile.nom;
    form.icone = ustensile.icone;
    showModal.value = true;
};

const submitForm = () => {
    if (isEditing.value) {
        router.put(route('admin.ustensiles.update', editingId.value), form, {
            onSuccess: () => { showModal.value = false; }
        });
    } else {
        router.post(route('admin.ustensiles.store'), form, {
            onSuccess: () => { showModal.value = false; }
        });
    }
};

const confirmDelete = (ustensile) => {
    if (confirm(`Voulez-vous vraiment supprimer l'ustensile "${ustensile.nom}" ?`)) {
        router.delete(route('admin.ustensiles.destroy', ustensile.id));
    }
};
</script>
