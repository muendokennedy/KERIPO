<script setup>
import AdminSidebar from '@/Components/app/AdminSidebar.vue'
import AdminHeader from '@/Components/app/AdminHeader.vue'
import { useForm } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

const form = useForm({
    category: '',
    ownersName: '',
    location: '',
    propertyValuation: '',
    images: []
})

const categories = ref([
    'Urban Plot',
    'Upcountry Plot',
    'House',
    'Apartment'
])

const imageFiles = ref([])
const imagePreviews = ref([])
const dragActive = ref(false)
const fileInputRef = ref(null)
const imageErrors = ref([])
const showImageError = ref(false)

const hasImageErrors = computed(() => {
  return form.errors.images || 
  form.errors['images.0'] ||
  form.errors['images.1'] ||
  form.errors['images.2'] ||
  Object.keys(form.errors).some(key => key.startsWith('images.'))
})

const getImageSpecificErrors = computed(() => {
  const errors = {}

  Object.keys(form.errors).forEach(key => {
    if(key.match(/^images\.(\d+)$/)){
      const index = parseInt(key.split('.')[1])
      errors[index] = form.errors[key]
    }
  })

  return errors
})

const handleImageSelect = (event) => {
    const files = Array.from(event.target.files)
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
  
  imageErrors.value = []
  showImageError.value = false

  const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp']

  const invalidFiles = files.filter(file => !validImageTypes.includes(file.type))

  if(invalidFiles.length > 0){
    imageErrors.value.push(`Invalid files type(s): ${invalidFiles.map(f => f.name)}. Please select only image files (JPEG, PNG, GIF, WebP).`)
    showImageError.value = true
    return
  }

  const filteredImages = files.filter(file => file.type.startsWith('image/'))
  const remainingSlots = 3 - imageFiles.value.length

  if(remainingSlots <= 0){
    imageErrors.value.push('You can only upload a maximum of 3 images. Please remove some images first.')
    showImageError.value = true
    return
  }

  if(filteredImages.length > remainingSlots){
    imageErrors.value.push(`You can only add ${remainingSlots} more images(s). You are trying to add ${filteredImages.length}`)
    showImageError.value = true
    return
  }

  // Check file sizes

  const maxSize = 10 * 1024 * 1024

  const oversizedFiles = filteredImages.filter(file => file.size > maxSize)

  if(oversizedFiles.length > 0){
    imageErrors.value.push(`Files(s) too large: ${oversizedFiles.map(f => f.name).join(', ')}. Maximum size is 10MB per image.`)
    showImageError.value = true
    return
  }

  const filesToAdd = filteredImages.slice(0, remainingSlots)

  filesToAdd.forEach(file => {
    imageFiles.value.push(file)

    const reader = new FileReader()

    reader.onload = (e) => {
      imagePreviews.value.push({
        id: Date.now() + Math.random(),
        src: e.target.result,
        name: file.name
      })
    }

    reader.onerror = (e) => {
      imageErrors.value.push(`Failed to read file. ${file.name}`)
      showImageError.value = true
    }

    reader.readAsDataURL(file)
  })

  form.images = imageFiles.value

  if(form.errors.images){
    form.clearErrors('images')
  }

  form.clearErrors(['images.0', 'images.1', 'images.2'])
}
const removeImage = (index) => {
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

const triggerFileInput = () => {
    if (imageFiles.value.length < 3) {
        fileInputRef.value?.click()
    }
}

const submit = () => {
    // Clear previous image errors
    imageErrors.value = []
    showImageError.value = false
    
    // Validate that exactly 3 images are selected
    if (imageFiles.value.length === 0) {
        imageErrors.value.push('Please select at least one image for the property.')
        showImageError.value = true
        return
    }
    
    if (imageFiles.value.length < 3) {
        imageErrors.value.push(`Please select exactly 3 images. You currently have ${imageFiles.value.length} image(s) selected.`)
        showImageError.value = true
        return
    }
    
    if (imageFiles.value.length > 3) {
        imageErrors.value.push(`Please select exactly 3 images. You currently have ${imageFiles.value.length} image(s) selected.`)
        showImageError.value = true
        return
    }

    console.log(form)
    
    // If we get here, we have exactly 3 images, proceed with form submission
    form.post(route('admin.property.store'))
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
          <h2 class="text-[rgb(4,46,255)] font-semibold text-lg md:text-xl py-4 capitalize">Add new property</h2>
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
                        <input type="text" v-model="form.ownersName" :class="[form.errors.ownersName ? 'border-red-500': '']" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out">
                        <p v-if="form.errors.ownersName" class="text-red-500">{{ form.errors.ownersName }}</p>
                      </div>
                    </div>
                    <div class="form-row w-full flex flex-col md:flex-row justify-between">
                      <div class="input-box md:basis-[48%]">
                          <label for="location" class="block py-3">Enter the location of property:</label>
                          <input type="text" v-model="form.location"  class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out">
                        <p v-if="form.errors.location" class="text-red-500">{{ form.errors.location }}</p>
                      </div>
                      <div class="input-box md:basis-[48%]">
                        <label for="propertyPrice" class="block py-3">Enter the price of the property:</label>
                        <input type="number" v-model="form.propertyValuation"  class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out">
                        <p v-if="form.errors.propertyValuation" class="text-red-500">{{ form.errors.propertyValuation }}</p>
                      </div>
                    </div>

                      <!-- Image Upload Section -->
                    <div class="form-row w-full mt-6">
                      <label class="block py-3">Property Images (Exactly 3 required):</label>
                      
                      <!-- Error Messages -->
                      <div v-if="showImageError && imageErrors.length > 0" class="mb-4">
                        <div 
                        v-for="error in imageErrors" :key="error"
                          class="flex items-center gap-2 text-red-600 bg-red-50 border border-red-200 rounded-md p-3 mb-2"
                        >
                          <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                          </svg>
                          <span>{{ error }}</span>
                        </div>
                      </div>

                      <!-- Success/Status Message -->
                      <div v-if="imageFiles.length === 3" class="mb-4">
                        <div class="flex items-center gap-2 text-green-600 bg-green-50 border border-green-200 rounded-md p-3">
                          <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                          </svg>
                          <span>Perfect! You have selected exactly 3 images.</span>
                        </div>
                      </div>

                      <div v-else-if="imageFiles.length > 0 && imageFiles.length < 3" class="mb-4">
                        <div class="flex items-center gap-2 text-yellow-600 bg-yellow-50 border border-yellow-200 rounded-md p-3">
                          <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                          </svg>
                          <span>You need {{ 3 - imageFiles.length }} more image(s) to reach the required 3 images.</span>
                        </div>
                      </div>
                      
                      <!-- Drag and Drop Area -->
                      <div 
                        @dragover="handleDragOver"
                        @dragleave="handleDragLeave"
                        @drop="handleDrop"
                        @click="triggerFileInput"
                        :class="[
                          imageFiles.length < 3 ? 'border-2 border-dashed rounded-lg p-8' : '', 'text-center cursor-pointer transition-all duration-300',
                          dragActive ? 'border-[#042EFF] bg-blue-50' : 'border-gray-300 hover:border-[#042EFF]',
                          imageFiles.length >= 3 ? 'cursor-not-allowed opacity-50' : ''
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
                        
                        <div v-if="imageFiles.length < 3" class="flex flex-col items-center">
                          <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                          </svg>
                          <p class="text-lg text-gray-600 mb-2">
                            {{ dragActive ? 'Drop images here' : 'Drag & drop images here' }}
                          </p>
                          <p class="text-sm text-gray-500 mb-2">or click to browse</p>
                          <p class="text-xs text-gray-400">
                            PNG, JPG, JPEG, GIF, WebP up to 10MB each ({{ imageFiles.length }}/3)
                          </p>
                        </div>
                      
                      </div>

                      <!-- Image Previews -->
                      <div v-if="imagePreviews.length > 0" class="mt-4">
                        <h4 class="mb-3">Preview Images:</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                          <div 
                            v-for="(preview, index) in imagePreviews" 
                            :key="preview.id"
                            class="relative group"
                          >
                            <div class="aspect-square rounded-lg overflow-hidden border-2 border-gray-200">
                              <img 
                                :src="preview.src" 
                                :alt="preview.name"
                                class="w-full h-full object-cover"
                              >
                            </div>
                            
                            <!-- Remove button -->
                            <button
                              type="button"
                              @click="removeImage(index)"
                              class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200"
                            >
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                              </svg>
                            </button>
                            
                            <!-- Image name -->
                            <p class="mt-2 text-sm text-gray-600 truncate">{{ preview.name }}</p>
                          </div>
                        </div>
                      </div>

                    </div>

                    <pre>{{ form.errors }}</pre>

                     <div v-if="hasImageErrors" class="mt-4">
                      <div class="text-red-600 bg-red-50 border border-red-200 rounded-md p-3">
                          <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium">Your images have some issues:</span>
                          </div>
                        <div v-if="form.errors.images" class="mb-2">
                          <p>{{ form.errors.images }}</p>
                        </div>

                        <div v-for="(error, key) in getImageSpecificErrors" :key="key" class="mb-1">
                          <p><strong class="px-2">Image {{ parseInt(key) + 1  }}:</strong>{{ error }}</p>
                        </div>
                      </div>
                     </div>
                    <!-- Error message for images -->

                    <button 
                      type="submit" 
                      :disabled="imageFiles.length !== 3"
                      :class="[
                        'capitalize px-4 py-2 rounded-md text-white my-4 transition-all duration-300',
                        imageFiles.length === 3 
                          ? 'bg-[#042EFF] hover:bg-blue-700 cursor-pointer' 
                          : 'bg-gray-400 cursor-not-allowed'
                      ]"
                    >
                      {{ imageFiles.length === 3 ? 'Add new Property' : `Add new Property (${imageFiles.length}/3 images)` }}
                    </button>
                    
                    <!-- Submit validation message -->
                    <div v-if="imageFiles.length !== 3" class="text-sm text-gray-600 mt-2">
                      <span v-if="imageFiles.length === 0">Please select exactly 3 images before submitting.</span>
                      <span v-else-if="imageFiles.length < 3">Please select {{ 3 - imageFiles.length }} more image(s) to submit the form.</span>
                      <span v-else>Please remove {{ imageFiles.length - 3 }} image(s) to submit the form.</span>
                    </div>
          </form>
        </div>
        </main>
    </section>

</template>
<style scoped>
</style>