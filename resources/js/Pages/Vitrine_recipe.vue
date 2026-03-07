<template>
    <VitrineLayout>
        <!-- Hero Header -->
        <div class="bg-gray-900 text-white relative">
            <div class="absolute inset-0 z-0">
                <img
                    :src="getRecipeImage(recipe)"
                    :alt="recipe.title"
                    class="w-full h-full object-cover opacity-30"
                />
                <div
                    class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent"
                ></div>
            </div>

            <div
                class="max-w-[1800px] mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-16 relative z-10 flex flex-col md:flex-row items-end justify-between gap-8"
            >
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-4">
                        <span
                            v-if="recipe.recette_type?.nom"
                            class="bg-emerald-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm"
                        >
                            {{ recipe.recette_type?.nom }}
                        </span>
                        <span
                            class="bg-white/10 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full border border-white/20 shadow-sm flex items-center gap-1.5"
                        >
                            <div
                                class="w-2 h-2 rounded-full"
                                :class="
                                    getDifficultyColorClass(
                                        recipe.difficulte?.nom ||
                                            recipe.difficulte,
                                    )
                                "
                            ></div>
                            {{
                                recipe.difficulte?.nom ||
                                recipe.difficulte ||
                                "Non défini"
                            }}
                        </span>
                    </div>

                    <h1
                        class="text-4xl md:text-5xl lg:text-6xl font-black mb-4 tracking-tight leading-tight"
                    >
                        {{ recipe.title }}
                    </h1>
                    <p
                        v-if="recipe.description"
                        class="text-gray-300 text-lg md:text-xl max-w-3xl font-medium leading-relaxed"
                    >
                        {{ recipe.description }}
                    </p>
                </div>

                <div class="flex flex-row md:flex-col gap-3 w-full md:w-auto">
                    <button
                        class="flex-1 md:w-full bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl font-bold tracking-wide transition-all shadow-lg hover:shadow-emerald-600/30 flex items-center justify-center gap-2"
                    >
                        <svg
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                            />
                        </svg>
                        Enregistrer
                    </button>
                    <button
                        @click="printRecipe"
                        class="flex-1 md:w-full bg-white/10 hover:bg-white/20 backdrop-blur-md text-white border border-white/20 px-6 py-3 rounded-xl font-bold tracking-wide transition-all flex items-center justify-center gap-2"
                    >
                        <svg
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"
                            />
                        </svg>
                        Imprimer
                    </button>
                </div>
            </div>
        </div>

        <div class="max-w-[1800px] mx-auto px-4 sm:px-6 lg:px-12 py-12">
            <!-- Stats Bar -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-wrap gap-y-6 md:divide-x divide-gray-100 mb-12 relative -mt-20 z-20"
            >
                <div
                    class="w-1/2 md:w-1/4 px-4 flex flex-col items-center justify-center text-center"
                >
                    <svg
                        class="w-7 h-7 text-emerald-500 mb-2"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    <span
                        class="text-sm text-gray-400 font-medium uppercase tracking-wider mb-1"
                        >Préparation</span
                    >
                    <span class="font-bold text-gray-900 text-lg"
                        >{{ getTemps('preparation') }} min</span
                    >
                </div>
                <div
                    class="w-1/2 md:w-1/4 px-4 flex flex-col items-center justify-center text-center"
                >
                    <svg
                        class="w-7 h-7 text-emerald-500 mb-2"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"
                        />
                    </svg>
                    <span
                        class="text-sm text-gray-400 font-medium uppercase tracking-wider mb-1"
                        >Cuisson</span
                    >
                    <span class="font-bold text-gray-900 text-lg"
                        >{{ getTemps('cuisson') }} min</span
                    >
                </div>
                <div
                    class="w-1/2 md:w-1/4 px-4 flex flex-col items-center justify-center text-center"
                >
                    <svg
                        class="w-7 h-7 text-emerald-500 mb-2"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                        />
                    </svg>
                    <span
                        class="text-sm text-gray-400 font-medium uppercase tracking-wider mb-1"
                        >Portions</span
                    >
                    <div class="flex items-center gap-3">
                        <button
                            @click="servings > 1 && servings--"
                            class="w-6 h-6 rounded-full bg-gray-100 hover:bg-emerald-100 text-gray-600 hover:text-emerald-600 flex items-center justify-center font-bold transition-colors"
                        >
                            -
                        </button>
                        <span class="font-bold text-gray-900 text-lg">{{
                            servings
                        }}</span>
                        <button
                            @click="servings++"
                            class="w-6 h-6 rounded-full bg-gray-100 hover:bg-emerald-100 text-gray-600 hover:text-emerald-600 flex items-center justify-center font-bold transition-colors"
                        >
                            +
                        </button>
                    </div>
                </div>
                <div
                    class="w-1/2 md:w-1/4 px-4 flex flex-col items-center justify-center text-center"
                >
                    <svg
                        class="w-7 h-7 text-emerald-500 mb-2"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    <span
                        class="text-sm text-gray-400 font-medium uppercase tracking-wider mb-1"
                        >Coût</span
                    >
                    <span class="font-bold text-gray-900 text-lg">{{
                        recipe.prix?.nom || recipe.prix || "Moyen"
                    }}</span>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Left Column (Ingredients) -->
                <div class="lg:w-1/3">
                    <div class="sticky top-24">
                        <h2
                            class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2"
                        >
                            <span
                                class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center"
                            >
                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                    />
                                </svg>
                            </span>
                            Ingrédients
                        </h2>

                        <div
                            v-if="recipeIngredients.length"
                            class="bg-white rounded-2xl shadow-sm border border-gray-100 p-2"
                        >
                            <ul class="divide-y divide-gray-50">
                                <li
                                    v-for="(
                                        ingredient, index
                                    ) in recipeIngredients"
                                    :key="index"
                                    class="p-3"
                                >
                                    <label
                                        class="flex items-center gap-3 cursor-pointer group"
                                    >
                                        <div
                                            class="relative flex items-center justify-center w-6 h-6 rounded-md border-2 border-gray-200 bg-white group-hover:border-emerald-400 transition-colors"
                                        >
                                            <input
                                                type="checkbox"
                                                class="absolute opacity-0 w-full h-full cursor-pointer peer"
                                            />
                                            <svg
                                                class="w-4 h-4 text-emerald-500 opacity-0 peer-checked:opacity-100 transition-opacity"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="3"
                                                    d="M5 13l4 4L19 7"
                                                />
                                            </svg>
                                        </div>
                                        <div
                                            class="flex-1 text-gray-700 group-hover:text-gray-900 transition-colors"
                                        >
                                            <span
                                                class="font-bold text-emerald-600"
                                                >{{
                                                    calculateAmount(
                                                        ingredient.quantite,
                                                    )
                                                }}</span
                                            >
                                            <span
                                                class="text-xs text-gray-400 font-medium ml-1 mr-2"
                                                >{{
                                                    ingredient.unite?.nom || ""
                                                }}</span
                                            >
                                            <span
                                                class="font-medium text-gray-800"
                                                >{{
                                                    ingredient.aliment?.nom ||
                                                    "Ingrédient"
                                                }}</span
                                            >
                                        </div>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div
                            v-else
                            class="text-gray-500 italic p-4 bg-gray-50 rounded-xl"
                        >
                            Aucun ingrédient renseigné.
                        </div>

                        <!-- Ustensils if available -->
                        <div
                            v-if="recipeUstensiles.length"
                            class="mt-8"
                        >
                            <h3
                                class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2"
                            >
                                Ustensiles Requis
                            </h3>
                            <ul class="flex flex-wrap gap-2">
                                <li
                                    v-for="(
                                        u, index
                                    ) in recipeUstensiles"
                                    :key="index"
                                    class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium"
                                >
                                    {{ u.ustensile?.nom || "Ustensile" }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Right Column (Instructions) -->
                <div class="lg:w-2/3">
                    <h2
                        class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2"
                    >
                        <span
                            class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center"
                        >
                            <svg
                                class="w-4 h-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                                />
                            </svg>
                        </span>
                        Préparation
                    </h2>

                    <div
                        v-if="recipeEtapes.length"
                        class="space-y-6"
                    >
                        <div
                            v-for="(step, index) in recipeEtapes"
                            :key="index"
                            class="flex gap-4 group"
                        >
                            <div class="flex flex-col items-center">
                                <div
                                    class="w-10 h-10 rounded-full bg-gray-100 text-gray-500 font-black text-lg flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-colors shadow-sm shrink-0"
                                >
                                    {{ step.numero || index + 1 }}
                                </div>
                                <div
                                    class="w-px h-full bg-gray-100 mt-2 group-last:hidden"
                                ></div>
                            </div>
                            <div
                                class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm group-hover:shadow-md group-hover:border-emerald-100 transition-all flex-1 mb-2"
                            >
                                <h4
                                    v-if="step.titre"
                                    class="text-lg font-bold text-gray-900 mb-2"
                                >
                                    {{ step.titre }}
                                </h4>

                                <!-- Step Requirements Section -->
                                <div v-if="(step.ingredients && step.ingredients.length) || (step.ustensiles && step.ustensiles.length)" 
                                     class="mb-4 p-4 rounded-xl bg-gray-50/50 border border-gray-100">
                                    <div class="flex flex-col gap-3">
                                        <!-- Ingredients for this step -->
                                        <div v-if="step.ingredients && step.ingredients.length" class="flex flex-wrap gap-2 items-center">
                                            <span class="text-[10px] font-black uppercase tracking-wider text-emerald-600/50 mr-1">Ingrédients :</span>
                                            <div v-for="ing in step.ingredients" :key="'step-ing-'+ing.id"
                                                 class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 text-sm font-semibold border border-emerald-100 shadow-sm">
                                                <i v-if="ing.aliment?.icone" :class="[ing.aliment?.icone.startsWith('fa') || ing.aliment?.icone.startsWith('fi') ? ing.aliment.icone : 'fi fi-rr-info', 'text-xs text-emerald-500']"></i>
                                                <svg v-else class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                                                {{ ing.aliment?.nom }}
                                            </div>
                                        </div>

                                        <!-- Utensils for this step -->
                                        <div v-if="step.ustensiles && step.ustensiles.length" class="flex flex-wrap gap-2 items-center">
                                            <span class="text-[10px] font-black uppercase tracking-wider text-orange-600/50 mr-1">Ustensiles :</span>
                                            <div v-for="ust in step.ustensiles" :key="'step-ust-'+ust.id"
                                                 class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-orange-50 text-orange-700 text-sm font-semibold border border-orange-100 shadow-sm">
                                                <i v-if="ust.icone" :class="[ust.icone.startsWith('fa') || ust.icone.startsWith('fi') ? ust.icone : 'fi fi-rr-tool-box-polygonal', 'text-xs text-orange-500']"></i>
                                                <svg v-else class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                                {{ ust.nom }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-600 leading-relaxed font-medium">
                                    {{ step.description }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div
                        v-else
                        class="text-gray-500 italic p-6 bg-gray-50 rounded-2xl text-center"
                    >
                        Aucune instruction n'a été ajoutée à cette recette.
                    </div>

                    <!-- Author Block -->
                    <div
                        class="mt-12 pt-8 border-t border-gray-100 flex items-center justify-between"
                    >
                        <div class="flex items-center gap-4">
                            <img
                                :src="
                                    'https://ui-avatars.com/api/?name=' +
                                    encodeURIComponent(
                                        recipe.user?.name || 'Chef',
                                    ) +
                                    '&background=f3f4f6&color=374151'
                                "
                                class="w-12 h-12 rounded-full"
                            />
                            <div>
                                <p class="text-sm text-gray-400 font-medium">
                                    Recette proposée par
                                </p>
                                <p class="text-lg font-bold text-gray-900">
                                    {{
                                        recipe.user?.name ||
                                        "Un Cuisinier Passionné"
                                    }}
                                </p>
                            </div>
                        </div>
                        <Link
                            :href="route('home')"
                            class="text-emerald-600 hover:text-emerald-700 font-medium text-sm transition-colors"
                            >Voir ses autres recettes &rarr;</Link
                        >
                    </div>
                </div>
            </div>
        </div>
    </VitrineLayout>
</template>

<script setup>
import { ref, computed } from "vue";
import { Link } from "@inertiajs/vue3";
import VitrineLayout from "@/Layouts/VitrineLayout.vue";

const props = defineProps({
    recipe: {
        type: Object,
        required: true,
    },
});

// Normalized data to handle both snake_case and camelCase from Inertia/Eloquent
const recipeIngredients = computed(() => props.recipe.recette_ingredients || props.recipe.recetteIngredients || []);
const recipeEtapes = computed(() => props.recipe.recette_etapes || props.recipe.recetteEtapes || []);
const recipeUstensiles = computed(() => props.recipe.recette_ustensiles || props.recipe.recetteUstensiles || []);
const recipePhotos = computed(() => props.recipe.recette_photos || props.recipe.recettePhotos || []);

const defaultServings = props.recipe.portions || 4;
const servings = ref(defaultServings);

// Handle new array 'temps' structure
const getTemps = (type) => {
    const temps = props.recipe.temps;
    if (!temps) return 0;
    const t = Array.isArray(temps) ? temps[0] : temps;
    return t ? (t[type] || 0) : 0;
};

// Calculate dynamic amount based on servings WITHOUT causing amount.replace errors.
// By strictly ensuring we convert to Number and returning a string representation safely.
const calculateAmount = (amount) => {
    if (amount === null || amount === undefined) return "";

    // Safely parse the amount string or number to a float
    // Handle edge cases where comma might be used instead of dot
    const parsedAmount = parseFloat(String(amount).replace(",", "."));

    if (isNaN(parsedAmount)) return String(amount);

    const calculated = (parsedAmount / defaultServings) * servings.value;

    // Format nicely: no decimals if whole number, otherwise up to 1 decimal
    return Number.isInteger(calculated)
        ? calculated.toString()
        : calculated.toFixed(1);
};

const printRecipe = () => {
    window.print();
};

const getDifficultyColorClass = (difficulty) => {
    const diff = (difficulty || "").toLowerCase();
    if (diff === "facile") return "bg-green-400";
    if (diff === "moyen") return "bg-yellow-400";
    if (diff === "difficile") return "bg-red-500";
    return "bg-gray-400";
};

const getRecipeImage = (recipe) => {
    if (!recipe) return "/images/placeholders/japanese_ramen.png";

    // Check for uploaded photo first
    const photos = recipe.recette_photos || recipe.recettePhotos;
    if (photos && photos.length > 0) {
        const photoEntry = Array.isArray(photos) ? photos[0] : photos;
        const photo = photoEntry?.photo;
        if (photo && photo.nom_fichier) {
            return "/storage/recipes/" + photo.nom_fichier;
        }
    }

    const type = (recipe.recette_type?.nom || "").toLowerCase();
    const title = (recipe.title || recipe.titre || "").toLowerCase();
    const check = (term) => type.includes(term) || title.includes(term);

    if (check("ramen") || check("nouilles") || check("japan"))
        return "/images/placeholders/japanese_ramen.png";
    if (check("pasta") || check("italien"))
        return "/images/placeholders/italian_pasta.png";
    if (check("salad") || check("végé"))
        return "/images/placeholders/mediterranean_salad.png";
    if (check("curry") || check("thaï"))
        return "/images/placeholders/thai_curry.png";
    if (check("dessert") || check("chocolat") || check("gâteau"))
        return "/images/placeholders/chocolate_dessert.png";
    if (check("pain") || check("boulangerie"))
        return "/images/placeholders/baked_goods.png";
    if (check("poisson") || check("saumon"))
        return "/images/placeholders/seafood_platter.png";
    if (check("pancake") || check("brunch"))
        return "/images/placeholders/breakfast_spread.png";

    return "/images/placeholders/japanese_ramen.png";
};
</script>
