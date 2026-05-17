<template>
    <div class="min-h-screen bg-white flex flex-col justify-center items-center px-6 py-24 sm:py-32 lg:px-8">
        <div class="text-center">
            <p class="text-6xl font-black text-emerald-600">404</p>
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Page introuvable</h1>
            <p class="mt-6 text-base leading-7 text-gray-600">Désolé, nous n'avons pas trouvé la page que vous recherchez.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <Link
                    :href="route('home')"
                    class="rounded-full bg-emerald-600 px-8 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 transition-all transform hover:scale-105"
                >
                    Retour à l'accueil
                </Link>
                <button
                    @click="goBack"
                    class="text-sm font-semibold text-gray-900 hover:text-emerald-600 transition-colors"
                >
                    Page précédente <span aria-hidden="true">&rarr;</span>
                </button>
            </div>
        </div>

        <!-- Decorative elements -->
        <div class="absolute top-0 left-0 -z-10 h-full w-full overflow-hidden opacity-10">
            <div class="absolute -top-[10%] -left-[10%] h-[40%] w-[40%] rounded-full bg-emerald-400 blur-3xl"></div>
            <div class="absolute bottom-[10%] right-[10%] h-[30%] w-[30%] rounded-full bg-emerald-200 blur-3xl"></div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const goBack = () => {
    window.history.back();
};
</script>
