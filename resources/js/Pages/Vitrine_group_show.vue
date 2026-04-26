<template>
    <Head>
        <title>{{ group.nom }}</title>
        <meta name="robots" content="noindex, nofollow" />
    </Head>
    <VitrineLayout>
        <!-- Header -->
        <div class="bg-gray-900 text-white py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
            <div class="max-w-[1520px] mx-auto relative z-10">
                <div class="flex items-center gap-4 mb-4">
                    <Link :href="route('groups')" class="text-gray-400 hover:text-emerald-500 transition-colors">
                        &larr; Retour à Mes Groupes
                    </Link>
                </div>
                <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight flex items-center gap-3">
                    <svg class="w-10 h-10 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    {{ group.nom }}
                </h1>
                <p class="text-gray-300 text-lg max-w-2xl font-medium flex items-center gap-2">
                    Géré par <span class="text-white font-bold">{{ group.owner?.username }}</span>
                    <span v-if="isOwner" class="bg-emerald-600/20 text-emerald-400 text-xs px-2 py-1 rounded-md border border-emerald-500/30 font-bold ml-2">C'est vous !</span>
                </p>
            </div>
        </div>

        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <!-- Onglets -->
            <div class="flex gap-6 mb-8 border-b border-gray-100 pb-4">
                <button 
                    @click="activeTab = 'recipes'"
                    :class="['font-bold pb-4 -mb-[18px] transition-colors', activeTab === 'recipes' ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-gray-500 hover:text-gray-900']"
                >
                    Recettes du groupe ({{ recipes.length }})
                </button>
                <button 
                    @click="activeTab = 'members'"
                    :class="['font-bold pb-4 -mb-[18px] transition-colors', activeTab === 'members' ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-gray-500 hover:text-gray-900']"
                >
                    Membres & Invités ({{ group.membres?.length || 0 }})
                </button>
            </div>

            <!-- TAB RECETTES -->
            <div v-if="activeTab === 'recipes'">
                <div class="flex justify-end mb-6">
                    <Link :href="route('recipe.create', { groupe_id: group.id })" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-xl shadow-sm transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Partager une recette
                    </Link>
                </div>

                <div v-if="recipes.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <Link
                        v-for="recipe in recipes"
                        :key="recipe.id"
                        :href="route('recipe', { id: recipe.id })"
                        class="group flex flex-col items-start focus:outline-none"
                    >
                        <div class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden mb-4 bg-gray-100 shadow-sm group-hover:shadow-lg transition-all duration-300 border border-gray-200">
                            <img
                                :src="getRecipeImage(recipe)"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                            />
                            <!-- Difficulty Badge -->
                            <div class="absolute bottom-3 left-3 px-2.5 py-1 rounded-lg bg-black/60 backdrop-blur-md text-white text-xs font-bold border border-white/10 shadow-sm flex items-center gap-1.5">
                                <div class="w-1.5 h-1.5 rounded-full" :class="getDifficultyColorClass(recipe.difficulte?.nom)"></div>
                                {{ recipe.difficulte?.nom || "Non défini" }}
                            </div>
                        </div>

                        <div class="flex items-center gap-2 mb-1">
                            <span v-if="recipe.recette_type?.nom" class="text-xs font-bold text-emerald-600 tracking-wide uppercase">{{ recipe.recette_type?.nom }}</span>
                        </div>

                        <h3 class="text-lg font-bold text-gray-900 leading-tight group-hover:text-emerald-600 transition-colors line-clamp-2">
                            {{ recipe.title }}
                        </h3>

                        <div class="mt-2 flex items-center justify-between w-full">
                            <div class="flex items-center gap-2">
                                <img :src="'https://ui-avatars.com/api/?name=' + encodeURIComponent(recipe.user?.username || 'Chef') + '&background=f3f4f6&color=374151'" class="w-6 h-6 rounded-full" />
                                <span class="text-sm font-medium text-gray-600">{{ recipe.user?.username || "Cuisinier" }}</span>
                            </div>
                        </div>
                    </Link>
                </div>

                <div v-else class="text-center py-20 px-4 bg-white rounded-3xl border border-gray-100 shadow-sm">
                    <div class="w-16 h-16 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Aucune recette</h3>
                    <p class="text-gray-500 max-w-md mx-auto mb-6">Ce groupe n'a pas encore de recettes partagées. Soyez le premier !</p>
                    <Link :href="route('recipe.create')" class="font-medium text-emerald-600 bg-emerald-50 hover:bg-emerald-100 px-6 py-2.5 rounded-full transition-colors">Partager une recette</Link>
                </div>
            </div>

            <!-- TAB MEMBRES -->
            <div v-if="activeTab === 'members'">
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Liste des Membres -->
                    <div class="md:w-2/3 space-y-4">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Membres actuels</h3>
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden divide-y divide-gray-100">
                            <!-- Administrateur -->
                            <div class="p-4 flex items-center justify-between bg-gray-50">
                                <div class="flex items-center gap-3">
                                    <img :src="'https://ui-avatars.com/api/?name=' + encodeURIComponent(group.owner?.username || 'Chef') + '&background=059669&color=fff'" class="w-10 h-10 rounded-full" />
                                    <div>
                                        <p class="font-bold text-gray-900">{{ group.owner?.username }} (Créateur)</p>
                                        <p class="text-sm text-gray-500">{{ group.owner?.email }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Autres membres -->
                            <div v-for="membre in group.membres" :key="membre.id" class="p-4 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <img :src="'https://ui-avatars.com/api/?name=' + encodeURIComponent(membre.username || 'Chef') + '&background=f3f4f6&color=374151'" class="w-10 h-10 rounded-full" />
                                    <div>
                                        <p class="font-bold text-gray-900">{{ membre.username }}</p>
                                        <p class="text-sm text-gray-500">{{ membre.email }}</p>
                                    </div>
                                </div>
                                <button v-if="isOwner" @click="kickMember(membre)" class="text-red-400 hover:text-red-600 text-sm font-bold uppercase disabled:opacity-50 tracking-wider">Éjecter</button>
                            </div>

                            <div v-if="!group.membres || group.membres.length === 0" class="p-8 text-center text-gray-500">
                                Vous êtes seul dans ce groupe pour le moment.
                            </div>
                        </div>

                        <!-- Liste des Invitations (pour l'owner) -->
                        <div v-if="isOwner && invitations.length > 0" class="mt-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Invitations en attente</h3>
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden divide-y divide-gray-100">
                                <div v-for="invit in invitations" :key="invit.id" class="p-4 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900">{{ invit.email }}</p>
                                            <p class="text-sm text-yellow-600">En attente de création de compte...</p>
                                        </div>
                                    </div>
                                    <button @click="revokeInvitation(invit.id)" class="text-red-400 hover:text-red-600 text-sm font-bold uppercase tracking-wider">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Encart Ajouter un Membre -->
                    <div class="md:w-1/3" v-if="isOwner">
                        <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-6 sticky top-24">
                            <h3 class="text-lg font-bold text-emerald-900 mb-2">Inviter quelqu'un</h3>
                            <p class="text-sm text-emerald-700 mb-6">Ajoutez un ami par son adresse e-mail. S'il n'a pas encore de compte, il recevra un e-mail pour s'inscrire !</p>
                            
                            <form @submit.prevent="inviteMember">
                                <div class="mb-4">
                                    <label class="block text-sm font-bold text-emerald-900 mb-1">Adresse e-mail</label>
                                    <input 
                                        v-model="inviteForm.email"
                                        type="email" 
                                        required
                                        placeholder="ami@exemple.com"
                                        class="w-full px-4 py-2 rounded-xl border border-emerald-200 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    />
                                    <p v-if="inviteForm.errors.email" class="text-red-500 text-xs mt-1">{{ inviteForm.errors.email }}</p>
                                </div>
                                <button 
                                    type="submit" 
                                    :disabled="inviteForm.processing"
                                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-xl transition-colors disabled:opacity-50 flex justify-center items-center gap-2"
                                >
                                    <span v-if="inviteForm.processing" class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                                    Inviter
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </VitrineLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Link, useForm, router, Head } from '@inertiajs/vue3';
import VitrineLayout from '@/Layouts/VitrineLayout.vue';

const props = defineProps({
    group: Object,
    recipes: Array,
    invitations: Array,
    isOwner: Boolean,
});

const activeTab = ref('recipes');

const inviteForm = useForm({
    email: '',
});

const inviteMember = () => {
    inviteForm.post(route('groups.members.add', props.group.id), {
        preserveScroll: true,
        onSuccess: () => inviteForm.reset(),
    });
};

const kickMember = (membre) => {
    if(confirm(`Voulez-vous vraiment éjecter ${membre.username} du groupe ?`)) {
        router.delete(route('groups.members.remove', { id: props.group.id, user_id: membre.id }), { preserveScroll: true });
    }
};

const revokeInvitation = (invitationId) => {
    if(confirm(`Annuler cette invitation ?`)) {
        router.delete(route('groups.invitations.revoke', { id: props.group.id, invitation_id: invitationId }), { preserveScroll: true });
    }
};

const getDifficultyColorClass = (difficulty) => {
    const diff = (difficulty || "").toLowerCase();
    if (diff === "facile") return "bg-green-400";
    if (diff === "moyen") return "bg-yellow-400";
    if (diff === "difficile") return "bg-red-500";
    return "bg-gray-400";
};

const getRecipeImage = (recipe) => {
    if (recipe.recette_photos && recipe.recette_photos.length > 0) {
        const photo = Array.isArray(recipe.recette_photos) ? recipe.recette_photos[0].photo : recipe.recette_photos.photo;
        if (photo && photo.nom_fichier) {
            return "/storage/recipes/" + photo.nom_fichier;
        }
    }
    return "/images/placeholders/japanese_ramen.png";
};
</script>
