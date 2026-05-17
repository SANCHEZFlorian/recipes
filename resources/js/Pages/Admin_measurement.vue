<template>
    <AdminLayout>
        <div class="py-6">
            <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-8 flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            Unités de Mesure
                        </h1>
                        <p class="mt-1 text-sm text-gray-500">
                            Gérez les unités de mesure utilisées dans les recettes (ex: kg, cuillère à soupe).
                        </p>
                    </div>
                    <button
                        @click="openAddModal"
                        class="premium-button-primary"
                    >
                        <i class="fas fa-plus mr-2"></i>
                        Ajouter une Unité
                    </button>
                </div>

                <!-- Measurements Table -->
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
                                    Nom
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Abréviation
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="unit in measurements" :key="unit.id">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ unit.id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center h-10 w-10 bg-emerald-100 rounded-full text-emerald-600">
                                        <i :class="[unit.icon, 'text-lg']"></i>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ unit.name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ unit.abbreviation }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button @click="editUnit(unit)" class="text-emerald-600 hover:text-emerald-900 mr-3 cursor-pointer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button @click="confirmDelete(unit)" class="text-red-600 hover:text-red-900 cursor-pointer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="measurements.length === 0">
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    Aucune unité de mesure trouvée.
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
                            {{ form.id ? "Modifier l'Unité" : "Ajouter une Unité" }}
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <label for="nom" class="premium-label">Nom</label>
                                <input type="text" id="nom" v-model="form.nom" placeholder="ex: Cuillère à soupe" class="premium-input" required />
                                <div v-if="form.errors.nom" class="text-red-500 text-xs mt-1 ml-1">{{ form.errors.nom }}</div>
                            </div>
                            <div>
                                <label for="abreviation" class="premium-label">Abréviation</label>
                                <input type="text" id="abreviation" v-model="form.abreviation" placeholder="ex: c.à.s" class="premium-input" required />
                                <div v-if="form.errors.abreviation" class="text-red-500 text-xs mt-1 ml-1">{{ form.errors.abreviation }}</div>
                            </div>
                            <div>
                                <label for="icone" class="premium-label">Icône (FontAwesome class)</label>
                                <input type="text" id="icone" v-model="form.icone" placeholder="ex: fas fa-balance-scale" class="premium-input" />
                                <p class="mt-1 text-xs text-gray-500">Laissez vide pour l'icône par défaut.</p>
                                <div v-if="form.errors.icone" class="text-red-500 text-xs mt-1 ml-1">{{ form.errors.icone }}</div>
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
            title="Supprimer l'unité"
            :message="'Voulez-vous vraiment supprimer l\'unité ' + selectedUnit?.name + ' ?'"
            @confirm="deleteUnit"
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
    measurements: Array,
});

const showModal = ref(false);
const showConfirmModal = ref(false);
const selectedUnit = ref(null);

const form = useForm({
    id: null,
    nom: "",
    abreviation: "",
    icone: "",
});

const openAddModal = () => {
    form.reset();
    form.clearErrors();
    showModal.value = true;
};

const editUnit = (unit) => {
    form.reset();
    form.clearErrors();
    form.id = unit.id;
    form.nom = unit.name;
    form.abreviation = unit.abbreviation;
    form.icone = unit.icon === 'fas fa-balance-scale' ? '' : unit.icon;
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
};

const submitForm = () => {
    if (form.id) {
        form.put(route('admin.measurements.update', form.id), {
            onSuccess: () => closeModal(),
        });
    } else {
        form.post(route('admin.measurements.store'), {
            onSuccess: () => closeModal(),
        });
    }
};

const confirmDelete = (unit) => {
    selectedUnit.value = unit;
    showConfirmModal.value = true;
};

const deleteUnit = () => {
    router.delete(route('admin.measurements.destroy', selectedUnit.value.id), {
        preserveScroll: true,
        onSuccess: () => {
            showConfirmModal.value = false;
        }
    });
};
</script>
