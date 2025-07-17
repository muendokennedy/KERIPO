<script setup>
import AdminSidebar from '@/Components/app/AdminSidebar.vue'
import AdminHeader from '@/Components/app/AdminHeader.vue'
import { XMarkIcon, ArrowLeftIcon } from '@heroicons/vue/24/solid'
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({
    admins: Array
})

const flashMessage = ref({
    show: false,
    type: 'success',
    message: ''
})

let flashTimeout = null

const showFlashMessage = (message, type = 'success') => {
    flashMessage.value = {
        show: true,
        type,
        message
    }

    if(flashTimeout){
        clearTimeout(flashTimeout)
    }

    flashTimeout = setTimeout(() => {
        hideFlashMessage()
    }, 8000)
}

const hideFlashMessage = () => {
    flashMessage.value.show = false

    if(flashTimeout){
        clearTimeout(flashTimeout)
        flashTimeout = null
    }
}

const newAdminForm = useForm({
    email: ''
})

const submit = () => {

    newAdminForm.post(route('admin.new.admin.invite'), {
        onSuccess: () => {
            showFlashMessage('The invitation has been sent successfully', 'success')
        }
    })

}

const isPrimaryAdmin = (admin) => {
    if(admin.email === 'kennedymuendo@gmail.com'){
        return true
    } else {
        return false
    }
}

</script>
<template>
    <AdminSidebar/>
    <section class="ml-[15rem] w-[calc(100% - 15rem)] main-content min-h-screen">
    <AdminHeader/>
      <main class="bg-[#E4E7F3] pt-20 px-[3%] pb-4">
        <div class="recent-sales bg-white p-4 rounded-md">
          <h2 class="text-[rgb(4,46,255)] font-semibold text-base md:text-xl py-4 capitalize">Active admins</h2>
          <div class="table-container overflow-x-auto">
            <table class="w-[40rem] lg:w-full border-2 my-4">
              <thead>
                <tr>
                  <th class="border-2 py-4">Admin name</th>
                  <th class="border-2 py-4">Email</th>
                  <th class="border-2 py-4">Photo</th>
                  <th class="border-2 py-4">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="admin in admins" :key="admin.id">
                  <td class="border-2 py-2 px-2 text-center">{{ admin.name }}</td>
                  <td class="border-2 py-2 px-2 text-center">{{ admin.email }}</td>
                  <td class="border-2 py-2 px-2 text-center sm:px-4 md:translate-x-4 lg:translate-x-6"><img :src="admin.avatar" :alt="admin.name" class="h-16 w-16 rounded-full object-cover"></td>
                  <td class="border-2 py-2 px-2 text-center">
                    <button v-if="isPrimaryAdmin(admin)" type="button" class="text-white bg-green-700 px-4 rounded-md py-2">Primary admin</button>
                    <button v-else type="button" class="text-white bg-[#042EFF] px-4 rounded-md py-2">Secondary admin</button>
                </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="table-container overflow-x-auto">
            <table class="w-[26rem] lg:w-1/2 border-2 mt-8">
              <thead>
                <tr>
                  <th class="border-2 py-4">Manage</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="admin in admins" :key="admin.id">
                  <td class="border-2 py-2 px-6 w-1/2">
                    <div class="flex w-full justify-between">
                      <button type="button" class="bg-[#FFCF10] py-3 px-8 capitalize rounded-md">message <i class="fa-solid fa-envelope pl-2"></i></button>
                      <div>
                          <button v-if="isPrimaryAdmin(admin)" type="button" class="bg-gray-300 py-3 px-8 capitalize rounded-md">remove <i class="fa-solid fa-times pl-2"></i></button>
                          <button v-else type="button" class="bg-[#FF4004] py-3 px-8 capitalize rounded-md">remove <i class="fa-solid fa-times pl-2"></i></button>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="new-admin bg-white p-4 rounded-md my-4">
          <h2 class="text-[rgb(4,46,255)] font-semibold text-base md:text-xl py-4 capitalize">add new new admin</h2>
          <div class="new-admin-form">
            <form @submit.prevent="submit">
                <div class="input-box">
                  <label for="email" class="block py-3">Enter the email address of the admin to be:</label>
                  <input type="text" v-model="newAdminForm.email" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
                </div>
              <button type="submit" class="capitalize px-4 py-2 bg-[#042EFF] rounded-md text-white my-4">add new admin</button>
            </form>
          </div>
        </div>
      </main>
    </section>
    <div v-if="flashMessage.show" class="fixed top-4 right-4 z-50 max-w-md w-full">
      <div :class="{
        'bg-green-100 border-green-400 text-green-700': flashMessage.type === 'success',
        'bg-red-100 border-red-400 text-red-700': flashMessage.type === 'error',
        'bg-yellow-100 border-yellow-400 text-yellow-700': flashMessage.type === 'warning'
      }" class="border-l-4 p-4 rounded-md shadow-lg">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <div class="mr-3">
              <i v-if="flashMessage.type === 'success'" class="fa-solid fa-check-circle text-green-500"></i>
              <i v-if="flashMessage.type === 'error'" class="fa-solid fa-exclamation-circle text-red-500"></i>
              <i v-if="flashMessage.type === 'warning'" class="fa-solid fa-exclamation-triangle text-yellow-500"></i>
            </div>
            <p class="font-medium">{{ flashMessage.message }}</p>
          </div>
          <button @click="hideFlashMessage" class="ml-4 text-gray-400 hover:text-gray-600">
            <XMarkIcon class="size-6 cursor-pointer font-bold"/>
          </button>
        </div>
      </div>
    </div>
</template>
