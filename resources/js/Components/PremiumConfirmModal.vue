<template>
    <div v-if="show" class="premium-modal-backdrop">
        <div class="premium-modal-content !max-w-md">
            <div class="p-8 text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-100 mb-6 shadow-inner">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ title }}</h3>
                <p class="text-sm text-gray-500">{{ message }}</p>
            </div>
            <div class="bg-gray-50/50 px-8 py-6 flex flex-col sm:flex-row-reverse gap-3 border-t border-gray-100">
                <button 
                    @click="$emit('confirm')" 
                    class="premium-button-primary !bg-red-600 hover:!bg-red-700 shadow-red-600/20"
                >
                    Confirmer
                </button>
                <button 
                    @click="$emit('close')" 
                    class="premium-button-secondary"
                >
                    Annuler
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    show: Boolean,
    title: {
        type: String,
        default: 'Confirmation'
    },
    message: {
        type: String,
        default: 'Êtes-vous sûr de vouloir effectuer cette action ?'
    }
});

defineEmits(['confirm', 'close']);
</script>
