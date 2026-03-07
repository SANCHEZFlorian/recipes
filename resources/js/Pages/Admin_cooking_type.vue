<template>
    <AdminLayout>
        <div class="py-6">
            <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-8 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">
                            Types de Cuisson
                        </h1>
                        <p class="mt-1 text-sm text-gray-500">
                            Gérez les méthodes de cuisson (ex: Four, Poêle, etc.).
                        </p>
                    </div>
                    <button
                        @click="openAddModal"
                        class="bg-emerald-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-emerald-700 shadow-sm shadow-emerald-600/20 transition-all flex items-center gap-2"
                    >
                        <i class="fas fa-plus mr-2"></i>
                        Ajouter un Type
                    </button>
                </div>

                <!-- Types Table -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Icône
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Type de cuisson
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr
                                v-for="type in types"
                                :key="type.id"
                            >
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ type.id }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="h-10 w-10 flex-shrink-0 flex items-center justify-center bg-emerald-100 rounded-full text-emerald-600">
                                        <i v-if="type.icone" :class="[type.icone, 'text-lg']"></i>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ type.nom }}
                                    </div>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                                >
                                    <button
                                        @click="openEditModal(type)"
                                        class="text-emerald-600 hover:text-emerald-900 mr-3 cursor-pointer"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button
                                        @click="deleteType(type.id)"
                                        class="text-red-600 hover:text-red-900 cursor-pointer"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="types.length === 0">
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                    Aucun type de cuisson trouvé.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add/Edit Modal -->
        <div v-if="isModalOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="closeModal" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-6 py-4">
                        <div class="flex justify-between items-center mb-4">
                            <h3
                                class="text-xl font-bold text-gray-900"
                            >
                                {{
                                    isEditing
                                        ? "Modifier le Type"
                                        : "Nouveau Type"
                                }}
                            </h3>
                            <button
                                @click="closeModal"
                                class="text-gray-400 hover:text-gray-500"
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
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>

                        <form @submit.prevent="submitForm">
                            <div class="px-6 py-4 space-y-4">
                                <!-- Nom -->
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-1"
                                        >Nom du type</label
                                    >
                                    <input
                                        v-model="form.nom"
                                        type="text"
                                        required
                                        class="w-full border-gray-200 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                        placeholder="Ex: Four, Poêle..."
                                    />
                                    <p
                                        v-if="form.errors.nom"
                                        class="mt-1 text-sm text-red-600"
                                    >
                                        {{ form.errors.nom }}
                                    </p>
                                </div>
                                
                                <!-- Icône -->
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-1"
                                        >Icône (Classe Flaticon / FontAwesome)</label
                                    >
                                    <input
                                        v-model="form.icone"
                                        type="text"
                                        class="w-full border-gray-200 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                        placeholder="Ex: fi fi-rr-fire"
                                    />
                                    <p
                                        v-if="form.errors.icone"
                                        class="mt-1 text-sm text-red-600"
                                    >
                                        {{ form.errors.icone }}
                                    </p>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="submit" :disabled="form.processing" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50">
                                    {{ isEditing ? 'Sauvegarder' : 'Créer' }}
                                </button>
                                <button type="button" @click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Annuler
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { Head, useForm, router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
    types: {
        type: Array,
        required: true,
    }
});

const isModalOpen = ref(false);
const isEditing = ref(false);
const editingId = ref(null);

const form = useForm({
    nom: "",
    icone: "",
});

const openAddModal = () => {
    isEditing.value = false;
    editingId.value = null;
    form.reset();
    form.clearErrors();
    isModalOpen.value = true;
};

const openEditModal = (type) => {
    isEditing.value = true;
    editingId.value = type.id;
    form.nom = type.nom;
    form.icone = type.icone;
    form.clearErrors();
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
    setTimeout(() => {
        form.reset();
        form.clearErrors();
    }, 200);
};

const submitForm = () => {
    if (isEditing.value) {
        form.put(route("admin.cooking-types.update", editingId.value), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
        });
    } else {
        form.post(route("admin.cooking-types.store"), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
        });
    }
};

const deleteType = (id) => {
    if (confirm("Êtes-vous sûr de vouloir supprimer ce type de cuisson ?")) {
        router.delete(route("admin.cooking-types.destroy", id), {
            preserveScroll: true,
        });
    }
};
</script>
