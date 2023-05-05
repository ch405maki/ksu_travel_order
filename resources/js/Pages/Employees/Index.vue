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
    employees: {type:Object},
    departments: {type:Object},
    role: {type:Object},
    position: {type:Object}
});
const form = useForm({
    name:'', email:'',phone:'',department_id:'', role_id:'', position_id:''
});
const formPage = useForm({});
const onPageClick = (event)=>{
    formPage.get(route('employees.index',{page:event}));
}
const openModal = (op,name,email,phone,department,employee,role,position) =>{
    modal.value = true;
    nextTick( () => nameInput.value.focus());
    operation.value = op;
    id.value = employee;
    if(op == 1){
        title.value = 'Create employee';
    }
    else{
        title.value = 'Edit employee';
        form.name=name;
        form.email=email;
        form.phone=phone;
        form.department_id=department;
        form.role_id=role;
        form.position_id=position;
    }
}
const closeModal = () =>{
    modal.value = false;
    form.reset();
}
const save = () =>{
    if(operation.value == 1){
        form.post(route('employees.store'),{
            onSuccess: () => {ok('Employee created')}
        });
    }
    else{
        form.put(route('employees.update',id.value),{
            onSuccess: () => {ok('Employee updated')}
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
            form.delete(route('employees.destroy',id),{
                onSuccess: () =>{ok('Employee deleted')}
            });
        }
    }); 

}

</script>

<template>
    <Head title="Employees" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Employees</h2>
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
                            <th class="px-2 py-2">EMAIL</th>
                            <th class="px-2 py-2">PHONE</th>
                            <th class="px-2 py-2">DEPARTMENT</th>
                            <th class="px-2 py-2">POSITION</th>
                            <th class="px-2 py-2">ROLE</th>
                            <th class="px-2 py-2"></th>
                            <th class="px-2 py-2"></th>
                            <th class="px-2 py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="emp, i in employees.data" :key="emp.id">
                        <td class="border border-gray-400 px-2 py-2">{{ (i+1) }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.name }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.email }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.phone }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.department.name }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.position.name }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.role.name }}</td>
                        <td class="border border-gray-400 px-2 py-2">
                            <WarningButton 
                            @click="openModal(2,emp.name,emp.email,emp.phone,emp.department_id,emp.id)">
                                <i class="fa-solid fa-edit"></i>
                            </WarningButton>
                        </td>
                        <td class="border border-gray-400 px-2 py-2">
                            <DangerButton @click="deleteEmployee(emp.id,emp.name)">
                                <i class="fa-solid fa-trash"></i>
                            </DangerButton>
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-white grid v-screen place-items-center">
                <VueTailwindPagination
                    :current="employees.currentPage" :total="employees.total"
                    :per-page="employees.perPage"
                    @page-changed="onPageClick($event)"
                ></VueTailwindPagination>
            </div>
        </div>
        <Modal :show="modal" @close="closeModal" maxWidth="7xl">
            <section class="p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800 w-full">

                <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Add Travel Order</h2>

                <form>
                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                        <div class="p-3 ">
                <InputLabel for="name" value="Name:"></InputLabel>
                <TextInput id="name" ref="nameInput"
                v-model="form.name" type="text" class="mt-1 block  w-full"
                placeholder="Name"></TextInput>
                <InputError :message="form.errors.name" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="email" value="Email:"></InputLabel>
                <TextInput id="email"
                v-model="form.email" type="text" class="mt-1 block  w-full"
                placeholder="Email"></TextInput>
                <InputError :message="form.errors.email" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="phone" value="Phone:"></InputLabel>
                <TextInput id="phone"
                v-model="form.phone" type="text" class="mt-1 block  w-full"
                placeholder="Phone"></TextInput>
                <InputError :message="form.errors.phone" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="department_id" value="Department:"></InputLabel>
                <SelectInput id="department_id" :options="departments"
                v-model="form.department_id" type="text" class="mt-1 block  w-full"
                ></SelectInput>
                <InputError :message="form.errors.department_id" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="role_id" value="Role:"></InputLabel>
                <SelectInput id="role_id" :options="role"
                v-model="form.role_id" type="text" class="mt-1 block  w-full"
                ></SelectInput>
                <InputError :message="form.errors.role_id" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="position_id" value="Position:"></InputLabel>
                <SelectInput id="position_id" :options="position"
                v-model="form.position_id" type="text" class="mt-1 block  w-full"
                ></SelectInput>
                <InputError :message="form.errors.position_id" class="mt-2"></InputError>
            </div>
            <div class="p-3 mt-6">
                <PrimaryButton :disabled="form.processing" @click="save">
                    <i class="fa-solid fa-save"></i> Save
                </PrimaryButton>
                <SecondaryButton class="ml-3" :disabled="form.processing"
                @click="closeModal">
                    Cancel
                </SecondaryButton>
            </div>
                    </div>
                </form>
            </section>
        </Modal>
    </AuthenticatedLayout>
</template>
