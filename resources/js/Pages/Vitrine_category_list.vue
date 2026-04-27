<template>
    <Head>
        <title>Catégories de recettes</title>
        <meta name="description" content="Parcourez toutes les catégories de recettes Family Recipe : entrées, plats, desserts, cuisine asiatique, italienne et bien plus. Trouvez l'inspiration par thème." />
        <meta property="og:title" content="Catégories de recettes — Family Recipe" />
        <meta property="og:description" content="De l'entrée au dessert, explorez nos catégories de recettes soigneusement triées." />
    </Head>
    <VitrineLayout>
        <!-- Refreshed Header -->
        <div class="bg-gray-900 text-white relative overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-40">
                <img
                    src="/images/placeholders/mediterranean_salad.png"
                    alt="Background"
                    class="w-full h-full object-cover blur-sm"
                />
                <div
                    class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/90 to-transparent"
                ></div>
            </div>
            <div
                class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10"
            >
                <div class="max-w-2xl">
                    <h1
                        class="text-4xl md:text-5xl font-black mb-4 tracking-tight"
                    >
                        Explorez par Catégorie
                    </h1>
                    <p class="text-gray-300 text-lg md:text-xl font-medium">
                        De l'entrée au dessert, trouvez l'inspiration parfaite
                        pour votre prochain repas parmi nos collections
                        soigneusement triées.
                    </p>
                </div>
            </div>
        </div>

        <!-- Categories Grid -->
        <div class="w-full max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900">
                    Toutes les Catégories
                </h2>
            </div>

            <div
                v-if="categories.length > 0"
                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6 w-full"
            >
                <div 
                    v-for="category in categories" 
                    :key="category.id" 
                    class="w-full"
                >
                    <Link
                        :href="route('category.show', { id: category.id })"
                        class="group relative block w-full min-h-[256px] h-64 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl hover:shadow-emerald-900/20 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-emerald-500/50 bg-gray-100"
                    >
                        <!-- Background Image -->
                        <div class="absolute inset-0 z-0 w-full h-full">
                            <img
                                :src="
                                    category.icone &&
                                    category.icone.startsWith('http')
                                        ? category.icone
                                        : getCategoryPlaceholder(category.nom)
                                "
                                :alt="category.nom"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out"
                            />
                        </div>

                        <!-- Gradient Overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-black/10 z-10 transition-opacity group-hover:opacity-90"
                        ></div>

                        <!-- Content -->
                        <div
                            class="absolute inset-0 z-20 flex flex-col justify-end p-6"
                        >
                            <div
                                class="transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300"
                            >
                                <h3
                                    class="text-2xl font-bold text-white mb-1 drop-shadow-md"
                                >
                                    {{ category.nom }}
                                </h3>
                                <div
                                    class="flex items-center gap-2 text-emerald-300 opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100"
                                >
                                    <span class="text-sm font-medium"
                                        >{{
                                            category.recette_types_count || 0
                                        }}
                                        Sous-catégories</span
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
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </Link>
                </div>
            </div>

            <!-- Empty State -->
            <div v-else class="text-center py-24 bg-gray-50 rounded-3xl">
                <div
                    class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400"
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
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                        />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">
                    Aucune catégorie disponible
                </h3>
                <p class="text-gray-500">
                    Revenez plus tard pour découvrir de nouvelles catégories de
                    recettes.
                </p>
            </div>
        </div>
    </VitrineLayout>
</template>

<script setup>
import { Link, Head } from "@inertiajs/vue3";
import VitrineLayout from "@/Layouts/VitrineLayout.vue";

const props = defineProps({
    categories: {
        type: Array,
        default: () => [],
    },
});

const getCategoryPlaceholder = (name) => {
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

    // Default image
    return "/images/placeholders/italian_pasta.png";
};
</script>
