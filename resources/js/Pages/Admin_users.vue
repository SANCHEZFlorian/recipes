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
                            Gérez les membres de la communauté, leurs droits d'accès et modérez les comptes.
                        </p>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Utilisateur
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rôle
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Inscription
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dernière Connexion
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="user in users" :key="user.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-emerald-100 text-emerald-600 font-bold">
                                            {{ user.username.charAt(0).toUpperCase() }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ user.username }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ user.email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span :class="[
                                        user.is_admin ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-800',
                                        'px-2 inline-flex text-xs leading-5 font-semibold rounded-full'
                                    ]">
                                        {{ user.is_admin ? 'Administrateur' : 'Membre' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ user.registered_at }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ user.last_login }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button 
                                        @click="toggleRole(user)" 
                                        class="text-indigo-600 hover:text-indigo-900 mr-4 cursor-pointer"
                                        :title="user.is_admin ? 'Rétrograder en membre' : 'Promouvoir administrateur'"
                                    >
                                        <i :class="user.is_admin ? 'fas fa-arrow-down' : 'fas fa-arrow-up'"></i>
                                    </button>
                                    <button 
                                        @click="confirmDelete(user)" 
                                        class="text-red-600 hover:text-red-900 cursor-pointer"
                                        title="Supprimer l'utilisateur"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="users.length === 0">
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    Aucun utilisateur trouvé.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
    users: Array,
});

const toggleRole = (user) => {
    const action = user.is_admin ? 'rétrograder' : 'promouvoir administrateur';
    if (confirm(`Êtes-vous sûr de vouloir ${action} l'utilisateur "${user.username}" ?`)) {
        router.post(route('admin.users.toggle-admin', user.id), {}, {
            preserveScroll: true,
        });
    }
};

const confirmDelete = (user) => {
    if (confirm(`ATTENTION : Êtes-vous sûr de vouloir supprimer DÉFINITIVEMENT le compte de "${user.username}" ? Cette action est irréversible.`)) {
        router.delete(route('admin.users.destroy', user.id), {
            preserveScroll: true,
        });
    }
};
</script>
