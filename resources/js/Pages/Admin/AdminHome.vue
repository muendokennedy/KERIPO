<script setup>
import AdminSidebar from '@/Components/app/AdminSidebar.vue'
import AdminHeader from '@/Components/app/AdminHeader.vue'
import { Link } from '@inertiajs/vue3'

import { ArrowUpIcon, ArrowDownIcon } from '@heroicons/vue/24/solid'


</script>

<template>
    <AdminSidebar/>
    <section class="text-base ml-[15rem] w-[calc(100% - 15rem)] main-content min-h-screen">
    <AdminHeader/>
      <main class="bg-[#E4E7F3] pt-20 px-[3%] pb-4">
        <div class="dashboard-box-container py-4 grid grid-cols-2 md:grid-cols-3 gap-4">
          <div class="box flex gap-4  bg-white p-4 rounded-md">
            <div class="left space-y-2">
              <h3 class="capitalize text-base font-semibold text-[#042EFF]">properties</h3>
              <h1 class="text-2xl font-semibold">40,876</h1>
              <ArrowUpIcon class="size-8 font-extrabold text-center leading-8 p-2 rounded-full bg-[#B5FFD5] text-[#042EFF]"/>
            </div>
            <div class="right flex flex-col gap-4 items-center">
            <ArrowUpIcon class="size-14 p-2 rounded-md bg-[#B5FFD5] text-center leading-[3.5rem] text-3xl text-[#042EFF]"/>
              <span class="text-sm">Up from yesterday</span>
            </div>
          </div>
          <div class="box flex gap-4  bg-white p-4 rounded-md">
            <div class="left space-y-2">
              <h3 class="capitalize text-base font-semibold text-[#042EFF]">orders</h3>
              <h1 class="text-2xl font-semibold">40,876</h1>
              <ArrowUpIcon class="size-8 font-extrabold text-center leading-8 p-2 rounded-full bg-[#B5FFD5] text-[#042EFF]"/>
            </div>
            <div class="right flex flex-col gap-4 items-center">
            <ArrowUpIcon class="size-14 p-2 rounded-md bg-[#B5FFD5] text-center leading-[3.5rem] text-3xl text-[#042EFF]"/>
            <span class="text-sm">Up from yesterday</span>
            </div>
          </div>
          <div class="box flex gap-4  bg-white p-4 rounded-md">
            <div class="left space-y-2">
              <h3 class="capitalize text-base font-semibold text-[#042EFF]">pending</h3>
              <h1 class="text-2xl font-semibold">40,876</h1>
              <ArrowUpIcon class="size-8 font-extrabold text-center leading-8 p-2 rounded-full bg-[#FBE4DD] text-[#FF4004]"/>
            </div>
            <div class="right flex flex-col gap-4 items-center">
            <ArrowUpIcon class="size-14 p-2 rounded-md bg-[#FBE4DD] text-center leading-[3.5rem] text-3xl text-[#FF4004]"/>
              <span class="text-sm">down from yesterday</span>
            </div>
          </div>
        </div>
        <div class="top-sales-container flex flex-col md:flex-row my-8 w-full gap-4">
          <div class="recent-sales bg-white p-4 rounded-md w-full md:w-2/3">
            <h2 class="text-[#042EFF] font-semibold text-2xl">Recent property acquisitions</h2>
            <div class="table-container overflow-x-auto">
              <table class="w-[40rem] md:w-full">
                <thead class="text-left">
                  <tr>
                    <th class="py-4">Date</th>
                    <th class="py-4">Customer</th>
                    <th class="py-4">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="py-2">02 Aug 2023</td>
                    <td class="py-2">Mark Alex</td>
                    <td class="py-2">Delivered</td>
                  </tr>
                  <tr>
                    <td class="py-2">02 Aug 2023</td>
                    <td class="py-2">Mark Alex</td>
                    <td class="py-2">Delivered</td>
                  </tr>
                  <tr>
                    <td class="py-2">02 Aug 2023</td>
                    <td class="py-2">Mark Alex</td>
                    <td class="py-2">Delivered</td>
                  </tr>
                  <tr>
                    <td class="py-2">02 Aug 2023</td>
                    <td class="py-2">Mark Alex</td>
                    <td class="py-2">Delivered</td>
                  </tr>
                </tbody>
              </table>
              <Link as="button" class="capitalize px-4 py-2 rounded-md text-white bg-[#042EFF] mt-4" :href="route('admin.properties')">see more</Link>
            </div>
          </div>
          <div class="recent-sales bg-white p-4 rounded-md w-full md:w-2/3">
            <h2 class="text-[#042EFF] font-semibold text-2xl">Top selling Property</h2>
            <div class="table-container overflow-x-auto">
              <table class="w-[40rem] md:w-full">
                <thead class="text-left">
                  <tr>
                    <th class="py-4">Property</th>
                    <th class="py-4">Category</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="py-2"><img src="/images/redmi note 12.png" alt="product" class="h-14 w-auto"></td>
                    <td class="py-2">House</td>
                  </tr>
                  <tr>
                    <td class="py-2"><img src="/images/redmi note 12.png" alt="product" class="h-14 w-auto"></td>
                    <td class="py-2">Urban Plot</td>
                  </tr>
                  <tr>
                    <td class="py-2"><img src="/images/redmi note 12.png" alt="product" class="h-14 w-auto"></td>
                    <td class="py-2">Upcountry Plot</td>
                  </tr>
                  <tr>
                    <td class="py-2"><img src="/images/redmi note 12.png" alt="product" class="h-14 w-auto"></td>
                    <td class="py-2">Apartment</td>
                  </tr>
                </tbody>
              </table>
              <Link as="button" class="capitalize px-4 py-2 rounded-md text-white bg-[#042EFF] mt-4" :href="route('admin.properties')">see more</Link>
            </div>
          </div>
        </div>
        <div class="recent-signups-container my-8 w-full">
          <div class="recent-sales bg-white p-4 rounded-md">
            <h2 class="text-[#042EFF] font-semibold text-2xl">Recent sign ups</h2>
            <div class="table-container overflow-x-auto">
              <table class="w-[40rem] md:w-full">
                <thead class="text-left">
                  <tr>
                    <th class="py-4">Date</th>
                    <th class="py-4">Name</th>
                    <th class="py-4">Phone</th>
                    <th class="py-4">Email</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="py-2">02 Aug 2023</td>
                    <td class="py-2">Mark Alex</td>
                    <td class="py-2">0745079253</td>
                    <td class="py-2">markalex@gmail.com</td>
                  </tr>
                  <tr>
                    <td class="py-2">02 Aug 2023</td>
                    <td class="py-2">Mark Alex</td>
                    <td class="py-2">0745079253</td>
                    <td class="py-2">markalex@gmail.com</td>
                  </tr>
                  <tr>
                    <td class="py-2">02 Aug 2023</td>
                    <td class="py-2">Mark Alex</td>
                    <td class="py-2">0745079253</td>
                    <td class="py-2">markalex@gmail.com</td>
                  </tr>
                  <tr>
                    <td class="py-2">02 Aug 2023</td>
                    <td class="py-2">Mark Alex</td>
                    <td class="py-2">0745079253</td>
                    <td class="py-2">markalex@gmail.com</td>
                  </tr>
                </tbody>
              </table>
              <Link as="button" class="capitalize px-4 py-2 rounded-md text-white bg-[#042EFF] mt-4" :href="route('admin.clientinfo')">see more</Link>
            </div>
          </div>
        </div>
      </main>
    </section>
</template>
