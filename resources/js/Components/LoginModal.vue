<template>
    <div
        v-if="show"
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4"
        @click.self="close"
    >
        <div
            class="bg-white rounded-xl w-full max-w-md mx-auto relative shadow-2xl"
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
                        <i class="fas fa-user-circle text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        Connexion à CookBook
                    </h2>
                    <p class="text-sm text-gray-500 mt-2">
                        Connectez-vous pour enregistrer vos recettes préférées
                        et rejoindre des groupes.
                    </p>
                </div>

                <form @submit.prevent="submit" class="space-y-5">
                    <!-- Email field -->
                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-700 mb-1"
                            >Adresse Email</label
                        >
                        <input
                            type="email"
                            id="email"
                            v-model="form.email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-sm transition-shadow"
                            :class="{
                                'border-red-500 ring-1 ring-red-500':
                                    form.errors.email,
                            }"
                            required
                            autofocus
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
                        <div class="flex justify-between items-center mb-1">
                            <label
                                for="password"
                                class="block text-sm font-medium text-gray-700"
                                >Mot de passe</label
                            >
                            <a
                                href="#"
                                class="text-xs text-emerald-600 hover:text-emerald-700 font-medium"
                                >Mot de passe oublié ?</a
                            >
                        </div>
                        <div class="relative">
                            <input
                                :type="showPassword ? 'text' : 'password'"
                                id="password"
                                v-model="form.password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-sm transition-shadow pr-10"
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
                    </div>

                    <!-- Remember me checkbox -->
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            id="remember"
                            v-model="form.remember"
                            class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded cursor-pointer"
                        />
                        <label
                            for="remember"
                            class="ml-2 text-sm text-gray-600 cursor-pointer"
                            >Se souvenir de moi</label
                        >
                    </div>

                    <!-- Login button -->
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 rounded-lg font-medium transition-colors disabled:opacity-75 disabled:cursor-not-allowed mt-2"
                    >
                        <span v-if="form.processing"
                            >Connexion en cours...</span
                        >
                        <span v-else>Se connecter</span>
                    </button>
                </form>

                <!-- Additional links -->
                <div
                    class="mt-8 text-center text-sm text-gray-600 border-t border-gray-100 pt-6"
                >
                    Vous n'avez pas de compte ?
                    <a
                        href="#"
                        @click.prevent="$emit('switch-to-register')"
                        class="text-emerald-600 hover:text-emerald-700 font-medium"
                        >Inscrivez-vous</a
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
