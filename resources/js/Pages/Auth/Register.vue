<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('client.register.store'), {
        onFinish: () => form.reset('password', 'password_confirmation', 'email'),
    });
};
</script>

<template>
    <Head title="Register" />
    <Header/>
    <section class="signup py-2 px-[5%]">
    <div class="signup-title text-lg py-5 font-semibold">Create <span class="text-[#2DE19D]">account</span></div>
    <hr>
    <div class="signup-container flex justify-center items-center">
      <div class="signup-form py-5 px-[2%] w-[500px] my-10 mx-auto bg-[#E8E8E8]">
        <div class="signup-form-title text-lg py-5 font-semibold text-center capitalize">sign up</div>
        <form @submit.prevent="submit" autocomplete="off">
            <div class="form-input bg-[#E8E8E8] border-none w-full block my-2">
                <label for="name" class="text-base block my-2">Enter your name:</label>
              <input type="text" v-model="form.name" class="text-base py-2 px-1 outline-none border-2 border-solid border-[#707070] w-full bg-[#E8E8E8] focus:border-[#2DE19D] transition-all duration-300 ease-in-out">
            </div>
            <InputError class="py-0 px-3 text-base" :message="form.errors.name" />
            <div class="form-input bg-[#E8E8E8] border-none w-full block my-2">
                <label for="email" class="text-base block my-2">Enter email:</label>
              <input type="text" class="text-base py-2 px-1 outline-none border-2 border-solid border-[#707070] w-full bg-[#E8E8E8] focus:border-[#2DE19D] transition-all duration-300 ease-in-out" v-model="form.email">
            </div>
            <InputError class="py-0 px-3 text-base" :message="form.errors.email" />
            <div class="form-input bg-[#E8E8E8] border-none w-full block my-2">
                <label for="password" class="text-base block my-2">Enter your password:</label>
              <input type="password" class="text-base py-2 px-1 outline-none border-2 border-solid border-[#707070] w-full bg-[#E8E8E8] focus:border-[#2DE19D] transition-all duration-300 ease-in-out" v-model="form.password">
            </div>
            <InputError class="py-0 px-3 text-base" :message="form.errors.password" />
            <div class="form-input bg-[#E8E8E8] border-none w-full block my-2">
                <label for="password_confirmation" class="text-base block my-2">Confirm your password:</label>
              <input type="password" class="text-base py-2 px-1 outline-none border-2 border-solid border-[#707070] w-full bg-[#E8E8E8] focus:border-[#2DE19D] transition-all duration-300 ease-in-out" v-model="form.password_confirmation">
            </div>
            <InputError class="py-0 px-3 text-base" :message="form.errors.password_confirmation" />
            <div class="submit-btn my-6">
              <button type="submit" class="btn rounded-3xl border-none outline-none bg-[#2DE19D] text-center text-base capitalize text-black cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#15f49f] py-2 px-6 w-[95%] block mx-auto">Send</button>
            </div>
          </form>
          <p class="account-already my-5 text-base">Already have an account?<Link :href="route('client.login.show')" class="px-10 capitalize hover:underline transition-all duration-300 ease-in-out">login in here</Link></p>
        </div>
    </div>
  </section>
  <Footer/>
</template>
