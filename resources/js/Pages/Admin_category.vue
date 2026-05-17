<template>
    <AdminLayout>
        <div class="py-6">
            <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-8 flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            Gestion des Catégories
                        </h1>
                        <p class="mt-1 text-sm text-gray-500">
                            Gérez vos catégories de recettes et leur visibilité.
                        </p>
                    </div>
                    <button
                        @click="openAddModal"
                        class="premium-button-primary"
                    >
                        <i class="fas fa-plus mr-2"></i>
                        Ajouter une Catégorie
                    </button>
                </div>

                <!-- Categories Table -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    ID
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Catégorie
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Permalien
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Recettes
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Statut
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr
                                v-for="category in categories"
                                :key="category.id"
                            >
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ category.id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0 flex items-center justify-center bg-emerald-100 rounded-full text-emerald-600">
                                            <img v-if="category.image"
                                                class="h-10 w-10 rounded-full object-cover"
                                                :src="category.image"
                                                :alt="category.name"
                                            />
                                            <i v-else :class="[category.icon, 'text-lg']"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                {{ category.name }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{
                                                    category.description?.substring(
                                                        0,
                                                        30,
                                                    )
                                                }}...
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                >
                                    {{ category.slug }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                >
                                    {{ category.recipe_count }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        :class="[
                                            category.status === 'Active'
                                                ? 'bg-green-100 text-green-800'
                                                : 'bg-red-100 text-red-800',
                                            'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                        ]"
                                    >
                                        {{
                                            category.status === 'Active'
                                                ? "Actif"
                                                : "Inactif"
                                        }}
                                    </span>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                                >
                                    <button
                                        @click="editCategory(category)"
                                        class="text-emerald-600 hover:text-emerald-900 mr-3 cursor-pointer"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button
                                        @click="confirmDelete(category)"
                                        class="text-red-600 hover:text-red-900 cursor-pointer"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="categories.length === 0">
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    Aucune catégorie trouvée.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add/Edit Modal -->
        <div v-if="showModal" class="premium-modal-backdrop">
            <div class="premium-modal-content">
                <form @submit.prevent="submitForm">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">
                            {{ form.id ? "Modifier la Catégorie" : "Ajouter une Catégorie" }}
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <label for="nom" class="premium-label">Nom de la Catégorie</label>
                                <input type="text" id="nom" v-model="form.nom" class="premium-input" placeholder="Ex: Entrées" required />
                                <div v-if="form.errors.nom" class="text-red-500 text-xs mt-1 ml-1">{{ form.errors.nom }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50/50 px-8 py-6 flex flex-row-reverse gap-4 border-t border-gray-100">
                        <button type="submit" :disabled="form.processing" class="premium-button-primary">
                            {{ form.id ? 'Sauvegarder' : 'Créer' }}
                        </button>
                        <button type="button" @click="closeModal" class="premium-button-secondary">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Confirm Modal -->
        <PremiumConfirmModal 
            :show="showConfirmModal"
            title="Supprimer la catégorie"
            :message="'Voulez-vous vraiment supprimer la catégorie ' + selectedCategory?.name + ' ?'"
            @confirm="deleteCategory"
            @close="showConfirmModal = false"
        />
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PremiumConfirmModal from "@/Components/PremiumConfirmModal.vue";

const props = defineProps({
    categories: Array,
});

const showModal = ref(false);
const showConfirmModal = ref(false);
const selectedCategory = ref(null);

const form = useForm({
    id: null,
    nom: "",
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
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
};

const submitForm = () => {
    if (form.id) {
        form.put(route('admin.categories.update', form.id), {
            onSuccess: () => closeModal(),
        });
    } else {
        form.post(route('admin.categories.store'), {
            onSuccess: () => closeModal(),
        });
    }
};

const confirmDelete = (cat) => {
    selectedCategory.value = cat;
    showConfirmModal.value = true;
};

const deleteCategory = () => {
    router.delete(route('admin.categories.destroy', selectedCategory.value.id), {
        preserveScroll: true,
        onSuccess: () => {
            showConfirmModal.value = false;
        }
    });
};
</script>
