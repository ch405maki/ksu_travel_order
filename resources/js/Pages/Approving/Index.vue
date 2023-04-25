<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import WarningButton from '@/Components/WarningButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
import { Head,Link,useForm } from '@inertiajs/vue3';
import { nextTick,ref } from 'vue';
import Swal from 'sweetalert2';
import VueTailwindPagination from '@ocrv/vue-tailwind-pagination';

const nameInput = ref(null);
const modal = ref(false);
const title = ref('');
const operation = ref(1);
const id = ref('');

const props = defineProps({
    approving: {type:Object},
    position: {type:Object}
});
const form = useForm({
    name:'',  position_id:''
});
const formPage = useForm({});
const onPageClick = (event)=>{
    formPage.get(route('approving.index',{page:event}));
}
const openModal = (op,name,approving,position) =>{
    modal.value = true;
    nextTick( () => nameInput.value.focus());
    operation.value = op;
    id.value = approving;
    if(op == 1){
        title.value = 'Create employee';
    }
    else{
        title.value = 'Edit employee';
        form.name=name;
        form.position_id=position;
    }
}
const closeModal = () =>{
    modal.value = false;
    form.reset();
}
const save = () =>{
    if(operation.value == 1){
        form.post(route('approving.store'),{
            onSuccess: () => {ok('created')}
        });
    }
    else{
        form.put(route('approving.update',id.value),{
            onSuccess: () => {ok('updated')}
        });
    }
}
const ok = (msj) =>{
    form.reset();
    closeModal();
    Swal.fire({title:msj,icon:'success'});
}
const deleteEmployee = (id,name) =>{
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
            form.delete(route('approving.destroy',id),{
                onSuccess: () =>{ok('Employee deleted')}
            });
        }
    }); 

}

</script>

<template>
    <Head title="Approving" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Approving</h2>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                    <PrimaryButton @click="openModal(1)">
                        <i class="fa-solid fa-plus-circle"></i> Add
                    </PrimaryButton>
                </div>
            </div>
            <div class="bg-white grid v-screen place-items-center overflow-x-auto py-3">
                <table class="table-auto border border-gray-400">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-2 py-2">#</th>
                            <th class="px-2 py-2">NAME</th>
                            <th class="px-2 py-2">POSITION</th>
                            <th class="px-2 py-2"></th>
                            <th class="px-2 py-2"></th>
                            <th class="px-2 py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="app, i in approving.data" :key="app.id">
                        <td class="border border-gray-400 px-2 py-2">{{ (i+1) }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ app.name }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ app.position }}</td>
                        <td class="border border-gray-400 px-2 py-2">
                            <WarningButton 
                            @click="openModal(2,app.name,app.id)">
                                <i class="fa-solid fa-edit"></i>
                            </WarningButton>
                        </td>
                        <td class="border border-gray-400 px-2 py-2">
                            <DangerButton @click="deleteEmployee(app.id,app.name)">
                                <i class="fa-solid fa-trash"></i>
                            </DangerButton>
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-white grid v-screen place-items-center">
                <VueTailwindPagination
                    :current="approving.currentPage" :total="approving.total"
                    :per-page="approving.perPage"
                    @page-changed="onPageClick($event)"
                ></VueTailwindPagination>
            </div>
        </div>
        <Modal :show="modal" @close="closeModal">
            <h2 class="p-3 text-lg font.medium text-hray-900">{{ title }}</h2>
            <div class="p-3 mt-6">
                <InputLabel for="name" value="Name:"></InputLabel>
                <TextInput id="name" ref="nameInput"
                v-model="form.name" type="text" class="mt-1 block w-3/4"
                placeholder="Name"></TextInput>
                <InputError :message="form.errors.name" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="position_id" value="Position:"></InputLabel>
                <SelectInput id="position_id" :options="position"
                v-model="form.position_id" type="text" class="mt-1 block w-3/4"
                ></SelectInput>
                <InputError :message="form.errors.position_id" class="mt-2"></InputError>
            </div>
            <div class="p-3 mt-6">
                <PrimaryButton :disabled="form.processing" @click="save">
                    <i class="fa-solid fa-save"></i> Save
                </PrimaryButton>
            </div>
            <div class="p-3 mt-6 flex justify-end">
                <SecondaryButton class="ml-3" :disabled="form.processing"
                @click="closeModal">
                    Cancel
                </SecondaryButton>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
