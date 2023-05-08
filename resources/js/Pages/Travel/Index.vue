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

            <section class="container px-4 mx-auto">
    <div class="sm:flex sm:items-center sm:justify-between">
        <h2 class="text-lg font-semibold  text-gray-800 dark:text-white">Add Travel Order</h2>

        <div class="flex items-center mt-4 gap-x-3">


            <button @click="openModal(1)" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_3098_154395)">
                    <path d="M13.3333 13.3332L9.99997 9.9999M9.99997 9.9999L6.66663 13.3332M9.99997 9.9999V17.4999M16.9916 15.3249C17.8044 14.8818 18.4465 14.1806 18.8165 13.3321C19.1866 12.4835 19.2635 11.5359 19.0351 10.6388C18.8068 9.7417 18.2862 8.94616 17.5555 8.37778C16.8248 7.80939 15.9257 7.50052 15 7.4999H13.95C13.6977 6.52427 13.2276 5.61852 12.5749 4.85073C11.9222 4.08295 11.104 3.47311 10.1817 3.06708C9.25943 2.66104 8.25709 2.46937 7.25006 2.50647C6.24304 2.54358 5.25752 2.80849 4.36761 3.28129C3.47771 3.7541 2.70656 4.42249 2.11215 5.23622C1.51774 6.04996 1.11554 6.98785 0.935783 7.9794C0.756025 8.97095 0.803388 9.99035 1.07431 10.961C1.34523 11.9316 1.83267 12.8281 2.49997 13.5832" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_3098_154395">
                    <rect width="20" height="20" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>

                <span>Add Travel</span>
            </button>
        </div>
    </div>

    <div class="flex flex-col mt-6">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center gap-x-3">
                                        <input type="checkbox" class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">
                                        <span>#</span>
                                    </div>
                                </th>

                                <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    REF. NUMBER
                                </th>

                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    TRIPS
                                </th>

                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    CREATED BY
                                </th>

                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    UPDATED BY
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    ACTION
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
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
                            <td class="border border-gray-400 px-2 py-2 text-center">
                            <div class="space-x-2">
                                <Link :href="route('travel.show',tra.id)"
                                    :class="'px-4 py-2 bg-blue-400 text-white border rounded-md font-semibold text-xs'">
                                    <i class="fa-solid fa-eye"></i>
                                </Link>

                                <WarningButton @click="openModal(2,tra.ref_num,tra.id)">
                                    <i class="fa-solid fa-edit"></i>
                                </WarningButton>

                                <DangerButton @click="deleteEmployee(tra.id,tra.ref_num)">
                                    <i class="fa-solid fa-trash"></i>
                                </DangerButton>
                            </div>
                        </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-between mt-6">
        <a href="#" class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
            </svg>

            <span>
                previous
            </span>
        </a>

        <div class="items-center hidden md:flex gap-x-3">
            <a href="#" class="px-2 py-1 text-sm text-blue-500 rounded-md dark:bg-gray-800 bg-blue-100/60">1</a>
            <a href="#" class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">2</a>
            <a href="#" class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">3</a>
            <a href="#" class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">...</a>
            <a href="#" class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">12</a>
            <a href="#" class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">13</a>
            <a href="#" class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">14</a>
        </div>

        <a href="#" class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
            <span>
                Next
            </span>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
            </svg>
        </a>
    </div>
</section>

        <Modal :show="modal" @close="closeModal" maxWidth="7xl">
            <section class="p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800 w-full">

                <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Add Travel Order</h2>

                <form>
                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">
                        <div class="p-3 mt-6">
                            <InputLabel for="employee_id" value="Name of Official:"></InputLabel>
                            <select id="employee_id" multiple v-model="form.employee_id" class="mt-1 block  w-full">
                                <option v-for="emp in employee" :value="emp.id">{{ emp.name }}</option>
                            </select>
                            <InputError :message="form.errors.employee_id" class="mt-2"></InputError>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-3">

                    <div class="p-3 mt-6">
                        <InputLabel for="ref_num" value="Ref. Number:"></InputLabel>
                        <TextInput id="ref_num" ref="ref_num"
                        v-model="form.ref_num" type="text" class="mt-1 block  w-full"
                        placeholder="Reference Number"></TextInput>
                        <InputError :message="form.errors.ref_num" class="mt-2"></InputError>
                    </div>

                    <div class="p-3 mt-6">
                        <InputLabel for="time_travel" value="Time Travel:"></InputLabel>
                        <TextInput id="time_travel" ref="time_travel"
                        v-model="form.time_travel" type="time" class="mt-1 block  w-full"
                        placeholder="Time Travel"></TextInput>
                        <InputError :message="form.errors.time_travel" class="mt-2"></InputError>
                    </div>

                    <div class="p-3 mt-6">
                        <InputLabel for="date_from_travel" value="Date From Travel:"></InputLabel>
                        <TextInput id="date_from_travel" ref="date_from_travel"
                        v-model="form.date_from_travel" type="date" class="mt-1 block  w-full"
                        placeholder="Time Travel"></TextInput>
                        <InputError :message="form.errors.date_from_travel" class="mt-2"></InputError>
                    </div>

                    <div class="p-3 mt-6">
                        <InputLabel for="date_to_travel" value="Date To Travel:"></InputLabel>
                        <TextInput id="date_to_travel" ref="date_to_travel"
                        v-model="form.date_to_travel" type="date" class="mt-1 block  w-full"
                        placeholder="Time Travel"></TextInput>
                        <InputError :message="form.errors.date_to_travel" class="mt-2"></InputError>
                    </div>

                    <div class="p-3 mt-6">
                        <InputLabel for="purpose" value="Purpose:"></InputLabel>
                        <TextInput id="purpose" ref="purpose"
                        v-model="form.purpose" type="text" class="mt-1 block  w-full"
                        placeholder="Purpose"></TextInput>
                        <InputError :message="form.errors.purpose" class="mt-2"></InputError>
                    </div>

                    <div class="p-3 mt-6">
                        <InputLabel for="source" value="Source:"></InputLabel>
                        <TextInput id="source" ref="source"
                        v-model="form.source" type="text" class="mt-1 block  w-full"
                        placeholder="Source"></TextInput>
                        <InputError :message="form.errors.source" class="mt-2"></InputError>
                    </div>

                    <div class="p-3 mt-6">
                        <InputLabel for="destination" value="Destination:"></InputLabel>
                        <TextInput id="destination" ref="destination"
                        v-model="form.destination" type="text" class="mt-1 block  w-full"
                        placeholder="Destination"></TextInput>
                        <InputError :message="form.errors.destination" class="mt-2"></InputError>
                    </div>

                    <div class="p-3 mt-6">
                        <InputLabel for="position_id" value="Position:"></InputLabel>
                        <SelectInput id="position_id" :options="position"
                        v-model="form.position_id" type="text" class="mt-1 block  w-full"
                        ></SelectInput>
                        <InputError :message="form.errors.position_id" class="mt-2"></InputError>
                    </div>

                    <div class="p-3 mt-6">
                        <InputLabel for="nature_id" value="Nature of Travel:"></InputLabel>
                        <SelectInput id="nature_id" :options="nature"
                        v-model="form.nature_id" type="text" class="mt-1 block  w-full"
                        ></SelectInput>
                        <InputError :message="form.errors.nature_id" class="mt-2"></InputError>
                    </div>

                    <div class="p-3 mt-6">
                        <InputLabel for="recommending_id" value="Recommending Approval:"></InputLabel>
                        <SelectInput id="recommending_id" :options="recommending"
                        v-model="form.recommending_id" type="text" class="mt-1 block  w-full"
                        ></SelectInput>
                        <InputError :message="form.errors.recommending_id" class="mt-2"></InputError>
                    </div>

                    <div class="p-3 mt-6">
                        <InputLabel for="approving_id" value="Approved By:"></InputLabel>
                        <SelectInput id="approving_id" :options="approving"
                        v-model="form.approving_id" type="text" class="mt-1 block  w-full"
                        ></SelectInput>
                        <InputError :message="form.errors.approving_id" class="mt-2"></InputError>
                    </div>

                    <div class="p-3 mt-6">
                        <InputLabel for="recommended_at" value="Recommended At:"></InputLabel>
                        <TextInput id="recommended_at" ref="recommended_at"
                        v-model="form.recommended_at" type="date" class="mt-1 block  w-full"
                        placeholder="Recommended At"></TextInput>
                        <InputError :message="form.errors.recommended_at" class="mt-2"></InputError>
                    </div>

                    <div class="p-3 mt-6">
                        <InputLabel for="approved_at" value="Approved At:"></InputLabel>
                        <TextInput id="approved_at" ref="recommended_at"
                        v-model="form.approved_at" type="date" class="mt-1 block  w-full"
                        placeholder="Approved At"></TextInput>
                        <InputError :message="form.errors.approved_at" class="mt-2"></InputError>
                    </div>

                    <div class="p-3 mt-6">
                        <InputLabel for="created_by" value="Created By:"></InputLabel>
                        <TextInput id="created_by" ref="recommended_at"
                        v-model="form.created_by" type="text" class="mt-1 block  w-full"
                        placeholder="Approved At"></TextInput>
                        <InputError :message="form.errors.created_by" class="mt-2"></InputError>
                    </div>

                    <div class="p-3 mt-6">
                        <InputLabel for="updated_by" value="Updated By:"></InputLabel>
                        <TextInput id="updated_by" ref="recommended_at"
                        v-model="form.updated_by" type="text" class="mt-1 block  w-full"
                        placeholder="Updated By"></TextInput>
                        <InputError :message="form.errors.updated_by" class="mt-2"></InputError>
                    </div>
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
                </form>
            </section>
        </Modal>
    </AuthenticatedLayout>
</template>
