<template>
    <Head title="Edit User" />
    <div
        class="p-5 bg-gray-100 rounded-lg shadow-md h-screen flex flex-col justify-center gap-4 px-12"
    >
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Editar Usuario</h2>
        <form @submit.prevent="submit" class="space-y-4">
            <input type="hidden" name="_token" :value="csrfToken" />

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1"
                    >Nombre:</label
                >
                <input
                    v-model="form.name"
                    class="border border-gray-300 rounded-lg p-2 w-full focus:ring-blue-500 focus:border-blue-500"
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1"
                    >Correo electrónico:</label
                >
                <input
                    v-model="form.email"
                    type="email"
                    class="border border-gray-300 rounded-lg p-2 w-full focus:ring-blue-500 focus:border-blue-500"
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1"
                    >Contraseña:</label
                >
                <input
                    type="password"
                    v-model="form.password"
                    class="border border-gray-300 rounded-lg p-2 w-full focus:ring-blue-500 focus:border-blue-500"
                />
            </div>

            <button
                type="submit"
                class="w-full mt-4 px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50"
            >
                Guardar Cambios
            </button>
        </form>
        <Link href="/user" class="text-blue-500 hover:underline"
            >Volver a la tabla de usuarios</Link
        >
    </div>
</template>

<script setup>
import { reactive } from "vue";
import { Link, Head, router } from "@inertiajs/vue3"; 

const props = defineProps({
    user: Object,
});

const form = reactive({
    name: props.user.name,
    email: props.user.email,
    password: props.user.password,
});

const submit = async () => {
    router.put(`/user/${props.user.id}`, form);
};


const csrfToken = document
    .querySelector('meta[name="csrf-token"]') // Fetch CSRF token from meta tag
    .getAttribute("content");
</script>
