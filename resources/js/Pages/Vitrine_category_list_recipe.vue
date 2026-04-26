<template>
    <Head>
        <title>{{ category.nom }}</title>
        <meta name="description" :content="`Découvrez toutes les recettes de la catégorie ${category.nom} sur CookBook. Laissez-vous inspirer par nos meilleures créations culinaires.`" />
        <meta property="og:title" :content="`${category.nom} — CookBook`" />
        <meta property="og:description" :content="`Toutes nos meilleures recettes ${category.nom}. Trouvez l'inspiration pour votre prochain repas.`" />
    </Head>
    <VitrineLayout>
        <!-- Category Hero -->
        <div class="bg-gray-900 text-white relative overflow-hidden py-16">
            <div class="absolute inset-0 z-0 opacity-40">
                <!-- Use the category placeholder logic -->
                <img
                    :src="
                        category.icone && category.icone.startsWith('http')
                            ? category.icone
                            : getCategoryImage(category.nom)
                    "
                    alt="Background"
                    class="w-full h-full object-cover blur-sm"
                />
                <div
                    class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent"
                ></div>
            </div>

            <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <Link
                    :href="route('categories.list')"
                    class="inline-flex items-center gap-2 text-emerald-400 hover:text-emerald-300 transition-colors mb-6 text-sm font-medium"
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
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"
                        />
                    </svg>
                    Retour aux Catégories
                </Link>

                <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">
                    {{ category.nom }}
                </h1>
                <p class="text-gray-300 text-lg max-w-2xl font-medium">
                    Toutes nos meilleures recettes de la catégorie
                    {{ category.nom }}. Laissez-vous inspirer.
                </p>
            </div>
        </div>

        <!-- Recipe Grid -->
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900">
                    Recettes associées
                    <span class="text-gray-400 text-lg font-normal ml-2"
                        >({{ recipes.length || 0 }})</span
                    >
                </h2>
            </div>

            <div
                v-if="recipes.length > 0"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-10"
            >
                <Link
                    v-for="recipe in recipes"
                    :key="recipe.id"
                    :href="route('recipe', { id: recipe.id })"
                    class="group flex flex-col items-start focus:outline-none"
                >
                    <div
                        class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden mb-4 bg-gray-100 shadow-sm group-hover:shadow-xl group-hover:shadow-emerald-900/10 transition-all duration-300"
                    >
                        <img
                            :src="getRecipeImage(recipe)"
                            :alt="recipe.titre"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                        />

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
                        {{ recipe.titre }}
                    </h3>
                </Link>
            </div>

            <div
                v-else
                class="text-center py-20 px-4 bg-white rounded-3xl border border-gray-100 shadow-sm mt-8"
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
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                        />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">
                    Aucune recette
                </h3>
                <p class="text-gray-500 max-w-md mx-auto">
                    Il n'y a pas encore de recettes dans cette catégorie.
                    Revenez plus tard !
                </p>
                <Link
                    :href="route('home')"
                    class="mt-6 inline-block font-medium text-emerald-600 bg-emerald-50 hover:bg-emerald-100 px-6 py-2.5 rounded-full transition-colors"
                >
                    Explorer d'autres recettes
                </Link>
            </div>
        </div>
    </VitrineLayout>
</template>

<script setup>
import { Link, Head } from "@inertiajs/vue3";
import VitrineLayout from "@/Layouts/VitrineLayout.vue";

const props = defineProps({
    category: {
        type: Object,
        required: true,
    },
    recipes: {
        type: Array,
        default: () => [],
    },
});

const getDifficultyColorClass = (difficulty) => {
    const diff = (difficulty || "").toLowerCase();
    if (diff === "facile") return "bg-green-400";
    if (diff === "moyen") return "bg-yellow-400";
    if (diff === "difficile") return "bg-red-500";
    return "bg-gray-400";
};

const getCategoryImage = (name) => {
    const n = (name || "").toLowerCase();

    if (n.includes("asiat") || n.includes("japon"))
        return "/images/placeholders/japanese_ramen.png";
    if (n.includes("italie") || n.includes("pâte"))
        return "/images/placeholders/italian_pasta.png";
    if (n.includes("salade") || n.includes("santé") || n.includes("végé"))
        return "/images/placeholders/mediterranean_salad.png";
    if (n.includes("indien") || n.includes("épicé"))
        return "/images/placeholders/thai_curry.png";
    if (
        n.includes("dessert") ||
        n.includes("sucré") ||
        n.includes("pâtisserie")
    )
        return "/images/placeholders/chocolate_dessert.png";
    if (n.includes("boulanger") || n.includes("pain") || n.includes("matin"))
        return "/images/placeholders/baked_goods.png";
    if (n.includes("mer") || n.includes("poiss"))
        return "/images/placeholders/seafood_platter.png";
    if (n.includes("brunch") || n.includes("déjeuner"))
        return "/images/placeholders/breakfast_spread.png";

    return "/images/placeholders/italian_pasta.png";
};

const getRecipeImage = (recipe) => {
    const type = (recipe.recette_type?.nom || "").toLowerCase();
    const title = (recipe.titre || "").toLowerCase();
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
