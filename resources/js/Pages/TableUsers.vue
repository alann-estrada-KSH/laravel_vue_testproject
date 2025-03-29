<template>
    <Head title="Table User" />
    <div
        class="flex flex-col items-center justify-center h-screen bg-gray-200 gap-3"
    >
        <h1 class="text-xl">Tabla de usuarios</h1>
        <Link href="/user/create" class="text-blue-500 hover:underline"
            >Registrar nuevo usuario</Link
        >
        <table
            class="table-auto border-collapse border border-gray-300 shadow-lg bg-white"
        >
            <thead class="bg-gray-300 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border border-gray-300">Nombre</th>
                    <th class="px-4 py-2 border border-gray-300">
                        Correo electrónico
                    </th>
                    <th class="px-4 py-2 border border-gray-300">Direcciones existentes</th>
                    <th class="px-4 py-2 border border-gray-300">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="users.length === 0">
                    <td
                        colspan="3"
                        class="px-4 py-2 border border-gray-300 text-center text-gray-500"
                    >
                        No hay usuarios disponibles.
                    </td>
                </tr>
                <tr
                    v-for="user in users"
                    :key="user.id"
                    class="hover:bg-gray-100"
                >
                    <td class="px-4 py-2 border border-gray-300">
                        {{ user.name }}
                    </td>
                    <td class="px-4 py-2 border border-gray-300">
                        {{ user.email }}
                    </td>
                    <td class="px-4 py-2 border border-gray-300" v-if="!user.addresses || user.addresses.length === 0">
                        No hay direcciones registradas
                    </td>
                    <td class="px-4 py-2 border border-gray-300" v-else>
                        {{ user.addresses.length }} dirección(es) asociada(s)
                    </td>
                    <td class="px-4 py-2 border border-gray-300 flex gap-2">
                        <Link
                            :href="`/user/${user.id}`"
                            class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600"
                        >
                            Ver Detalles
                        </Link>
                        <Link
                            :href="`/user/${user.id}/edit`"
                            class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600"
                        >
                            Editar
                        </Link>
                        <button
                            class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                            @click="deleteUser(user)"
                        >
                            Eliminar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";

// Recibe los usuarios desde Laravel
defineProps({
    users: Array,
});

// Método para eliminar un usuario
const deleteUser = async (user) => {
    try {
        const response = await fetch(`/user/${user.id}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({ id: user.id }),
        });

        const data = await response.json();
        if (data.success) {
            location.reload();
        }
    } catch (error) {
        console.error("Error eliminando usuario:", error);
    }
};

</script>

<style lang="scss" scoped></style>
