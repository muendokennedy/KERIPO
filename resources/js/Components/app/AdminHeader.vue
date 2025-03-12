<script setup>
import { Link } from '@inertiajs/vue3'
import { MagnifyingGlassIcon } from '@heroicons/vue/24/solid'
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
        <div class="profile-section sm:ml-auto lg:ml-0 border-2 flex items-center rounded-md w-36 sm:w-64 justify-between">
        <div class="profile-pic h-[48px] w-[70px] p-1">
            <img src="/images/man4.jpeg" alt="profile image" class="w-full h-full object-cover rounded-l-md">
        </div>
        <span class="sm:pr-2 text-xs sm:text-base">Kennedy Munyao</span>
        </div>
    </header>
</template>
