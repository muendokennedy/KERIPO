<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <footer>
      <div class="footer-info-box">
        <div class="link-box">
          <p class="footer-box-title">Main Links</p>
          <Link :href="route('home')">Home</Link>
          <Link :href="route('urban')">Urban Plots</Link>
          <Link :href="route('apartments')">Residential Apartments</Link>
          <Link :href="route('upcountry')">Upcountry Plots</Link>
          <Link :href="route('houses')">Houses</Link>
        </div>
        <div class="link-box">
          <p class="footer-box-title">Social media links</p>
          <Link :href="route('upcountry')">Facebook</Link>
          <Link :href="route('upcountry')">Twitter</Link>
          <Link :href="route('upcountry')">Instagram</Link>
          <Link :href="route('upcountry')">Pinterest</Link>
        </div>
        <div class="link-box">
          <p class="footer-box-title">Our offices</p>
          <Link :href="route('upcountry')">Nairobi</Link>
          <Link :href="route('upcountry')">Mombasa</Link>
          <Link :href="route('upcountry')">Nakuru</Link>
          <Link :href="route('upcountry')">Kisumu</Link>
          <Link :href="route('upcountry')">Login as an admin</Link>
        </div>
        <div class="link-box">
          <p class="footer-box-title">Our mission</p>
          <p>To ensure that fraud surrounding acquisition of real estate properties is reduced</p>
          <hr>
          <div class="social-media-icons">
            <i class="fa-brands fa-square-facebook"></i>
            <i class="fa-brands fa-x-twitter"></i>
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-pinterest"></i>
            <i class="fa-brands fa-linkedin"></i>
          </div>
        </div>
      </div>
      <hr>
      <div class="copyright-box">This is the offficial site of <span>Kenya real estate inventory system</span>| kenyarealestate@gmail.com | All Rights Reserved</div>
    </footer>
</template>
