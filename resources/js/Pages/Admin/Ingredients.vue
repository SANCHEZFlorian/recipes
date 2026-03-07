<template>
    <VitrineLayout>
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h1 class="text-3xl font-black text-gray-900 mb-2">Gestion des Ingrédients</h1>
                    <p class="text-gray-500 font-medium">Validez, corrigez ou supprimez les ingrédients du système.</p>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100 text-xs font-bold text-gray-400 uppercase tracking-widest">
                            <th class="px-6 py-4">Nom</th>
                            <th class="px-6 py-4">Type</th>
                            <th class="px-6 py-4 text-center">Statut</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <tr v-for="ing in ingredients" :key="ing.id" class="hover:bg-gray-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <template v-if="editingId === ing.id">
                                    <input v-model="editForm.nom" type="text" class="px-3 py-1.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-emerald-500">
                                </template>
                                <template v-else>
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                                            <i :class="ing.icone || 'fas fa-question-circle'"></i>
                                        </div>
                                        <span class="font-bold text-gray-900">{{ ing.nom }}</span>
                                    </div>
                                </template>
                            </td>
                            <td class="px-6 py-4">
                                <template v-if="editingId === ing.id">
                                    <select v-model="editForm.aliment_type_id" class="px-3 py-1.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-emerald-500 bg-white">
                                        <option v-for="t in types" :key="t.id" :value="t.id">{{ t.nom }}</option>
                                    </select>
                                </template>
                                <template v-else>
                                    <span v-if="ing.aliment_type" class="text-sm font-medium text-gray-600">{{ ing.aliment_type.nom }}</span>
                                    <span v-else class="text-xs italic text-red-400">Non défini</span>
                                </template>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center">
                                    <span v-if="ing.is_certified" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                        Certifié
                                    </span>
                                    <span v-else class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                                        En attente
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <template v-if="editingId === ing.id">
                                        <button @click="saveEdit(ing)" class="text-emerald-600 hover:text-emerald-700 font-bold text-sm px-3 py-1.5 bg-emerald-50 rounded-lg">Enregistrer</button>
                                        <button @click="editingId = null" class="text-gray-400 hover:text-gray-600 font-bold text-sm px-3 py-1.5">Annuler</button>
                                    </template>
                                    <template v-else>
                                        <button v-if="!ing.is_certified" @click="certify(ing.id)" class="text-amber-600 hover:text-amber-700 font-bold text-xs uppercase px-2 py-1 bg-amber-50 rounded-md">Certifier</button>
                                        <button @click="startEdit(ing)" class="text-gray-400 hover:text-emerald-600 p-1.5 transition-colors">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </button>
                                        <button @click="deleteIng(ing.id)" class="text-gray-400 hover:text-red-600 p-1.5 transition-colors">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </template>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </VitrineLayout>
</template>

<script setup>
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import VitrineLayout from '@/Layouts/VitrineLayout.vue';

const props = defineProps({
    ingredients: Array,
    types: Array
});

const editingId = ref(null);
const editForm = useForm({
    nom: '',
    aliment_type_id: '',
    is_certified: false
});

const startEdit = (ing) => {
    editingId.value = ing.id;
    editForm.nom = ing.nom;
    editForm.aliment_type_id = ing.aliment_type_id;
    editForm.is_certified = !!ing.is_certified;
};

const saveEdit = (ing) => {
    editForm.put(route('admin.ingredients.update', ing.id), {
        onSuccess: () => editingId.value = null,
    });
};

const certify = (id) => {
    router.post(route('admin.ingredients.certify', id));
};

const deleteIng = (id) => {
    if (confirm('Voulez-vous vraiment supprimer cet ingrédient ?')) {
        router.delete(route('admin.ingredients.destroy', id));
    }
};
</script>
