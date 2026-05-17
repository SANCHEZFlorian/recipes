<template>
    <div ref="selectRef" class="relative w-full">
        <!-- Trigger Button -->
        <button
            type="button"
            @click="toggleDropdown"
            class="premium-input flex items-center justify-between text-left cursor-pointer select-none"
            :class="[
                isOpen ? 'border-emerald-500 ring-4 ring-emerald-500/10' : '',
                modelValue === null || modelValue === '' || modelValue === undefined ? 'text-slate-400' : 'text-slate-900 font-medium'
            ]"
        >
            <span class="truncate">
                {{ selectedOption ? getOptionLabel(selectedOption) : placeholder }}
            </span>
            <i 
                class="fas fa-chevron-down text-xs text-slate-400 transition-transform duration-300"
                :class="{ 'rotate-180 text-emerald-500': isOpen }"
            ></i>
        </button>

        <!-- Dropdown Menu -->
        <transition
            enter-active-class="transition duration-100 ease-out"
            enter-from-class="transform scale-95 opacity-0 -translate-y-2"
            enter-to-class="transform scale-100 opacity-100 translate-y-0"
            leave-active-class="transition duration-75 ease-in"
            leave-from-class="transform scale-100 opacity-100 translate-y-0"
            leave-to-class="transform scale-95 opacity-0 -translate-y-2"
        >
            <div
                v-if="isOpen"
                class="absolute z-[100] mt-2 w-full bg-white/95 backdrop-blur-md border border-slate-100 rounded-2xl shadow-xl max-h-60 overflow-y-auto custom-scrollbar p-1.5"
            >
                <!-- Placeholder / Default Option if not required -->
                <button
                    v-if="!required"
                    type="button"
                    @click="selectOption(null)"
                    class="w-full text-left px-4 py-2.5 rounded-xl text-sm transition-colors text-slate-400 hover:bg-slate-50 flex items-center justify-between cursor-pointer"
                >
                    <span>{{ placeholder }}</span>
                    <i v-if="modelValue === null || modelValue === '' || modelValue === undefined" class="fas fa-check text-xs text-emerald-500"></i>
                </button>

                <!-- List Options -->
                <button
                    v-for="option in options"
                    :key="getOptionValue(option)"
                    type="button"
                    @click="selectOption(option)"
                    class="w-full text-left px-4 py-2.5 rounded-xl text-sm transition-colors flex items-center justify-between cursor-pointer"
                    :class="[
                        isOptionSelected(option)
                            ? 'bg-emerald-50 text-emerald-700 font-bold'
                            : 'text-slate-700 hover:bg-slate-50'
                    ]"
                >
                    <span class="truncate">{{ getOptionLabel(option) }}</span>
                    <i v-if="isOptionSelected(option)" class="fas fa-check text-xs text-emerald-500"></i>
                </button>

                <div v-if="options.length === 0" class="px-4 py-3 text-center text-xs text-slate-400">
                    Aucune option disponible
                </div>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    modelValue: [String, Number, Object],
    options: {
        type: Array,
        default: () => []
    },
    placeholder: {
        type: String,
        default: 'Sélectionnez une option'
    },
    required: {
        type: Boolean,
        default: false
    },
    labelKey: {
        type: String,
        default: ''
    },
    valueKey: {
        type: String,
        default: ''
    }
});

const emit = defineEmits(['update:modelValue', 'change']);

const isOpen = ref(false);
const selectRef = ref(null);

const toggleDropdown = () => {
    isOpen.value = !isOpen.value;
};

const closeDropdown = () => {
    isOpen.value = false;
};

// Normalizers
const getOptionValue = (option) => {
    if (typeof option !== 'object' || option === null) return option;
    if (props.valueKey) return option[props.valueKey];
    return option.id !== undefined ? option.id : (option.value !== undefined ? option.value : option);
};

const getOptionLabel = (option) => {
    if (typeof option !== 'object' || option === null) return option;
    if (props.labelKey) return option[props.labelKey];
    return option.nom !== undefined ? option.nom : (option.name !== undefined ? option.name : (option.label !== undefined ? option.label : option));
};

const selectedOption = computed(() => {
    return props.options.find(opt => getOptionValue(opt) === props.modelValue) || null;
});

const isOptionSelected = (option) => {
    return getOptionValue(option) === props.modelValue;
};

const selectOption = (option) => {
    const val = option === null ? null : getOptionValue(option);
    emit('update:modelValue', val);
    emit('change', val);
    closeDropdown();
};

// Outside click handling
const handleClickOutside = (event) => {
    if (selectRef.value && !selectRef.value.contains(event.target)) {
        closeDropdown();
    }
};

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
});
</script>
