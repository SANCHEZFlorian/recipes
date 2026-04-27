<template>
    <div
        v-if="show"
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4 overflow-y-auto"
        @click.self="close"
    >
        <div
            class="bg-white rounded-xl w-full max-w-md mx-auto relative shadow-2xl my-8"
        >
            <!-- Close button -->
            <button
                @click="close"
                class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 cursor-pointer"
            >
                <i class="fas fa-times text-xl"></i>
            </button>

            <!-- Modal content -->
            <div class="p-8">
                <div class="text-center mb-8">
                    <div
                        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 mb-4"
                    >
                        <i class="fas fa-user-plus text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        Créer un compte Family Recipe
                    </h2>
                    <p class="text-sm text-gray-500 mt-2">
                        Inscrivez-vous pour partager vos propres recettes et
                        interagir avec la communauté.
                    </p>
                </div>

                <form @submit.prevent="submit" class="space-y-4">
                    <!-- Username field -->
                    <div>
                        <label
                            for="username"
                            class="block text-sm font-medium text-gray-700 mb-1"
                            >Nom d'utilisateur</label
                        >
                        <input
                            type="text"
                            id="username"
                            v-model="form.username"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-sm transition-shadow"
                            :class="{
                                'border-red-500 ring-1 ring-red-500':
                                    form.errors.username,
                            }"
                            required
                            autofocus
                        />
                        <div
                            v-if="form.errors.username"
                            class="text-red-500 text-xs mt-1"
                        >
                            {{ form.errors.username }}
                        </div>
                    </div>

                    <!-- Email field -->
                    <div>
                        <label
                            for="register-email"
                            class="block text-sm font-medium text-gray-700 mb-1"
                            >Adresse Email</label
                        >
                        <input
                            type="email"
                            id="register-email"
                            v-model="form.email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-sm transition-shadow"
                            :class="{
                                'border-red-500 ring-1 ring-red-500':
                                    form.errors.email,
                            }"
                            required
                        />
                        <div
                            v-if="form.errors.email"
                            class="text-red-500 text-xs mt-1"
                        >
                            {{ form.errors.email }}
                        </div>
                    </div>

                    <!-- Password field -->
                    <div>
                        <label
                            for="register-password"
                            class="block text-sm font-medium text-gray-700 mb-1"
                            >Mot de passe</label
                        >
                        <div class="relative">
                            <input
                                :type="showPassword ? 'text' : 'password'"
                                id="register-password"
                                v-model="form.password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-sm transition-shadow pr-10"
                                :class="{
                                    'border-red-500 ring-1 ring-red-500':
                                        form.errors.password,
                                }"
                                required
                            />
                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 cursor-pointer"
                            >
                                <i
                                    :class="
                                        showPassword
                                            ? 'fas fa-eye-slash'
                                            : 'fas fa-eye'
                                    "
                                ></i>
                            </button>
                        </div>
                        <div
                            v-if="form.errors.password"
                            class="text-red-500 text-xs mt-1"
                        >
                            {{ form.errors.password }}
                        </div>
                    </div>

                    <!-- Password Confirmation field -->
                    <div>
                        <label
                            for="password_confirmation"
                            class="block text-sm font-medium text-gray-700 mb-1"
                            >Confirmer le mot de passe</label
                        >
                        <input
                            type="password"
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-sm transition-shadow"
                            required
                        />
                    </div>

                    <div class="pt-2">
                        <p class="text-xs text-gray-500 mb-4">
                            En vous inscrivant, vous acceptez nos
                            <a href="#" class="text-emerald-600 hover:underline"
                                >Conditions d'utilisation</a
                            >
                            et notre
                            <a href="#" class="text-emerald-600 hover:underline"
                                >Politique de confidentialité</a
                            >.
                        </p>

                        <!-- Register button -->
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 rounded-lg font-medium transition-colors disabled:opacity-75 disabled:cursor-not-allowed"
                        >
                            <span v-if="form.processing"
                                >Inscription en cours...</span
                            >
                            <span v-else>S'inscrire</span>
                        </button>
                    </div>
                </form>

                <!-- Additional links -->
                <div
                    class="mt-6 text-center text-sm text-gray-600 border-t border-gray-100 pt-6"
                >
                    Vous avez déjà un compte ?
                    <a
                        href="#"
                        @click.prevent="$emit('switch-to-login')"
                        class="text-emerald-600 hover:text-emerald-700 font-medium"
                        >Connectez-vous</a
                    >
                </div>
            </div>
        </div>
    </div>
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
