<script setup>
import AdminSidebar from '@/Components/app/AdminSidebar.vue'
import AdminHeader from '@/Components/app/AdminHeader.vue'
import { Link } from '@inertiajs/vue3'


const props = defineProps({
    orders: {
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
          <h2 class="text-[rgb(4,46,255)] font-semibold text-xl py-4 capitalize">orders</h2>
          <div v-if="orders.length">
            <div class="table-scroll overflow-x-auto">
                <table class="w-full border-2 my-4">
                <thead>
                    <tr>
                    <th class="border-2 py-4 px-2">Customer</th>
                    <th class="border-2 py-4 px-2">Address</th>
                    <th class="border-2 py-4 px-2">Details</th>
                    <th class="border-2 py-4 px-2">Email</th>
                    <th class="border-2 py-4 px-2">Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(order, index) in orders" :key="index">
                    <td class="border-2 py-2 px-2 text-center">{{ order.user.name }}</td>
                    <td class="border-2 py-2 px-2 text-center">{{ order.user.address }}</td>
                    <td class="border-2 py-2 px-2 text-center"><Link as="button" :href="route('admin.dashboard')" class="text-white bg-[#042EFF] px-4 rounded-md py-1">view</Link></td>
                    <td class="border-2 py-2 px-2 text-center">{{ order.user.email }}</td>
                    <td class="border-2 py-2 px-2 text-center">{{ order.user.mobileNumber }}</td>
                    </tr>
                </tbody>
                </table>
            </div>
            <div class="table-scroll overflow-x-auto">
                <table class="w-[40rem] border-2 mt-8">
                <thead>
                    <tr>
                    <th class="border-2 py-4">Status</th>
                    <th class="border-2 py-4">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(order, index) in orders" :key="index">
                    <td class="border-2 py-2 px-2 text-center">{{ order.orderStatus }}</td>
                    <td class="border-2 py-2 px-6 w-1/2">
                        <div class="flex w-full gap-2 justify-between">
                        <button type="button" class="bg-[#FFCF10] py-3 px-4 capitalize rounded-md">approve <i class="fa-solid fa-check pl-2 text-green-700"></i></button>
                        <button type="button" class="bg-[#FF4004] py-3 px-4 capitalize rounded-md">reject <i class="fa-solid fa-times pl-2"></i></button>
                        </div>
                    </td>
                    </tr>
                </tbody>
                </table>
            </div>
          </div>
          <div v-else class="font-bold">There no property orders placed currently</div>
        </div>
      </main>
    </section>
</template>
