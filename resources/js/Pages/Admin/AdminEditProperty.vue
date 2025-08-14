<script setup>
import AdminSidebar from '@/Components/app/AdminSidebar.vue'
import AdminHeader from '@/Components/app/AdminHeader.vue'
import { useForm } from '@inertiajs/vue3'
import { onMounted, ref, computed } from 'vue'

const props = defineProps({
    property: {
        type: Object,
        required: true
    }
})

const form = useForm({
    category: '',
    ownersName: '',
    location: '',
    propertyValuation: '',
    images: [],
    existingImages: [],
    imagesToDelete: []
})

// Image management state
const imageFiles = ref([])
const imagePreviews = ref([])
const existingImages = ref([])
const imagesToDelete = ref([])
const dragActive = ref(false)
const fileInputRef = ref(null)
const imageErrors = ref([])
const showImageError = ref(false)

const categories = ref([
    'Urban Plot',
    'Upcountry Plot',
    'House',
    'Apartment'
])

// Computed property to check if there are any image-related errors from backend
const hasImageErrors = computed(() => {
    return form.errors.images || 
           form.errors['images.0'] || 
           form.errors['images.1'] || 
           form.errors['images.2'] ||
           Object.keys(form.errors).some(key => key.startsWith('images.'))
})

// Computed property to get specific image errors
const getImageSpecificErrors = computed(() => {
    const errors = {}
    Object.keys(form.errors).forEach(key => {
        if (key.match(/^images\.(\d+)$/)) {
            const index = parseInt(key.split('.')[1])
            errors[index] = form.errors[key]
        }
    })
    return errors
})

// Get total image count (existing + new)
const totalImageCount = computed(() => {
    return existingImages.value.length + imageFiles.value.length
})

onMounted(() => {
    // Populate form with existing property data
    form.category = props.property.category
    form.ownersName = props.property.ownersName
    form.location = props.property.location
    form.propertyValuation = props.property.propertyValuation

    // Initialize existing images
    if (props.property.images) {
        existingImages.value = props.property.images.map(img => ({
            id: img.id,
            path: img.image_path,
            url: img.image_url || `/storage/${img.image_path}`,
            original_name: img.original_name
        }))
    }
})

// Add this computed property to your existing computed properties
const getNewImageError = computed(() => {
    return (index) => {
        // Calculate the index position considering existing images
        const adjustedIndex = existingImages.value.length + index;
        
        // Check for specific image errors
        const errorKey = `images.${adjustedIndex}`;
        if (form.errors[errorKey]) {
            return form.errors[errorKey];
        }
        
        // Also check for zero-based indexing if backend uses different indexing
        const zeroBasedErrorKey = `images.${index}`;

        if (form.errors[zeroBasedErrorKey]) {
            return form.errors[zeroBasedErrorKey];
        }


        
        return null;
    }
});

// Method to check if a new image has an error
const hasNewImageError = (index) => {
    return getNewImageError.value(index) !== null;
};

// Method to get error message for a new image
const getNewImageErrorMessage = (index) => {
    return getNewImageError.value(index);
};


const handleImageSelect = (e) => {
    const files = Array.from(e.target.files)
    processFiles(files)
}

const handleDragOver = (e) => {
    e.preventDefault()
    dragActive.value = true
}

const handleDragLeave = (e) => {
    e.preventDefault()
    dragActive.value = false
}

const handleDrop = (e) => {
    e.preventDefault()
    dragActive.value = false
    const files = Array.from(e.dataTransfer.files)
    processFiles(files)
}

const processFiles = (files) => {
    // Clear previous errors
    imageErrors.value = []
    showImageError.value = false
    
    // Validate file types first
    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp']
    const invalidFiles = files.filter(file => !validImageTypes.includes(file.type))
    
    if (invalidFiles.length > 0) {
        imageErrors.value.push(`Invalid file type(s): ${invalidFiles.map(f => f.name).join(', ')}. Please select only image files (JPEG, PNG, GIF, WebP).`)
        showImageError.value = true
        return
    } 
    
    // Filter only image files (double check)
    const filteredImages = files.filter(file => file.type.startsWith('image/'))
    
    // Check if adding these files would exceed the limit
    const remainingSlots = 3 - totalImageCount.value
    
    if (remainingSlots <= 0) {
        imageErrors.value.push('You can only have a maximum of 3 images. Please remove some images first.')
        showImageError.value = true
        return
    }
    
    if (filteredImages.length > remainingSlots) {
        imageErrors.value.push(`You can only add ${remainingSlots} more image(s). You're trying to add ${filteredImages.length}.`)
        showImageError.value = true
        return
    }
    
    // Check file sizes (max 10MB per file)
    const maxSize = 10 * 1024 * 1024 // 10MB in bytes
    const oversizedFiles = filteredImages.filter(file => file.size > maxSize)
    
    if (oversizedFiles.length > 0) {
        imageErrors.value.push(`File(s) too large: ${oversizedFiles.map(f => f.name).join(', ')}. Maximum size is 10MB per image.`)
        showImageError.value = true
        return
    }
    
    const filesToAdd = filteredImages.slice(0, remainingSlots)
    
    filesToAdd.forEach(file => {
        // Add to file array
        imageFiles.value.push(file)
        
        // Create preview
        const reader = new FileReader()
        reader.onload = (e) => {
            imagePreviews.value.push({
                id: Date.now() + Math.random(),
                src: e.target.result,
                name: file.name
            })
        }
        reader.onerror = () => {
            imageErrors.value.push(`Failed to read file: ${file.name}`)
            showImageError.value = true
        }
        reader.readAsDataURL(file)
    })
    
    // Update form data
    form.images = imageFiles.value
    
    // Clear any previous form errors for images when successfully adding
    if (form.errors.images) {
        form.clearErrors('images')
    }
    // Clear individual image errors
    form.clearErrors(['images.0', 'images.1', 'images.2'])
}

const removeNewImage = (index) => {
    imageFiles.value.splice(index, 1)
    imagePreviews.value.splice(index, 1)
    form.images = imageFiles.value
    
    // Clear errors when removing images
    imageErrors.value = []
    showImageError.value = false
    
    // Reset file input
    if (fileInputRef.value) {
        fileInputRef.value.value = ''
    }
}

const removeExistingImage = (index) => {
    const imageToRemove = existingImages.value[index]
    imagesToDelete.value.push(imageToRemove.id)
    existingImages.value.splice(index, 1)
    
    // Clear errors when removing images
    imageErrors.value = []
    showImageError.value = false
}

const triggerFileInput = () => {
    if (totalImageCount.value < 3) {
        fileInputRef.value?.click()
    }
}

const submit = () => {
    // Clear previous image errors
    imageErrors.value = []
    showImageError.value = false
    
    // Validate that exactly 3 images are present (existing + new)
    if (totalImageCount.value === 0) {
        imageErrors.value.push('Please ensure the property has at least one image.')
        showImageError.value = true
        return
    }
    
    if (totalImageCount.value < 3) {
        imageErrors.value.push(`Please ensure the property has exactly 3 images. You currently have ${totalImageCount.value} image(s).`)
        showImageError.value = true
        return
    }
    
    if (totalImageCount.value > 3) {
        imageErrors.value.push(`Please ensure the property has exactly 3 images. You currently have ${totalImageCount.value} image(s).`)
        showImageError.value = true
        return
    }

    // Clean property valuation
    form.propertyValuation = form.propertyValuation
        ? Number(String(form.propertyValuation).replace(/[^\d.]/g, ''))
        : 0

    // Add images to delete to form data
    form.existingImages = existingImages.value
    form.imagesToDelete = imagesToDelete.value

    // Submit as POST with _method: PUT for file uploads
    form.post(route('admin.property.update', props.property), {
        forceFormData: true,
        _method: 'PUT'
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
        <div class="recent-sales bg-white p-4 rounded-md">
          <h2 class="text-[rgb(4,46,255)] font-semibold text-lg md:text-xl py-4 capitalize">Edit existing property details</h2>
          <pre>{{ property }}</pre>
          <pre>{{ imagesToDelete }}</pre>
          <pre>{{ form }}</pre>
          <form @submit.prevent="submit">

              <div class="form-row w-full flex flex-col md:flex-row justify-between">
                      <div class="relative input-box md:basis-[48%]">
                        <label for="category" class="block py-3">Select Category:</label>
                        <select v-model="form.category" :class="[form.errors.category ? 'border-red-500': '']" class="border-2 outline-none rounded-md px-4 py-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out">
                            <option v-for="category in categories" :key="category"  :value="category">{{ category }}</option>
                        </select>
                        <div v-if="!form.category" class="absolute left-4 transform -translate-y-[2rem] pointer-events-none">
                            -----Select a category------
                        </div>
                        <p v-if="form.errors.category" class="text-red-500">{{ form.errors.category }}</p>
                      </div>
                      <div class="input-box md:basis-[48%]">
                        <label for="ownersName" class="block py-3">Enter the Owner's name:</label>
                        <input type="text" v-model="form.ownersName"  :class="[form.errors.ownersName ? 'border-red-500': '']" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out">
                        <p v-if="form.errors.ownersName" class="text-red-500">{{ form.errors.ownersName }}</p>
                      </div>
                    </div>
                    <div class="form-row w-full flex flex-col md:flex-row justify-between">
                      <div class="input-box md:basis-[48%]">
                          <label for="location" class="block py-3">Enter the location of property:</label>
                          <input type="text" v-model="form.location" :class="[form.errors.location ? 'border-red-500': '']" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out">
                        <p v-if="form.errors.location" class="text-red-500">{{ form.errors.location }}</p>
                      </div>
                      <div class="input-box md:basis-[48%]">
                        <label for="propertyPrice" class="block py-3">Enter the price of the property:</label>
                        <input type="text" v-model="form.propertyValuation" :class="[form.errors.propertyValuation ? 'border-red-500': '']" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out">
                        <p v-if="form.errors.propertyValuation" class="text-red-500">{{ form.errors.propertyValuation }}</p>
                      </div>
                    </div>

                    <!-- Image Management Section -->
                    <div class="form-row w-full mt-6">
                      <label class="block py-3 font-medium">Property Images (Exactly 3 required):</label>
                      
                      <!-- Debug section - Remove this in production -->
                      <div v-if="Object.keys(form.errors).length > 0" class="mt-4 p-3 bg-gray-100 rounded-md text-sm">
                        <p class="font-bold mb-2">Debug - All Form Errors:</p>
                        <pre class="whitespace-pre-wrap">{{ JSON.stringify(form.errors, null, 2) }}</pre>
                      </div>

                      <!-- Backend validation errors for images -->
                      <div v-if="hasImageErrors" class="mt-4">
                        <div class="text-red-600 bg-red-50 border border-red-200 rounded-md p-3 mb-4">
                          <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium">Image Validation Errors:</span>
                          </div>
                          
                          <!-- General images error -->
                          <div v-if="form.errors.images" class="mb-2">
                            <p>{{ form.errors.images }}</p>
                          </div>
                          
                          <!-- Individual image errors -->
                          <div v-for="(error, key) in getImageSpecificErrors" :key="key" class="mb-1">
                            <p>{{ error }}</p>
                          </div>
                          
                        </div>
                      </div>

                      <!-- Error Messages -->
                      <div v-if="showImageError && imageErrors.length > 0" class="mb-4">
                        <div 
                          v-for="error in imageErrors" 
                          :key="error"
                          class="flex items-center gap-2 text-red-600 bg-red-50 border border-red-200 rounded-md p-3 mb-2"
                        >
                          <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                          </svg>
                          <span>{{ error }}</span>
                        </div>
                      </div>

                      <!-- Success/Status Message -->
                      <div v-if="totalImageCount === 3" class="mb-4">
                        <div class="flex items-center gap-2 text-green-600 bg-green-50 border border-green-200 rounded-md p-3">
                          <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                          </svg>
                          <span>Perfect! You have exactly 3 images selected.</span>
                        </div>
                      </div>

                      <div v-else-if="totalImageCount > 0 && totalImageCount < 3" class="mb-4">
                        <div class="flex items-center gap-2 text-yellow-600 bg-yellow-50 border border-yellow-200 rounded-md p-3">
                          <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                          </svg>
                          <span>You need {{ 3 - totalImageCount }} more image(s) to reach the required 3 images.</span>
                        </div>
                      </div>

                      <!-- Current Images Display -->
                      <div v-if="existingImages.length > 0 || imagePreviews.length > 0" class="mb-4">
                        <h4 class="font-medium mb-3">Current Images ({{ totalImageCount }}/3):</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                          <!-- Existing Images -->
                          <div 
                            v-for="(image, index) in existingImages" 
                            :key="`existing-${image.id}`"
                            class="relative group"
                          >
                            <div class="aspect-square rounded-lg overflow-hidden border-2 border-gray-200">
                              <img 
                                :src="image.url" 
                                :alt="image.original_name"
                                class="w-full h-full object-cover"
                              >
                            </div>
                            
                            <!-- Remove button -->
                            <button
                              type="button"
                              @click="removeExistingImage(index)"
                              class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200"
                            >
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                              </svg>
                            </button>
                            
                            <!-- Image name -->
                            <p class="mt-2 text-sm text-gray-600 truncate">{{ image.original_name }}</p>
                            <p class="text-xs text-gray-400">Existing</p>
                          </div>

                          <!-- New Images -->
                           <div 
                                v-for="(preview, index) in imagePreviews" 
                                :key="`new-${preview.id}`"
                                class="relative group"
                              >
                                <div 
                                  :class="[
                                    'aspect-square rounded-lg overflow-hidden border-2 transition-colors duration-200',
                                    hasNewImageError(index) ? 'border-red-500 border-2' : 'border-blue-200'
                                  ]"
                                >
                                  <img 
                                    :src="preview.src" 
                                    :alt="preview.name"
                                    class="w-full h-full object-cover"
                                  >
                                </div>
                          
                                
                                <!-- New badge (only show if no error) -->
                                <div 
                                  class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded"
                                >
                                  New
                                </div>
                                
                                <!-- Remove button -->
                                <button
                                  type="button"
                                  @click="removeNewImage(index)"
                                  class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200"
                                >
                                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                  </svg>
                                </button>
                                
                                <!-- Image name -->
                                <p class="mt-2 text-sm text-gray-600 truncate">{{ preview.name }}</p>
                                <p 
                                  :class="[
                                    'text-xs',
                                    hasNewImageError(index) ? 'text-red-500' : 'text-blue-500'
                                  ]"
                                >
                                  {{ hasNewImageError(index) ? 'Upload Error' : 'New Upload' }}
                                </p>
                                
                                <!-- Error message for this specific image -->
                              </div>
                        </div>
                      </div>
                      
                      <!-- Drag and Drop Area (only show if less than 3 images) -->
                      <div v-if="totalImageCount < 3">
                        <div 
                          @dragover="handleDragOver"
                          @dragleave="handleDragLeave"
                          @drop="handleDrop"
                          @click="triggerFileInput"
                          :class="[
                            'border-2 border-dashed rounded-lg p-8 text-center cursor-pointer transition-all duration-300',
                            dragActive ? 'border-[#042EFF] bg-blue-50' : 'border-gray-300 hover:border-[#042EFF]'
                          ]"
                        >
                          <input 
                            ref="fileInputRef"
                            type="file" 
                            multiple 
                            accept="image/*"
                            @change="handleImageSelect"
                            class="hidden"
                          >
                          
                          <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="text-lg text-gray-600 mb-2">
                              {{ dragActive ? 'Drop images here' : 'Add more images' }}
                            </p>
                            <p class="text-sm text-gray-500 mb-2">Drag & drop or click to browse</p>
                            <p class="text-xs text-gray-400">
                              PNG, JPG, JPEG, GIF, WebP up to 10MB each ({{ totalImageCount }}/3)
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>

                    <button 
                      type="submit" 
                      :disabled="totalImageCount !== 3"
                      :class="[
                        'capitalize px-4 py-2 rounded-md text-white my-4 transition-all duration-300',
                        totalImageCount === 3 
                          ? 'bg-[#042EFF] hover:bg-blue-700 cursor-pointer' 
                          : 'bg-gray-400 cursor-not-allowed'
                      ]"
                    >
                      {{ totalImageCount === 3 ? 'Update Property' : `Update Property (${totalImageCount}/3 images)` }}
                    </button>
                    
                    <!-- Submit validation message -->
                    <div v-if="totalImageCount !== 3" class="text-sm text-gray-600 mt-2">
                      <span v-if="totalImageCount === 0">Please ensure the property has exactly 3 images before updating.</span>
                      <span v-else-if="totalImageCount < 3">Please add {{ 3 - totalImageCount }} more image(s) to update the property.</span>
                      <span v-else>Please remove {{ totalImageCount - 3 }} image(s) to update the property.</span>
                    </div>
          </form>
        </div>
        </main>
    </section>

</template>
<style scoped>
</style>