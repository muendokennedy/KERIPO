<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <header>
    <div class="logo-area">
      <div class="nav-logo"><img src="/images/kenyan logo.png" alt="Kenyan logo"></div>
      <div class="nav-title">Kenya real estate system</div>
    </div>
    <nav>
        <Link :href="route('client.home')">Home</Link>
      <div class="link-container">
      <a class="drop-down">Land plots <i class="fa-solid fa-caret-down"></i></a>
      <div class="links">
        <Link :href="route('client.urban')">Urban Plots</Link>
        <Link :href="route('client.upcountry')">Upcountry Plots</Link>
      </div>
      </div>
      <div class="link-container">
      <a class="drop-down">Buildings <i class="fa-solid fa-caret-down"></i></a>
      <div class="links">
        <Link :href="route('client.apartments')">Apartments</Link>
        <Link :href="route('client.houses')">Houses</Link>
      </div>
      </div>
      <Link :href="route('client.contact')">Contact</Link>
    </nav>
  </header>
</template>
