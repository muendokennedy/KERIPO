<script setup>
import AdminSidebar from '@/Components/app/AdminSidebar.vue'
import AdminHeader from '@/Components/app/AdminHeader.vue'
import {onMounted, ref} from 'vue'
import { 
    PencilSquareIcon, 
    TrashIcon, 
    CloudArrowUpIcon, 
    XMarkIcon, 
    CheckCircleIcon, 
    ExclamationTriangleIcon,
    EyeIcon,
    ChevronLeftIcon,
    ChevronRightIcon,
    UserIcon,
    CalendarIcon,
    MapPinIcon,
    CurrencyDollarIcon,
    TagIcon,
    IdentificationIcon
} from '@heroicons/vue/24/solid'
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
const showPropertyDetailsModal = ref(false)
const propertyToDelete = ref(null)
const selectedProperty = ref(null)
const currentImageIndex = ref(0)

const showDeleteModal = (property) => {
    propertyToDelete.value = property
    showPropertyDeleteModal.value = true
}

const showDetailsModal = (property) => {
    selectedProperty.value = property
    currentImageIndex.value = 0
    showPropertyDetailsModal.value = true
}

const closeDetailsModal = () => {
    showPropertyDetailsModal.value = false
    selectedProperty.value = null
    currentImageIndex.value = 0
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

const deletePropertyFromModal = () => {
    if(selectedProperty.value) {
        deleteProperty(selectedProperty.value)
        closeDetailsModal()
    }
}

const nextImage = () => {
    if (selectedProperty.value && selectedProperty.value.images) {
        currentImageIndex.value = (currentImageIndex.value + 1) % selectedProperty.value.images.length
    }
}

const prevImage = () => {
    if (selectedProperty.value && selectedProperty.value.images) {
        currentImageIndex.value = currentImageIndex.value === 0 
            ? selectedProperty.value.images.length - 1 
            : currentImageIndex.value - 1
    }
}

const goToImage = (index) => {
    currentImageIndex.value = index
}

const formatCurrency = (amount) => {
    return new Intl.NumberFormat('en-KE', {
        style: 'currency',
        currency: 'KES'
    }).format(amount)
}

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    })
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
        <!-- Success Notification -->
        <Transition name="slide-fade">
            <div v-show="showSuccessNotification && success" class="flash-message transition-all duration-300 flex gap-2 text-white bg-green-500 border-green-700 border rounded-md fixed right-20 top-20 w-[600px] p-4 z-50">
                <CheckCircleIcon class="size-6 cursor-pointer"/>
                <span>{{ success }}</span>
                <XMarkIcon @click="showSuccessNotification = false" class="size-6 cursor-pointer absolute right-2"/>
            </div>
        </Transition>

        <!-- Delete Confirmation Modal -->
        <div v-show="showPropertyDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg w-[30rem] relative">
                <XMarkIcon @click="closeDeleteModal" class="size-6 cursor-pointer absolute right-4 top-4 text-gray-500 hover:text-gray-700"/>
                <div class="flex gap-4 items-center mb-6">
                    <ExclamationTriangleIcon class="size-12 text-red-500"/>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Delete Property</h3>
                        <p class="text-gray-600">Are you sure you want to permanently delete this property? This action cannot be undone.</p>
                    </div>
                </div>
                <div class="flex justify-end gap-3">
                    <button @click="closeDeleteModal" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors">
                        Cancel
                    </button>
                    <button @click="confirmDelete" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">
                        Delete Property
                    </button>
                </div>
            </div>
        </div>

        <!-- Property Details Modal -->
        <div v-show="showPropertyDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg w-full max-w-4xl max-h-[90vh] overflow-hidden relative">
                <!-- Modal Header -->
                <div class="sticky top-0 bg-white border-b px-6 py-4 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-900">Property Details</h2>
                    <button @click="closeDetailsModal" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                        <XMarkIcon class="size-6 text-gray-500"/>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="overflow-y-auto max-h-[calc(90vh-80px)]" v-if="selectedProperty">
                    <!-- Image Carousel -->
                    <div class="flex flex-col items-center relative bg-gray-100" v-if="selectedProperty.images && selectedProperty.images.length > 0">
                        <div class="aspect-auto h-96 relative overflow-hidden">
                            <img 
                                :src="selectedProperty.images[currentImageIndex].image_url || `/storage/${selectedProperty.images[currentImageIndex].image_path}`"
                                :alt="`Property image ${currentImageIndex + 1}`"
                                class="w-full h-full object-cover"
                            >
                          </div>
                          <!-- Image Counter -->
                          <div class="absolute top-4 right-4 bg-black bg-opacity-50 text-white px-3 py-1 rounded-full text-sm">
                              {{ currentImageIndex + 1 }} / {{ selectedProperty.images.length }}
                          </div>
                                       <!-- Navigation Arrows -->
                            <button 
                                v-if="selectedProperty.images.length > 1"
                                @click="prevImage" 
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-70 text-white p-2 rounded-full transition-all"
                            >
                                <ChevronLeftIcon class="size-6"/>
                            </button>
                            <button 
                                v-if="selectedProperty.images.length > 1"
                                @click="nextImage" 
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-70 text-white p-2 rounded-full transition-all"
                            >
                                <ChevronRightIcon class="size-6"/>
                            </button>

                        <!-- Image Thumbnails -->
                        <div class="flex gap-2 p-4 overflow-x-auto" v-if="selectedProperty.images.length > 1">
                            <button
                                v-for="(image, index) in selectedProperty.images"
                                :key="index"
                                @click="goToImage(index)"
                                :class="[
                                    'block flex-shrink-0 w-20 h-16 rounded-lg overflow-hidden border-2 transition-all',
                                    currentImageIndex === index ? 'border-blue-500' : 'border-gray-200 hover:border-gray-400'
                                ]"
                            >
                                <img 
                                    :src="image.image_url || `/storage/${image.image_path}`"
                                    :alt="`Thumbnail ${index + 1}`"
                                    class="w-full h-full object-cover"
                                >
                            </button>
                        </div>
                    </div>

                    <!-- No Images Placeholder -->
                    <div v-else class="aspect-video bg-gray-100 flex items-center justify-center">
                        <div class="text-center text-gray-500">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p>No images available</p>
                        </div>
                    </div>

                    <!-- Property Details -->
                    <div class="p-6">
                        <!-- Basic Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <IdentificationIcon class="size-5 text-blue-600"/>
                                    <div>
                                        <p class="text-sm text-gray-600">Property ID</p>
                                        <p class="font-semibold text-lg">{{ selectedProperty.propertyId }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <TagIcon class="size-5 text-green-600"/>
                                    <div>
                                        <p class="text-sm text-gray-600">Category</p>
                                        <p class="font-semibold">{{ selectedProperty.category }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <MapPinIcon class="size-5 text-red-600"/>
                                    <div>
                                        <p class="text-sm text-gray-600">Location</p>
                                        <p class="font-semibold">{{ selectedProperty.location }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <UserIcon class="size-5 text-purple-600"/>
                                    <div>
                                        <p class="text-sm text-gray-600">Owner</p>
                                        <p class="font-semibold">{{ selectedProperty.ownersName }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <CurrencyDollarIcon class="size-5 text-yellow-600"/>
                                    <div>
                                        <p class="text-sm text-gray-600">Valuation</p>
                                        <p class="font-semibold text-lg">{{ selectedProperty.propertyValuation }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="size-5 mt-1">
                                        <div :class="{
                                            'bg-green-500': selectedProperty.acquisitionStatus === 'Available',
                                            'bg-red-500': selectedProperty.acquisitionStatus === 'Unavailable',
                                            'bg-yellow-500': selectedProperty.acquisitionStatus === 'Pending Approval'
                                        }" class="size-5 rounded-full"></div>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Status</p>
                                        <span :class="{
                                            'bg-green-100 text-green-800': selectedProperty.acquisitionStatus === 'Available',
                                            'bg-red-100 text-red-800': selectedProperty.acquisitionStatus === 'Unavailable',
                                            'bg-yellow-100 text-yellow-800': selectedProperty.acquisitionStatus === 'Pending Approval'
                                        }" class="px-3 py-1 rounded-full text-sm font-medium">
                                            {{ selectedProperty.acquisitionStatus }}
                                        </span>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <CalendarIcon class="size-5 text-indigo-600"/>
                                    <div>
                                        <p class="text-sm text-gray-600">Created</p>
                                        <p class="font-semibold">{{ formatDate(selectedProperty.created_at) }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3" v-if="selectedProperty.updated_at">
                                    <CalendarIcon class="size-5 text-gray-600"/>
                                    <div>
                                        <p class="text-sm text-gray-600">Last Updated</p>
                                        <p class="font-semibold">{{ formatDate(selectedProperty.updated_at) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Information (if property has been ordered) -->
                        <div v-if="selectedProperty.order" class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                            <h4 class="font-semibold text-blue-900 mb-3 flex items-center gap-2">
                                <svg class="size-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a2 2 0 002 2h4a2 2 0 002-2V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                </svg>
                                Order Information
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">Customer Name</p>
                                    <p class="font-medium">{{ selectedProperty.order.customer_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Customer Email</p>
                                    <p class="font-medium">{{ selectedProperty.order.customer_email }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Order Date</p>
                                    <p class="font-medium">{{ formatDate(selectedProperty.order.created_at) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Order Status</p>
                                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ selectedProperty.order.status }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Details -->
                        <div v-if="selectedProperty.slug" class="bg-gray-50 rounded-lg p-4 mb-6">
                            <h4 class="font-semibold text-gray-900 mb-2">Additional Information</h4>
                            <div class="text-sm text-gray-600">
                                <p><span class="font-medium">Slug:</span> {{ selectedProperty.slug }}</p>
                                <p v-if="selectedProperty.created_by">
                                    <span class="font-medium">Created by Admin ID:</span> {{ selectedProperty.created_by }}
                                </p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-3 pt-6 border-t">
                            <Link 
                                :href="route('admin.property.edit', selectedProperty)" 
                                as="button" 
                                class="flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium transition-colors"
                            >
                                <PencilSquareIcon class="size-5"/>
                                Edit Property
                            </Link>
                            
                            <button 
                                @click="deletePropertyFromModal" 
                                class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition-colors"
                            >
                                <TrashIcon class="size-5"/>
                                Delete Property
                            </button>
                            
                            <button 
                                @click="closeDetailsModal" 
                                class="flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors ml-auto"
                            >
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
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
                      <th class="border-2 py-4 px-2">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(property, index) in properties" :key="index" class="hover:bg-gray-50 cursor-pointer" @click="showDetailsModal(property)">
                      <td class="border-2 py-2 px-2 text-center">{{ property.propertyId }}</td>
                      <td class="border-2 py-2 px-2 text-center">{{ property.category }}</td>
                      <td class="border-2 py-2 px-2 text-center">{{ property.location }}</td>
                      <td class="border-2 py-2 px-2 text-center">{{ property.ownersName }}</td>
                      <td class="border-2 py-2 px-2 text-center">{{ property.propertyValuation }}</td>
                      <td class="border-2 py-2 px-2 text-center">
                        <span :class="{
                            'bg-green-100 text-green-800' : property.acquisitionStatus === 'Available',
                            'bg-red-100 text-red-800' : property.acquisitionStatus === 'Unavailable',
                            'bg-yellow-100 text-yellow-800': property.acquisitionStatus === 'Pending Approval'
                        }" class="px-3 py-1 rounded-full text-sm font-medium">{{ property.acquisitionStatus }}</span>
                      </td>
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
                        <div class="flex w-full justify-between gap-2">
                          <button @click="showDetailsModal(property)" class="bg-blue-500 hover:bg-blue-600 inline-flex items-center gap-2 py-3 px-6 capitalize rounded-md text-white transition-colors">
                            <EyeIcon class="size-5"/>
                            View
                          </button>
                          <Link :href="route('admin.property.edit', property)" as="button" class="bg-[#FFCF10] hover:bg-yellow-500 inline-flex items-center gap-2 edit-button py-3 px-6 capitalize rounded-md transition-colors">
                            <PencilSquareIcon class="size-5"/>
                            Edit
                          </Link>
                          <button type="button" @click="showDeleteModal(property)" class="bg-[#FF4004] hover:bg-red-600 inline-flex items-center gap-2 edit-button py-3 px-6 capitalize rounded-md text-white transition-colors">
                            <TrashIcon class="size-5"/>
                            Remove
                          </button>
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
.slide-fade-enter-active {
  transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(20px);
  opacity: 0;
}
</style>