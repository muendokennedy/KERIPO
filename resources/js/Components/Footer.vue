<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <footer class="text-sm bg-[#DAF8F3] py-10 px-[5%] mt-12">
      <div class="footer-info-box grid grid-cols-4">
        <div class="w-[250px] link-box">
          <p class="footer-box-title py-3 px-0 text-base font-semibold text-[#2DE19D]">Main Links</p>
          <Link class="block text-black py-1 px-0 my-4 mx-0 transition-all duration-300 ease-in-out hover:text-[#2DE19D]" :href="route('client.home')">Home</Link>
          <Link class="block text-black py-1 px-0 my-4 mx-0 transition-all duration-300 ease-in-out hover:text-[#2DE19D]" :href="route('client.urban')">Urban Plots</Link>
          <Link class="block text-black py-1 px-0 my-4 mx-0 transition-all duration-300 ease-in-out hover:text-[#2DE19D]" :href="route('client.apartments')">Residential Apartments</Link>
          <Link class="block text-black py-1 px-0 my-4 mx-0 transition-all duration-300 ease-in-out hover:text-[#2DE19D]" :href="route('client.upcountry')">Upcountry Plots</Link>
          <Link class="block text-black py-1 px-0 my-4 mx-0 transition-all duration-300 ease-in-out hover:text-[#2DE19D]" :href="route('client.houses')">Houses</Link>
        </div>
        <div class="w-[250px] link-box">
          <p class="footer-box-title py-3 px-0 text-base font-semibold text-[#2DE19D]">Social media links</p>
          <Link class="block text-black py-1 px-0 my-4 mx-0 transition-all duration-300 ease-in-out hover:text-[#2DE19D]" :href="route('client.upcountry')">Facebook</Link>
          <Link class="block text-black py-1 px-0 my-4 mx-0 transition-all duration-300 ease-in-out hover:text-[#2DE19D]" :href="route('client.upcountry')">Twitter</Link>
          <Link class="block text-black py-1 px-0 my-4 mx-0 transition-all duration-300 ease-in-out hover:text-[#2DE19D]" :href="route('client.upcountry')">Instagram</Link>
          <Link class="block text-black py-1 px-0 my-4 mx-0 transition-all duration-300 ease-in-out hover:text-[#2DE19D]" :href="route('client.upcountry')">Pinterest</Link>
        </div>
        <div class="w-[250px] link-box">
          <p class="footer-box-title py-3 px-0 text-base font-semibold text-[#2DE19D]">Our offices</p>
          <Link class="block text-black py-1 px-0 my-4 mx-0 transition-all duration-300 ease-in-out hover:text-[#2DE19D]" :href="route('client.upcountry')">Nairobi</Link>
          <Link class="block text-black py-1 px-0 my-4 mx-0 transition-all duration-300 ease-in-out hover:text-[#2DE19D]" :href="route('client.upcountry')">Mombasa</Link>
          <Link class="block text-black py-1 px-0 my-4 mx-0 transition-all duration-300 ease-in-out hover:text-[#2DE19D]" :href="route('client.upcountry')">Nakuru</Link>
          <Link class="block text-black py-1 px-0 my-4 mx-0 transition-all duration-300 ease-in-out hover:text-[#2DE19D]" :href="route('client.upcountry')">Kisumu</Link>
          <Link class="block text-black py-1 px-0 my-4 mx-0 transition-all duration-300 ease-in-out hover:text-[#2DE19D]" :href="route('admin.login.show')">Login as an admin</Link>
        </div>
        <div class="w-[250px] link-box">
          <p class="footer-box-title py-3 px-0 text-base font-semibold text-[#2DE19D]">Our mission</p>
          <p class="py-3 px-0">To ensure that fraud surrounding acquisition of real estate properties is reduced</p>
          <hr>
          <div class="social-media-icons flex gap-5 my-5 mx-0 text-black">
            <i class="text-base transition-all duration-300 ease-in-out hover:text-[#2DE19D]fa-brands fa-square-facebook"></i>
            <i class="text-base transition-all duration-300 ease-in-out hover:text-[#2DE19D]fa-brands fa-x-twitter"></i>
            <i class="text-base transition-all duration-300 ease-in-out hover:text-[#2DE19D]fa-brands fa-instagram"></i>
            <i class="text-base transition-all duration-300 ease-in-out hover:text-[#2DE19D]fa-brands fa-pinterest"></i>
            <i class="text-base transition-all duration-300 ease-in-out hover:text-[#2DE19D]fa-brands fa-linkedin"></i>
          </div>
        </div>
      </div>
      <hr>
      <div class="copyright-box text-center pt-14">This is the official site of <span class="text-[#2DE19D]">Kenya real estate inventory system</span>| kenyarealestate@gmail.com | All Rights Reserved</div>
    </footer>
</template>
