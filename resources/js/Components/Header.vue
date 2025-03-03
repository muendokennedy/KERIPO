<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <header>
    <div class="logo-area">
      <div class="nav-logo"><img src="images/kenyan logo.png" alt="Kenyan logo"></div>
      <div class="nav-title">Kenya real estate system</div>
    </div>
    <nav>
        <Link :href="route('home')">Home</Link>
      <div class="link-container">
      <a class="drop-down">Land plots <i class="fa-solid fa-caret-down"></i></a>
      <div class="links">
        <Link :href="route('urban')">Urban Plots</Link>
        <Link :href="route('upcountry')">Upcountry Plots</Link>
      </div>
      </div>
      <div class="link-container">
      <a class="drop-down">Buildings <i class="fa-solid fa-caret-down"></i></a>
      <div class="links">
        <Link :href="route('apartments')">Apartments</Link>
        <Link :href="route('houses')">Houses</Link>
      </div>
      </div>
      <Link :href="route('contact')">Contact</Link>
    </nav>
  </header>
</template>
