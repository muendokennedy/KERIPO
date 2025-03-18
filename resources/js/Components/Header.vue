<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <header class="sticky inset-0 bg-[#2DE19D] flex justify-between text-base py-0 px-[2%] items-center z-50">
        <div class="logo-area flex gap-8 items-center">
          <div class="nav-logo h-8 w-8"><img src="/images/kenyan logo.png" alt="Kenyan logo"></div>
          <div class="nav-title font-medium text-lg capitalize">Kenya real estate system</div>
        </div>
        <nav class="flex gap-5 relative items-center">
            <Link class="text-black text-base p-3" :href="route('client.home')">Home</Link>
            <Link class="text-black text-base p-3" :href="route('client.urban')">Urban Plots</Link>
            <Link class="text-black text-base p-3" :href="route('client.upcountry')">Upcountry Plots</Link>
            <Link class="text-black text-base p-3" :href="route('client.apartments')">Apartments</Link>
            <Link class="text-black text-base p-3" :href="route('client.houses')">Houses</Link>
            <Link class="text-black text-base p-3" :href="route('client.contact')">Contact</Link>
        </nav>
    </header>
</template>
