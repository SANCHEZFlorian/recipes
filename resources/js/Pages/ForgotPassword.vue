<template>
    <Head>
        <title>Mot de passe oublié</title>
        <meta name="robots" content="noindex, nofollow" />
    </Head>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-emerald-50/30 to-gray-100 flex items-center justify-center p-4">
        <div class="w-full max-w-md">

            <!-- Logo -->
            <div class="text-center mb-8">
                <a :href="route('home')" class="inline-flex items-center gap-2 group">
                    <img src="/images/logo.png" alt="Family Recipe" class="h-10 w-10 object-contain" />
                    <span class="text-2xl font-black text-gray-900">Family <span class="text-emerald-600">Recipe</span></span>
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/60 border border-gray-100 overflow-hidden">
                <!-- Header -->
                <div class="bg-gray-900 px-8 py-8 text-center">
                    <div class="w-14 h-14 bg-emerald-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h1 class="text-xl font-bold text-white mb-1">Mot de passe oublié ?</h1>
                    <p class="text-gray-400 text-sm">Pas de panique, on vous envoie un lien de réinitialisation.</p>
                </div>

                <div class="px-8 py-8">
                    <!-- Success message -->
                    <div
                        v-if="$page.props.flash?.status"
                        class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-start gap-3"
                    >
                        <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm text-emerald-700 font-medium">{{ $page.props.flash.status }}</p>
                    </div>

                    <form @submit.prevent="submit" class="space-y-5">
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Adresse e-mail
                            </label>
                            <input
                                id="email"
                                type="email"
                                v-model="form.email"
                                required
                                autofocus
                                placeholder="votre@email.com"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition-all text-sm"
                                :class="{ 'border-red-400 ring-2 ring-red-400/20': form.errors.email }"
                            />
                            <p v-if="form.errors.email" class="mt-1.5 text-xs text-red-500 font-medium">
                                {{ form.errors.email }}
                            </p>
                            <p class="mt-2 text-xs text-gray-500">
                                Entrez l'adresse e-mail associée à votre compte Family Recipe.
                            </p>
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
                            <span>{{ form.processing ? 'Envoi en cours...' : 'Envoyer le lien de réinitialisation' }}</span>
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <Link :href="route('home', { login: 1 })" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium transition-colors">
                            ← Retour à la connexion
                        </Link>
                    </div>
                </div>
            </div>

            <p class="text-center text-xs text-gray-400 mt-6">
                &copy; {{ new Date().getFullYear() }} Family Recipe. Tous droits réservés.
            </p>
        </div>
    </div>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>
