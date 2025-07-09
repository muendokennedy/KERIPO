<script setup>
import AdminSidebar from '@/Components/app/AdminSidebar.vue'
import AdminHeader from '@/Components/app/AdminHeader.vue'
// import ProductModal from '@/Components/app/ProductModal.vue'
import {onMounted, ref} from 'vue'
import { PencilSquareIcon, TrashIcon, CloudArrowUpIcon, XMarkIcon, CheckCircleIcon, ExclamationTriangleIcon } from '@heroicons/vue/24/solid'
// import {isImage} from '@/helpers.js'
import { useForm, Link} from '@inertiajs/vue3'

const props = defineProps({
  properties: {
    type: Array,
    required: true
  },
  success: {
    type: String
  }
})

const form = useForm({})

const showSuccessNotification = ref(false)
const showPropertyDeleteModal = ref(false)
const propertyToDelete = ref(null)

const showDeleteModal = (property) => {
    propertyToDelete.value = property
    showPropertyDeleteModal.value = true
}

const confirmDelete = () => {
    if(propertyToDelete.value){
        deleteProperty(propertyToDelete.value)
        closeDeleteModal()
    }
}

const closeDeleteModal = () => {
    showPropertyDeleteModal.value = false
    propertyToDelete.value = null
}

onMounted(() => {
    showSuccessNotification.value = true

    setTimeout(() => {
        showSuccessNotification.value = false
    }, 8000)
})

const deleteProperty = (property) => {


    form.delete(route('admin.property.delete', property), {
        onSuccess: () => {
            setTimeout(() => {
            showSuccessNotification.value = false
        }, 8000)
        showSuccessNotification.value = true
        },
        preserveScroll: true
    })
}

</script>

<template>
    <AdminSidebar/>
    <section class="ml-[15rem] w-[calc(100% - 15rem)] main-content min-h-screen">
    <AdminHeader/>
    <main class="bg-[#E4E7F3] pt-20 px-[3%] pb-4">
        <Transition name="slide-fade">
            <div v-show="showSuccessNotification && success" class="flash-message transition-all duration-300 flex gap-2 text-white bg-green-500 border-green-700 border rounded-md fixed right-20 top-20 w-[600px] p-4 z-10">
                <CheckCircleIcon class="size-6 cursor-pointer"/>
                <span>{{ success }}</span>
                <XMarkIcon @click="showSuccessNotification = false" class="size-6 cursor-pointer absolute right-2"/>
            </div>
        </Transition>
            <div v-show="showPropertyDeleteModal" class="bg-[#f1dd89] p-4 rounded-md w-[50rem] h-[6rem] fixed right-[2rem]">
                <XMarkIcon @click="closeDeleteModal" class="size-6 cursor-pointer absolute right-2"/>
                <div class="flex gap-2 items-center">
                    <ExclamationTriangleIcon class="size-10 cursor-pointer text-[#FFCF10]"/>
                    <p>You are about to permanently delete the selected property!!</p>
                </div>
                <button @click="confirmDelete" class="absolute right-2 p-2 bg-red-500 rounded-md text-white bottom-2">Continue</button>
            </div>
        <div class="recent-sales bg-white p-4 rounded-md">
          <h2 class="text-[rgb(4,46,255)] font-semibold text-lg md:text-xl py-4 capitalize">Properties</h2>
          <div v-if="properties.length">
              <div class="table-container overflow-x-auto">
                <table  class="w-[45rem] md:w-full border-2 my-4">
                  <thead>
                    <tr>
                      <th class="border-2 py-4 px-2">Property ID</th>
                      <th class="border-2 py-4 px-2">Category</th>
                      <th class="border-2 py-4 px-2">Location</th>
                      <th class="border-2 py-4 px-2">Owner Name</th>
                      <th class="border-2 py-4 px-2">Valuation</th>
                      <th class="border-2 py-4 px-2">Acquisition status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(property, index) in properties" :key="index">
                      <td class="border-2 py-2 px-2 text-center">{{ property.propertyId }}</td>
                      <td class="border-2 py-2 px-2 text-center">{{ property.category }}</td>
                      <td class="border-2 py-2 px-2 text-center">{{ property.location }}</td>
                      <td class="border-2 py-2 px-2 text-center">{{ property.ownersName }}</td>
                      <td class="border-2 py-2 px-2 text-center">{{ property.propertyValuation }}</td>
                      <td class="border-2 py-2 px-2 text-center">{{ property.acquisitionStatus }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="table-container overflow-x-auto">
                <table class="w-[45rem] lg:w-[90%] border-2 mt-8">
                  <thead>
                    <tr>
                      <th class="border-2 py-4">Manage</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(property, index) in properties" :key="index">
                      <td class="border-2 py-2 px-6 w-1/2">
                        <div class="flex w-full justify-between">
                          <Link :href="route('admin.property.edit', property)" as="button" class="bg-[#FFCF10] inline-flex items-center gap-2 edit-button py-3 px-8 capitalize rounded-md">edit <PencilSquareIcon class="size-6"/> </Link>
                          <button type="button" @click="showDeleteModal(property)" class="bg-[#FF4004] inline-flex items-center gap-2 edit-button py-3 px-8 capitalize rounded-md">remove <TrashIcon class="size-6"/> </button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
          </div>
          <div v-else class="font-bold">There are no properties listed in our portal, kindly upload them below!</div>
        </div>
        <Link :href="route('admin.property.new.show')" as="button" class="capitalize px-4 py-2 bg-[#042EFF] rounded-md text-white my-4">add new property</Link>
        </main>
    </section>

</template>
<style scoped>
</style>
