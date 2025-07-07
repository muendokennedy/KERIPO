<script setup>
import {Link } from '@inertiajs/vue3'
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'

const props = defineProps({
    urbanPlots: {
        type: Array,
        required: true
    }
})
</script>

<template>
    <Header/>
    <section class="urban py-2 px-[5%]">
    <div class="urban-title w-[200px] text-lg py-5 font-semibold border-b border-solid border-black"><span class="text-[#2DE19D]">Urban</span> Land plots</div>
    <div class="urban-welcome-text my-5">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Inventore, saepe. Quisquam nihil ipsa itaque laboriosam voluptates fugit animi reiciendis odio, magni tenetur alias illum repellendus soluta eos labore, impedit deserunt mollitia? Reiciendis nihil aut sunt sit, neque quis expedita voluptas consequuntur deserunt laboriosam obcaecati facere. Magni provident nostrum iusto eaque dignissimos expedita et assumenda, iste eveniet voluptates voluptatum ad voluptatibus repellat voluptas in. Dicta cum veritatis harum maiores, itaque possimus, voluptas reiciendis ab rem iure vel dolorem aperiam. Voluptatibus, adipisci accusamus. Aspernatur quis repudiandae iusto non eius soluta dicta cumque eos hic, animi tempore temporibus similique cupiditate asperiores optio totam?</div>
    <hr>

    <div class="table-container overflow-x-auto">
        <table class="w-full my-5 border-collapse">
            <thead>
                <tr>
                <th class="py-4 px-2 bg-[#2DE19D] text-left border-t border-solid border-black border-b">Property Id</th>
                <th class="py-4 px-2 bg-[#2DE19D] text-left border-t border-solid border-black border-b">Location</th>
                <th class="py-4 px-2 bg-[#2DE19D] text-left border-t border-solid border-black border-b">Owner</th>
                <th class="py-4 px-2 bg-[#2DE19D] text-left border-t border-solid border-black border-b">price</th>
                <th class="py-4 px-2 bg-[#2DE19D] text-left border-t border-solid border-black border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(urbanPlot, index) in urbanPlots" :key="index">
                  <td class="py-4 px-2">{{ urbanPlot.propertyId }}</td>
                  <td class="py-4 px-2">{{ urbanPlot.location }}</td>
                  <td class="py-4 px-2">{{ urbanPlot.ownersName }}</td>
                  <td class="py-4 px-2">{{ urbanPlot.propertyValuation }}</td>
                  <td class="py-4 px-2">{{ urbanPlot.acquisitionStatus }}</td>
                </tr>
                </tbody>
                </table>
          </div>
    <hr>
    <div class="call-to-action text-lg py-5 font-semibold">Want to get yourself a piece of land?</div>
    <div class="call-to-action-details">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Assumenda facere numquam sapiente praesentium maiores ipsum, fugiat consectetur tenetur veniam quam dolor at pariatur vitae cupiditate eligendi ullam quos optio consequatur earum dolores expedita. Repellendus perferendis incidunt quaerat explicabo quia harum distinctio, ad accusamus dolorum tempora vel nostrum ullam. Aliquid, debitis?</div>
    <Link  as="button" :href="route('client.conditions')" class="my-7 w-[300px] block rounded-3xl border-none outline-none bg-[#2DE19D] py-3 px-6 text-center text-base capitalize text-black cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#15f49f]">Click here to begin the process</Link>
    <hr>
  </section>
  <Footer/>
</template>
