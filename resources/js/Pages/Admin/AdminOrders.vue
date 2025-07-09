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
                    <td class="border-2 py-2 px-2 text-center"><Link as="button" :href="route('admin.orderInfo', order.id)" class="text-white bg-[#042EFF] px-4 rounded-md py-1">view</Link></td>
                    <td class="border-2 py-2 px-2 text-center">{{ order.user.email }}</td>
                    <td class="border-2 py-2 px-2 text-center">{{ order.user.mobileNumber }}</td>
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
