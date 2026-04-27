<template>
    <Head>
        <title>Mon Profil — Family Recipe</title>
        <meta name="robots" content="noindex, nofollow" />
    </Head>
    <VitrineLayout>
        <!-- Profile Header -->
        <div class="relative bg-gray-900 border-b border-gray-100 pb-16">
            <!-- Cover Image -->
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
                            :src="user.avatar"
                            class="w-full h-full rounded-2xl border-4 border-white shadow-xl object-cover"
                        />
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
                                @{{ user.username }} • {{ user.email }}
                            </p>
                            <p class="text-gray-200 md:text-gray-600 max-w-xl">
                                {{ user.bio }}
                            </p>
                        </div>
                        <button
                            @click="isEditing = !isEditing"
                            class="inline-flex justify-center items-center gap-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-100 px-6 py-2.5 rounded-xl font-medium transition-colors border border-emerald-100 shadow-sm"
                        >
                            <svg v-if="!isEditing" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <svg v-else class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            {{ isEditing ? 'Annuler' : 'Modifier mon profil' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Edit Form -->
            <transition
                enter-active-class="transition ease-out duration-200"
                enter-from-class="opacity-0 -translate-y-4"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition ease-in duration-150"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 -translate-y-4"
            >
                <div v-if="isEditing" class="mb-12 bg-white rounded-3xl border border-emerald-100 shadow-xl shadow-emerald-900/5 p-8">
                    <form @submit.prevent="submitProfile" class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-6">
                                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <span class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center text-sm">01</span>
                                    Informations de base
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nom d'utilisateur</label>
                                        <input v-model="form.username" type="text" class="w-full bg-gray-50 border-gray-200 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 transition-all" />
                                        <p v-if="form.errors.username" class="mt-1 text-sm text-red-600">{{ form.errors.username }}</p>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Prénom</label>
                                            <input v-model="form.firstname" type="text" class="w-full bg-gray-50 border-gray-200 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 transition-all" />
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nom</label>
                                            <input v-model="form.lastname" type="text" class="w-full bg-gray-50 border-gray-200 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 transition-all" />
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                                        <input v-model="form.email" type="email" class="w-full bg-gray-50 border-gray-200 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 transition-all" />
                                        <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <span class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center text-sm">02</span>
                                    Détails & Sécurité
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">À propos de moi</label>
                                        <textarea v-model="form.about" rows="3" class="w-full bg-gray-50 border-gray-200 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 transition-all"></textarea>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Ville</label>
                                            <input v-model="form.city" type="text" class="w-full bg-gray-50 border-gray-200 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 transition-all" />
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Pays</label>
                                            <input v-model="form.country" type="text" class="w-full bg-gray-50 border-gray-200 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 transition-all" />
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nouveau mot de passe (optionnel)</label>
                                        <input v-model="form.password" type="password" class="w-full bg-gray-50 border-gray-200 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 transition-all" />
                                        <p v-if="form.errors.password" class="mt-1 text-sm text-red-600">{{ form.errors.password }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                            <button
                                type="button"
                                @click="isEditing = false"
                                class="px-6 py-2.5 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-colors"
                            >
                                Annuler
                            </button>
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="bg-emerald-600 text-white px-8 py-2.5 rounded-xl font-bold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-600/20 disabled:opacity-50"
                            >
                                {{ form.processing ? 'Enregistrement...' : 'Enregistrer les modifications' }}
                            </button>
                        </div>
                    </form>
                </div>
            </transition>

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
                            Mes Recettes Récentes
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
                        <Link
                            :href="route('recipe.create')"
                            class="inline-block font-medium text-white bg-emerald-600 hover:bg-emerald-700 px-6 py-2.5 rounded-xl transition-colors shadow-md shadow-emerald-600/20"
                        >
                            Ajouter une recette
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </VitrineLayout>
</template>

<script setup>
import { Link, Head, useForm } from "@inertiajs/vue3";
import VitrineLayout from "@/Layouts/VitrineLayout.vue";
import { ref } from "vue";

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

const isEditing = ref(false);

const form = useForm({
    username: props.user.username,
    firstname: props.user.name.split(' ')[0] || '',
    lastname: props.user.name.split(' ')[1] || '',
    email: props.user.email,
    about: props.user.bio !== 'Aucune biographie renseignée.' ? props.user.bio : '',
    city: props.user.location.split(', ')[0] || '',
    country: props.user.location.split(', ')[1] || '',
    password: '',
    password_confirmation: '',
});

const submitProfile = () => {
    form.put(route('profile.update'), {
        preserveScroll: true,
        onSuccess: () => {
            isEditing.value = false;
        },
    });
};

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
