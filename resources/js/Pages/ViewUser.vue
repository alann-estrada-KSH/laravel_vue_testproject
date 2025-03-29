<template>
    <Head title="View User" />
    <div
        class="p-6 bg-gray-200 flex flex-col items-center justify-center gap-4"
    >
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Datos del usuario</h1>
        <div class="flex flex-col gap-4">
            <p class="text-gray-600">
                Nombre:
                <span class="font-medium" v-if="user.data.name">
                    {{ user.data.name }}
                </span>
                <span v-else class="text-red-500">No disponible</span>
            </p>
            <p class="text-gray-600">
                Correo electrónico:
                <span v-if="user.data.email" class="font-medium">
                    {{ user.data.email }}
                </span>
                <span v-else class="text-red-500">No disponible</span>
            </p>
            <p class="text-gray-600">
                Fecha de creación:
                <span class="font-medium" v-if="user.data.created_at">
                    {{ new Date(user.data.created_at).toLocaleDateString() }}
                </span>
                <span v-else class="text-red-500">No disponible</span>
            </p>
            <h3 class="text-lg font-semibold text-gray-700 mt-4">
                Direcciones
            </h3>
            <ul
                class="list-disc list-inside bg-gray-50 p-4 rounded-md border border-gray-200"
            >
                <li v-if="!user.data.addresses" class="text-gray-500 list-none">
                    No hay direcciones registradas.
                </li>
                <li
                    v-else
                    v-for="address in user.data.addresses"
                    :key="address.id"
                    class="m-4 list-none"
                >
                    <p class="text-gray-600">
                        Calle:
                        <span class="font-medium">{{ address.street }}</span>
                    </p>
                    <p class="text-gray-600">
                        Colonia:
                        <span class="font-medium">{{ address.suburb }}</span>
                    </p>
                    <p class="text-gray-600">
                        Fecha de creación:
                        <span class="font-medium">
                            {{
                                new Date(
                                    address.created_at
                                ).toLocaleDateString()
                            }}
                        </span>
                    </p>
                    <p class="text-gray-600">
                        Fecha de actualización:
                        <span class="font-medium">
                            {{
                                new Date(
                                    address.updated_at
                                ).toLocaleDateString()
                            }}
                        </span>
                    </p>
                    <div class="flex gap-4 mt-2">
                        <Link
                            :href="`/user/${user.data.id}/address/${address.id}/edit`"
                            class="text-blue-600 hover:text-blue-800 font-medium"
                        >
                            Editar dirección
                        </Link>
                        <button
                            @click="deleteAddress(address.id)"
                            class="text-red-600 hover:text-red-800 font-medium"
                        >
                            Eliminar dirección
                        </button>
                    </div>
                </li>
            </ul>
            <div class="flex gap-4">
                <Link
                    :href="`/user/${user.data.id}/address/create`"
                    class="text-blue-600 hover:text-blue-800 font-medium"
                >
                    Agregar dirección
                </Link>
                <Link
                    :href="`/user/${user.data.id}/edit`"
                    class="text-blue-600 hover:text-blue-800 font-medium"
                >
                    Editar usuario
                </Link>
            </div>
        </div>
        <Link
            href="/user"
            class="inline-block mt-6 text-blue-600 hover:text-blue-800 font-medium"
        >
            Volver a la tabla de usuarios
        </Link>
    </div>
</template>

<script setup>
import { Link, Head, router } from "@inertiajs/vue3";
const props = defineProps({
    user: Object,
});

const deleteAddress = (addressId) => {
    router.delete(`/user/${props.user.data.id}/address/${addressId}`, {
        onSuccess: () => {
            location.reload();
        },
    });
};
</script>

<style lang="scss" scoped></style>
