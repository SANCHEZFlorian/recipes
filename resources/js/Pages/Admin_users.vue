<template>
    <AdminLayout>
        <div class="py-6">
            <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-8 flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            Gestion des Utilisateurs
                        </h1>
                        <p class="mt-1 text-sm text-gray-500">
                            Gérez les membres de la communauté, leurs informations personnelles et leurs droits d'accès.
                        </p>
                    </div>
                    <button @click="openCreateModal" class="premium-button-primary">
                        <i class="fas fa-user-plus mr-2"></i> Ajouter un utilisateur
                    </button>
                </div>

                <!-- Users Table -->
                <div class="premium-table-container">
                    <table class="premium-table">
                        <thead>
                            <tr>
                                <th>Utilisateur</th>
                                <th>Rôle</th>
                                <th>Inscription</th>
                                <th>Dernière Connexion</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr v-for="user in users" :key="user.id">
                                <td>
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 font-black shadow-inner">
                                            {{ user.username.charAt(0).toUpperCase() }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-black text-slate-900">{{ user.username }}</div>
                                            <div class="text-xs text-slate-500 font-medium">{{ user.email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span :class="[
                                        user.is_admin ? 'bg-indigo-100 text-indigo-700' : 'bg-slate-100 text-slate-700',
                                        'px-2.5 py-1 inline-flex text-[10px] font-black uppercase tracking-wider rounded-lg'
                                    ]">
                                        {{ user.is_admin ? 'Administrateur' : 'Membre' }}
                                    </span>
                                </td>
                                <td class="text-sm font-medium text-slate-500">
                                    {{ user.registered_at }}
                                </td>
                                <td class="text-sm font-medium text-slate-400">
                                    {{ user.last_login }}
                                </td>
                                <td class="text-right">
                                    <div class="flex justify-end gap-2">
                                        <button @click="openEditModal(user)" class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors hover:bg-slate-100 text-slate-400 hover:text-emerald-600 cursor-pointer" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button @click="toggleRole(user)" class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors hover:bg-slate-100 text-slate-400 hover:text-indigo-600 cursor-pointer" :title="user.is_admin ? 'Rétrograder en membre' : 'Promouvoir administrateur'">
                                            <i :class="user.is_admin ? 'fas fa-arrow-down' : 'fas fa-arrow-up'"></i>
                                        </button>
                                        <button @click="confirmDelete(user)" class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors hover:bg-rose-50 text-slate-400 hover:text-rose-600 cursor-pointer" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="users.length === 0">
                                <td colspan="5" class="px-6 py-16 text-center text-slate-400 font-medium">
                                    Aucun utilisateur trouvé.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- User Modal -->
        <div v-if="showModal" class="premium-modal-backdrop">
            <div class="premium-modal-content !max-w-3xl">
                <form @submit.prevent="submitForm">
                    <div class="p-10">
                        <h3 class="text-3xl font-black text-slate-900 mb-10 tracking-tight">
                            {{ isEditing ? 'Modifier l\'utilisateur' : 'Nouvel utilisateur' }}
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                            <div>
                                <label class="premium-label">Nom d'utilisateur</label>
                                <input v-model="form.username" type="text" required class="premium-input" placeholder="ex: jsmith" />
                                <p v-if="form.errors.username" class="mt-2 text-xs text-rose-500 font-bold ml-1">{{ form.errors.username }}</p>
                            </div>
                            <div>
                                <label class="premium-label">Email</label>
                                <input v-model="form.email" type="email" required class="premium-input" placeholder="ex: john@example.com" />
                                <p v-if="form.errors.email" class="mt-2 text-xs text-rose-500 font-bold ml-1">{{ form.errors.email }}</p>
                            </div>
                            <div>
                                <label class="premium-label">Prénom</label>
                                <input v-model="form.firstname" type="text" class="premium-input" placeholder="ex: John" />
                            </div>
                            <div>
                                <label class="premium-label">Nom</label>
                                <input v-model="form.lastname" type="text" class="premium-input" placeholder="ex: Smith" />
                            </div>
                            <div>
                                <label class="premium-label">Mot de passe {{ isEditing ? '(laisser vide pour ne pas changer)' : '' }}</label>
                                <input v-model="form.password" type="password" :required="!isEditing" class="premium-input" placeholder="••••••••" />
                                <p v-if="form.errors.password" class="mt-2 text-xs text-rose-500 font-bold ml-1">{{ form.errors.password }}</p>
                            </div>
                            <div class="flex items-end">
                                <label class="flex items-center cursor-pointer mb-1.5 p-4 rounded-2xl border-2 border-slate-100 w-full transition-all hover:border-emerald-200 hover:bg-emerald-50/30 group">
                                    <input type="checkbox" v-model="form.is_admin" class="h-6 w-6 rounded-lg border-slate-200 text-emerald-600 focus:ring-emerald-500/20 transition-all shadow-inner" />
                                    <span class="ml-4 text-sm text-slate-700 font-black">Administrateur</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50/50 px-10 py-8 flex flex-row-reverse gap-4 border-t border-slate-100">
                        <button type="submit" :disabled="form.processing" class="premium-button-primary">
                            {{ isEditing ? 'Enregistrer les modifications' : 'Créer l\'utilisateur' }}
                        </button>
                        <button type="button" @click="showModal = false" class="premium-button-secondary">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Confirm Modal Delete -->
        <PremiumConfirmModal 
            :show="showConfirmModal"
            title="Supprimer l'utilisateur"
            :message="'Êtes-vous sûr de vouloir supprimer DÉFINITIVEMENT le compte de ' + selectedUser?.username + ' ? Cette action est irréversible.'"
            @confirm="deleteUser"
            @close="showConfirmModal = false"
        />

        <!-- Confirm Modal Toggle Role -->
        <PremiumConfirmModal 
            :show="showToggleConfirmModal"
            :title="selectedUser?.is_admin ? 'Rétrograder l\'utilisateur' : 'Promouvoir l\'utilisateur'"
            :message="'Voulez-vous vraiment ' + (selectedUser?.is_admin ? 'rétrograder' : 'promouvoir administrateur') + ' l\'utilisateur ' + selectedUser?.username + ' ?'"
            @confirm="confirmToggleRole"
            @close="showToggleConfirmModal = false"
        />
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PremiumConfirmModal from "@/Components/PremiumConfirmModal.vue";

const props = defineProps({
    users: Array,
});

const showModal = ref(false);
const isEditing = ref(false);
const editingId = ref(null);
const showConfirmModal = ref(false);
const selectedUser = ref(null);
const showToggleConfirmModal = ref(false);

const form = useForm({
    username: "",
    firstname: "",
    lastname: "",
    email: "",
    password: "",
    is_admin: false,
});

const openCreateModal = () => {
    isEditing.value = false;
    form.reset();
    form.clearErrors();
    showModal.value = true;
};

const openEditModal = (user) => {
    isEditing.value = true;
    editingId.value = user.id;
    form.reset();
    form.clearErrors();
    form.username = user.username;
    form.firstname = user.firstname || "";
    form.lastname = user.lastname || "";
    form.email = user.email;
    form.password = "";
    form.is_admin = user.is_admin;
    showModal.value = true;
};

const submitForm = () => {
    if (isEditing.value) {
        form.put(route('admin.users.update', editingId.value), {
            onSuccess: () => { showModal.value = false; },
        });
    } else {
        form.post(route('admin.users.store'), {
            onSuccess: () => { showModal.value = false; },
        });
    }
};

const toggleRole = (user) => {
    selectedUser.value = user;
    showToggleConfirmModal.value = true;
};

const confirmToggleRole = () => {
    router.post(route('admin.users.toggle-admin', selectedUser.value.id), {}, {
        preserveScroll: true,
        onSuccess: () => {
            showToggleConfirmModal.value = false;
        }
    });
};

const confirmDelete = (user) => {
    selectedUser.value = user;
    showConfirmModal.value = true;
};

const deleteUser = () => {
    router.delete(route('admin.users.destroy', selectedUser.value.id), {
        preserveScroll: true,
        onSuccess: () => {
            showConfirmModal.value = false;
        }
    });
};
</script>
