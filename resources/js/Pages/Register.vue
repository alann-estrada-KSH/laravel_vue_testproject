<template>
    <Head title="Register" />
    <div
        class="flex flex-col items-center justify-center h-screen bg-gray-200 gap-3"
    >
        <h1 class="text-lg">Registro de usuarios</h1>
        <form action="/user" method="post" class="flex flex-col gap-2">
            <input type="hidden" name="_token" :value="csrfToken" />
            <div class="flex flex-col">
                <label for="name">Nombre</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="bg-gray-100 border-2 border-gray-300 p-2 rounded-lg"
                />
            </div>
            <div class="flex flex-col">
                <label for="email">Correo electrónico</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="bg-gray-100 border-2 border-gray-300 p-2 rounded-lg"
                />
            </div>
            <div class="flex flex-col">
                <label for="password">Contraseña</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="bg-gray-100 border-2 border-gray-300 p-2 rounded-lg"
                />
            </div>
            <div>
                <input
                    type="submit"
                    value="Registrarse"
                    class="bg-blue-500 text-white p-2 rounded-lg cursor-pointer"
                />
            </div>
        </form>
    </div>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";

const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");
</script>

<style lang="scss" scoped></style>
