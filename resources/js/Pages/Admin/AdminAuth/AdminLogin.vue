<script setup>
import { useForm, Link } from "@inertiajs/vue3"

const form = useForm({
    email: '',
    password: ''
})

const submit = () => {
    form.post(route('admin.authenticate'), {
        onFinish: () => form.reset('password')
    })
}


</script>

<template>
    <section class="min-h-screen">
      <main class="bg-[#E4E7F3] pt-20 px-[3%] pb-4 min-h-screen">
        <div class="sigup-box bg-white p-4 px-8 rounded-md w-[30rem] mx-auto">
          <form @submit.prevent="submit">
            <h2 class="text-center text-xl text-[#042EFF] font-semibold capitalize py-4 border-b-2">Login in as admin</h2>
            <div class="input-box">
              <label for="email" class="capitalize block py-3">Enter your email:</label>
              <input type="text" v-model="form.email" id="email" class="p-2 rounded-md border-2 outline-none w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus
              :class="[
                form.errors.email ? 'border-red-500' : 'border-[#042EFF]'
              ]">
              <p v-if="form.errors.email" class="text-red-500">{{ form.errors.email }}</p>
            </div>
            <div class="input-box">
              <label for="password" class="capitalize block py-3">Enter your password</label>
              <input type="password" v-model="form.password" id="password" class="p-2 rounded-md border-2 outline-none w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus
              :class="[
                form.errors.email ? 'border-red-500' : 'border-[#042EFF]'
              ]">
            </div>
            <p class="capitalize my-4"><Link :href="route('admin.register.show')" class="text-[#042eff] hover:underline transition-all duration-300 ease-in-out">Forgot password</Link></p>
            <button type="submit" class="text-white bg-[#042EFF] block w-full px-4 py-3 rounded-md my-6 capitalize hover:bg-[#384857] transition-all duration-300 ease-in-out">log in as admin</button>
          </form>
        </div>
      </main>
    </section>
</template>
