<script setup>
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

const form = useForm({
    firstname: '',
    surname: '',
    gender: '',
    email: '',
    birthday: '',
    status: '',
    description: '',
});

const submit = () => {
    form.post(route('customers.store'), {
        onFinish: () => { }
    });
};
</script>
<template>
    <section id="customer" class="flex flex-col items-center">
        <div v-if="$page.props.errors.error" class="p-4 bg-red-300">
            {{ $page.props.errors.error }}
        </div>
        <div class="container">
            <div class="pb-4 font-bold text-[22px]">
                <h1>Create Customer</h1>
            </div>
            <form @submit.prevent="submit">
                <div class="flex">
                    <div class="flex flex-col pb-2 pr-1 w-full">
                        <label class="text-sm">Name</label>
                        <input type="text" v-model="form.firstname" class="rounded border-gray-200">
                        <InputError class="mt-2" :message="form.errors.firstname" />
                    </div>
                    <div class="flex flex-col pb-2 pl-1 w-full">
                        <label class="text-sm">Surname</label>
                        <input type="text" v-model="form.surname" class="rounded border-gray-200">
                        <InputError class="mt-2" :message="form.errors.surname" />
                    </div>
                </div>
                <div class="flex flex-col pb-2">
                    <label class="text-sm">Imagem</label>
                    <input type="file" class="text-sm rounded border-gray-200">
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <div class="flex">
                    <div class="flex flex-col pb-2 pr-1 w-full">
                        <label class="text-sm">Gender</label>
                        <select v-model="form.gender" class="rounded border-gray-300">
                            <option>Femenino</option>
                            <option>Masculino</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.gender" />
                    </div>
                    <div class="flex flex-col pb-2 pl-1 w-full">
                        <label class="text-sm">Email</label>
                        <input type="email" v-model="form.email" class="rounded border-gray-200">
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                </div>
                <div class="flex flex-col pb-2">
                    <label class="text-sm">Birthday</label>
                    <input type="date" v-model="form.birthday" class="rounded border-gray-200">
                    <InputError class="mt-2" :message="form.errors.birthday" />
                </div>
                <div class="flex flex-col pb-2">
                    <label class="text-sm">Status</label>
                    <select v-model="form.status" class="rounded border-gray-300">
                        <option>Activo</option>
                        <option>Inactivo</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.status" />
                </div>
                <div class="flex flex-col pb-4">
                    <label class="text-sm">Description</label>
                    <textarea v-model="form.description" rows="2" class="rounded border-gray-200"></textarea>
                    <InputError class="mt-2" :message="form.errors.description" />
                </div>
                <div class="flex pt-2">
                    <div class="pr-4">
                        <input type="submit" value="Register" :disabled="form.processing"
                            class="text-white font-bold bg-blue-700 px-8 py-2 cursor-pointer rounded">
                    </div>
                    <div>
                        <input type="reset" value="Reset"
                            class="text-white font-bold bg-red-700 px-8 py-2 cursor-pointer rounded">
                    </div>
                </div>
            </form>
        </div>
    </section>
</template>
<style scoped>
.container {
    padding: 50px 150px;
    display: flex;
    flex-direction: column;
    justify-items: center;
}
</style>