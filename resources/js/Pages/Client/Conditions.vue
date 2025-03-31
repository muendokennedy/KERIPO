<script setup>
import {Link, useForm } from '@inertiajs/vue3'
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
import {ref } from 'vue'


const form = useForm({
    agree: ''
})

const submit = () => {

    form.get(route('client.conditions.check'), {
        onFinish: () => form.reset('agree'),
        preserveScroll: true
    })
}


</script>

<template>
    <Header/>
    <section class="urban py-2 px-[5%]">
        <div class="conditions-title text-lg py-2 font-semibold border-b border-solid border-[#E8E8E8] w-[300px] my-5"><span class="text-[#2DE19D]">Terms</span> and <span>Conditions</span></div>
    <div class="payment-welcome-text">Before you begin the process of the property acquisition, it is a MUST to read these terms and conditions and comply.</div>
    <div class="conditions-box py-5 px-[2%] my-7 bg-[#E8E8E8]">
      <div class="conditions-box-title text-lg py-2 font-semibold">TERMS AND CONDITIONS</div>
      <ul class="list-disc pl-5">
        <li class="condition relative pl-7 leading-10">Before you begin thes you must be serious about acquisition of this property.</li>
        <li class="condition relative pl-7 leading-10">Before you begin this process you must have the funds stated for the acquisition of the property.</li>
        <li class="condition relative pl-7 leading-10">You must be of legal adult age of 18 years and above.</li>
        <li class="condition relative pl-7 leading-10">You must have atleast one of the valid identification documents by the republic of Kenya such as national ID, driving licence or valid passport.</li>
        <li class="condition relative pl-7 leading-10">It is recommended that you proceed with acquisition of the property once you are satisfied with the valuation of the said property.</li>
      </ul>
    </div>
    <div class="agree-title text-lg py-2 font-semibold">Do you agree with the terms and conditions?</div>
    <form @submit.prevent="submit">
      <div class="input-box flex gap-2 mr-10 items-center">
      <input type="radio" v-model="form.agree" value="1" id="agree">
      <label for="agree">I AGREE</label>
      </div>
      <div class="input-box flex gap-2 mr-10 items-center">
      <input type="radio" v-model="form.agree" value="0" id="agree2">
      <label for="agree2">I DO NOT AGREE</label>
      </div>
      <button class="btn my-5 block w-[250px] rounded-3xl border-none outline-none bg-[#2DE19D] py-3 px-6 text-center text-base capitalize text-black cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#15f49f]">continue</button>
    </form>
  <hr>
  </section>
  <Footer/>
</template>
