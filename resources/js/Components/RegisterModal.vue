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
            class="premium-modal-backdrop overflow-y-auto"
            @click.self="close"
        >
            <div class="premium-modal-content max-w-md my-8">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <h2 class="text-3xl font-black text-slate-900 tracking-tight">
                            Rejoignez-nous !
                        </h2>
                        <p class="text-slate-500 mt-3 font-medium">
                            Créez votre compte pour partager vos secrets de cuisine.
                        </p>
                    </div>

                    <form @submit.prevent="submit" class="space-y-5">
                        <!-- Username field -->
                        <div>
                            <label for="username" class="premium-label">Nom d'utilisateur</label>
                            <input
                                type="text"
                                id="username"
                                v-model="form.username"
                                class="premium-input"
                                :class="{ 'border-rose-300 bg-rose-50/30': form.errors.username }"
                                placeholder="Chef Gourmet"
                                required
                                autofocus
                            />
                            <div v-if="form.errors.username" class="text-rose-500 text-xs font-bold mt-2 ml-1">
                                {{ form.errors.username }}
                            </div>
                        </div>

                        <!-- Email field -->
                        <div>
                            <label for="register-email" class="premium-label">Adresse Email</label>
                            <input
                                type="email"
                                id="register-email"
                                v-model="form.email"
                                class="premium-input"
                                :class="{ 'border-rose-300 bg-rose-50/30': form.errors.email }"
                                placeholder="votre@email.com"
                                required
                            />
                            <div v-if="form.errors.email" class="text-rose-500 text-xs font-bold mt-2 ml-1">
                                {{ form.errors.email }}
                            </div>
                        </div>

                        <!-- Password field -->
                        <div>
                            <label for="register-password" class="premium-label">Mot de passe</label>
                            <div class="relative">
                                <input
                                    :type="showPassword ? 'text' : 'password'"
                                    id="register-password"
                                    v-model="form.password"
                                    class="premium-input pr-12"
                                    placeholder="••••••••"
                                    :class="{ 'border-rose-300 bg-rose-50/30': form.errors.password }"
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
                            <div v-if="form.errors.password" class="text-rose-500 text-xs font-bold mt-2 ml-1">
                                {{ form.errors.password }}
                            </div>
                        </div>

                        <!-- Password Confirmation field -->
                        <div>
                            <label for="password_confirmation" class="premium-label">Confirmer le mot de passe</label>
                            <input
                                type="password"
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                class="premium-input"
                                placeholder="••••••••"
                                required
                            />
                        </div>

                        <div class="pt-4">
                            <p class="text-xs text-slate-400 mb-6 text-center px-4">
                                En vous inscrivant, vous acceptez nos
                                <a href="#" class="text-emerald-600 font-bold hover:underline">Conditions</a>
                                et notre
                                <a href="#" class="text-emerald-600 font-bold hover:underline">Politique de confidentialité</a>.
                            </p>

                            <!-- Register button -->
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
                                    Inscription...
                                </span>
                                <span v-else>Créer mon compte</span>
                            </button>
                        </div>
                    </form>

                    <!-- Additional links -->
                    <div
                        class="mt-10 text-center text-sm text-slate-500 border-t border-slate-100 pt-8"
                    >
                        Vous avez déjà un compte ?
                        <a
                            href="#"
                            @click.prevent="$emit('switch-to-login')"
                            class="text-emerald-600 hover:text-emerald-700 font-bold ml-1"
                            >Connectez-vous</a
                        >
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["close", "switch-to-login"]);

const showPassword = ref(false);

const form = useForm({
    username: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const close = () => {
    form.reset();
    form.clearErrors();
    emit("close");
};

const submit = () => {
    form.post(route("register"), {
        onSuccess: () => {
            close();
        },
    });
};
</script>
