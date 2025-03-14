<script setup>
import AdminSidebar from '@/Components/app/AdminSidebar.vue'
import AdminHeader from '@/Components/app/AdminHeader.vue'
import { useForm } from '@inertiajs/vue3'
import { onMounted, ref } from 'vue'

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
    // avatar: null
})

onMounted(() => {

    form.category = props.property.category,
    form.ownersName = props.property.ownersName,
    form.location = props.property.location,
    form.propertyValuation = props.property.propertyValuation
})


const categories = ref([
    'Urban Plot',
    'Upcountry Plot',
    'House',
    'Apartment'
])

const submit = () => {

  form.propertyValuation = form.propertyValuation
        ? Number(String(form.propertyValuation).replace(/[^\d.]/g, ''))
        : 0;

    form.put(route('admin.property.update', props.property))
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
                          <input type="text" v-model="form.location"   class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out">
                        <p v-if="form.errors.location" class="text-red-500">{{ form.errors.location }}</p>
                      </div>
                      <div class="input-box md:basis-[48%]">
                        <label for="propertyPrice" class="block py-3">Enter the price of the property:</label>
                        <input type="text" v-model="form.propertyValuation"   class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out">
                        <p v-if="form.errors.propertyValuation" class="text-red-500">{{ form.errors.propertyValuation }}</p>
                      </div>
                    </div>
                    <button type="submit" class="capitalize px-4 py-2 bg-[#042EFF] rounded-md text-white my-4">Edit property</button>
          </form>
        </div>
        </main>
    </section>

</template>
<style scoped>
</style>
