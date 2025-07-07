<script setup>
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
</script>

<template>
<Header/>
    <section class="urban py-2 px-[5%]">
        <div class="conditions-title text-lg py-2 font-semibold border-b border-solid border-[#E8E8E8] w-[300px] my-5"><span class="text-[#2DE19D]">information</span> <span> Received</span></div>
    <div class="payment-welcome-text">Congratulations, your submitted information has been received successfully</div>
    <div class="conditions-box py-5 px-[2%] my-7 bg-[#E8E8E8]">
      <div class="conditions-box-title text-lg py-2 font-semibold">WHAT TO DO NEXT</div>
      <ul class="list-disc pl-5">
        <li class="condition relative pl-7 leading-10">You are required to wait for a maximum of 48 hours to gain approval</li>
        <li class="condition relative pl-7 leading-10">You will be required to pay a legal processing fee of KES. 12,000 via Mpesa.</li>
        <li class="condition relative pl-7 leading-10">You are required to prepare for a field tour</li>
      </ul>
    </div>
    <div class="agree-title text-lg py-2 font-semibold">Do you agree with the terms and conditions?</div>
  <hr>
  </section>
  <Footer/>
</template>
