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
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />
    <Header/>
    <section class="signup">
    <div class="signup-title">Create <span>account</span></div>
    <hr>
    <div class="signup-container">
      <div class="signup-form">
        <div class="signup-form-title">sign up</div>
        <form @submit.prevent="submit">
            <div class="form-input bg-[#E8E8E8] border-none">
                <label for="name" class="text-2xl">Enter your name:</label>
              <input type="text" class="text-2xl" v-model="form.name">
            </div>
            <InputError class="py-0 px-3" :message="form.errors.name" />
            <div class="form-input bg-[#E8E8E8] border-none">
                <label for="email" class="text-2xl">Enter email:</label>
              <input type="text" class="text-2xl" v-model="form.email">
            </div>
            <InputError class="py-0 px-3" :message="form.errors.email" />
            <div class="form-input bg-[#E8E8E8] border-none">
                <label for="password" class="text-2xl">Enter your password:</label>
              <input type="password" class="text-2xl" v-model="form.password">
            </div>
            <InputError class="py-0 px-3" :message="form.errors.password" />
            <div class="form-input bg-[#E8E8E8] border-none">
                <label for="password_confirmation" class="text-2xl">Confirm your password:</label>
              <input type="password" class="text-2xl" v-model="form.password_confirmation">
            </div>
            <InputError class="py-0 px-3" :message="form.errors.password_confirmation" />
            <div class="submit-btn">
              <button type="submit" class="btn">Send</button>
            </div>
          </form>
          <p class="account-already">Already have an account?<Link :href="route('client.login')">login in here</Link></p>
        </div>
    </div>
  </section>
  <Footer/>
</template>
