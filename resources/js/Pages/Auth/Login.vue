<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('client.login.store'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Header/>
    <section class="signup py-2 px-[5%]">
    <div class="signup-title text-lg py-5 font-semibold">Sign in to your <span class="text-[#2DE19D]">account</span></div>
    <hr>
    <div class="signup-container flex justify-center items-center">
      <div class="signup-form py-5 px-[2%] w-[500px] my-10 mx-auto bg-[#E8E8E8]">
        <div class="signup-form-title text-lg py-5 font-semibold text-center capitalize">login</div>
        <form @submit.prevent="submit" autocomplete="off">
            <div class="form-input bg-[#E8E8E8] border-none w-full block my-2">
              <label  class="text-base block my-2">Enter email:</label>
              <input type="text" v-model="form.email" class="text-base py-2 px-1 outline-none border-2 border-solid border-[#707070] w-full bg-[#E8E8E8] focus:border-[#2DE19D] transition-all duration-300 ease-in-out">
            </div>
            <InputError class="p-3 mt-1" :message="form.errors.email" />
            <div class="form-input bg-[#E8E8E8] border-none w-full block my-2">
              <label  class="text-base block my-2">Enter your password:</label>
              <input type="password" v-model="form.password" class="text-base py-2 px-1 outline-none border-2 border-solid border-[#707070] w-full bg-[#E8E8E8] focus:border-[#2DE19D] transition-all duration-300 ease-in-out">
            </div>
            <InputError class="p-3 mt-1" :message="form.errors.password" />
            <div class="submit-btn mt-5">
              <button type="submit" class="btn rounded-3xl border-none outline-none bg-[#2DE19D] text-center text-base capitalize text-black cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#15f49f] py-2 px-6 w-[95%] block mx-auto">Continue</button>
            </div>
          </form>
          <p class="account-already my-5 text-base">Don't have an account yet?<Link :href="route('client.register.show')" class="px-10 capitalize hover:underline transition-all duration-300 ease-in-out">sign up here</Link></p>
        </div>
    </div>
  </section>
  <Footer/>
</template>
