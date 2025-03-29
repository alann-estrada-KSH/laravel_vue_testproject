<template>
    <Head title="Add Address" />
    <div
        class="flex flex-col items-center justify-center h-screen bg-gray-200 gap-3"
    >
        <h1 class="text-lg font-bold">Agregar dirección</h1>
        <form
            @submit.prevent="submit"
            class="flex flex-col gap-4"
        >
            <input type="hidden" name="_token" :value="csrfToken" />
            <div class="flex flex-col">
                <label for="street">Calle</label>
                <input
                    type="text"
                    id="street"
                    name="street"
                    v-model="form.street"
                    placeholder="Calle"
                    class="bg-gray-100 border-2 border-gray-300 p-2 rounded-lg"
                />
            </div>
            <div class="flex flex-col">
                <label for="city">Ciudad</label>
                <input
                    type="text"
                    id="city"
                    name="city"
                    v-model="form.city"
                    placeholder="Ciudad"
                    class="bg-gray-100 border-2 border-gray-300 p-2 rounded-lg"
                />
            </div>
            <div class="flex flex-col">
                <label for="suburb">Colonia</label>
                <input
                    type="text"
                    id="suburb"
                    name="suburb"
                    v-model="form.suburb"
                    placeholder="Colonia"
                    class="bg-gray-100 border-2 border-gray-300 p-2 rounded-lg"
                />
            </div>
            <div>
                <button
                    type="submit"
                    class="bg-blue-500 text-white p-2 rounded-lg cursor-pointer"
                >
                    Agregar dirección
                </button>
            </div>
        </form>
        <Link
            href="/user"
            class="bg-gray-300 text-gray-700 p-2 rounded-lg cursor-pointer"
            >Regresar
        </Link>
    </div>
</template>

<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
const props = defineProps({
    user_id: Number,
});

const form = useForm({
    user_id: props.user_id,
    street: "",
    city: "",
    suburb: "",
});

const submit = () => {
    form.post(`/user/${props.user_id}/address`, {
        onSuccess: () => {
            form.reset();
        },
        onError: (errors) => {
            console.error(errors);
        },
    });
};

const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");
</script>

<style lang="scss" scoped></style>
