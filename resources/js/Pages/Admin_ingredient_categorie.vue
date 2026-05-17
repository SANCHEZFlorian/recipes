<template>
    <AdminLayout>
        <div class="py-6">
            <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-8 flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            Gestion des Types d'Ingrédients
                        </h1>
                        <p class="mt-1 text-sm text-gray-500">
                            Gérez vos catégories/types d'ingrédients.
                        </p>
                    </div>
                    <button
                        @click="openAddModal"
                        class="premium-button-primary"
                    >
                        <i class="fas fa-plus mr-2"></i>
                        Ajouter un Type
                    </button>
                </div>

                <!-- Categories Table -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Type d'ingrédient
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Permalien
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ingrédients
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
                            <tr v-for="category in categories" :key="category.id">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-500">
                                    #{{ category.id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <template v-if="category.image && (category.image.includes('fa-') || category.image.includes('fi-') || category.image.includes('fi '))">
                                                <div class="h-10 w-10 rounded-full flex items-center justify-center bg-emerald-100 text-emerald-600 text-lg">
                                                    <i :class="category.image"></i>
                                                </div>
                                            </template>
                                            <template v-else-if="category.image && !category.image.includes('f')">
                                                <div class="h-10 w-10 rounded-full flex items-center justify-center bg-emerald-100 text-emerald-600 text-xl font-medium">
                                                    {{ category.image }}
                                                </div>
                                            </template>
                                            <template v-else>
                                                <img class="h-10 w-10 rounded-full object-cover" :src="category.image" alt="" />
                                            </template>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ category.name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ category.slug }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ category.ingredientCount }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span :class="[ category.status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800', 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full' ]">
                                        {{ category.status === 'Active' ? "Actif" : "Inactif" }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button @click="editCategory(category)" class="text-emerald-600 hover:text-emerald-900 mr-3 cursor-pointer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button @click="confirmDelete(category)" class="text-red-600 hover:text-red-900 cursor-pointer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="categories.length === 0">
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    Aucun type d'ingrédient trouvé.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add/Edit Modal -->
        <div v-if="showModal" class="premium-modal-backdrop" @click.self="closeModal">
            <div class="premium-modal-content max-w-md p-6 bg-white rounded-3xl shadow-2xl relative">
                <button @click="closeModal" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
                
                <h3 class="text-2xl font-black text-slate-900 mb-6">
                    {{ form.id ? "Modifier le Type d'ingrédient" : "Ajouter un Type d'ingrédient" }}
                </h3>
                
                <form @submit.prevent="submitForm">
                    <div class="space-y-5">
                        <div>
                            <label for="nom" class="premium-label">Nom du Type</label>
                            <input type="text" id="nom" v-model="form.nom" class="premium-input" placeholder="Ex: Légumes" required />
                            <div v-if="form.errors.nom" class="text-red-500 text-xs mt-1">{{ form.errors.nom }}</div>
                        </div>
                        <div>
                            <label for="icone" class="premium-label">Icône (ex: 🍎, ou fa-solid fa-apple-whole)</label>
                            <input type="text" id="icone" v-model="form.icone" class="premium-input" placeholder="Ex: 🍎" />
                            <div v-if="form.errors.icone" class="text-red-500 text-xs mt-1">{{ form.errors.icone }}</div>
                        </div>
                    </div>

                    <div class="flex gap-3 mt-8">
                        <button type="button" @click="closeModal" class="premium-button-secondary flex-1">
                            Annuler
                        </button>
                        <button type="submit" :disabled="form.processing" class="premium-button-primary flex-1 disabled:opacity-50">
                            {{ form.id ? 'Sauvegarder' : 'Créer' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
    categories: Array,
});

const showModal = ref(false);

const form = useForm({
    id: null,
    nom: "",
    icone: "",
});

const openAddModal = () => {
    form.reset();
    form.clearErrors();
    showModal.value = true;
};

const editCategory = (cat) => {
    form.reset();
    form.clearErrors();
    form.id = cat.id;
    form.nom = cat.name;
    // icone maps to image property in our controller mapping
    form.icone = cat.image && !cat.image.includes('/storage/') ? cat.image : "";
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
};

const submitForm = () => {
    if (form.id) {
        form.put(route('admin.ingredient-categories.update', form.id), {
            onSuccess: () => closeModal(),
        });
    } else {
        form.post(route('admin.ingredient-categories.store'), {
            onSuccess: () => closeModal(),
        });
    }
};

const confirmDelete = (cat) => {
    if (confirm(`Êtes-vous sûr de vouloir supprimer le type "${cat.name}" ?`)) {
        router.delete(route('admin.ingredient-categories.destroy', cat.id), {
            preserveScroll: true,
        });
    }
};
</script>
