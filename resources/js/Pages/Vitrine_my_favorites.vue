<template>
    <Head>
        <title>Mes Recettes Favorites</title>
        <meta name="robots" content="noindex, nofollow" />
    </Head>
    <VitrineLayout>
        <!-- Hero Section -->
        <div class="bg-gray-900 text-white py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
            <div class="max-w-[1520px] mx-auto relative z-10">
                <div class="flex items-center gap-4 mb-4">
                    <Link :href="route('profile')" class="text-gray-400 hover:text-emerald-500 transition-colors">
                        &larr; Retour au profil
                    </Link>
                </div>
                <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight flex items-center gap-3">
                    <svg class="w-10 h-10 text-emerald-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    Mes Recettes Favorites
                </h1>
                <p class="text-gray-300 text-lg md:text-xl max-w-2xl font-medium">
                    Retrouvez ici toutes les recettes que vous avez enregistrées pour les cuisiner plus tard.
                </p>
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
                            class="absolute top-3 right-3 p-2 rounded-full bg-emerald-600 backdrop-blur-sm text-white shadow-sm transition-all z-10 hover:bg-emerald-700"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
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
                    Aucun favori pour l'instant
                </h3>
                <p class="text-gray-500 max-w-md mx-auto">
                    Vous n'avez pas encore enregistré de recette dans vos favoris. Parcourez notre catalogue et cliquez sur le cœur pour sauvegarder celles qui vous plaisent !
                </p>
                <Link
                    :href="route('home')"
                    class="inline-block mt-6 font-medium text-emerald-600 bg-emerald-50 hover:bg-emerald-100 px-6 py-2.5 rounded-full transition-colors"
                >
                    Découvrir des recettes
                </Link>
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
import { computed } from "vue";
import { Link, router, Head } from "@inertiajs/vue3";
import VitrineLayout from "@/Layouts/VitrineLayout.vue";

const props = defineProps({
    recipes: Object,
});

const toggleFavorite = (id) => {
    router.post(route('recipe.favorite', id), {}, { preserveScroll: true });
};

// Dans Mes Favoris, filteredRecipes est simplement tout le tableau
const filteredRecipes = computed(() => {
    return props.recipes?.data || [];
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
