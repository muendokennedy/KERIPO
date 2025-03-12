<script setup>
// import {CameraIcon, CloudArrowUpIcon} from '@heroicons/vue/24/solid'
import { useForm, Link } from '@inertiajs/vue3'
import {ref} from 'vue'

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    avatar: null
})

const avatarImageSource = ref(null)

const onAvatarChoose = (event) => {
    form.avatar = event.target.files[0]

    if(form.avatar){
        const reader = new FileReader()

        reader.onload = () => {
            avatarImageSource.value = reader.result;
        }

        reader.readAsDataURL(form.avatar)
    }

     console.log(form.avatar)
}

const cancelAvatarImage = () => {
    form.avatar = null,
    avatarImageSource.value = null
}

const submit = () => {
    form.post(route('admin.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
        onSuccess: () => {
            cancelAvatarImage()
        }
    },

 )
}


</script>

<template>
    <section class="min-h-screen">
      <main class="bg-[#E4E7F3] pt-20 px-[3%] pb-4">
        <div class="sigup-box bg-white p-4 px-8 rounded-md w-[30rem] mx-auto">
          <form @submit.prevent="submit">
            <h2 class="text-center text-xl text-[#042EFF] font-semibold capitalize py-4 border-b-2">signup as an admin</h2>
            <div class="input-box">
              <label for="name" class="capitalize block py-3">Enter name:</label>
              <input type="text" v-model="form.name" id="name" class="p-2 rounded-md border-2 outline-none w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
              <p v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</p>
            </div>
            <div class="input-box mb-4">
              <label for="email" class="capitalize block py-3">Enter email:</label>
              <input type="text" v-model="form.email" id="email" class="p-2 rounded-md border-2 outline-none w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
              <p v-if="form.errors.email" class="text-red-500">{{ form.errors.email }}</p>
            </div>
            <p class="mb-4">Upload a profile photo:</p>
            <div class="border-[#042EFF]"
            :class="avatarImageSource ? 'border-0' : 'border-2 border-dashed'">
                <div v-if="avatarImageSource" class="flex justify-center items-center rounded-full">
                    <div class="group relative border-2 h-40 w-40 border-[#042EFF] rounded-full">
                        <div class="h-full w-full rounded-full">
                            <img :src="avatarImageSource" alt="" class="h-full w-full object-cover rounded-full">
                        </div>
                        <span class="opacity-0 group-hover:opacity-100 hover:g: absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                            <CameraIcon class="size-8"/>
                        </span>
                    </div>
                </div>
                <div v-else class="flex flex-col items-center">
                    <span class="text-4xl text-[#042EFF]">
                            <!-- <input type="file" @change="onAvatarChoose" @click.stop class="absolute opacity-0 left-0 top-0 right-0 bottom-0"> -->
                            <CloudArrowUpIcon class="size-8"/>
                    </span>
                    <div class="initial-info">
                      <span  class="block py-2">Browse image:</span>
                    </div>
                </div>
              </div>
            <div class="input-box">
              <label for="password" class="capitalize block py-3">Enter password</label>
              <input type="password" v-model="form.password" id="password" class="p-2 rounded-md border-2 outline-none w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
              <p v-if="form.errors.password" class="text-red-500">{{ form.errors.password }}</p>
            </div>
            <div class="input-box">
              <label for="password_confirmation" class="capitalize block py-3">confirm your password:</label>
              <input type="password" v-model="form.password_confirmation"  id="password_confirmation" class="p-2 rounded-md border-2 outline-none w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
              <p v-if="form.errors.password_confirmation" class="text-red-500">{{ form.errors.password_confirmation }}</p>
            </div>
            <button type="submit" class="text-white bg-[#042EFF] block w-full px-4 py-3 rounded-md my-6 capitalize hover:bg-[#384857] transition-all duration-300 ease-in-out">signup</button>
            <p class="capitalize"><span>already have an account? </span> <Link :href="route('admin.login.show')" class="text-[#042eff] hover:underline transition-all duration-300 ease-in-out">login here</Link></p>
          </form>
        </div>
      </main>
    </section>
</template>
