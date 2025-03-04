<script setup>
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <Header/>
    <section class="urban">
    <div class="urban-title">Apartments</div>
    <div class="urban-welcome-text">The following are the apartments properties available for sale. There owners and respective prices are stated in the table below. This process can be reversed at any point up to the point of the site visit. Each property availabe for sale has unique identification number that is used to uniquely identify the property all through the process.</div>
    <hr>
    <div class="table-container overflow-x-auto">
            <table>
            <thead>
              <tr>
                <th class="py-6 px-2">Property Id</th>
                <th class="py-6 px-2">Location</th>
                <th class="py-6 px-2">Owner</th>
                <th class="py-6 px-2">price</th>
                <th class="py-6 px-2">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  <td class="py-6 px-2">89343495</td>
                  <td class="py-6 px-2">Ruiru</td>
                  <td class="py-6 px-2">James Odhiambo</td>
                  <td class="py-6 px-2">Ksh. 56,934</td>
                  <td class="py-6 px-2">Sold</td>
                </tr>
                </tbody>
                </table>
          </div>
    <hr>
    <div class="call-to-action">Want to get yourself a piece of land?</div>
    <div class="call-to-action-details">Interested in acquistion of one or more of the above properties? Click the button below to submit your personal information that is required for the process to begin.</div>
    <Link :href="route('urban')" class="btn">Click here to begin the process</Link>
    <hr>
  </section>
  <Footer/>
</template>
