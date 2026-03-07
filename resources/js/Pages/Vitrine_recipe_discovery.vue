<template>
    <VitrineLayout>
        <!-- Hero Section -->
        <div
            class="bg-emerald-600 text-white py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden"
        >
            <!-- Decorative background elements -->
            <div
                class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"
            ></div>
            <div
                class="absolute bottom-0 left-0 -mb-10 -ml-10 w-32 h-32 bg-emerald-900/20 rounded-full blur-2xl"
            ></div>

            <div class="max-w-[1520px] mx-auto relative z-10 text-center">
                <h1 class="text-4xl md:text-5xl font-black mb-6 tracking-tight">
                    Que vas-tu cuisiner aujourd'hui ?
                </h1>
                <p
                    class="text-emerald-100 text-lg md:text-xl max-w-2xl mx-auto mb-10 font-medium"
                >
                    Découvre des milliers de recettes savoureuses, testées et
                    approuvées par notre communauté de passionnés.
                </p>

                <div class="flex justify-center mb-10 gap-4">
                    <Link :href="route('recipe.create')" class="bg-white text-emerald-600 hover:bg-emerald-50 px-6 py-3 rounded-full font-bold shadow-lg transition-transform hover:scale-105 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Publier ma recette
                    </Link>
                </div>

                <div class="max-w-2xl mx-auto relative">
                    <input
                        v-model="searchQuery"
                        type="search"
                        placeholder="Rechercher un plat, un ingrédient..."
                        class="w-full pl-6 pr-14 py-4 rounded-2xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-emerald-400/50 shadow-xl"
                        @keyup.enter="search"
                    />
                    <button
                        @click="search"
                        class="absolute right-2 top-2 bottom-2 bg-emerald-600 text-white rounded-xl px-4 hover:bg-emerald-700 transition-colors shadow-md"
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
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Filter Bar -->
        <div
            class="bg-white border-b border-gray-100 sticky top-16 z-30 shadow-sm"
        >
            <div
                class="max-w-[1520px] mx-auto px-2 sm:px-4 lg:px-8 py-3 overflow-x-auto flex items-center gap-3"
            >
                <div
                    class="text-sm font-semibold text-gray-400 pr-2 border-r border-gray-200 uppercase tracking-widest whitespace-nowrap"
                >
                    Filtres
                </div>

                <button
                    v-for="filter in [
                        'Rapide',
                        'Facile',
                        'Végétarien',
                        'Dessert',
                        'Pas cher',
                    ]"
                    :key="filter"
                    @click="toggleFilter(filter)"
                    :class="[
                        'px-4 py-1.5 rounded-full text-sm font-medium transition-all whitespace-nowrap border',
                        activeFilters.includes(filter)
                            ? 'bg-emerald-600 border-emerald-600 text-white shadow-md shadow-emerald-600/20'
                            : 'bg-gray-50 border-gray-200 text-gray-600 hover:border-emerald-300 hover:text-emerald-700',
                    ]"
                >
                    {{ filter }}
                </button>

                <button
                    v-if="activeFilters.length > 0"
                    @click="activeFilters = []"
                    class="ml-auto text-sm text-gray-400 hover:text-red-500 font-medium whitespace-nowrap transition-colors flex items-center gap-1"
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
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                    Effacer
                </button>
            </div>
        </div>

        <!-- Recipe Grid -->
        <div class="max-w-[1520px] mx-auto px-2 sm:px-4 lg:px-8 py-10">
            <div
                v-if="filteredRecipes.length > 0"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-10"
            >
                <Link
                    v-for="recipe in filteredRecipes"
                    :key="recipe.id"
                    :href="route('recipe', { id: recipe.id })"
                    class="group flex flex-col items-start focus:outline-none"
                >
                    <div
                        class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden mb-4 bg-gray-100 shadow-sm group-hover:shadow-xl group-hover:shadow-emerald-900/10 transition-all duration-300"
                    >
                        <img
                            :src="getRecipeImage(recipe)"
                            :alt="recipe.title"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                        />
                        <!-- Heart button -->
                        <button
                            @click.prevent="toggleFavorite(recipe.id)"
                            class="absolute top-3 right-3 p-2 rounded-full bg-white/90 backdrop-blur-sm text-gray-400 hover:text-emerald-500 hover:bg-white shadow-sm transition-all z-10"
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
                        </button>
                        <!-- Difficulty Badge -->
                        <div
                            class="absolute bottom-3 left-3 px-2.5 py-1 rounded-lg bg-black/60 backdrop-blur-md text-white text-xs font-bold border border-white/10 shadow-sm flex items-center gap-1.5"
                        >
                            <div
                                class="w-1.5 h-1.5 rounded-full"
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
                        </div>
                    </div>

                    <div class="flex items-center gap-2 mb-1">
                        <span
                            v-if="recipe.recette_type?.nom"
                            class="text-xs font-bold text-emerald-600 tracking-wide uppercase"
                            >{{ recipe.recette_type?.nom }}</span
                        >
                        <span
                            v-if="recipe.temps_preparation"
                            class="text-xs text-gray-500 flex items-center gap-1"
                            ><svg
                                class="w-3.5 h-3.5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                            {{ recipe.temps_preparation }} min</span
                        >
                    </div>

                    <h3
                        class="text-lg font-bold text-gray-900 leading-tight group-hover:text-emerald-600 transition-colors line-clamp-2"
                    >
                        {{ recipe.title }}
                    </h3>

                    <div class="mt-2 flex items-center justify-between w-full">
                        <div class="flex items-center gap-2">
                            <img
                                :src="
                                    'https://ui-avatars.com/api/?name=' +
                                    encodeURIComponent(
                                        recipe.user?.name || 'Chef',
                                    ) +
                                    '&background=f3f4f6&color=374151'
                                "
                                class="w-6 h-6 rounded-full"
                            />
                            <span class="text-sm font-medium text-gray-600">{{
                                recipe.user?.name || "Cuisinier"
                            }}</span>
                        </div>
                    </div>
                </Link>
            </div>

            <div
                v-else
                class="text-center py-20 px-4 bg-white rounded-3xl border border-gray-100 shadow-sm"
            >
                <div
                    class="w-20 h-20 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-4"
                >
                    <svg
                        class="w-10 h-10"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                        />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">
                    Aucune recette trouvée
                </h3>
                <p class="text-gray-500 max-w-md mx-auto">
                    Essayez d'ajuster vos filtres ou de rechercher un autre
                    plat. Nous ajoutons constamment de nouvelles recettes !
                </p>
                <button
                    @click="resetFilters"
                    class="mt-6 font-medium text-emerald-600 bg-emerald-50 hover:bg-emerald-100 px-6 py-2.5 rounded-full transition-colors"
                >
                    Réinitialiser
                </button>
            </div>

            <!-- Pagination (Mock for now, relies on Inertia for real implementation) -->
            <div
                v-if="recipes && recipes.last_page > 1"
                class="mt-12 flex items-center justify-center gap-2"
            >
                <Link
                    v-for="link in recipes.links"
                    :key="link.label"
                    :href="link.url || '#'"
                    class="px-4 py-2 rounded-lg font-medium transition-colors border"
                    :class="
                        link.active
                            ? 'bg-emerald-600 text-white border-emerald-600 shadow-sm'
                            : 'bg-white text-gray-600 border-gray-200 hover:border-emerald-300 hover:text-emerald-600'
                    "
                    v-html="
                        link.label
                            .replace('Previous', '&laquo; Précédent')
                            .replace('Next', 'Suivant &raquo;')
                    "
                ></Link>
            </div>
        </div>
    </VitrineLayout>
</template>

<script setup>
import { ref, computed } from "vue";
import { Link } from "@inertiajs/vue3";
import VitrineLayout from "@/Layouts/VitrineLayout.vue";

const props = defineProps({
    recipes: Object, // Paginated object
});

const searchQuery = ref("");
const activeFilters = ref([]);

const search = () => {
    // In a real app, this would use Inertia.router.get with preservation
    console.log("Searching for:", searchQuery.value);
};

const toggleFilter = (filter) => {
    if (activeFilters.value.includes(filter)) {
        activeFilters.value = activeFilters.value.filter((f) => f !== filter);
    } else {
        activeFilters.value.push(filter);
    }
};

const resetFilters = () => {
    searchQuery.value = "";
    activeFilters.value = [];
};

const toggleFavorite = (id) => {
    // Prevent default handles link navigation
    console.log("Toggled favorite for recipe:", id);
};

// Client-side filtering logic based on mock filter names vs recipe properties
const filteredRecipes = computed(() => {
    const rawRecipes = props.recipes?.data || [];

    return rawRecipes.filter((recipe) => {
        // Search filter
        if (searchQuery.value) {
            const query = searchQuery.value.toLowerCase();
            const titleMatch =
                recipe.title && recipe.title.toLowerCase().includes(query);
            const typeMatch =
                recipe.recette_type?.nom &&
                recipe.recette_type.nom.toLowerCase().includes(query);
            if (!titleMatch && !typeMatch) return false;
        }

        // Tag filters (Simplified logic for the mock tags)
        if (activeFilters.value.length > 0) {
            const time = recipe.temps_preparation || 0;
            const diff = (
                recipe.difficulte?.nom ||
                recipe.difficulte ||
                ""
            ).toLowerCase();
            const type = (recipe.recette_type?.nom || "").toLowerCase();

            for (const filter of activeFilters.value) {
                if (filter === "Rapide" && time > 30) return false;
                if (filter === "Facile" && diff !== "facile") return false;
                if (filter === "Dessert" && !type.includes("dessert"))
                    return false;
                // Add logic for Végétarien / Pas cher if data exists
            }
        }

        return true;
    });
});

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
    if (recipe.recette_photos && recipe.recette_photos.length > 0) {
        const photo = Array.isArray(recipe.recette_photos) ? recipe.recette_photos[0].photo : recipe.recette_photos.photo;
        if (photo && photo.nom_fichier) {
            return "/storage/recipes/" + photo.nom_fichier;
        }
    }

    // Similar to previous logic but kept clean
    const type = (recipe.recette_type?.nom || "").toLowerCase();
    const title = (recipe.title || "").toLowerCase();
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

    return "/images/placeholders/japanese_ramen.png"; // Premium default
};
</script>
