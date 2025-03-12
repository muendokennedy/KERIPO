<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import { HomeIcon, ChartBarIcon, InboxStackIcon, ListBulletIcon, CircleStackIcon, UserIcon, Cog6ToothIcon, ArrowRightStartOnRectangleIcon } from '@heroicons/vue/24/solid'


</script>
<template>
    <input type="checkbox" id="menu-bar" class="hidden">
    <div class="z-50 side-bar fixed left-0 min-h-screen w-[15rem] bg-[#042EFF] py-4 flex flex-col justify-between">
      <div class="sidebar-primary-box">
        <h2 class="side-bar-title text-white font-bold text-2xl text-center capitalize my-4">KeriTech</h2>
        <ul class="my-8 text-white px-6 space-y-6 capitalize">
          <li><Link :href="route('admin.dashboard')" class="flex items-center">
            <HomeIcon class="size-6 inline text-xl mr-3"/>
            <span>dashboard</span></Link></li>
            <li><Link :href="route('admin.analytics')">
            <ChartBarIcon class="size-6 inline text-xl mr-3"/>
          <span>analytics</span></Link></li>
          <li><Link :href="route('admin.properties')">
            <InboxStackIcon class="size-6 inline text-xl mr-3"/>
            <span>Properties</span></Link></li>
          <li><Link :href="route('admin.orders')">
            <ListBulletIcon class="size-6 inline text-xl mr-3"/>
            <span>Orders</span></Link></li>
          <li><Link :href="route('admin.clientinfo')">
            <UserIcon class="size-6 inline text-xl mr-3"/>
            <span>client info</span></Link></li>
          <li><Link :href="route('admin.settings')">
            <Cog6ToothIcon class="size-6 inline text-xl mr-3"/>
            <span>settings</span></Link></li>
        </ul>
    </div>
    <div class="side-bar-bottom my-4 text-white px-4 space-y-2 capitalize">
        <ul>
            <li><Link method="post" :href="route('admin.logout')">
            <ArrowRightStartOnRectangleIcon class="size-6 inline text-xl mr-3"/>
            <span>log out</span></Link></li>
        </ul>
      </div>
    </div>
</template>
