<template>
    <AdminLayout>
        <div class="py-6">
            <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Configuration du Site</h1>
                    <p class="mt-1 text-sm text-gray-500">Gérez les paramètres généraux de votre application.</p>
                </div>

                <form @submit.prevent="submit" class="grid grid-cols-1 gap-8">
                    <!-- General Settings -->
                    <div class="bg-white shadow-sm rounded-2xl border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-50">
                            <h3 class="text-lg font-bold text-gray-900">Informations Générales</h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="premium-label">Nom du Site</label>
                                    <input v-model="form.site_name" type="text" class="premium-input" />
                                </div>
                                <div>
                                    <label class="premium-label">Email de Contact</label>
                                    <input v-model="form.contact_email" type="email" class="premium-input" />
                                </div>
                            </div>
                            
                            <div>
                                <label class="premium-label">Description du Site (SEO)</label>
                                <textarea v-model="form.site_description" rows="3" class="premium-input"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Maintenance Mode -->
                    <div class="bg-white shadow-sm rounded-2xl border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-50">
                            <h3 class="text-lg font-bold text-gray-900">Maintenance & Sécurité</h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900">Mode Maintenance</h4>
                                    <p class="text-xs text-gray-500">Rendre le site inaccessible aux utilisateurs (sauf administrateurs).</p>
                                </div>
                                <button 
                                    type="button"
                                    @click="form.maintenance_mode = !form.maintenance_mode"
                                    :class="[form.maintenance_mode ? 'bg-emerald-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2']"
                                >
                                    <span :class="[form.maintenance_mode ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']"></span>
                                </button>
                            </div>
                        </div>
                        <div class="px-8 py-6 bg-gray-50/50 text-right border-t border-gray-100">
                            <button 
                                type="submit" 
                                :disabled="form.processing"
                                class="premium-button-primary"
                            >
                                <i v-if="form.processing" class="fas fa-spinner fa-spin mr-2"></i>
                                Enregistrer les modifications
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
    settings: Object
});

const form = useForm({
    site_name: props.settings.site_name || "Family Recipe",
    contact_email: props.settings.contact_email || "contact@family-recipe.com",
    site_description: props.settings.site_description || "",
    maintenance_mode: props.settings.maintenance_mode === '1' || props.settings.maintenance_mode === true,
});

const submit = () => {
    form.post(route('admin.settings.update'), {
        preserveScroll: true,
    });
};
</script>
