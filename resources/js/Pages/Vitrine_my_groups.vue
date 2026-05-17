<template>
    <Head>
        <title>Mes Groupes</title>
        <meta name="robots" content="noindex, nofollow" />
    </Head>
    <VitrineLayout>
        <!-- Header -->
        <div
            class="bg-emerald-600 text-white py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden"
        >
            <div class="absolute inset-0 z-0">
                <div
                    class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-white/20 via-transparent to-transparent"
                ></div>
            </div>

            <div class="max-w-[1520px] mx-auto relative z-10 text-center">
                <h1 class="text-3xl md:text-5xl font-black mb-4 tracking-tight">
                    Mes Groupes
                </h1>
                <p
                    class="text-emerald-50 text-lg max-w-2xl mx-auto font-medium"
                >
                    Rejoignez des communautés de passionnés, partagez vos
                    meilleures recettes et apprenez de nouveaux secrets
                    culinaires.
                </p>
            </div>
        </div>

        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <!-- Tabs / Filter -->
            <div
                class="flex items-center justify-between mb-8 border-b border-gray-100 pb-4"
            >
                <div class="flex gap-6">
                    <button
                        class="text-emerald-600 font-bold border-b-2 border-emerald-600 pb-4 -mb-[18px]"
                    >
                        Mes Adhésions
                    </button>
                    <!-- Future features placeholder -->
                    <!-- <button class="text-gray-500 hover:text-gray-900 font-medium pb-4 border-b-2 border-transparent hover:border-gray-200 transition-colors -mb-[18px]">Découvrir</button> -->
                </div>
                
                <div class="flex items-center gap-3">
                    <Link
                        :href="route('recipe.create')"
                        class="text-emerald-600 bg-emerald-50 hover:bg-emerald-100 px-4 py-2 rounded-xl font-medium text-sm transition-colors flex items-center gap-2"
                    >
                        Créer une Recette
                    </Link>
                    <!-- Create Group Trigger -->
                <button
                    @click="showCreateModal = true"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl font-medium text-sm transition-colors shadow-sm flex items-center gap-2"
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
                            d="M12 4v16m8-8H4"
                        />
                    </svg>
                    Créer un groupe
                </button>
            </div>
        </div>

            <!-- Content Area -->
            <div
                v-if="
                    (ownedGroups && ownedGroups.length > 0) ||
                    (joinedGroups && joinedGroups.length > 0)
                "
                class="space-y-12"
            >
                <!-- My Owned Groups -->
                <div v-if="ownedGroups && ownedGroups.length > 0">
                    <h2
                        class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2"
                    >
                        <svg
                            class="w-6 h-6 text-emerald-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                            />
                        </svg>
                        Groupes que je gère
                    </h2>
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
                    >
                        <div
                            v-for="group in ownedGroups"
                            :key="group.id"
                            class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-emerald-200 transition-all group"
                        >
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold text-gray-900">
                                    {{ group.nom }}
                                </h3>
                                <!-- Group Settings Dropdown (Simplified Edit/Delete) -->
                                <div class="flex gap-2">
                                    <button
                                        @click="openEditModal(group)"
                                        class="text-gray-400 hover:text-emerald-600 transition-colors p-1"
                                        title="Modifier le groupe"
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
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                            />
                                        </svg>
                                    </button>
                                    <button
                                        @click="confirmDelete(group)"
                                        class="text-gray-400 hover:text-red-600 transition-colors p-1"
                                        title="Supprimer le groupe"
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
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div
                                class="flex items-center gap-2 text-sm text-gray-500 mb-6"
                            >
                                <svg
                                    class="w-4 h-4 text-emerald-500"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                    />
                                </svg>
                                {{ group.membres_count || 0 }} Membre(s)
                            </div>
                            <Link
                                :href="route('groups.show', group.id)"
                                class="w-full bg-emerald-50 text-emerald-700 font-medium py-2 rounded-lg hover:bg-emerald-100 transition-colors text-center block mt-6"
                            >
                                Gérer et voir le groupe
                            </Link>
                        </div>
                    </div>
                </div>

                <!-- Groups Joined -->
                <div v-if="joinedGroups && joinedGroups.length > 0">
                    <h2
                        class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2"
                    >
                        <svg
                            class="w-6 h-6 text-emerald-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"
                            />
                        </svg>
                        Groupes rejoints
                    </h2>
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
                    >
                        <div
                            v-for="group in joinedGroups"
                            :key="group.id"
                            class="bg-gray-50 border border-gray-100 rounded-2xl p-6 shadow-sm"
                        >
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                {{ group.nom }}
                            </h3>
                            <p
                                class="text-sm text-gray-500 mb-4 flex items-center gap-1.5"
                            >
                                Créé par
                                    <img
                                        :src="group.owner?.avatar"
                                        class="w-5 h-5 rounded-full object-cover"
                                    />
                                <span class="font-medium text-gray-700">{{
                                    group.owner?.username || "Inconnu"
                                }}</span>
                            </p>
                            <div
                                class="flex items-center gap-2 text-sm text-gray-500 mb-6"
                            >
                                <svg
                                    class="w-4 h-4 text-gray-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                    />
                                </svg>
                                {{ group.membres_count || 0 }} Membre(s)
                            </div>
                            <div class="flex gap-2">
                                <Link
                                    :href="route('groups.show', group.id)"
                                    class="flex-1 bg-white border border-gray-200 text-gray-700 font-medium py-2 rounded-lg hover:border-emerald-300 hover:text-emerald-700 transition-colors text-center block"
                                >
                                    Voir Recettes
                                </Link>
                                <button
                                    @click="confirmLeave(group)"
                                    class="px-4 bg-white border border-red-100 text-red-500 font-medium py-2 rounded-lg hover:bg-red-50 hover:border-red-200 transition-colors"
                                    title="Quitter le groupe"
                                >
                                    Quitter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State for Groups -->
            <div
                v-else
                class="text-center py-20 px-4 bg-white rounded-3xl border border-gray-100 shadow-sm max-w-3xl mx-auto"
            >
                <div
                    class="w-20 h-20 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-5 relative group"
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
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                        />
                    </svg>
                    <div
                        class="absolute -top-1 -right-1 text-yellow-400 opacity-0 group-hover:opacity-100 transition-opacity"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                            />
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">
                    Vous n'avez rejoint aucun groupe
                </h3>
                <p class="text-gray-500 mb-8 max-w-md mx-auto">
                    Créez votre propre groupe ou demandez à un ami de vous
                    inviter pour partager des recettes exclusives.
                </p>
                <button
                    @click="showCreateModal = true"
                    class="font-medium text-emerald-600 bg-emerald-50 hover:bg-emerald-100 px-8 py-3 rounded-full transition-colors text-lg inline-flex items-center gap-2"
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
                            d="M12 4v16m8-8H4"
                        />
                    </svg>
                    Créer mon premier groupe
                </button>
            </div>
        </div>

        <!-- Modals -->

        <!-- Create Group Modal -->
        <div
            v-if="showCreateModal"
            class="premium-modal-backdrop"
            @click.self="showCreateModal = false"
        >
            <div
                class="premium-modal-content max-w-md p-6 bg-white relative"
            >
                <button
                    @click="showCreateModal = false"
                    class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 transition-colors"
                >
                    <i class="fas fa-times text-lg"></i>
                </button>
                <h3 class="text-2xl font-black text-slate-900 mb-6">
                    Nouveau Groupe
                </h3>

                <form @submit.prevent="submitCreate">
                    <div class="mb-6">
                        <label class="premium-label">Nom du groupe</label>
                        <input
                            v-model="createForm.nom"
                            type="text"
                            class="premium-input"
                            required
                            placeholder="Ex: Recettes de Famille"
                        />
                    </div>

                    <button
                        type="submit"
                        :disabled="createForm.processing"
                        class="w-full premium-button-primary disabled:opacity-50"
                    >
                        Créer le groupe
                    </button>
                </form>
            </div>
        </div>

        <!-- Edit Group Modal -->
        <div
            v-if="showEditModal"
            class="premium-modal-backdrop"
            @click.self="showEditModal = false"
        >
            <div
                class="premium-modal-content max-w-md p-6 bg-white relative"
            >
                <button
                    @click="showEditModal = false"
                    class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 transition-colors"
                >
                    <i class="fas fa-times text-lg"></i>
                </button>
                <h3 class="text-2xl font-black text-slate-900 mb-6">
                    Modifier le Groupe
                </h3>

                <form @submit.prevent="submitEdit">
                    <div class="mb-6">
                        <label class="premium-label">Nouveau nom</label>
                        <input
                            v-model="editForm.nom"
                            type="text"
                            class="premium-input"
                            required
                        />
                    </div>

                    <button
                        type="submit"
                        :disabled="editForm.processing"
                        class="w-full premium-button-primary disabled:opacity-50"
                    >
                        Mettre à jour
                    </button>
                </form>
            </div>
        </div>

        <!-- Confirm Modals -->
        <PremiumConfirmModal 
            :show="showConfirmDelete"
            title="Supprimer le groupe"
            :message="'Voulez-vous vraiment supprimer DÉFINITIVEMENT le groupe ' + selectedGroup?.nom + ' ?'"
            @confirm="executeDelete"
            @close="showConfirmDelete = false"
        />

        <PremiumConfirmModal 
            :show="showConfirmLeave"
            title="Quitter le groupe"
            :message="'Voulez-vous vraiment quitter le groupe ' + selectedGroup?.nom + ' ?'"
            @confirm="executeLeave"
            @close="showConfirmLeave = false"
        />
    </VitrineLayout>
</template>

<script setup>
import { ref } from "vue";
import { useForm, Link, Head, router } from "@inertiajs/vue3";
import VitrineLayout from "@/Layouts/VitrineLayout.vue";
import PremiumConfirmModal from "@/Components/PremiumConfirmModal.vue";

const props = defineProps({
    ownedGroups: {
        type: Array,
        default: () => [],
    },
    joinedGroups: {
        type: Array,
        default: () => [],
    },
});

// Modals State
const showCreateModal = ref(false);
const showEditModal = ref(false);
const showConfirmDelete = ref(false);
const showConfirmLeave = ref(false);
const selectedGroup = ref(null);

// Forms
const createForm = useForm({
    nom: "",
});

const editForm = useForm({
    id: null,
    nom: "",
});

const submitCreate = () => {
    createForm.post(route("groups.store"), {
        preserveScroll: true,
        onSuccess: () => {
            showCreateModal.value = false;
            createForm.reset();
        },
    });
};

const openEditModal = (group) => {
    editForm.id = group.id;
    editForm.nom = group.nom;
    showEditModal.value = true;
};

const submitEdit = () => {
    editForm.put(route("groups.update", { id: editForm.id }), {
        preserveScroll: true,
        onSuccess: () => {
            showEditModal.value = false;
            editForm.reset();
        },
    });
};

const confirmDelete = (group) => {
    selectedGroup.value = group;
    showConfirmDelete.value = true;
};

const executeDelete = () => {
    router.delete(route("groups.destroy", { id: selectedGroup.value.id }), {
        preserveScroll: true,
        onSuccess: () => {
            showConfirmDelete.value = false;
        }
    });
};

const confirmLeave = (group) => {
    selectedGroup.value = group;
    showConfirmLeave.value = true;
};

const executeLeave = () => {
    router.post(route("groups.leave", { id: selectedGroup.value.id }), {}, {
        preserveScroll: true,
        onSuccess: () => {
            showConfirmLeave.value = false;
        }
    });
};
</script>
