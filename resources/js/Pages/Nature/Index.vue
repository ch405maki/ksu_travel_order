<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head,Link,useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Swal from 'sweetalert2';

const props = defineProps({
    nature: {type:Object}
});
const form = useForm({
    id:'',
    name:''
});
const deleteNature = (id,name) =>{
    const alerta = Swal.mixin({
        buttonsStyling:true
    });
    alerta.fire({
        title:'Are you sure delete '+name+' ?',
        icon:'question', showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Yes,delete',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancel'
    }).then((result) => {
        if(result.isConfirmed) {
            form.delete(route('nature.destroy',id));
        }
    });
}
</script>

<template>
    <Head title="Nature" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nature</h2>
        </template>

        <div class="container my-24 px-6 mx-auto">

                <!-- Section: Design Block -->
                <section class="mb-32 text-gray-800">
                <div class="block rounded-lg shadow-lg bg-white">
                    <div class="flex flex-wrap items-center">
                    <div class="grow-0 shrink-0 basis-auto w-full lg:w-6/12 xl:w-8/12">
                        <div class="px-6 py-12 md:px-12">
                            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-left text-sm font-light">
                        <thead
                            class="border-b bg-white font-medium dark:border-neutral-500 dark:bg-neutral-600">
                            <tr class="bg-gray-100">
                                <th class="px-4 py-4">#</th>
                                <th class="px-4 py-4">Nature</th>
                                <th class="px-4 py-4"></th>
                                <th class="px-4 py-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="nat, i in nature" :key="nat.id">
                            <td class="border border-gray-400 px-4 py-4">{{ (i+1) }}</td>
                            <td class="border border-gray-400 px-4 py-4">{{ nat.name }}</td>
                            <td class="border border-gray-400 px-4 py-4">
                                <Link :href="route('nature.edit',nat.id)"
                                :class="'px-4 py-2 bg-yellow-400 text-white border rounded-md font-semibold text-xs'">
                                <i class="fa-solid fa-edit"></i>
                                </Link>
                            </td>
                            <td class="border border-gray-400 px-4 py-4">
                                <DangerButton @click="deleteNature(nat.id,nat.name)">
                                    <i class="fa-solid fa-trash"></i>
                                </DangerButton>
                            </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="grow-0 shrink-0 basis-auto block w-full lg:flex lg:w-8/12 xl:w-4/12">
            <form @submit.prevent="form.post(route('nature.store'))"
                class="mt-6 space-y-6 max-w-xl">
                <InputLabel for="name" value="Nature"></InputLabel>
                <TextInput id="name" v-model="form.name" autofocus required
                type="text"
                class="mt-1 block w-full"></TextInput>
                <InputError :message="form.errors.name" class="mt-2"></InputError>
                <PrimaryButton :disabled="form.processing">
                    <i class="fa-solid fa-save"></i> Save
                </PrimaryButton>
            </form>
        </div>
    </div>
</div>
</section>
<!-- Section: Design Block -->
</div>
    </AuthenticatedLayout>
</template>