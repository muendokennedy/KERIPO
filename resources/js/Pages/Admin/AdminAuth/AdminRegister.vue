<script setup>
// import {CameraIcon, CloudArrowUpIcon, XMarkIcon} from '@heroicons/vue/24/solid'
import { useForm, Link, usePage } from '@inertiajs/vue3'
import {ref, computed} from 'vue'

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    avatar: null
})

const avatarImageSource = ref(null)
const isDragging = ref(false)
const fileError = ref('')

// Get flash messages from Inertia
const page = usePage()
const flashSuccess = computed(() => page.props.flash?.success)

// Allowed file types
const allowedTypes = ['image/png', 'image/jpg', 'image/jpeg', 'image/webp']
const allowedExtensions = ['.png', '.jpg', '.jpeg', '.webp']

const validateFile = (file) => {
    fileError.value = ''
    
    if (!file) return false
    
    // Check file type
    if (!allowedTypes.includes(file.type)) {
        fileError.value = 'Only PNG, JPG, JPEG, and WebP files are allowed.'
        return false
    }
    
    // Check file size (optional - 5MB limit)
    if (file.size > 5 * 1024 * 1024) {
        fileError.value = 'File size must be less than 5MB.'
        return false
    }
    
    return true
}

const processFile = (file) => {
    if (!validateFile(file)) return
    
    form.avatar = file
    
    const reader = new FileReader()
    reader.onload = () => {
        avatarImageSource.value = reader.result
    }
    reader.readAsDataURL(file)
}

const onAvatarChoose = (event) => {
    const file = event.target.files[0]
    if (file) {
        processFile(file)
    }
}

// Drag and drop handlers
const onDragEnter = (e) => {
    e.preventDefault()
    isDragging.value = true
}

const onDragLeave = (e) => {
    e.preventDefault()
    isDragging.value = false
}

const onDragOver = (e) => {
    e.preventDefault()
}

const onDrop = (e) => {
    e.preventDefault()
    isDragging.value = false
    
    const files = e.dataTransfer.files
    if (files.length > 0) {
        processFile(files[0])
    }
}

const cancelAvatarImage = () => {
    form.avatar = null
    avatarImageSource.value = null
    fileError.value = ''
}

const submit = () => {
    form.post(route('admin.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
        onSuccess: () => {
            cancelAvatarImage()
        }
    })
}
</script>

<template>
    <section class="min-h-screen">
      <main class="bg-[#E4E7F3] pt-20 px-[3%] pb-4">
        <!-- Success Flash Message -->
        <div v-if="flashSuccess" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-md shadow-lg z-50 animate-fade-in">
          <div class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            {{ flashSuccess }}
          </div>
        </div>

        <div class="sigup-box bg-white p-4 px-8 rounded-md w-[30rem] mx-auto">
          <form @submit.prevent="submit">
            <h2 class="text-center text-xl text-[#042EFF] font-semibold capitalize py-4 border-b-2">signup as an admin</h2>
            <div class="input-box">
              <label for="name" class="capitalize block py-3">Enter name:</label>
              <input type="text" v-model="form.name" id="name" class="p-2 rounded-md border-2 outline-none w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
              <p v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</p>
            </div>
            <div class="input-box mb-4">
              <label for="email" class="capitalize block py-3">Enter email:</label>
              <input type="text" v-model="form.email" id="email" class="p-2 rounded-md border-2 outline-none w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
              <p v-if="form.errors.email" class="text-red-500">{{ form.errors.email }}</p>
            </div>
            
            <p class="mb-4">Upload a profile photo:</p>
            
            <!-- Enhanced Image Upload Section -->
            <div class="mb-4">
              <!-- Image Preview (when image is selected) -->
              <div v-if="avatarImageSource" class="flex flex-col items-center gap-4">
                <div class="relative">
                  <div class="h-32 w-32 rounded-full border-4 border-[#042EFF] overflow-hidden shadow-lg">
                    <img :src="avatarImageSource" alt="Profile Preview" class="h-full w-full object-cover">
                  </div>
                  <button
                    type="button"
                    @click="cancelAvatarImage"
                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors"
                  >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </div>
                <p class="text-sm text-gray-600">Click the × to remove image</p>
              </div>

              <!-- Drag and Drop Area (when no image is selected) -->
              <div
                v-else
                @dragenter="onDragEnter"
                @dragleave="onDragLeave"
                @dragover="onDragOver"
                @drop="onDrop"
                class="relative border-2 border-dashed rounded-lg p-8 text-center transition-all duration-300"
                :class="{
                  'border-[#042EFF] bg-blue-50': isDragging,
                  'border-gray-300 hover:border-[#042EFF] hover:bg-gray-50': !isDragging
                }"
              >
                <input
                  type="file"
                  @change="onAvatarChoose"
                  accept=".png,.jpg,.jpeg,.webp"
                  class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                >
                
                <div class="flex flex-col items-center gap-3">
                  <!-- Upload Icon -->
                  <div class="text-4xl text-[#042EFF]">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                  </div>
                  
                  <!-- Upload Text -->
                  <div>
                    <p class="text-lg font-medium text-gray-700">
                      <span v-if="isDragging" class="text-[#042EFF]">Drop your image here</span>
                      <span v-else>Drag & drop your image here</span>
                    </p>
                    <p class="text-sm text-gray-500 mt-1">or click to browse from your computer</p>
                    <p class="text-xs text-gray-400 mt-2">Supports: PNG, JPG, JPEG, WebP (Max: 5MB)</p>
                  </div>
                </div>
              </div>
              
              <!-- File Error Message -->
              <p v-if="fileError" class="text-red-500 text-sm mt-2">{{ fileError }}</p>
              <p v-if="form.errors.avatar" class="text-red-500 text-sm mt-2">{{ form.errors.avatar }}</p>
            </div>
            
            <div class="input-box">
              <label for="password" class="capitalize block py-3">Enter password</label>
              <input type="password" v-model="form.password" id="password" class="p-2 rounded-md border-2 outline-none w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
              <p v-if="form.errors.password" class="text-red-500">{{ form.errors.password }}</p>
            </div>
            <div class="input-box">
              <label for="password_confirmation" class="capitalize block py-3">confirm your password:</label>
              <input type="password" v-model="form.password_confirmation"  id="password_confirmation" class="p-2 rounded-md border-2 outline-none w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
              <p v-if="form.errors.password_confirmation" class="text-red-500">{{ form.errors.password_confirmation }}</p>
            </div>
            <button 
              type="submit" 
              :disabled="form.processing"
              class="text-white bg-[#042EFF] block w-full px-4 py-3 rounded-md my-6 capitalize hover:bg-[#384857] transition-all duration-300 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <span v-if="form.processing">Processing...</span>
              <span v-else>signup</span>
            </button>
            <p class="capitalize"><span>already have an account? </span> <Link :href="route('admin.login.show')" class="text-[#042eff] hover:underline transition-all duration-300 ease-in-out">login here</Link></p>
          </form>
        </div>
      </main>
    </section>
</template>

<style scoped>
@keyframes fade-in {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fade-in 0.3s ease-out;
}
</style>