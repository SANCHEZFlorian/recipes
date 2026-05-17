<template>
    <Head>
        <title>Nouvelle Recette</title>
        <meta name="robots" content="noindex, nofollow" />
    </Head>
    <VitrineLayout>
        <!-- Header -->
        <div class="bg-emerald-600 text-white py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
            <div class="absolute inset-0 z-0">
                <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-white/20 via-transparent to-transparent"></div>
            </div>
            
            <div class="max-w-4xl mx-auto relative z-10">
                <h1 class="text-3xl md:text-5xl font-black mb-4 tracking-tight">Nouvelle Recette</h1>
                <p class="text-emerald-50 text-lg font-medium">Partagez votre création culinaire avec la communauté. Remplissez les étapes ci-dessous de la façon la plus précise possible.</p>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <form @submit.prevent="submitForm" class="space-y-12">
                
                <!-- Section 1: Informations de base -->
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-xl shadow-inner">1</div>
                        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Informations Principales</h2>
                    </div>

                    <div class="space-y-8">
                        <!-- Titre -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="md:col-span-2">
                                <label class="premium-label">Titre de la recette</label>
                                <input v-model="form.title" type="text" class="premium-input text-lg font-bold" placeholder="Ex: Gratin Dauphinois Traditionnel" required>
                            </div>
                            <div>
                                <label class="premium-label">Photo de couverture</label>
                                <div class="relative h-[52px]">
                                    <input type="file" @input="form.photo = $event.target.files[0]" id="photo_upload" class="sr-only" accept="image/*">
                                    <label for="photo_upload" class="flex items-center justify-center w-full h-full border-2 border-dashed border-slate-200 rounded-xl cursor-pointer hover:border-emerald-500 hover:bg-emerald-50 transition-all text-sm font-bold text-slate-500 overflow-hidden">
                                        <template v-if="!form.photo">
                                            <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            Choisir une photo
                                        </template>
                                        <template v-else>
                                            <span class="text-emerald-600 truncate px-4">{{ form.photo.name }}</span>
                                        </template>
                                    </label>
                                </div>
                                <p v-if="form.errors.photo" class="mt-2 text-xs text-rose-500 font-bold ml-1">{{ form.errors.photo }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Categories (Types de plats) -->
                            <div>
                                <label class="premium-label flex justify-between items-center">
                                    <span>Catégories / Types de plat</span>
                                    <span class="text-xs font-bold" :class="form.category_ids.length === 3 ? 'text-amber-500' : 'text-slate-400'">
                                        {{ form.category_ids.length }} / 3 max
                                    </span>
                                </label>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <button
                                        v-for="type in types"
                                        :key="type.id"
                                        type="button"
                                        @click="toggleCategory(type.id)"
                                        class="px-4 py-2.5 rounded-2xl border text-sm font-medium transition-all duration-300 cursor-pointer select-none active:scale-95 flex items-center gap-2"
                                        :class="[
                                            form.category_ids.includes(type.id)
                                                ? 'border-emerald-500 bg-emerald-50 text-emerald-700 font-bold shadow-md shadow-emerald-500/5'
                                                : form.category_ids.length >= 3
                                                    ? 'border-slate-100 bg-slate-50 text-slate-300 cursor-not-allowed opacity-50'
                                                    : 'border-slate-200 bg-white/70 backdrop-blur-sm text-slate-600 hover:border-emerald-300 hover:text-emerald-600'
                                        ]"
                                        :disabled="form.category_ids.length >= 3 && !form.category_ids.includes(type.id)"
                                    >
                                        <i v-if="type.icone" :class="type.icone" class="text-xs"></i>
                                        <span>{{ type.nom }}</span>
                                    </button>
                                </div>
                                <p v-if="form.errors.category_ids" class="mt-2 text-xs text-rose-500 font-bold ml-1">{{ form.errors.category_ids }}</p>
                            </div>

                            <!-- Portions -->
                            <div>
                                <label class="premium-label">Nombre de portions</label>
                                <div class="flex items-center gap-1 bg-white/70 backdrop-blur-sm border border-slate-200 rounded-2xl p-1 w-fit focus-within:border-emerald-500 focus-within:ring-4 focus-within:ring-emerald-500/10 transition-all duration-300">
                                    <button 
                                        type="button" 
                                        @click="form.portions = Math.max(1, form.portions - 1)"
                                        class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 active:scale-95 transition-all font-bold cursor-pointer select-none"
                                    >
                                        <i class="fas fa-minus text-xs"></i>
                                    </button>
                                    
                                    <input 
                                        v-model.number="form.portions" 
                                        type="number" 
                                        min="1" 
                                        class="w-16 text-center bg-transparent border-0 ring-0 focus:ring-0 font-bold text-slate-800 text-lg p-0"
                                        @input="form.portions = Math.max(1, parseInt($event.target.value) || 1)"
                                    >
                                    
                                    <button 
                                        type="button" 
                                        @click="form.portions = form.portions + 1"
                                        class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 active:scale-95 transition-all font-bold cursor-pointer select-none"
                                    >
                                        <i class="fas fa-plus text-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Difficulté -->
                            <div>
                                <label class="premium-label">Difficulté</label>
                                <div class="grid grid-cols-3 gap-3">
                                    <label v-for="diff in difficultes" :key="diff.id" class="cursor-pointer">
                                        <input type="radio" v-model="form.difficulte_id" :value="diff.id" class="peer sr-only" required>
                                        <div class="text-center px-3 py-3 rounded-2xl border-2 border-slate-100 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-700 text-slate-500 font-bold transition-all hover:border-emerald-200 text-sm">
                                            {{ diff.nom }}
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <!-- Prix -->
                            <div>
                                <label class="premium-label">Coût estimé</label>
                                <div class="grid grid-cols-3 gap-3">
                                    <label v-for="px in prix" :key="px.id" class="cursor-pointer">
                                        <input type="radio" v-model="form.prix_id" :value="px.id" class="peer sr-only" required>
                                        <div class="text-center px-3 py-3 rounded-2xl border-2 border-slate-100 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-700 text-slate-500 font-bold transition-all hover:border-emerald-200 text-sm">
                                            {{ px.nom }}
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Groupe -->
                        <div v-if="userGroups && userGroups.length > 0" class="mt-8 border-t border-slate-100 pt-8">
                            <label class="premium-label">Partager dans un groupe ? <span class="text-slate-400 font-normal">(Optionnel)</span></label>
                            <PremiumSelect
                                v-model="form.groupe_id"
                                :options="userGroups"
                                placeholder="Non, rendre cette recette publique"
                                label-key="nom"
                            />
                            <p class="text-xs text-emerald-600 mt-3 font-bold flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Si vous sélectionnez un groupe, seuls ses membres pourront y accéder !
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Temps -->
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-xl shadow-inner">2</div>
                        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Temps de préparation</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <label class="premium-label flex items-center gap-2">
                                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" /></svg>
                                Préparation (min)
                            </label>
                            <input v-model.number="form.temps_preparation" type="number" min="0" class="premium-input" placeholder="0" required>
                        </div>
                        <div>
                            <label class="premium-label flex items-center gap-2">
                                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" /></svg>
                                Cuisson (min)
                            </label>
                            <input v-model.number="form.temps_cuisson" type="number" min="0" class="premium-input" placeholder="0" required>
                        </div>
                        <div>
                            <label class="premium-label flex items-center gap-2">
                                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Repos (min)
                            </label>
                            <input v-model.number="form.temps_repos" type="number" min="0" class="premium-input" placeholder="0" required>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Ingredients -->
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12">
                    <div class="flex items-center justify-between flex-wrap gap-4 mb-10">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-xl shadow-inner">3</div>
                            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Ingrédients</h2>
                        </div>
                        <button type="button" @click="addIngredient" class="premium-button-secondary py-3 flex items-center gap-2 text-emerald-600 border-emerald-100 bg-emerald-50/50 hover:bg-emerald-50">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            Ajouter un ingrédient
                        </button>
                    </div>

                    <div class="space-y-6">
                        <div v-for="(ing, index) in form.ingredients" :key="index" class="flex flex-wrap md:flex-nowrap items-end gap-4 bg-slate-50/50 p-6 rounded-3xl border border-slate-100 transition-all hover:bg-slate-50">
                            
                            <div class="w-full md:w-2/5">
                                <label class="premium-label text-xs uppercase tracking-wider text-slate-400">Ingrédient</label>
                                <div class="relative group">
                                    <input 
                                        type="text" 
                                        v-model="ing.search" 
                                        @focus="ing.showResults = true"
                                        @blur="hideResults(ing)"
                                        class="premium-input bg-white" 
                                        placeholder="Chercher ou créer..."
                                        required
                                    >
                                    <div v-if="ing.showResults && filteredAliments(ing.search).length > 0" class="absolute z-20 w-full mt-2 bg-white/95 backdrop-blur-md border border-slate-100 rounded-2xl shadow-xl max-h-60 overflow-y-auto p-1.5 transition-all duration-200">
                                        <div 
                                            v-for="al in filteredAliments(ing.search)" 
                                            :key="al.id" 
                                            @click="selectAliment(index, al)"
                                            class="px-4 py-2.5 hover:bg-emerald-50 hover:text-emerald-900 rounded-xl cursor-pointer text-sm font-bold text-slate-700 flex items-center justify-between transition-colors"
                                        >
                                            <span class="flex items-center gap-2">
                                                <i class="fas fa-apple-alt text-emerald-500 text-xs"></i>
                                                {{ al.nom }}
                                            </span>
                                            <span class="text-[10px] bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded-full font-bold">Existant</span>
                                        </div>
                                    </div>
                                    <div v-else-if="ing.showResults && ing.search.length > 2" class="absolute z-20 w-full mt-2 bg-white/95 backdrop-blur-md border border-slate-100 rounded-2xl shadow-xl p-1.5 transition-all duration-200">
                                        <button 
                                            type="button"
                                            @click="createNewAliment(index, ing.search)"
                                            class="w-full text-left px-4 py-2.5 bg-emerald-50/50 hover:bg-emerald-50 text-emerald-700 text-sm font-black rounded-xl hover:text-emerald-800 transition-colors flex items-center justify-between"
                                        >
                                            <span class="flex items-center gap-2">
                                                <i class="fas fa-plus-circle text-emerald-600"></i>
                                                Créer "{{ ing.search }}"
                                            </span>
                                            <span class="text-[10px] bg-emerald-600 text-white px-2 py-0.5 rounded-full font-bold">Nouveau</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="w-full md:w-1/4">
                                <label class="premium-label text-xs uppercase tracking-wider text-slate-400">Quantité</label>
                                <input v-model.number="ing.quantite" type="number" min="0.1" step="0.1" class="premium-input bg-white" required>
                            </div>

                            <div class="w-full md:w-1/4">
                                <label class="premium-label text-xs uppercase tracking-wider text-slate-400">Unité</label>
                                <PremiumSelect
                                    v-model="ing.unite_id"
                                    :options="formattedUnites"
                                    placeholder="Choisir..."
                                    label-key="nom"
                                    required
                                />
                            </div>
                            
                            <div class="w-full md:w-auto">
                                <button type="button" @click="removeIngredient(index)" class="text-rose-400 hover:text-rose-600 p-3 hover:bg-rose-50 rounded-xl transition-all active:scale-90" title="Supprimer">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </div>
                        </div>
                        <div v-if="form.ingredients.length === 0" class="text-slate-400 font-medium text-center py-12 bg-slate-50/50 rounded-[2rem] border-2 border-dashed border-slate-100">
                            Aucun ingrédient ajouté pour le moment.
                        </div>
                    </div>
                </div>

                <!-- Section 4: Étapes -->
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12">
                    <div class="flex items-center justify-between flex-wrap gap-4 mb-10">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-xl shadow-inner">4</div>
                            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Préparation</h2>
                        </div>
                        <button type="button" @click="addStep" class="premium-button-secondary py-3 flex items-center gap-2 text-emerald-600 border-emerald-100 bg-emerald-50/50 hover:bg-emerald-50">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            Ajouter une étape
                        </button>
                    </div>

                    <div class="space-y-8">
                        <div v-for="(step, index) in form.etapes" :key="index" class="bg-slate-50/30 w-full p-8 rounded-[2rem] border border-slate-100 flex flex-col md:flex-row gap-8 relative group">
                            <div class="font-black text-6xl text-emerald-100 leading-none">
                                {{ index + 1 }}
                            </div>
                            <div class="flex-1 space-y-6">
                                <div>
                                    <label class="premium-label text-xs uppercase tracking-wider text-slate-400">Description de l'action</label>
                                    <textarea v-model="step.description" rows="3" class="premium-input bg-white resize-none font-medium text-base" placeholder="Ex: Dans un saladier, mélanger vigoureusement les œufs et le sucre..." required></textarea>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div>
                                        <label class="premium-label text-xs uppercase tracking-wider text-slate-400">Ingrédients concernés</label>
                                        <div class="space-y-2 mt-3 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                                            <label v-for="(ing, i) in validIngredientsForm" :key="i" 
                                                   :class="[
                                                       step.ingredient_indexes.includes(i) 
                                                           ? 'border-emerald-500 bg-emerald-50/40 text-emerald-955 shadow-sm shadow-emerald-500/5' 
                                                           : 'border-slate-100 hover:border-emerald-200 hover:bg-emerald-50/30 text-slate-700 bg-white'
                                                   ]"
                                                   class="flex items-center gap-3 p-3 rounded-xl border cursor-pointer transition-all">
                                                <input type="checkbox" :value="i" v-model="step.ingredient_indexes" class="w-5 h-5 rounded-lg border-slate-300 text-emerald-600 focus:ring-emerald-500/20 transition-all cursor-pointer">
                                                <span class="text-sm font-bold">{{ getAlimentName(ing.aliment_id) }}</span>
                                                <span :class="[
                                                    step.ingredient_indexes.includes(i)
                                                        ? 'bg-emerald-100 text-emerald-700 font-extrabold'
                                                        : 'bg-slate-100 text-slate-400'
                                                ]" class="text-[10px] px-1.5 py-0.5 rounded ml-auto font-black">{{ ing.quantite }}</span>
                                            </label>
                                            <p v-if="validIngredientsForm.length === 0" class="text-xs text-slate-400 italic py-2">Ajoutez d'abord des ingrédients.</p>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="premium-label text-xs uppercase tracking-wider text-slate-400">Ustensiles Requis</label>
                                        <div class="space-y-2 mt-3 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                                            <label v-for="ust in ustensiles" :key="ust.id" 
                                                   :class="[
                                                       step.ustensile_ids.includes(ust.id) 
                                                           ? 'border-emerald-500 bg-emerald-50/40 text-emerald-955 shadow-sm shadow-emerald-500/5' 
                                                           : 'border-slate-100 hover:border-emerald-200 hover:bg-emerald-50/30 text-slate-700 bg-white'
                                                   ]"
                                                   class="flex items-center gap-3 p-3 rounded-xl border cursor-pointer transition-all">
                                                <input type="checkbox" :value="ust.id" v-model="step.ustensile_ids" class="w-5 h-5 rounded-lg border-slate-300 text-emerald-600 focus:ring-emerald-500/20 transition-all cursor-pointer">
                                                <span class="text-sm font-bold">{{ ust.nom }}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" @click="removeStep(index)" class="absolute top-4 right-4 text-rose-300 hover:text-rose-600 p-2 rounded-xl transition-all hover:bg-rose-50 opacity-0 group-hover:opacity-100" title="Supprimer">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </div>
                        <div v-if="form.etapes.length === 0" class="text-slate-400 font-medium text-center py-12 bg-slate-50/50 rounded-[2rem] border-2 border-dashed border-slate-100">
                            Aucune étape définie pour le moment.
                        </div>
                    </div>
                </div>

                <!-- Submit Area -->
                <div class="pt-12 border-t border-slate-100 flex flex-col md:flex-row justify-end gap-4">
                    <Link :href="route('home')" class="premium-button-secondary text-center">
                        Annuler
                    </Link>
                    <button type="submit" :disabled="form.processing" class="premium-button-primary text-lg px-12 flex items-center justify-center gap-3">
                        <svg v-if="form.processing" class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        <span>{{ form.processing ? 'Publication...' : 'Publier ma recette' }}</span>
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
import PremiumSelect from '@/Components/PremiumSelect.vue';

const props = defineProps({
    difficultes: Array,
    prix: Array,
    aliments: Array,
    unites: Array,
    ustensiles: Array,
    types: Array,
    userGroups: {
        type: Array,
        default: () => []
    },
    defaultGroupId: {
        type: Number,
        default: null
    }
});

const formattedUnites = computed(() => {
    return props.unites.map(u => ({
        id: u.id,
        nom: `${u.nom} (${u.abreviation})`
    }));
});

// Main Form Payload mirroring the complex database relations
const form = useForm({
    title: '',
    category_ids: [],
    portions: 1,
    difficulte_id: null,
    prix_id: null,
    groupe_id: props.defaultGroupId || null,

    temps_preparation: '',
    temps_cuisson: '',
    temps_repos: '',
    photo: null,

    ingredients: [],
    etapes: []
});

const toggleCategory = (id) => {
    const idx = form.category_ids.indexOf(id);
    if (idx !== -1) {
        form.category_ids.splice(idx, 1);
    } else if (form.category_ids.length < 3) {
        form.category_ids.push(id);
    }
};

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

    form.post(route('recipe.store'), {
        preserveScroll: true,
        onError: (errors) => {
            console.error("Erreur de publication:", errors);
        }
    });
};
</script>
