<script setup>
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

import { getCurrentInstance, ref } from "vue";

const app = getCurrentInstance();
const $page = app.appContext.config.globalProperties.$page;

const form = useForm({
    __method:'PUT',
    firstname: $page.props.customer.firstname,
    surname: $page.props.customer.surname,
    gender: $page.props.customer.gender,
    email: $page.props.customer.email,
    birthday: $page.props.customer.birthday,
    status: $page.props.customer.status,
    description: $page.props.customer.description,
});

const submit = () => {
    form.put(route('customers.update', $page.props.customer.id), {
        onFinish: () => {}
    });
};
</script>
<template>
    <section id="customer" class="flex flex-col items-center">
        <div v-if="$page.props.errors.error" class="p-4 bg-red-300">
            {{ $page.props.errors.error}}
        </div>
        <div class="container">
            <div class="pb-4 font-bold text-[22px]">
                <h1>Customer Update</h1>
            </div>
            <form @submit.prevent="submit">
                <div class="flex justify">
                    <div class="flex flex-col pb-2 pr-1 w-full">
                        <label>Name</label>
                        <input type="text" v-model="form.firstname" class="rounded border-gray-200">
                        <InputError class="mt-2" :message="form.errors.firstname" />
                    </div>
                    <div class="flex flex-col pb-2 pl-1 w-full">
                        <label>Surname</label>
                        <input type="text" v-model="form.surname" class="rounded border-gray-200">
                        <InputError class="mt-2" :message="form.errors.surname" />
                    </div>
                </div>
                <div class="flex flex-col pb-2">
                    <labe>Gender</labe>
                    <select v-model="form.gender" class="rounded border-gray-300">
                        <option>Femenino</option>
                        <option>Masculino</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.gender" />
                </div>
                <div class="flex flex-col pb-2">
                    <label>Email</label>
                    <input type="email" v-model="form.email" class="rounded border-gray-200">
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <div class="flex flex-col pb-2">
                    <label>Birthday</label>
                    <input type="date" v-model="form.birthday" class="rounded border-gray-200">
                    <InputError class="mt-2" :message="form.errors.birthday" />
                </div>
                <div class="flex flex-col pb-2">
                    <labe>Status</labe>
                    <select v-model="form.status" class="rounded border-gray-300">
                        <option>Activo</option>
                        <option>Inactivo</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.status" />
                </div>
                <div class="flex flex-col pb-4">
                    <label>Description</label>
                    <textarea v-model="form.description" rows="2" class="rounded border-gray-200"></textarea>
                    <InputError class="mt-2" :message="form.errors.description" />
                </div>
                <div class="flex pt-2">
                    <div class="pr-4">
                        <input type="submit" value="Update" :disabled="form.processing" class="text-white font-bold bg-blue-700 px-8 py-2 cursor-pointer rounded">
                    </div>
                    <!-- <div>
                        <input type="reset" value="Reset" class="bg-red-400 px-6 py-2 cursor-pointer rounded">
                    </div> -->
                </div>
            </form>
        </div>
    </section>
</template>
<style scoped>
 .container{
    padding: 50px 150px;
    display: flex;
    flex-direction: column;
    justify-items: center;
 }
</style>