<template>
    <AdminLayout>
        <div class="py-6">
            <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-8 flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            Gestion des Ingrédients
                        </h1>
                        <p class="mt-1 text-sm text-gray-500">
                            Gérez votre base de données d'ingrédients.
                        </p>
                    </div>
                    <button
                        @click="openAddModal"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 cursor-pointer whitespace-nowrap !rounded-button"
                    >
                        <i class="fas fa-plus mr-2"></i>
                        Ajouter un Ingrédient
                    </button>
                </div>

                <!-- Ingredients Table -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Type
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="ingredient in ingredients" :key="ingredient.id">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ ingredient.id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ ingredient.name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ ingredient.category }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span :class="[ ingredient.status === 'Certifié' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800', 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full' ]">
                                        <i v-if="ingredient.status === 'Certifié'" class="fas fa-check-circle mr-1"></i>
                                        {{ ingredient.status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button @click="toggleCertification(ingredient)" title="Basculer la certification" class="text-blue-600 hover:text-blue-900 mr-3 cursor-pointer">
                                        <i class="fas fa-award"></i>
                                    </button>
                                    <button @click="editIngredient(ingredient)" title="Modifier" class="text-emerald-600 hover:text-emerald-900 mr-3 cursor-pointer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button @click="confirmDelete(ingredient)" title="Supprimer" class="text-red-600 hover:text-red-900 cursor-pointer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="ingredients.length === 0">
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    Aucun ingrédient trouvé.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add/Edit Modal -->
        <div v-if="showModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="closeModal" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form @submit.prevent="submitForm">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">
                                {{ form.id ? "Modifier l'Ingrédient" : "Ajouter un Ingrédient" }}
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom de l'ingrédient</label>
                                    <input type="text" id="nom" v-model="form.nom" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" required />
                                    <div v-if="form.errors.nom" class="text-red-500 text-xs mt-1">{{ form.errors.nom }}</div>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Type d'ingrédient</label>
                                    <select id="type" v-model="form.aliment_type_id" class="mt-1 block w-full pl-3 pr-10 py-2 border-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm rounded-md border" required>
                                        <option value="" disabled>Sélectionnez un type</option>
                                        <option v-for="type in types" :key="type.id" :value="type.id">
                                            {{ type.name }}
                                        </option>
                                    </select>
                                    <div v-if="form.errors.aliment_type_id" class="text-red-500 text-xs mt-1">{{ form.errors.aliment_type_id }}</div>
                                </div>
                                <div class="flex items-center mt-2">
                                    <input id="certified" type="checkbox" v-model="form.is_certified" class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                                    <label for="certified" class="ml-2 block text-sm text-gray-900">Ingrédient certifié</label>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" :disabled="form.processing" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50">
                                {{ form.id ? 'Sauvegarder' : 'Créer' }}
                            </button>
                            <button type="button" @click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
    ingredients: Array,
    types: Array
});

const showModal = ref(false);

const form = useForm({
    id: null,
    nom: "",
    aliment_type_id: "",
    is_certified: false
});

const openAddModal = () => {
    form.reset();
    form.clearErrors();
    form.is_certified = false;
    showModal.value = true;
};

const editIngredient = (ing) => {
    form.reset();
    form.clearErrors();
    form.id = ing.id;
    form.nom = ing.name;
    form.aliment_type_id = ing.aliment_type_id;
    form.is_certified = ing.status === 'Certifié';
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
};

const submitForm = () => {
    if (form.id) {
        form.put(route('admin.ingredients.update', form.id), {
            onSuccess: () => closeModal(),
        });
    } else {
        form.post(route('admin.ingredients.store'), {
            onSuccess: () => closeModal(),
        });
    }
};

const toggleCertification = (ing) => {
    router.post(route('admin.ingredients.certify', ing.id), {}, { preserveScroll: true });
}

const confirmDelete = (ing) => {
    if (confirm(`Êtes-vous sûr de vouloir supprimer l'ingrédient "${ing.name}" ?`)) {
        router.delete(route('admin.ingredients.destroy', ing.id), {
            preserveScroll: true,
        });
    }
};
</script>
