<template>
    <AdminLayout>
        <div class="py-6">
            <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Paramètres du Site</h1>
                    <p class="mt-1 text-sm text-gray-500">Configurez les options générales de votre application.</p>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <div class="text-center py-12">
                        <i class="fas fa-tools text-gray-400 text-5xl mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900">En cours de développement</h3>
                        <p class="text-gray-500 mt-2">La gestion des paramètres sera disponible prochainement.</p>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
    settings: Array
});
</script>
