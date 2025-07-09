<script setup>
import AdminSidebar from '@/Components/app/AdminSidebar.vue'
import AdminHeader from '@/Components/app/AdminHeader.vue'
import { XMarkIcon, ArrowLeftIcon } from '@heroicons/vue/24/solid'
import { Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({
    order: {
        type: Object,
        required: true
    }
})

const showApproveModal = ref(false)
const showRejectModal = ref(false)
const showMessageModal = ref(false)
const rejectionReason = ref('')
const messageContent = ref('')
const isLoading = ref(false)

const openApproveModal = () => {
    hideFlashMessage()
    showApproveModal.value = true
}

const closeApproveModal = () => {
    showApproveModal.value = false
}

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

const approveOrderForm = useForm({})

const approveOrder = () => {
    isLoading.value = true

    approveOrderForm.post(route('admin.order.approve', props.order.id), {
        onSuccess: () => {
            hideFlashMessage()
            closeApproveModal()
            isLoading.value = false
            showFlashMessage('The order has been approved successfully', 'success')
        },
        onError: () => {
            isLoading.value = false
            showFlashMessage('Failed to approve order. Please try again', 'error')
        },
        preserveScroll: true
    })
}

const openRejectModal = () => {
    hideFlashMessage()
    showRejectModal.value = true
    rejectionReason.value = ''
}

const closeRejectModal = () => {
    showRejectModal.value = false
    rejectionReason.value = ''
}

const rejectOrderForm = useForm({rejectReason: ''})

const rejectOrder = () => {
    if(!rejectionReason.value.trim()){
        showFlashMessage('Please provide a reason for rejection', 'warning')
        return
    }

    isLoading.value = true

    rejectOrderForm.rejectReason = rejectionReason.value

    rejectOrderForm.post(route('admin.order.reject', props.order.id), {

        onSuccess: () => {
            hideFlashMessage()
            closeRejectModal()
            isLoading.value = false
            showFlashMessage('The order has been rejected successfully', 'success')
        },
        onError: () => {
            isLoading.value = false
            showFlashMessage('Failed to reject order please try again', 'error')
        },
        preserveScroll: true
    })
}

const openMessageModal = () => {
    hideFlashMessage()
    showMessageModal.value = true
    messageContent.value = ''
}

const closeMessageModal = () => {
    showMessageModal.value = false
    messageContent.value = ''
}

const sendMessageForm = useForm({clientMessage: ''})

const sendMessage = () => {
    if(!messageContent.value.trim()){
       showFlashMessage('Please enter a message', 'warning')
        return
    }

    isLoading.value =  true

    sendMessageForm.clientMessage = messageContent.value

    sendMessageForm.post(route('admin.order.message.send', props.order.id), {
        onSuccess: () => {
            hideFlashMessage()
            closeMessageModal()
            isLoading.value = false
            showFlashMessage('The message has been sent successfully', 'success')
        },
        onError: () => {
            isLoading.value = false
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
        <div class="recent-sales bg-white p-4 rounded-md">
          <div class="flex justify-between items-center py-4">
            <h2 class="text-[rgb(4,46,255)] font-semibold text-xl capitalize">Order Details</h2>
            <Link as="button" :href="route('admin.orders')" class="text-white flex gap-2 bg-[rgb(4,46,255)] px-4 rounded-md py-2">
              <ArrowLeftIcon class="size-6 cursor-pointer font-bold"/>
              <span>Back to Orders</span>
            </Link>
          </div>

          <div v-if="order">
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

            <div class="mb-6">
              <h3 class="text-[rgb(4,46,255)] font-semibold text-lg mb-4">Order Information</h3>
              <div class="table-scroll overflow-x-auto">
                <table class="w-full border-2">
                  <tbody>
                    <tr>
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50 w-1/4">Order ID</td>
                      <td class="border-2 py-3 px-4">{{ order.orderId }}</td>
                    </tr>
                    <tr>
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50">Order Date</td>
                      <td class="border-2 py-3 px-4">{{ new Date(order.created_at).toLocaleDateString('en-US', {weekday: 'short', year: 'numeric', month: 'short', day: 'numeric'}) }}</td>
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
                  </tbody>
                </table>
              </div>
            </div>

            <div class="mb-6" v-if="order.property">
              <h3 class="text-[rgb(4,46,255)] font-semibold text-lg mb-4">Property Information</h3>
              <div class="table-scroll overflow-x-auto">
                <table class="w-full border-2">
                  <tbody>
                    <tr>
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50 w-1/4">Property ID</td>
                      <td class="border-2 py-3 px-4">{{ order.property.propertyId }}</td>
                    </tr>
                    <tr>
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50">Property Type</td>
                      <td class="border-2 py-3 px-4">{{ order.property.category }}</td>
                    </tr>
                    <tr>
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50">Location</td>
                      <td class="border-2 py-3 px-4">{{ order.property.location }}</td>
                    </tr>
                    <tr>
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50">Owner</td>
                      <td class="border-2 py-3 px-4">{{ order.property.ownersName }}</td>
                    </tr>
                    <tr>
                      <td class="border-2 py-3 px-4 font-semibold bg-gray-50">Property valuation</td>
                      <td class="border-2 py-3 px-4">KES {{ order.property.propertyValuation?.toLocaleString() }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="mb-6">
              <h3 class="text-[rgb(4,46,255)] font-semibold text-lg mb-4">Additional Notes</h3>
              <div class="border-2 p-4 bg-gray-50 rounded-md">
                <p>The client that placed this order has acquired properties through us before</p>
              </div>
            </div>
             <div class="mb-6">
              <h3 class="text-[rgb(4,46,255)] font-semibold text-lg mb-4">Order Management</h3>
              <div class="flex gap-4">
                <button
                  type="button"
                  @click="openApproveModal"
                  class="bg-[#FFCF10] py-3 px-6 capitalize rounded-md font-semibold"
                  v-if="order.orderStatus !== 'approved'"
                >
                  approve order <i class="fa-solid fa-check pl-2 text-green-700"></i>
                </button>
                <button
                  type="button"
                  @click="openRejectModal"
                  class="bg-[#FF4004] py-3 px-6 capitalize rounded-md font-semibold text-white"
                  v-if="order.orderStatus !== 'rejected'"
                >
                  reject order <i class="fa-solid fa-times pl-2"></i>
                </button>
                <button
                  type="button"
                  @click="openMessageModal"
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
      <!-- Approve Order Modal -->
    <div v-if="showApproveModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg p-6 max-w-2xl w-full mx-4">
        <h3 class="text-lg font-semibold text-[rgb(4,46,255)] mb-4">Confirm Order Approval</h3>
        <p class="text-gray-600 mb-6">Are you sure you want to approve this order? This action cannot be undone.</p>
        <div class="flex justify-end gap-4">
          <button
            @click="closeApproveModal"
            class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50 disabled:opacity-80 disabled:cursor-not-allowed"
            :disabled="isLoading"
          >
            Cancel
          </button>
          <button
            @click="approveOrder"
            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 disabled:opacity-80 disabled:cursor-not-allowed"
            :disabled="isLoading"
          >
            {{ isLoading ? 'Approving...' : 'Approve Order' }}
          </button>
        </div>
      </div>
    </div>

    <!-- Reject Order Modal -->
    <div v-if="showRejectModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg p-6 max-w-2xl w-full mx-4">
        <h3 class="text-lg font-semibold text-[rgb(4,46,255)] mb-4">Reject Order</h3>
        <p class="text-gray-600 mb-4">Please provide a reason for rejecting this order:</p>
        <textarea
          v-model="rejectionReason"
          placeholder="Enter rejection reason..."
          class="w-full p-3 border border-gray-300 rounded-md resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
          rows="4"
        ></textarea>
        <div class="flex justify-end gap-4 mt-6">
          <button
            @click="closeRejectModal"
            class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50 disabled:opacity-80 disabled:cursor-not-allowed"
            :disabled="isLoading"
          >
            Cancel
          </button>
          <button
            @click="rejectOrder"
            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 disabled:opacity-80 disabled:cursor-not-allowed"
            :disabled="isLoading"
          >
            {{ isLoading ? 'Rejecting...' : 'Reject Order' }}
          </button>
        </div>
      </div>
    </div>

    <!-- Send Message Modal -->
    <div v-if="showMessageModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg p-6 max-w-2xl w-full mx-4">
        <h3 class="text-lg font-semibold text-[rgb(4,46,255)] mb-4">Send Message</h3>
        <p class="text-gray-600 mb-4">Send a message to {{ order.user.name }}:</p>
        <textarea
          v-model="messageContent"
          placeholder="Enter your message..."
          class="w-full p-3 border border-gray-300 rounded-md resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
          rows="4"
        ></textarea>
        <div class="flex justify-end gap-4 mt-6">
          <button
            @click="closeMessageModal"
            class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50 disabled:opacity-80 disabled:cursor-not-allowed"
            :disabled="isLoading"
          >
            Cancel
          </button>
          <button
            @click="sendMessage"
            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-80 disabled:cursor-not-allowed"
            :disabled="isLoading"
          >
            {{ isLoading ? 'Sending...' : 'Send Message' }}
          </button>
        </div>
      </div>
    </div>
</template>
