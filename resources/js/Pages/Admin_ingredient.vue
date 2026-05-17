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
                        class="premium-button-primary"
                    >
                        <i class="fas fa-plus mr-2"></i>
                        Ajouter un Ingrédient
                    </button>
                </div>

                <!-- Ingredients Table -->
                <div class="premium-table-container">
                    <table class="premium-table">
                        <thead>
                            <tr>
                                <th class="w-20">ID</th>
                                <th>Nom</th>
                                <th>Type</th>
                                <th>Statut</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr v-for="ingredient in ingredients" :key="ingredient.id">
                                <td class="text-xs font-black text-slate-400">
                                    #{{ ingredient.id }}
                                </td>
                                <td>
                                    <div class="text-sm font-black text-slate-900">
                                        {{ ingredient.name }}
                                    </div>
                                </td>
                                <td class="text-sm font-medium text-slate-500">
                                    {{ ingredient.category }}
                                </td>
                                <td>
                                    <span :class="[ 
                                        ingredient.status === 'Certifié' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500', 
                                        'px-2.5 py-1 inline-flex text-[10px] font-black uppercase tracking-wider rounded-lg items-center gap-1.5' 
                                    ]">
                                        <i v-if="ingredient.status === 'Certifié'" class="fas fa-check-circle"></i>
                                        {{ ingredient.status }}
                                    </span>
                                </td>
                                <td class="text-right">
                                    <div class="flex justify-end gap-2">
                                        <button @click="toggleCertification(ingredient)" title="Basculer la certification" class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors hover:bg-slate-100 text-slate-400 hover:text-amber-500 cursor-pointer">
                                            <i class="fas fa-award"></i>
                                        </button>
                                        <button @click="editIngredient(ingredient)" title="Modifier" class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors hover:bg-slate-100 text-slate-400 hover:text-emerald-600 cursor-pointer">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button @click="confirmDelete(ingredient)" title="Supprimer" class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors hover:bg-rose-50 text-slate-400 hover:text-rose-600 cursor-pointer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="ingredients.length === 0">
                                <td colspan="5" class="px-6 py-16 text-center text-slate-400 font-medium">
                                    Aucun ingrédient trouvé dans la base.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div v-if="showModal" class="premium-modal-backdrop">
            <div class="premium-modal-content">
                <form @submit.prevent="submitForm">
                    <div class="p-10">
                        <h3 class="text-3xl font-black text-slate-900 mb-8 tracking-tight">
                            {{ form.id ? "Modifier l'Ingrédient" : "Nouvel Ingrédient" }}
                        </h3>
                        <div class="space-y-6">
                            <div>
                                <label for="nom" class="premium-label">Nom de l'ingrédient</label>
                                <input type="text" id="nom" v-model="form.nom" class="premium-input" placeholder="Ex: Farine de blé" required />
                                <div v-if="form.errors.nom" class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ form.errors.nom }}</div>
                            </div>
                            <div>
                                <label for="type" class="premium-label">Type d'ingrédient</label>
                                <PremiumSelect
                                    id="type"
                                    v-model="form.aliment_type_id"
                                    :options="types"
                                    placeholder="Sélectionnez un type"
                                    label-key="name"
                                    required
                                />
                                <div v-if="form.errors.aliment_type_id" class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ form.errors.aliment_type_id }}</div>
                            </div>
                            <label class="flex items-center cursor-pointer p-4 rounded-2xl border-2 border-slate-100 w-full transition-all hover:border-emerald-200 hover:bg-emerald-50/30 group">
                                <input id="certified" type="checkbox" v-model="form.is_certified" class="h-6 w-6 text-emerald-600 focus:ring-emerald-500/20 border-slate-200 rounded-lg shadow-inner">
                                <span class="ml-4 block text-sm font-black text-slate-700">Ingrédient certifié</span>
                            </label>
                        </div>
                    </div>
                    <div class="bg-slate-50/50 px-10 py-8 flex flex-row-reverse gap-4 border-t border-slate-100">
                        <button type="submit" :disabled="form.processing" class="premium-button-primary">
                            {{ form.id ? 'Enregistrer' : 'Créer l\'ingrédient' }}
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
            title="Supprimer l'ingrédient"
            :message="'Voulez-vous vraiment supprimer l\'ingrédient ' + selectedIngredient?.name + ' ?'"
            @confirm="deleteIngredient"
            @close="showConfirmModal = false"
        />
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PremiumConfirmModal from "@/Components/PremiumConfirmModal.vue";
import PremiumSelect from "@/Components/PremiumSelect.vue";

const props = defineProps({
    ingredients: Array,
    types: Array
});

const showModal = ref(false);
const showConfirmModal = ref(false);
const selectedIngredient = ref(null);

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
    selectedIngredient.value = ing;
    showConfirmModal.value = true;
};

const deleteIngredient = () => {
    router.delete(route('admin.ingredients.destroy', selectedIngredient.value.id), {
        preserveScroll: true,
        onSuccess: () => {
            showConfirmModal.value = false;
        }
    });
};
</script>
