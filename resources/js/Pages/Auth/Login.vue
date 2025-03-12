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
    <section class="signup">
    <div class="signup-title">Sign in to your <span>account</span></div>
    <hr>
    <div class="signup-container">
      <div class="signup-form">
        <div class="signup-form-title">login</div>
        <form @submit.prevent="submit">
            <div class="form-input bg-[#E8E8E8] border-none">
              <label for="email" class="text-2xl">Enter email:</label>
              <input type="text" v-model="form.email" class="text-2xl">
            </div>
            <InputError class="p-3 mt-1" :message="form.errors.email" />
            <div class="form-input bg-[#E8E8E8] border-none">
              <label for="password" class="text-2xl">Enter your password:</label>
              <input type="password" v-model="form.password" class="text-2xl" name="password" id="password">
            </div>
            <InputError class="p-3 mt-1" :message="form.errors.password" />
            <div class="submit-btn">
              <button type="submit" class="btn">Send</button>
            </div>
          </form>
          <p class="account-already">Don't have an account yet?<Link :href="route('client.register.show')">sign up here</Link></p>
        </div>
    </div>
  </section>
  <Footer/>
</template>
