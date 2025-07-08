<script setup>
import AdminSidebar from '@/Components/app/AdminSidebar.vue'
import AdminHeader from '@/Components/app/AdminHeader.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    order: {
        type: Object,
        required: true
    }
})
</script>
<template>
    <AdminSidebar/>
    <section class="ml-[15rem] w-[calc(100% - 15rem)] main-content min-h-screen">
    <AdminHeader/>
      <main class="bg-[#E4E7F3] pt-20 px-[3%] pb-4">
        <div class="recent-sales bg-white p-4 rounded-md">
          <div class="flex justify-between items-center py-4">
            <h2 class="text-[rgb(4,46,255)] font-semibold text-xl capitalize">Order Details</h2>
            <Link as="button" :href="route('admin.orders')" class="text-white bg-gray-600 px-4 rounded-md py-2">
              <i class="fa-solid fa-arrow-left pr-2"></i>Back to Orders
            </Link>
          </div>

          <div v-if="order">
            <!-- Customer Information -->
            <div class="mb-6">
              <h3 class="text-[rgb(4,46,255)] font-semibold text-lg mb-4">Customer Information</h3>
              <div class="table-scroll overflow-x-auto">
                <table class="w-full border-2">
                  <tbody>
                    <tr>
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50 w-1/4">Customer Name</td>
                      <td class="border-2 py-3 px-4">{{ order.user.name }}</td>
                    </tr>
                    <tr>
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50">Email</td>
                      <td class="border-2 py-3 px-4">{{ order.user.email }}</td>
                    </tr>
                    <tr>
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50">Contact</td>
                      <td class="border-2 py-3 px-4">{{ order.user.mobileNumber }}</td>
                    </tr>
                    <tr>
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50">Address</td>
                      <td class="border-2 py-3 px-4">{{ order.user.address }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Order Information -->
            <div class="mb-6">
              <h3 class="text-[rgb(4,46,255)] font-semibold text-lg mb-4">Order Information</h3>
              <div class="table-scroll overflow-x-auto">
                <table class="w-full border-2">
                  <tbody>
                    <tr>
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50 w-1/4">Order ID</td>
                      <td class="border-2 py-3 px-4">#{{ order.id }}</td>
                    </tr>
                    <tr>
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50">Order Date</td>
                      <td class="border-2 py-3 px-4">{{ new Date(order.created_at).toLocaleDateString() }}</td>
                    </tr>
                    <tr>
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50">Status</td>
                      <td class="border-2 py-3 px-4">
                        <span :class="{
                          'bg-green-100 text-green-800': order.orderStatus === 'approved',
                          'bg-red-100 text-red-800': order.orderStatus === 'rejected',
                          'bg-yellow-100 text-yellow-800': order.orderStatus === 'pending'
                        }" class="px-3 py-1 rounded-full text-sm font-medium">
                          {{ order.orderStatus }}
                        </span>
                      </td>
                    </tr>
                    <tr v-if="order.total_amount">
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50">Total Amount</td>
                      <td class="border-2 py-3 px-4 font-semibold text-lg">KSh {{ order.total_amount?.toLocaleString() }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Order Items -->
            <div class="mb-6" v-if="order.items && order.items.length">
              <h3 class="text-[rgb(4,46,255)] font-semibold text-lg mb-4">Order Items</h3>
              <div class="table-scroll overflow-x-auto">
                <table class="w-full border-2">
                  <thead>
                    <tr>
                      <th class="border-2 py-4 px-2 bg-gray-50">Item</th>
                      <th class="border-2 py-4 px-2 bg-gray-50">Quantity</th>
                      <th class="border-2 py-4 px-2 bg-gray-50">Price</th>
                      <th class="border-2 py-4 px-2 bg-gray-50">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in order.items" :key="index">
                      <td class="border-2 py-3 px-4">{{ item.name || item.product_name }}</td>
                      <td class="border-2 py-3 px-4 text-center">{{ item.quantity }}</td>
                      <td class="border-2 py-3 px-4 text-center">KSh {{ item.price?.toLocaleString() }}</td>
                      <td class="border-2 py-3 px-4 text-center font-semibold">KSh {{ (item.quantity * item.price)?.toLocaleString() }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Property Information (if applicable) -->
            <div class="mb-6" v-if="order.property">
              <h3 class="text-[rgb(4,46,255)] font-semibold text-lg mb-4">Property Information</h3>
              <div class="table-scroll overflow-x-auto">
                <table class="w-full border-2">
                  <tbody>
                    <tr>
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50 w-1/4">Property Name</td>
                      <td class="border-2 py-3 px-4">{{ order.property.name }}</td>
                    </tr>
                    <tr>
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50">Property Type</td>
                      <td class="border-2 py-3 px-4">{{ order.property.type }}</td>
                    </tr>
                    <tr>
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50">Location</td>
                      <td class="border-2 py-3 px-4">{{ order.property.location }}</td>
                    </tr>
                    <tr v-if="order.property.price">
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50">Property Price</td>
                      <td class="border-2 py-3 px-4 font-semibold">KSh {{ order.property.price?.toLocaleString() }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Additional Notes -->
            <div class="mb-6" v-if="order.notes">
              <h3 class="text-[rgb(4,46,255)] font-semibold text-lg mb-4">Additional Notes</h3>
              <div class="border-2 p-4 bg-gray-50 rounded-md">
                <p>{{ order.notes }}</p>
              </div>
            </div>

            <!-- Order Management Actions -->
            <div class="mb-6">
              <h3 class="text-[rgb(4,46,255)] font-semibold text-lg mb-4">Order Management</h3>
              <div class="flex gap-4">
                <button
                  type="button"
                  class="bg-[#FFCF10] py-3 px-6 capitalize rounded-md font-semibold"
                  v-if="order.orderStatus !== 'approved'"
                >
                  approve order <i class="fa-solid fa-check pl-2 text-green-700"></i>
                </button>
                <button
                  type="button"
                  class="bg-[#FF4004] py-3 px-6 capitalize rounded-md font-semibold text-white"
                  v-if="order.orderStatus !== 'rejected'"
                >
                  reject order <i class="fa-solid fa-times pl-2"></i>
                </button>
                <button
                  type="button"
                  class="bg-blue-600 py-3 px-6 capitalize rounded-md font-semibold text-white"
                >
                  send message <i class="fa-solid fa-envelope pl-2"></i>
                </button>
              </div>
            </div>
          </div>

          <div v-else class="font-bold">Order not found</div>
        </div>
      </main>
    </section>
</template>
