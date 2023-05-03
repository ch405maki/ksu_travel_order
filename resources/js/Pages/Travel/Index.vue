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
    travel: {type:Object},
    approving: {type:Object},
    position: {type:Object},
    employee: {type:Object},
    nature: {type:Object},
    trip: {type:Object},
    recommending: {type:Object},
});
const form = useForm({
    ref_num: '',
    time_travel: '',
    date_from_travel: '',
    date_to_travel: '',
    purpose: '',
    source: '',
    destination: '',
    employee_id: '',
    position_id: '',
    nature_id: '',
    recommending_id: '',
    approving_id: '',
    recommended_at: '',
    approved_at: '',
    created_by: '',
    updated_by: ''
});
const formPage = useForm({});
const onPageClick = (event)=>{
    formPage.get(route('travel.index',{page:event}));
}
const openModal = (op,travel,position) =>{
    modal.value = true;
    nextTick( () => nameInput.value.focus());
    operation.value = op;
    id.value = travel;
    if(op == 1){
        title.value = 'Create Travel';
    }
    else{
        title.value = 'Edit Travel';
        form.ref_num= ref_num;
        form.time_travel= time_travel;
        form.date_from_travel= date_from_travel;
        form.date_to_travel= date_to_travel;
        form.purpose= purpose;
        form.source= source;
        form.destination= destination;
        form.employee_id= employee;
        form.position_id= position;
        form.nature_id= nature;
        form.recommending_id= recommending;
        form.approving_id= approving;
        form.recommended_at= recommended_at;
        form.approved_at= approved_at;
        form.created_by= created_by;
        form.updated_by= updated_by;
    }
}
const closeModal = () =>{
    modal.value = false;
    form.reset();
}
const save = () =>{
    if(operation.value == 1){
        form.post(route('travel.store'),{
            onSuccess: () => {ok('created')}
        });
    }
    else{
        form.put(route('travel.update',id.value),{
            onSuccess: () => {ok('updated')}
        });
    }
}
const ok = (msj) =>{
    form.reset();
    closeModal();
    Swal.fire({title:msj,icon:'success'});
}
const deleteEmployee = (id,ref_num) =>{
    const alerta = Swal.mixin({
        buttonsStyling:true
    });
    alerta.fire({
        title:'Are you sure delete '+ref_num+' ?',
        icon:'question', showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Yes,delete',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancel'
    }).then((result) => {
        if(result.isConfirmed) {
            form.delete(route('travel.destroy',id),{
                onSuccess: () =>{ok('Employee deleted')}
            });
        }
    }); 

}

</script>

<template>
    <Head title="Travel" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Travel</h2>
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
                            <th class="px-2 py-2">REF. NUMBER</th>
                            <th class="px-2 py-2">TRIPS</th>
                            <th class="px-2 py-2">CREATED BY</th>
                            <th class="px-2 py-2">UPDATED BY</th>
                            <th class="px-2 py-2">ACTION</th>
                            <th class="px-2 py-2">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(tra, i) in travel" :key="i">
                        <td class="border border-gray-400 px-2 py-2">{{ (i+1) }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ tra.ref_num }}</td>
                        <td class="border border-gray-400 px-2 py-2">
                            
                                <p v-for="(val, index) in tra.trips" :key="index">
                                    <div>
                                        <p>Trip: {{ val.time_travel }}</p>
                                        <p>Passengers</p>
                                        <ol>
                                            <li v-for="(passenger, ind) in val.passengers">
                                                {{ ind + 1 }}: {{ passenger.employee.name }}
                                            </li>
                                        </ol>
                                    </div>
                                </p>
                        </td>
                        <td class="border border-gray-400 px-2 py-2">{{ tra.created_by }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ tra.updated_by }}</td>
                        
                        <td class="border border-gray-400 px-2 py-2">
                            <WarningButton 
                            @click="openModal(2,tra.ref_num,tra.id)">
                                <i class="fa-solid fa-edit"></i>
                            </WarningButton>
                        </td>
                        <td class="border border-gray-400 px-2 py-2">
                            <DangerButton @click="deleteEmployee(tra.id,tra.ref_num)">
                                <i class="fa-solid fa-trash"></i>
                            </DangerButton>
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-white grid v-screen place-items-center">
                <VueTailwindPagination
                    :current="travel.currentPage" :total="travel.total"
                    :per-page="travel.perPage"
                    @page-changed="onPageClick($event)"
                ></VueTailwindPagination>
            </div>
        </div>
        <Modal :show="modal" @close="closeModal">
            <h2 class="p-3 text-lg font.medium text-hray-900">{{ title }}</h2>

            <div class="p-3 mt-6">
                <InputLabel for="ref_num" value="Ref. Number:"></InputLabel>
                <TextInput id="ref_num" ref="ref_num"
                v-model="form.ref_num" type="text" class="mt-1 block w-3/4"
                placeholder="Reference Number"></TextInput>
                <InputError :message="form.errors.ref_num" class="mt-2"></InputError>
            </div>

            <div class="p-3 mt-6">
                <InputLabel for="time_travel" value="Time Travel:"></InputLabel>
                <TextInput id="time_travel" ref="time_travel"
                v-model="form.time_travel" type="time" class="mt-1 block w-3/4"
                placeholder="Time Travel"></TextInput>
                <InputError :message="form.errors.time_travel" class="mt-2"></InputError>
            </div>

            <div class="p-3 mt-6">
                <InputLabel for="date_from_travel" value="Date From Travel:"></InputLabel>
                <TextInput id="date_from_travel" ref="date_from_travel"
                v-model="form.date_from_travel" type="date" class="mt-1 block w-3/4"
                placeholder="Time Travel"></TextInput>
                <InputError :message="form.errors.date_from_travel" class="mt-2"></InputError>
            </div>

            <div class="p-3 mt-6">
                <InputLabel for="date_to_travel" value="Date To Travel:"></InputLabel>
                <TextInput id="date_to_travel" ref="date_to_travel"
                v-model="form.date_to_travel" type="date" class="mt-1 block w-3/4"
                placeholder="Time Travel"></TextInput>
                <InputError :message="form.errors.date_to_travel" class="mt-2"></InputError>
            </div>

            <div class="p-3 mt-6">
                <InputLabel for="purpose" value="Purpose:"></InputLabel>
                <TextInput id="purpose" ref="purpose"
                v-model="form.purpose" type="text" class="mt-1 block w-3/4"
                placeholder="Purpose"></TextInput>
                <InputError :message="form.errors.purpose" class="mt-2"></InputError>
            </div>

            <div class="p-3 mt-6">
                <InputLabel for="source" value="Source:"></InputLabel>
                <TextInput id="source" ref="source"
                v-model="form.source" type="text" class="mt-1 block w-3/4"
                placeholder="Source"></TextInput>
                <InputError :message="form.errors.source" class="mt-2"></InputError>
            </div>

            <div class="p-3 mt-6">
                <InputLabel for="destination" value="Destination:"></InputLabel>
                <TextInput id="destination" ref="destination"
                v-model="form.destination" type="text" class="mt-1 block w-3/4"
                placeholder="Destination"></TextInput>
                <InputError :message="form.errors.destination" class="mt-2"></InputError>
            </div>

            <div class="p-3">
                <InputLabel for="employee_id" value="Name of Official:"></InputLabel>
                <select id="employee_id" multiple v-model="form.employee_id" class="mt-1 block w-3/4">
                    <option v-for="emp in employee" :value="emp.id">{{ emp.name }}</option>
                </select>
                <InputError :message="form.errors.employee_id" class="mt-2"></InputError>
            </div>


            <div class="p-3">
                <InputLabel for="position_id" value="Position:"></InputLabel>
                <SelectInput id="position_id" :options="position"
                v-model="form.position_id" type="text" class="mt-1 block w-3/4"
                ></SelectInput>
                <InputError :message="form.errors.position_id" class="mt-2"></InputError>
            </div>

            <div class="p-3">
                <InputLabel for="nature_id" value="Nature of Travel:"></InputLabel>
                <SelectInput id="nature_id" :options="nature"
                v-model="form.nature_id" type="text" class="mt-1 block w-3/4"
                ></SelectInput>
                <InputError :message="form.errors.nature_id" class="mt-2"></InputError>
            </div>

            <div class="p-3">
                <InputLabel for="recommending_id" value="Recommending Approval:"></InputLabel>
                <SelectInput id="recommending_id" :options="recommending"
                v-model="form.recommending_id" type="text" class="mt-1 block w-3/4"
                ></SelectInput>
                <InputError :message="form.errors.recommending_id" class="mt-2"></InputError>
            </div>

            <div class="p-3">
                <InputLabel for="approving_id" value="Approved By:"></InputLabel>
                <SelectInput id="approving_id" :options="approving"
                v-model="form.approving_id" type="text" class="mt-1 block w-3/4"
                ></SelectInput>
                <InputError :message="form.errors.approving_id" class="mt-2"></InputError>
            </div>

            <div class="p-3 mt-6">
                <InputLabel for="recommended_at" value="Recommended At:"></InputLabel>
                <TextInput id="recommended_at" ref="recommended_at"
                v-model="form.recommended_at" type="date" class="mt-1 block w-3/4"
                placeholder="Recommended At"></TextInput>
                <InputError :message="form.errors.recommended_at" class="mt-2"></InputError>
            </div>

            <div class="p-3 mt-6">
                <InputLabel for="approved_at" value="Approved At:"></InputLabel>
                <TextInput id="approved_at" ref="recommended_at"
                v-model="form.approved_at" type="date" class="mt-1 block w-3/4"
                placeholder="Approved At"></TextInput>
                <InputError :message="form.errors.approved_at" class="mt-2"></InputError>
            </div>

            <div class="p-3 mt-6">
                <InputLabel for="created_by" value="Created By:"></InputLabel>
                <TextInput id="created_by" ref="recommended_at"
                v-model="form.created_by" type="text" class="mt-1 block w-3/4"
                placeholder="Approved At"></TextInput>
                <InputError :message="form.errors.created_by" class="mt-2"></InputError>
            </div>

            <div class="p-3 mt-6">
                <InputLabel for="updated_by" value="Updated By:"></InputLabel>
                <TextInput id="updated_by" ref="recommended_at"
                v-model="form.updated_by" type="text" class="mt-1 block w-3/4"
                placeholder="Updated By"></TextInput>
                <InputError :message="form.errors.updated_by" class="mt-2"></InputError>
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
