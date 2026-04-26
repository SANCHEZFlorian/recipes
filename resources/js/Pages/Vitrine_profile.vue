<template>
    <Head>
        <title>Mon Profil</title>
        <meta name="robots" content="noindex, nofollow" />
    </Head>
    <VitrineLayout>
        <!-- Profile Header -->
        <div class="relative bg-gray-900 border-b border-gray-100 pb-16">
            <!-- Cover Image (Mocked gradient for elegance) -->
            <div
                class="h-48 md:h-64 bg-gradient-to-r from-emerald-600 via-emerald-700 to-emerald-900 w-full object-cover"
            ></div>

            <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div
                    class="flex flex-col md:flex-row gap-6 relative -mt-16 md:-mt-20"
                >
                    <!-- Avatar -->
                    <div
                        class="relative w-32 h-32 md:w-40 md:h-40 shrink-0 mx-auto md:mx-0"
                    >
                        <img
                            :src="
                                'https://ui-avatars.com/api/?name=' +
                                encodeURIComponent(user.name) +
                                '&background=ffffff&color=047857&size=200'
                            "
                            class="w-full h-full rounded-2xl border-4 border-white shadow-xl object-cover"
                        />
                        <button
                            class="absolute bottom-2 right-2 bg-white text-gray-600 p-2 rounded-xl shadow-md border border-gray-100 hover:text-emerald-600 transition-colors"
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
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>
                        </button>
                    </div>

                    <!-- User Info -->
                    <div
                        class="flex-1 pt-2 md:pt-24 text-center md:text-left flex flex-col md:flex-row md:items-end md:justify-between gap-4"
                    >
                        <div>
                            <h1
                                class="text-3xl font-black text-white md:text-gray-900 drop-shadow-md md:drop-shadow-none"
                            >
                                {{ user.name }}
                            </h1>
                            <p
                                class="text-emerald-300 md:text-emerald-600 font-medium mb-3"
                            >
                                {{ user.email }}
                            </p>
                            <p class="text-gray-200 md:text-gray-600 max-w-xl">
                                {{
                                    user.bio ||
                                    "Passionné de cuisine. Toujours à la recherche de nouvelles saveurs à partager."
                                }}
                            </p>
                        </div>
                        <Link
                            :href="route('profile')"
                            class="inline-flex justify-center items-center gap-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-100 px-6 py-2.5 rounded-xl font-medium transition-colors border border-emerald-100"
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
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>
                            Modifier le profil
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Stats Card -->
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
                    >
                        <h3
                            class="font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2"
                        >
                            Statistiques
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-gray-500 flex items-center gap-2"
                                    ><svg
                                        class="w-4 h-4 text-emerald-500"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                                        />
                                    </svg>
                                    Recettes</span
                                >
                                <span class="font-bold text-gray-900">{{
                                    user.stats?.recipes || 0
                                }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-gray-500 flex items-center gap-2"
                                    ><svg
                                        class="w-4 h-4 text-emerald-500"
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
                                    Favoris</span
                                >
                                <span class="font-bold text-gray-900">{{
                                    user.stats?.favorites || 0
                                }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-gray-500 flex items-center gap-2"
                                    ><svg
                                        class="w-4 h-4 text-emerald-500"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                        />
                                    </svg>
                                    Vues</span
                                >
                                <span class="font-bold text-gray-900">{{
                                    user.stats?.views || 0
                                }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">
                            Mes Recettes Récents
                        </h2>
                        <Link
                            :href="route('home')"
                            class="text-emerald-600 hover:text-emerald-700 font-medium text-sm transition-colors"
                            >Toutes voir &rarr;</Link
                        >
                    </div>

                    <div
                        v-if="recentRecipes && recentRecipes.length > 0"
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
                    >
                        <Link
                            v-for="recipe in recentRecipes"
                            :key="recipe.id"
                            :href="route('recipe', { id: recipe.id })"
                            class="group flex flex-col items-start focus:outline-none"
                        >
                            <div
                                class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden mb-3 bg-gray-100 shadow-sm group-hover:shadow-xl group-hover:shadow-emerald-900/10 transition-all duration-300"
                            >
                                <img
                                    :src="getRecipeImage(recipe)"
                                    :alt="recipe.titre"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                                />
                                <div
                                    class="absolute bottom-2 left-2 px-2 py-1 rounded-md bg-black/60 backdrop-blur-md text-white text-xs font-bold border border-white/10 shadow-sm flex items-center gap-1.5"
                                >
                                    <div
                                        class="w-1.5 h-1.5 rounded-full"
                                        :class="
                                            recipe.difficulte?.nom === 'Facile'
                                                ? 'bg-green-400'
                                                : 'bg-yellow-400'
                                        "
                                    ></div>
                                    {{ recipe.difficulte?.nom || "Facile" }}
                                </div>
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
                        class="text-center py-16 px-4 bg-white rounded-3xl border border-gray-100 shadow-sm block"
                    >
                        <div
                            class="w-16 h-16 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-4"
                        >
                            <svg
                                class="w-8 h-8"
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
                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            Aucune recette
                        </h3>
                        <p class="text-gray-500 max-w-sm mx-auto mb-6">
                            Vous n'avez pas encore publié de recette. Partagez
                            votre passion avec la communauté !
                        </p>
                        <button
                            class="font-medium text-white bg-emerald-600 hover:bg-emerald-700 px-6 py-2.5 rounded-xl transition-colors shadow-md shadow-emerald-600/20"
                        >
                            Ajouter une recette
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </VitrineLayout>
</template>

<script setup>
import { Link, Head } from "@inertiajs/vue3";
import VitrineLayout from "@/Layouts/VitrineLayout.vue";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    recentRecipes: {
        type: Array,
        default: () => [],
    },
    recentActivity: {
        type: Array,
        default: () => [],
    },
});

const getRecipeImage = (recipe) => {
    // Basic premium fallback mapping
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

    return "/images/placeholders/mediterranean_salad.png";
};
</script>
