<template>
    <Head>
        <title>Nouveau mot de passe</title>
        <meta name="robots" content="noindex, nofollow" />
    </Head>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-emerald-50/30 to-gray-100 flex items-center justify-center p-4">
        <div class="w-full max-w-md">

            <!-- Logo -->
            <div class="text-center mb-8">
                <a :href="route('home')" class="inline-flex items-center gap-2">
                    <img src="/images/logo.png" alt="Family Recipe" class="h-10 w-10 object-contain" />
                    <span class="text-2xl font-black text-gray-900">Family <span class="text-emerald-600">Recipe</span></span>
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/60 border border-gray-100 overflow-hidden">
                <!-- Header -->
                <div class="bg-gray-900 px-8 py-8 text-center">
                    <div class="w-14 h-14 bg-emerald-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                    <h1 class="text-xl font-bold text-white mb-1">Créer un nouveau mot de passe</h1>
                    <p class="text-gray-400 text-sm">Choisissez un mot de passe sécurisé pour votre compte.</p>
                </div>

                <div class="px-8 py-8">
                    <form @submit.prevent="submit" class="space-y-5">
                        <!-- Hidden email field -->
                        <input type="hidden" v-model="form.email" />
                        <input type="hidden" v-model="form.token" />

                        <!-- Email (read-only display) -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Compte</label>
                            <div class="px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 text-sm text-gray-600 font-medium">
                                {{ form.email }}
                            </div>
                        </div>

                        <!-- New Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nouveau mot de passe
                            </label>
                            <div class="relative">
                                <input
                                    id="password"
                                    :type="showPassword ? 'text' : 'password'"
                                    v-model="form.password"
                                    required
                                    autofocus
                                    placeholder="Minimum 8 caractères"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition-all text-sm pr-12"
                                    :class="{ 'border-red-400 ring-2 ring-red-400/20': form.errors.password }"
                                />
                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 p-1"
                                >
                                    <svg v-if="showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                    <svg v-else class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            <p v-if="form.errors.password" class="mt-1.5 text-xs text-red-500 font-medium">
                                {{ form.errors.password }}
                            </p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                Confirmer le mot de passe
                            </label>
                            <input
                                id="password_confirmation"
                                type="password"
                                v-model="form.password_confirmation"
                                required
                                placeholder="Retapez votre mot de passe"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition-all text-sm"
                                :class="{ 'border-red-400 ring-2 ring-red-400/20': form.errors.password_confirmation }"
                            />
                            <p v-if="form.errors.password_confirmation" class="mt-1.5 text-xs text-red-500 font-medium">
                                {{ form.errors.password_confirmation }}
                            </p>
                        </div>

                        <!-- Password strength hint -->
                        <div class="flex gap-1.5" v-if="form.password">
                            <div
                                v-for="i in 4" :key="i"
                                class="h-1 flex-1 rounded-full transition-all duration-300"
                                :class="passwordStrength >= i ? strengthColor : 'bg-gray-100'"
                            ></div>
                        </div>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full bg-emerald-600 hover:bg-emerald-700 disabled:opacity-60 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-md shadow-emerald-600/20 flex items-center justify-center gap-2"
                        >
                            <svg v-if="form.processing" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>{{ form.processing ? 'Sauvegarde...' : 'Enregistrer le nouveau mot de passe' }}</span>
                        </button>
                    </form>
                </div>
            </div>

            <p class="text-center text-xs text-gray-400 mt-6">
                &copy; {{ new Date().getFullYear() }} Family Recipe. Tous droits réservés.
            </p>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    token: { type: String, required: true },
    email: { type: String, required: true },
});

const showPassword = ref(false);

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

// Password strength meter
const passwordStrength = computed(() => {
    const p = form.password;
    if (!p) return 0;
    let score = 0;
    if (p.length >= 8) score++;
    if (p.length >= 12) score++;
    if (/[A-Z]/.test(p) && /[a-z]/.test(p)) score++;
    if (/[0-9]/.test(p) || /[^A-Za-z0-9]/.test(p)) score++;
    return score;
});

const strengthColor = computed(() => {
    const s = passwordStrength.value;
    if (s <= 1) return 'bg-red-400';
    if (s === 2) return 'bg-orange-400';
    if (s === 3) return 'bg-yellow-400';
    return 'bg-emerald-500';
});

const submit = () => {
    form.post(route('password.update'));
};
</script>
