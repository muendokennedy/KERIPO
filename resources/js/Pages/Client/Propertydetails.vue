<script setup>
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
import { Link } from '@inertiajs/vue3'
import { ref, onMounted, computed } from 'vue'

const props = defineProps({
    property: {
        type: Object,
        required: true
    }
})

// Carousel functionality
const currentImageIndex = ref(0)
const copiedPropertyId = ref(false)

// Computed property to handle different image data structures
const propertyImages = computed(() => {
    // Handle the specific structure where images is an array of objects with image_path
    if (props.property.images && Array.isArray(props.property.images)) {
        return props.property.images.map(img => {
            // Extract image_path from each image object
            if (img && img.image_path) {
                return img.image_path
            }
            // Fallback to other possible properties
            if (img && img.url) {
                return img.url
            }
            if (img && img.path) {
                return img.path
            }
            // If it's already a string URL
            if (typeof img === 'string') {
                return img
            }
            return null
        }).filter(Boolean) // Remove any null values
    }
    
    // Handle single image object with image_path
    if (props.property.images && props.property.images.image_path) {
        return [props.property.images.image_path]
    }
    
    // Handle if images is a single URL string
    if (props.property.images && typeof props.property.images === 'string') {
        return [props.property.images]
    }
    
    // Fallback: look for other common image field names
    if (props.property.image && props.property.image.image_path) {
        return [props.property.image.image_path]
    }
    if (props.property.image && typeof props.property.image === 'string') {
        return [props.property.image]
    }
    
    // Return empty array if no images found
    return []
})

console.log(propertyImages.value)

const nextImage = () => {
    if (propertyImages.value.length > 0) {
        currentImageIndex.value = (currentImageIndex.value + 1) % propertyImages.value.length
    }
}

const prevImage = () => {
    if (propertyImages.value.length > 0) {
        currentImageIndex.value = currentImageIndex.value === 0 
            ? propertyImages.value.length - 1 
            : currentImageIndex.value - 1
    }
}

const goToImage = (index) => {
    currentImageIndex.value = index
}

// Copy to clipboard functionality
const copyToClipboard = async (propertyId) => {
    try {
        await navigator.clipboard.writeText(propertyId)
        copiedPropertyId.value = true
        
        setTimeout(() => {
            copiedPropertyId.value = false
        }, 2000)
    } catch (err) {
        console.error('Failed to copy: ', err)
    }
}

// Handle image loading errors
const handleImageError = (event) => {
    console.error('Image failed to load:', event.target.src)
    // You could replace with a placeholder image here
    // event.target.src = '/path/to/placeholder-image.jpg'
}

// Auto-advance carousel (optional)
onMounted(() => {
    if (propertyImages.value.length > 1) {
        setInterval(() => {
            nextImage()
        }, 5000) // Change image every 5 seconds
    }
})
</script>

<template>
    <Header/>
    <section class="urban py-2 px-[5%]">
        <!-- Back Navigation -->
        <div class="mb-5">
            <Link 
                :href="route('client.conditions')" 
                class="inline-flex items-center text-black hover:text-[#2DE19D] transition-colors duration-300"
            >
                ← Back to Properties
            </Link>
        </div>
        <!-- Property Title Section -->
        <div class="property-header mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                <h1 class="text-3xl font-bold text-black mb-2 md:mb-0">
                    {{ property.title || `Property ${property.propertyId}` }}
                </h1>
                <div class="flex items-center gap-3">
                    <span class="text-2xl font-semibold text-[#2DE19D]">
                        ${{ property.propertyValuation?.toLocaleString() || 'N/A' }}
                    </span>
                    <button 
                        @click="copyToClipboard(property.propertyId)"
                        class="rounded-2xl border-none outline-none py-2 px-4 text-sm capitalize text-black cursor-pointer transition-all duration-300 ease-in-out"
                        :class="copiedPropertyId ? 'bg-green-500 hover:bg-green-600' : 'bg-gray-400 hover:bg-gray-500'"
                    >
                        {{ copiedPropertyId ? 'Copied!' : 'Copy ID' }}
                    </button>
                </div>
            </div>
            <div class="text-lg text-gray-700 mb-2">📍 {{ property.location }}</div>
            <div class="text-base">
                <span class="font-semibold">Owner:</span> {{ property.ownersName }} | 
                <span class="font-semibold">Status:</span> 
                <span :class="property.acquisitionStatus === 'Available' ? 'text-green-600' : 'text-orange-600'">
                    {{ property.acquisitionStatus }}
                </span>
            </div>
        </div>

        <!-- Image Carousel -->
        <div class="carousel-container mb-8">
            <div class="relative w-full h-[400px] md:h-[500px] bg-gray-200 rounded-2xl overflow-hidden">
                <div v-if="property.images && property.images.length > 0" class="w-full h-full">
                    <!-- Main Image -->
                    <img 
                        :src="`/storage/${propertyImages[currentImageIndex]}`" 
                        :alt="`Property image ${currentImageIndex + 1} storage/${propertyImages[currentImageIndex]}`"
                        class="w-full h-full object-cover"
                    />
                    
                    <!-- Navigation Arrows -->
                    <button 
                        v-if="property.images.length > 1"
                        @click="prevImage"
                        class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full p-3 hover:bg-opacity-70 transition-all duration-300"
                    >
                        ←
                    </button>
                    <button 
                        v-if="property.images.length > 1"
                        @click="nextImage"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full p-3 hover:bg-opacity-70 transition-all duration-300"
                    >
                        →
                    </button>
                    
                    <!-- Image Counter -->
                    <div class="absolute top-4 right-4 bg-black bg-opacity-50 text-white px-3 py-1 rounded-full text-sm">
                        {{ currentImageIndex + 1 }} / {{ property.images.length }}
                    </div>
                </div>
                
                <!-- Placeholder if no images -->
                <div v-else class="w-full h-full flex items-center justify-center text-gray-500 text-xl">
                    No Images Available
                </div>
            </div>
            
            <!-- Thumbnail Navigation -->
            <div v-if="property.images && property.images.length > 1" class="flex gap-3 mt-4 overflow-x-auto pb-2">
                <button 
                    v-for="(image, index) in property.images" 
                    :key="index"
                    @click="goToImage(index)"
                    class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 transition-all duration-300"
                    :class="currentImageIndex === index ? 'border-[#2DE19D]' : 'border-gray-300 hover:border-gray-400'"
                >
                    <img :src="`/storage/${image.image_path}`" :alt="image.original_name" class="w-full h-full object-cover" />
                </button>
            </div>
        </div>

        <!-- Property Details Grid -->
        <div class="grid md:grid-cols-2 gap-8 mb-8">
            <!-- Property Information -->
            <div class="property-info">
                <h2 class="text-2xl font-semibold mb-4 border-b border-solid border-black pb-2">Property Information</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium">Property ID:</span>
                        <span>{{ property.propertyId }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Type:</span>
                        <span>{{ property.propertyType || 'Apartment' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Size:</span>
                        <span>{{ property.size || 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Bedrooms:</span>
                        <span>{{ property.bedrooms || 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Bathrooms:</span>
                        <span>{{ property.bathrooms || 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Year Built:</span>
                        <span>{{ property.yearBuilt || 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <!-- Features & Amenities -->
            <div class="property-features">
                <h2 class="text-2xl font-semibold mb-4 border-b border-solid border-black pb-2">Features & Amenities</h2>
                <div class="grid grid-cols-2 gap-2">
                    <div v-for="feature in property.features || ['Modern Kitchen', 'Parking Space', 'Garden', 'Security']" 
                         :key="feature" 
                         class="flex items-center gap-2 text-sm"
                    >
                        <span class="text-[#2DE19D]">✓</span>
                        <span>{{ feature }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="property-description mb-8">
            <h2 class="text-2xl font-semibold mb-4 border-b border-solid border-black pb-2">Description</h2>
            <p class="text-gray-700 leading-relaxed">
                {{ property.description || 'This beautiful apartment offers modern living in a prime location. With excellent amenities and thoughtful design, this property represents an exceptional opportunity for both investment and residential purposes. The property features high-quality finishes throughout and is situated in a desirable neighborhood with easy access to local amenities.' }}
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons flex flex-col sm:flex-row gap-4 mb-8">
            <Link 
                as="button" 
                :href="route('client.conditions')" 
                class="flex-1 sm:max-w-xs rounded-3xl border-none outline-none bg-[#2DE19D] py-4 px-8 text-center text-lg font-semibold capitalize text-black cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#15f49f]"
            >
                Get This Property
            </Link>
            <Link 
                as="button" 
                :href="route('client.conditions', { id: property.propertyId })" 
                class="flex-1 sm:max-w-xs rounded-3xl border-2 border-[#2DE19D] outline-none bg-transparent py-4 px-8 text-center text-lg font-semibold capitalize text-[#2DE19D] cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#2DE19D] hover:text-black"
            >
                Schedule Visit
            </Link>
            <button 
                @click="copyToClipboard(property.propertyId)"
                class="flex-1 sm:max-w-xs rounded-3xl border-2 outline-none py-4 px-8 text-center text-lg font-semibold capitalize cursor-pointer transition-all duration-300 ease-in-out"
                :class="copiedPropertyId ? 'border-green-500 bg-green-500 text-white hover:bg-green-600' : 'border-gray-400 bg-gray-400 text-black hover:bg-gray-500'"
            >
                {{ copiedPropertyId ? 'ID Copied!' : 'Copy Property ID' }}
            </button>
        </div>

        <!-- Contact Information -->
        <div class="contact-section bg-gray-50 rounded-2xl p-6">
            <h2 class="text-2xl font-semibold mb-4">Contact Information</h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <span class="font-medium">Owner:</span> {{ property.ownersName }}
                </div>
                <div v-if="property.contactPhone">
                    <span class="font-medium">Phone:</span> {{ property.contactPhone }}
                </div>
                <div v-if="property.contactEmail">
                    <span class="font-medium">Email:</span> {{ property.contactEmail }}
                </div>
                <div>
                    <span class="font-medium">Property ID:</span> {{ property.propertyId }}
                </div>
            </div>
        </div>
    </section>
    <Footer/>
</template>