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
                    >Calle</label
                >
                <input
                    v-model="form.street"
                    type="text"
                    placeholder="Calle"
                    from="street"
                    name="street"
                    class="border border-gray-300 rounded-lg p-2 w-full focus:ring-blue-500 focus:border-blue-500"
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1"
                    >Colonia</label
                >
                <input
                    v-model="form.suburb"
                    type="text"
                    placeholder="Colonia"
                    from="suburb"
                    name="suburb"
                    class="border border-gray-300 rounded-lg p-2 w-full focus:ring-blue-500 focus:border-blue-500"
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1"
                    >Ciudad</label
                >
                <input
                    v-model="form.city"
                    type="text"
                    placeholder="Ciudad"
                    from="city"
                    name="city"
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
        <Link :href="`/user/${user_id}`" class="text-blue-500 hover:underline"
            >Volver a la tabla de usuarios</Link
        >
    </div>
</template>

<script setup>
import { reactive } from "vue";
import { Link, Head, router } from "@inertiajs/vue3";

const props = defineProps({
    address: Object,
});

const form = reactive({
    street: props.address.street,
    city: props.address.city || "",
    suburb: props.address.suburb,
});

const submit = async () => {
    router.put(
        `/user/${props.address.user_id}/address/${props.address.id}`,
        form
    );
};

const csrfToken = document
    .querySelector('meta[name="csrf-token"]') // Fetch CSRF token from meta tag
    .getAttribute("content");
</script>
