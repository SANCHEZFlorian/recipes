<template>
    <Head>
        <title>Modifier la Recette</title>
        <meta name="robots" content="noindex, nofollow" />
    </Head>
    <VitrineLayout>
        <!-- Header -->
        <div class="bg-emerald-600 text-white py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
            <div class="absolute inset-0 z-0">
                <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-white/20 via-transparent to-transparent"></div>
            </div>
            
            <div class="max-w-4xl mx-auto relative z-10">
                <h1 class="text-3xl md:text-5xl font-black mb-4 tracking-tight">Modifier la Recette</h1>
                <p class="text-emerald-50 text-lg font-medium">Mettez à jour les informations de votre création culinaire pour la communauté.</p>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <form @submit.prevent="submitForm" class="space-y-12">
                
                <!-- Section 1: Informations de base -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-lg">1</div>
                        <h2 class="text-2xl font-bold text-gray-900">Informations Principales</h2>
                    </div>

                    <div class="space-y-6">
                        <!-- Titre -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Titre de la recette</label>
                                <input v-model="form.title" type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition-all font-medium text-lg placeholder:font-normal" placeholder="Ex: Gratin Dauphinois Traditionnel" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Photo de couverture</label>
                                <div class="relative h-[52px]">
                                    <input type="file" @input="form.photo = $event.target.files[0]" id="photo_upload" class="sr-only" accept="image/*">
                                    <label for="photo_upload" class="flex items-center justify-center w-full h-full border-2 border-dashed border-gray-200 rounded-xl cursor-pointer hover:border-emerald-500 hover:bg-emerald-50 transition-all text-sm font-bold text-gray-500 overflow-hidden">
                                        <template v-if="!form.photo">
                                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            Choisir une photo
                                        </template>
                                        <template v-else>
                                            <span class="text-emerald-600 truncate px-2">{{ form.photo.name }}</span>
                                        </template>
                                    </label>
                                </div>
                                <p v-if="form.errors.photo" class="mt-1 text-xs text-red-500 font-bold">{{ form.errors.photo }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Type -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Type de plat</label>
                                <select v-model="form.recette_type_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition-all bg-white" required>
                                    <option value="" disabled>Sélectionner un type...</option>
                                    <option v-for="type in types" :key="type.id" :value="type.id">{{ type.nom }}</option>
                                </select>
                            </div>

                            <!-- Portions -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nombre de portions</label>
                                <input v-model.number="form.portions" type="number" min="1" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition-all" placeholder="Ex: 4" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Difficulté -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Difficulté</label>
                                <div class="grid grid-cols-3 gap-3">
                                    <label v-for="diff in difficultes" :key="diff.id" class="cursor-pointer">
                                        <input type="radio" v-model="form.difficulte_id" :value="diff.id" class="peer sr-only" required>
                                        <div class="text-center px-3 py-2 rounded-xl border-2 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-700 text-gray-500 font-medium transition-all hover:border-emerald-200">
                                            {{ diff.nom }}
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <!-- Prix -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Coût estimé</label>
                                <div class="grid grid-cols-3 gap-3">
                                    <label v-for="px in prix" :key="px.id" class="cursor-pointer">
                                        <input type="radio" v-model="form.prix_id" :value="px.id" class="peer sr-only" required>
                                        <div class="text-center px-3 py-2 rounded-xl border-2 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-700 text-gray-500 font-medium transition-all hover:border-emerald-200">
                                            {{ px.nom }}
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Groupe -->
                        <div v-if="userGroups && userGroups.length > 0" class="mt-6 border-t border-gray-100 pt-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Partager dans un groupe ? <span class="text-gray-400 font-normal">(Optionnel)</span></label>
                            <select v-model="form.groupe_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition-all bg-white">
                                <option :value="null">Non, rendre cette recette publique</option>
                                <option v-for="group in userGroups" :key="group.id" :value="group.id">
                                    {{ group.nom }}
                                </option>
                            </select>
                            <p class="text-xs text-emerald-600 mt-2 font-medium">Si vous sélectionnez un groupe, seuls ses membres pourront y accéder !</p>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Temps -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-lg">2</div>
                        <h2 class="text-2xl font-bold text-gray-900">Temps nécessaires (en minutes)</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" /></svg>
                                Préparation
                            </label>
                            <input v-model.number="form.temps_preparation" type="number" min="0" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20" placeholder="0" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" /></svg>
                                Cuisson
                            </label>
                            <input v-model.number="form.temps_cuisson" type="number" min="0" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20" placeholder="0" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Repos
                            </label>
                            <input v-model.number="form.temps_repos" type="number" min="0" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20" placeholder="0" required>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Ingredients -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-lg">3</div>
                            <h2 class="text-2xl font-bold text-gray-900">Ingrédients</h2>
                        </div>
                        <button type="button" @click="addIngredient" class="text-emerald-600 font-bold hover:text-emerald-700 transition-colors flex items-center gap-2 bg-emerald-50 px-4 py-2 rounded-xl">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            Ajouter un ingrédient
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div v-for="(ing, index) in form.ingredients" :key="index" class="flex flex-wrap md:flex-nowrap items-center gap-4 bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                            
                            <div class="w-full md:w-2/5">
                                <label class="block text-xs font-bold text-gray-500 mb-1">Ingrédient</label>
                                <div class="relative group">
                                    <input 
                                        type="text" 
                                        v-model="ing.search" 
                                        @focus="ing.showResults = true"
                                        @blur="hideResults(ing)"
                                        class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-emerald-500 bg-white" 
                                        placeholder="Taper pour chercher ou créer..."
                                        required
                                    >
                                    <div v-if="ing.showResults && filteredAliments(ing.search).length > 0" class="absolute z-20 w-full mt-1 bg-white border border-gray-200 rounded-xl shadow-xl max-h-48 overflow-y-auto overflow-hidden">
                                        <div 
                                            v-for="al in filteredAliments(ing.search)" 
                                            :key="al.id" 
                                            @click="selectAliment(index, al)"
                                            class="px-4 py-2 hover:bg-emerald-50 cursor-pointer text-sm font-medium text-gray-700 flex items-center justify-between"
                                        >
                                            <span>{{ al.nom }}</span>
                                        </div>
                                    </div>
                                    <div v-else-if="ing.showResults && ing.search.length > 2" class="absolute z-20 w-full mt-1 bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden p-2">
                                        <button 
                                            type="button"
                                            @click="createNewAliment(index, ing.search)"
                                            class="w-full text-left px-3 py-2 bg-emerald-50 text-emerald-700 text-sm font-bold rounded-lg hover:bg-emerald-100 transition-colors"
                                        >
                                            Créer "{{ ing.search }}"
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="w-full md:w-1/4">
                                <label class="block text-xs font-bold text-gray-500 mb-1">Quantité</label>
                                <input v-model.number="ing.quantite" type="number" min="0.1" step="0.1" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-emerald-500" required>
                            </div>

                            <div class="w-full md:w-1/4">
                                <label class="block text-xs font-bold text-gray-500 mb-1">Unité</label>
                                <select v-model="ing.unite_id" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-emerald-500 bg-white" required>
                                    <option value="" disabled>Choisir...</option>
                                    <option v-for="unite in unites" :key="unite.id" :value="unite.id">{{ unite.nom }} ({{ unite.abreviation }})</option>
                                </select>
                            </div>
                            
                            <div class="w-full md:w-auto pt-5">
                                <button type="button" @click="removeIngredient(index)" class="text-red-400 hover:text-red-600 p-2 hover:bg-red-50 rounded-lg transition-colors" title="Supprimer">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </div>
                        </div>
                        <p v-if="form.ingredients.length === 0" class="text-gray-500 italic text-center py-4 bg-gray-50 rounded-2xl border border-dashed border-gray-200">Aucun ingrédient stipulé pour le moment.</p>
                    </div>
                </div>

                <!-- Section 4: Étapes -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-lg">4</div>
                            <h2 class="text-2xl font-bold text-gray-900">Préparation étape par étape</h2>
                        </div>
                        <button type="button" @click="addStep" class="text-emerald-600 font-bold hover:text-emerald-700 transition-colors flex items-center gap-2 bg-emerald-50 px-4 py-2 rounded-xl">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            Ajouter une étape
                        </button>
                    </div>

                    <div class="space-y-6">
                        <div v-for="(step, index) in form.etapes" :key="index" class="bg-gray-50 w-full p-6 rounded-2xl border border-gray-200 flex gap-4">
                            <div class="font-black text-4xl text-emerald-200 mt-2">
                                {{ index + 1 }}
                            </div>
                            <div class="flex-1 space-y-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Description de l'action à réaliser</label>
                                    <textarea v-model="step.description" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 resize-none font-medium" placeholder="Ex: Dans un saladier, mélanger vigoureusement les œufs et le sucre..." required></textarea>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 mb-1">Ingrédients concernés (optionnel)</label>
                                        <div class="space-y-2 mt-2 max-h-40 overflow-y-auto pr-2">
                                            <label v-for="(ing, i) in validIngredientsForm" :key="i" class="flex items-center gap-2 p-2 rounded-lg border border-gray-100 hover:bg-emerald-50 cursor-pointer transition-colors bg-white">
                                                <input type="checkbox" :value="i" v-model="step.ingredient_indexes" class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 rounded focus:ring-emerald-500">
                                                <span class="text-sm text-gray-700 font-medium">{{ getAlimentName(ing.aliment_id) }} ({{ ing.quantite }})</span>
                                            </label>
                                            <p v-if="validIngredientsForm.length === 0" class="text-xs text-gray-400 italic">Ajoutez d'abord des ingrédients à la recette.</p>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 mb-1">Ustensiles Requis (optionnel)</label>
                                        <div class="space-y-2 mt-2 max-h-40 overflow-y-auto pr-2">
                                            <label v-for="ust in ustensiles" :key="ust.id" class="flex items-center gap-2 p-2 rounded-lg border border-gray-100 hover:bg-emerald-50 cursor-pointer transition-colors bg-white">
                                                <input type="checkbox" :value="ust.id" v-model="step.ustensile_ids" class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 rounded focus:ring-emerald-500">
                                                <span class="text-sm text-gray-700 font-medium">{{ ust.nom }}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" @click="removeStep(index)" class="text-red-400 hover:text-red-600 p-2 self-start rounded-lg transition-colors hover:bg-red-50" title="Supprimer">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </div>
                        <p v-if="form.etapes.length === 0" class="text-gray-500 italic text-center py-4 bg-gray-50 rounded-2xl border border-dashed border-gray-200">Ajoutez au moins une étape pour guider vos lecteurs.</p>
                    </div>
                </div>

                <!-- Submit Area -->
                <div class="pt-8 border-t border-gray-200 flex justify-end gap-4">
                    <Link :href="route('home')" class="px-6 py-3 font-bold text-gray-500 hover:bg-gray-100 rounded-xl transition-colors">
                        Annuler
                    </Link>
                    <button type="submit" :disabled="form.processing" class="bg-emerald-600 text-white font-bold py-3 px-8 rounded-xl hover:bg-emerald-700 transition-all shadow-lg hover:shadow-emerald-500/30 flex items-center gap-2 disabled:opacity-50">
                        <svg v-if="form.processing" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Mettre à jour la recette
                    </button>
                </div>
            </form>
        </div>
    </VitrineLayout>
</template>

<script setup>
import { computed } from 'vue';
import { useForm, Link, Head } from '@inertiajs/vue3';
import VitrineLayout from '@/Layouts/VitrineLayout.vue';

const props = defineProps({
    recipe: {
        type: Object,
        required: true
    },
    difficultes: Array,
    prix: Array,
    aliments: Array,
    unites: Array,
    ustensiles: Array,
    types: Array,
    userGroups: {
        type: Array,
        default: () => []
    }
});

// Format existing ingredients if any
const initialIngredients = (props.recipe.recette_ingredients || []).map(ri => ({
    aliment_id: ri.aliment_id,
    aliment_name: ri.aliment ? ri.aliment.nom : '',
    search: ri.aliment ? ri.aliment.nom : '',
    showResults: false,
    quantite: ri.quantite,
    unite_id: ri.unite_id,
    pivot_id: ri.id
}));

// Format existing steps and map pivot ingredients
const initialEtapes = (props.recipe.recette_etapes || []).map(etape => {
    const ingredientIndexes = [];
    if (etape.ingredients && etape.ingredients.length > 0) {
        etape.ingredients.forEach(etapeIng => {
            const foundIndex = initialIngredients.findIndex(ri => ri.pivot_id === etapeIng.id);
            if (foundIndex !== -1) ingredientIndexes.push(foundIndex);
        });
    }
    
    return {
        numero: etape.numero,
        description: etape.description,
        ingredient_indexes: ingredientIndexes,
        ustensile_ids: etape.ustensiles ? etape.ustensiles.map(u => u.id) : []
    };
});

// Main Form Payload mirroring the complex database relations
const form = useForm({
    title: props.recipe.title || '',
    recette_type_id: props.recipe.recette_type_id || '',
    portions: props.recipe.portions || 1,
    difficulte_id: props.recipe.difficulte_id || null,
    prix_id: props.recipe.prix_id || null,
    groupe_id: props.recipe.groupe_id || null,

    temps_preparation: props.recipe.temps ? props.recipe.temps.preparation : '',
    temps_cuisson: props.recipe.temps ? props.recipe.temps.cuisson : '',
    temps_repos: props.recipe.temps ? props.recipe.temps.repos : '',
    photo: null, // New photo upload replaces the old one if set

    ingredients: initialIngredients,
    etapes: initialEtapes.length > 0 ? initialEtapes : [{
        numero: 1,
        description: '',
        ingredient_indexes: [],
        ustensile_ids: []
    }]
});

// Ingredient Management
const addIngredient = () => {
    form.ingredients.push({
        aliment_id: '',
        aliment_name: '', // For uncertified ones
        search: '', // Frontend UI binding
        showResults: false,
        quantite: '',
        unite_id: ''
    });
};

const filteredAliments = (query) => {
    if (!query) return props.aliments.slice(0, 10);
    const lowQuery = query.toLowerCase();
    return props.aliments.filter(a => a.nom.toLowerCase().includes(lowQuery)).slice(0, 8);
};

const hideResults = (ing) => {
    setTimeout(() => {
        if (!ing.aliment_id && ing.search.trim().length > 0) {
            // Check if there is an exact match in the filtered list
            const result = props.aliments.find(a => a.nom.toLowerCase() === ing.search.toLowerCase().trim());
            if (result) {
                selectAliment(form.ingredients.indexOf(ing), result);
            } else {
                // Otherwise auto-create it
                createNewAliment(form.ingredients.indexOf(ing), ing.search.trim());
            }
        }
        ing.showResults = false;
    }, 200);
};

const selectAliment = (index, al) => {
    const ing = form.ingredients[index];
    ing.aliment_id = al.id;
    ing.aliment_name = al.nom;
    ing.search = al.nom;
    ing.showResults = false;
};

const createNewAliment = (index, name) => {
    const ing = form.ingredients[index];
    ing.aliment_id = 'new_' + Math.random().toString(36).substr(2, 9);
    ing.aliment_name = name;
    ing.search = name;
    ing.showResults = false;
};

const removeIngredient = (index) => {
    form.ingredients.splice(index, 1);
    
    // Clean up associated steps that pointed to this ingredient index in the array
    form.etapes.forEach(step => {
        if (step.ingredient_indexes && Array.isArray(step.ingredient_indexes)) {
            step.ingredient_indexes = step.ingredient_indexes
                .filter(i => i !== index) // Remove the deleted index
                .map(i => i > index ? i - 1 : i); // Shift others down
        }
    });
};

// Return only ingredients that have at least an aliment selected for the Steps dropdowns
const validIngredientsForm = computed(() => {
    return form.ingredients; 
});

const getAlimentName = (id) => {
    if (!id) return 'Inconnu';
    const ingredient = form.ingredients.find(i => i.aliment_id === id);
    if (ingredient) return ingredient.aliment_name || ingredient.search;
    
    const aliment = props.aliments.find(a => a.id === id);
    return aliment ? aliment.nom : 'Inconnu';
};

// Step Management
const addStep = () => {
    form.etapes.push({
        numero: form.etapes.length + 1,
        description: '',
        ingredient_indexes: [],
        ustensile_ids: []
    });
};

const removeStep = (index) => {
    form.etapes.splice(index, 1);
    // Recursively re-number remaining steps to maintain consistent data sequence
    form.etapes.forEach((s, idx) => s.numero = idx + 1);
};

// Submission
const submitForm = () => {
    // Validate custom arrays before attempting post
    if (form.ingredients.length === 0) {
        alert("N'oubliez pas d'ajouter des ingrédients à votre recette !");
        return;
    }
    
    if (form.etapes.length === 0) {
        alert("Ajoutez des instructions détaillées pour votre recette.");
        return;
    }

    form.post(route('recipe.update', props.recipe.id), {
        preserveScroll: true,
        onError: (errors) => {
            console.error("Erreur de publication:", errors);
        }
    });
};
</script>
