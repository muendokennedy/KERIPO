<script setup>
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    apartments: {
        type: Array
    }
})
</script>

<template>
    <Header/>
    <section class="urban py-2 px-[5%]">
    <div class="urban-title w-[200px] text-lg py-5 font-semibold border-b border-solid border-black">Apartments</div>
    <div class="urban-welcome-text my-5">The following are the apartments properties available for sale. There owners and respective prices are stated in the table below. This process can be reversed at any point up to the point of the site visit. Each property availabe for sale has unique identification number that is used to uniquely identify the property all through the process.</div>
    <hr>
    <div class="table-container overflow-x-auto">
            <table class="w-full my-5 border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-2 bg-[#2DE19D] text-left border-t border-solid border-black border-b">Property Id</th>
                <th class="py-4 px-2 bg-[#2DE19D] text-left border-t border-solid border-black border-b">Location</th>
                <th class="py-4 px-2 bg-[#2DE19D] text-left border-t border-solid border-black border-b">Owner</th>
                <th class="py-4 px-2 bg-[#2DE19D] text-left border-t border-solid border-black border-b">Price</th>
                <th class="py-4 px-2 bg-[#2DE19D] text-left border-t border-solid border-black border-b">Status</th>
                <th class="py-4 px-2 bg-[#2DE19D] text-left border-t border-solid border-black border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(apartment, index) in apartments" :key="index">
                  <td class="py-4 px-2">{{ apartment.propertyId }}</td>
                  <td class="py-4 px-2">{{ apartment.location }}</td>
                  <td class="py-4 px-2">{{ apartment.ownersName }}</td>
                  <td class="py-4 px-2">{{ apartment.propertyValuation }}</td>
                  <td class="py-4 px-2">{{ apartment.acquisitionStatus }}</td>
                  <td class="py-4 px-2">
                    <Link 
                      as="button" 
                      :href="route('apartment.details', { id: apartment.propertyId })" 
                      class="rounded-2xl border-none outline-none bg-[#2DE19D] py-2 px-4 text-sm capitalize text-black cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#15f49f]"
                    >
                      View Details
                    </Link>
                  </td>
                </tr>
                </tbody>
                </table>
          </div>
    <hr>
    <div class="call-to-action text-lg py-5 font-semibold">Want to get yourself a piece of land?</div>
    <div class="call-to-action-details">Interested in acquistion of one or more of the above properties? Click the button below to submit your personal information that is required for the process to begin.</div>
    <Link as="button" :href="route('client.conditions')" class="my-7 w-[300px] block rounded-3xl border-none outline-none bg-[#2DE19D] py-3 px-6 text-center text-base capitalize text-black cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#15f49f]">Click here to begin the process</Link>
    <hr>
  </section>
  <Footer/>
</template>
