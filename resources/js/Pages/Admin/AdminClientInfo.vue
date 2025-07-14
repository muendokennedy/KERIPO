<script setup>
import AdminSidebar from '@/Components/app/AdminSidebar.vue'
import AdminHeader from '@/Components/app/AdminHeader.vue'

const props = defineProps({
    users: {
        type: Array
    }
})

</script>
<template>
    <AdminSidebar/>
    <section class="ml-[15rem] w-[calc(100% - 15rem)] main-content min-h-screen">
    <AdminHeader/>
      <main class="bg-[#E4E7F3] pt-20 px-[3%] pb-4">
        <div class="recent-sales bg-white p-4 rounded-md">
          <h2 class="text-[rgb(4,46,255)] font-semibold text-base md:text-xl py-4 capitalize">Signed up clients</h2>
          <div class="table-container overflow-x-auto">
            <table class="w-[40rem] md:w-full border-2 my-4">
              <thead>
                <tr>
                  <th class="border-2 py-4">Client Name</th>
                  <th class="border-2 py-4">Email</th>
                  <th class="border-2 py-4 px-2">Active Customer</th>
                  <th class="border-2 py-4">Contact</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users" :key="user.id">
                  <td class="border-2 py-2 px-2 text-center">{{ user.name }}</td>
                  <td class="border-2 py-2 px-2 text-center">{{ user.email }}</td>
                  <td class="border-2 py-2 px-2 text-center">{{ user?.propertyId ? 'Yes' : 'No' }}</td>
                  <td class="border-2 py-2 px-2 text-center">{{ user?.mobileNumber || 'N/A' }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="table-container overflow-x-auto">
            <table class="w-[30rem] md:w-full lg:w-4/5 border-2 mt-8">
              <thead>
                <tr>
                  <th class="border-2 py-4">Manage</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users" :key="user.id">
                  <td class="border-2 py-2 px-6 w-1/2">
                    <div class="flex w-full justify-between">
                      <button type="button" class="bg-[#FFCF10] py-3 px-8 capitalize rounded-md">message <i class="fa-solid fa-envelope pl-2"></i></button>
                      <button type="button" class="bg-[#FF4004] py-3 px-8 capitalize rounded-md">suspend <i class="fa-solid fa-times pl-2"></i></button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </section>
</template>
