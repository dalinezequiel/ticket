<script setup>
import { Link } from '@inertiajs/vue3';
import Pagination from "@/Components/Pagination.vue";
import { getCurrentInstance } from "vue";

const app = getCurrentInstance();
const $inertia = app.appContext.config.globalProperties.$inertia;

const remove = (product) => {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger mr-2",
        },
        buttonsStyling: false,
    });
    swalWithBootstrapButtons
        .fire({
            title: "Tem certeza?",
            text: "Você não será capaz de reverter isso!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sim, remover!",
            cancelButtonText: "Não, cancelar!",
            showLoaderOnConfirm: true,
            reverseButtons: true,
            preConfirm: () => {
                return axios

                    .delete("/Site/customers/" + product)
                    .then(({ data }) => {
                        if (data.success) {
                            return data;
                        } else {
                            if (data.errors) {
                                Swal.showValidationMessage(`${data.errors.toString().replace(".", "")} , Tente Novamente`
                                );
                            } else {
                                Swal.showValidationMessage(`${data.message} , Tente Novamente`);
                            }
                        }
                    })
                    .catch((error) => {
                        Swal.showValidationMessage(`O pedido falhou: ${error}`);
                    });
            },
            allowOutsideClick: () => !Swal.isLoading(),
        })
        .then((result) => {
            //   // this.dismiss();
            //   console.log(result);
            if (result.value) {
                // this.getResults(1);

                swalWithBootstrapButtons.fire(
                    "Removido!",
                    "Removido com sucesso.",
                    "success"
                );
                $inertia.reload();
                // router.reload()
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    "Cancelado",
                    "Processo cancelado :)",
                    "error"
                );
            }
        });
};
</script>
<template>
    <section id="customer" class="flex flex-col items-center">
        <!-- <div class="p-4 bg-red-300">
                    </div> -->
        <div class="container">
            <div class="pb-6 flex items-center justify-between">
                <div class="font-bold text-[22px]">
                    <h1>Customer List</h1>
                </div>
                <div>
                    <Link class="text-[14px] text-white font-bold bg-blue-700 px-6 py-2 cursor-pointer rounded" :href="route('customers.create')">
                    Add New
                    </Link>
                </div>
            </div>
            <table class="shadow">
                <thead>
                    <tr class="text-[12px] text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <td class="px-6 py-4">
                            First Name
                        </td>
                        <td class="px-6 py-4">
                            Surname
                        </td>
                        <td class="px-6 py-4">
                            Gender
                        </td>
                        <td class="px-6 py-4">
                            Email
                        </td>
                        <td class="px-6 py-4">
                            Birthday
                        </td>
                        <td class="px-6 py-4">
                            Status
                        </td>
                        <td class="px-6 py-4 flex justify-center">
                            Ações
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="customer in $page.props.customers.data" :key="customer.id"
                        class="bg-white border-b text-[14px]">
                        <td class="px-6 py-2">
                            {{ customer.firstname }}
                        </td>
                        <td class="px-6 py-2">
                            {{ customer.surname }}
                        </td>
                        <td class="px-6 py-2">
                            {{ customer.gender }}
                        </td>
                        <td class="px-6 py-2">
                            {{ customer.email }}
                        </td>
                        <td class="px-6 py-2">
                            {{ customer.birthday }}
                        </td>
                        <td class="px-6 py-2">
                            {{ customer.status }}
                        </td>
                        <td class="px-6 py-4 ">
                            <div class="flex gap-1 justify-center">
                                <Link :href="route('customers.edit', customer.id)"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline p-2">
                                    <img src="/images/table/edit-18.png" class="hover:underline">
                                </Link>

                                <button @click="remove(customer.id)"
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline p-2">
                                    <img src="/images/table/delete-18.png" class="hover:underline">
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="w-full py-10 text-center">
                <nav class="flex items-center dark:bg-gray-900 py-4 justify-between pt-4" aria-label="Table navigation">
                    <span class="text-sm font-normal dark:bg-gray-900 text-gray-500 dark:text-gray-400">Showing
                        <span class="font-semibold text-gray-900 dark:text-white">{{
                            $page.props.customers.current_page }}-{{ $page.props.customers.last_page }}
                        </span>
                        of
                        <span class="font-semibold text-gray-900 dark:text-white">{{
                            $page.props.customers.total
                        }}</span></span>
                    <div class="inline-flex items-center -space-x-px">
                        <pagination :links="$page.props.customers.links" />
                    </div>
                </nav>
            </div>
        </div>
    </section>
</template>
<style scoped>
.container {
    padding: 98px 150px;
    display: flex;
    flex-direction: column;
    justify-items: center;
}
</style>