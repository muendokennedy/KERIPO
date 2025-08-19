<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { MagnifyingGlassIcon } from '@heroicons/vue/24/solid'

const authenticatedAdminUser = usePage().props.auth.adminUser;

</script>
<template>
    <header class="w-[calc(100% - 15rem)] main-header flex justify-between gap-2 px-2 py-2 items-center pr-4 fixed top-0 left-[15rem] right-0 z-20 bg-white">
        <div class="flex items-center">
        <label for="menu-bar" class="cursor-pointer menu-bar"><i class="fa-solid fa-bars text-2xl font-bold p-2"></i></label>
        <h2 class="capitalize text-lg sm:text-xl font-semibold text-[#042EFF]">dashboard</h2>
        </div>
        <div class="header-search  w-1/3 lg:w-1/2 hidden lg:flex items-center relative">
        <input type="search" name="search-term" id="search-term" placeholder="search here..." class="border-2 rounded-md px-4 py-3 w-full outline-none pr-[70px] focus:border-[#042EFF] transition-all duration-300 ease-in-out">
        <label for="search-term" class="rounded-r-md absolute right-2 inline-block px-3 py-2 text-white bg-[#042EFF] cursor-pointer">
            <MagnifyingGlassIcon class="size-6 text-xl font-extrabold"/>
        </label>
        </div>
        <div v-if="authenticatedAdminUser?.avatar" class="profile-section sm:ml-auto lg:ml-0 border-2 flex items-center rounded-md w-36 sm:w-64 gap-2">
        <div class="profile-pic h-[48px] w-[70px] p-1">
            <img :src="authenticatedAdminUser.avatar" :alt="authenticatedAdminUser.avatar" class="w-full h-full object-cover rounded-l-md">
        </div>
        <span class="sm:pr-2 text-xs sm:text-base">{{ authenticatedAdminUser.name }}</span>
        </div>
        <div v-else class="profile-section sm:ml-auto lg:ml-0 border-2 flex items-center rounded-md w-36 sm:w-64 gap-2">
        <div class="profile-pic h-[48px] w-[70px] p-1 opacity-30">
            <div class="flex items-center justify-center w-full h-full object-cover rounded-l-md">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-12">
                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
        <span class="sm:pr-2 text-xs sm:text-base">{{ authenticatedAdminUser.name }}</span>
        </div>
    </header>
</template>
