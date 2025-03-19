<script setup>
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
import { Link, usePage } from '@inertiajs/vue3'

const authenticatedUser = usePage().props.auth.user




</script>

<template>
    <Header/>
    <section class="py-2 px-[5%]">
    <div class="welcome-section flex items-center w-full justify-between my-5 mx-0">
        <div v-if="$page.props.auth.user" class="home-title text-lg py-5 px-0 font-semibold">
            Hello
            <span class="text-[#2DE19D]">{{ authenticatedUser.name }}</span>
            Welcome back
        </div>
      <div v-else class="home-title text-lg py-5 px-0 font-semibold">Welcome to the only
        <span class="text-[#2DE19D]">authentic</span>
        realestate portal in Kenya
      </div>
      <div v-if="$page.props.auth.user" class="signup-login flex items-center justify-end gap-8 w-[20%]">
          <Link :href="route('client.logout')" as="button" method="post" class="rounded-3xl border-none outline-none bg-[#2DE19D] py-3 px-6 text-center text-base capitalize text-black cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#15f49f]">logout</Link>
      </div>
      <div v-else class="signup-login flex items-center justify-end gap-8 w-[20%]">
          <Link :href="route('client.register.show')" class="rounded-3xl border-none outline-none bg-[#2DE19D] py-3 px-6 text-center text-base capitalize text-black cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#15f49f]">signup</Link>
          <Link :href="route('client.login.show')" class="rounded-3xl border-none outline-none bg-[#2DE19D] py-3 px-6 text-center text-base capitalize text-black cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#15f49f]">login</Link>
        </div>
    </div>
    <div class="home-welcome-text">Welcome to Real estate Kenya, official website. We provide the interface for reliable accessibility of all the real estate dealerships in Kenya. We ensure that the process is smooth and fraud free. We also connect people with a pool of Real Estate properties that would never have existed in  our absence. Our mission is to bring clarity to the whole process and prevent any occurrences of frauds. If you wish to have more clarity feel free to call our customer care who is available during the public or government work ours or visit one of our offices in the following Kenyan cities: Nairobi, Mombasa, Nakuru, Kisumu.</div>
    <div class="home-title text-lg py-5 px-0 font-semibold">We deal in:</div>
    <hr>
    <div class="home-property-box my-10 mx-0">
      <div class="home-property-box-title text-lg font-semibold">Real estate <span class="text-[#2DE19D]">Apartments</span></div>
      <div class="property-box my-5 mx-0 flex justify-between w-full">
        <div class="property-image h-[300px] w-[500px]">
          <img class="h-full w-full rounded-md" src="images/appartment.jpg" alt="">
        </div>
        <div class="property-details w-[600px]">
          We have Real estate Apartments. These exist in several forms. We may have someone who is selling an already existing Apartment, an apartment that is fresh from construction and is under sale and many other other situations. All these have different prices and we are not in control of the purchase prices.
          They appear as valued by the owners.
          <Link class="rounded-3xl border-none outline-none bg-[#2DE19D] py-3 px-6 text-center text-base capitalize text-black cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#15f49f] block w-36 my-5 mx-0" :href="route('client.apartments')" >see more</Link>
        </div>
      </div>
    </div>
    <hr>
    <div class="home-property-box my-10 mx-0">
      <div class="home-property-box-title text-lg font-semibold"><span class="text-[#2DE19D]">Urban </span>Land Plots </div>
      <div class="property-box my-5 mx-0 flex justify-between w-full">
        <div class="property-image h-[300px] w-[500px]">
          <img class="h-full w-full rounded-md" src="images/land plot.jpg" alt="">
        </div>
        <div class="property-details w-[600px]">We have plots of land which are specifically located in the urban or metrolpolitan regions. These of course are more expensive than the other similar plots of land and are much smaller. However they involve long processes of legal ownership authenticity. Over 90% of them are sold already built up. You can see more about these properties by clicking the button below.
          <Link class="rounded-3xl border-none outline-none bg-[#2DE19D] py-3 px-6 text-center text-base capitalize text-black cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#15f49f] block w-36 my-5 mx-0" :href="route('client.urban')">see more</Link>
        </div>
      </div>
    </div>
    <hr>
    <div class="home-property-box my-10 mx-0">
      <div class="home-property-box-title text-lg font-semibold"><span class="text-[#2DE19D]">Upcountry </span>Land Plots </div>
      <div class="property-box my-5 mx-0 flex justify-between w-full">
        <div class="property-image h-[300px] w-[500px]">
          <img class="h-full w-full rounded-md" src="images/land plot2.jpeg" alt="">
        </div>
        <div class="property-details w-[600px]">We have plots of land which are mainly located in the rural areas and the remote regions of the country. These plots of land are mainly large in size. Some are located in rainy areas and most of them are more expensive, as valued by their owners while others are located in dry areas and most of them tend to be less expensive or even affordable in the end. To see more about these types of properties, click the link below.
          <Link class="rounded-3xl border-none outline-none bg-[#2DE19D] py-3 px-6 text-center text-base capitalize text-black cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#15f49f] block w-36 my-5 mx-0" :href="route('client.upcountry')">see more</Link>
        </div>
      </div>
    </div>
    <hr>
    <div class="home-property-box my-10 mx-0">
      <div class="home-property-box-title text-lg font-semibold"><span class="text-[#2DE19D]">Houses </span>on sale</div>
      <div class="property-box my-5 mx-0 flex justify-between w-full">
        <div class="property-image h-[300px] w-[500px]">
          <img class="h-full w-full rounded-md" src="images/house.jpg" alt="">
        </div>
        <div class="property-details w-[600px]">We have houses on sale. These houses come in the following forms: old houses which are well taken care of and  are of high market value, new houses which are fresh from construction or even many houses in an estate. The houses are mainly from the three cities of Kenya which are Nairobi, Mombasa, Nakuru and Kisumu. Neverthesless we still have houses from other smaller towns of Kenya thought they account for much lower percentage of the overall number of house properties. To see more about the house properties avaible, click the link below.
          <Link class="rounded-3xl border-none outline-none bg-[#2DE19D] py-3 px-6 text-center text-base capitalize text-black cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#15f49f] block w-36 my-5 mx-0" :href="route('client.houses')">see more</Link>
        </div>
      </div>
    </div>
    <hr>
    </section>
    <Footer/>
</template>
<style scoped>
</style>
