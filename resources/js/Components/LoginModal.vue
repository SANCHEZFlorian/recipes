<template>
    <transition
        enter-active-class="transition duration-300 ease-out"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition duration-200 ease-in"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-if="show"
            class="premium-modal-backdrop"
            @click.self="close"
        >
            <div class="premium-modal-content max-w-md">
                <!-- Close button -->
                <button
                    @click="close"
                    class="absolute top-6 right-6 text-slate-400 hover:text-slate-600 transition-colors cursor-pointer z-10"
                >
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Modal content -->
                <div class="p-10">
                    <div class="text-center mb-10">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 mb-6 shadow-inner"
                        >
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>
                        <h2 class="text-3xl font-black text-slate-900 tracking-tight">
                            Bon retour !
                        </h2>
                        <p class="text-slate-500 mt-3 font-medium">
                            Connectez-vous pour retrouver vos recettes et vos groupes favoris.
                        </p>
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <!-- Email field -->
                        <div>
                            <label for="email" class="premium-label">Adresse Email</label>
                            <input
                                type="email"
                                id="email"
                                v-model="form.email"
                                class="premium-input"
                                :class="{ 'border-rose-300 bg-rose-50/30': form.errors.email }"
                                placeholder="votre@email.com"
                                required
                                autofocus
                            />
                            <div v-if="form.errors.email" class="text-rose-500 text-xs font-bold mt-2 ml-1">
                                {{ form.errors.email }}
                            </div>
                        </div>

                        <!-- Password field -->
                        <div>
                            <div class="flex justify-between items-center mb-1.5">
                                <label for="password" class="premium-label mb-0">Mot de passe</label>
                                <Link
                                    :href="route('password.request')"
                                    class="text-xs text-emerald-600 hover:text-emerald-700 font-bold"
                                >Oublié ?</Link>
                            </div>
                            <div class="relative">
                                <input
                                    :type="showPassword ? 'text' : 'password'"
                                    id="password"
                                    v-model="form.password"
                                    class="premium-input pr-12"
                                    placeholder="••••••••"
                                    required
                                />
                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-emerald-600 transition-colors cursor-pointer"
                                >
                                    <svg v-if="showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                    <svg v-else class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Remember me checkbox -->
                        <div class="flex items-center ml-1">
                            <input
                                type="checkbox"
                                id="remember"
                                v-model="form.remember"
                                class="h-5 w-5 text-emerald-600 focus:ring-emerald-500/20 border-slate-200 rounded-lg cursor-pointer transition-all"
                            />
                            <label
                                for="remember"
                                class="ml-3 text-sm text-slate-600 font-medium cursor-pointer"
                            >Rester connecté</label>
                        </div>

                        <!-- Login button -->
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="premium-button-primary w-full py-4 text-lg"
                        >
                            <span v-if="form.processing" class="flex items-center justify-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Connexion...
                            </span>
                            <span v-else>Se connecter</span>
                        </button>
                    </form>

                    <!-- Additional links -->
                    <div
                        class="mt-10 text-center text-sm text-slate-500 border-t border-slate-100 pt-8"
                    >
                        Pas encore de compte ?
                        <a
                            href="#"
                            @click.prevent="$emit('switch-to-register')"
                            class="text-emerald-600 hover:text-emerald-700 font-bold ml-1"
                            >Créer un compte</a
                        >
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup>
import { ref } from "vue";
import { useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["close", "switch-to-register"]);

const showPassword = ref(false);

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const close = () => {
    form.reset();
    form.clearErrors();
    emit("close");
};

const submit = () => {
    form.post(route("login"), {
        onSuccess: () => {
            close();
        },
    });
};
</script>
