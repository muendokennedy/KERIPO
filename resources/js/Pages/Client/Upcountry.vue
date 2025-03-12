<script setup>
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <Header/>
    <section class="urban">
    <div class="urban-title"><span>Upcountry</span> Land plots</div>
    <div class="urban-welcome-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Inventore, saepe. Quisquam nihil ipsa itaque laboriosam voluptates fugit animi reiciendis odio, magni tenetur alias illum repellendus soluta eos labore, impedit deserunt mollitia? Reiciendis nihil aut sunt sit, neque quis expedita voluptas consequuntur deserunt laboriosam obcaecati facere. Magni provident nostrum iusto eaque dignissimos expedita et assumenda, iste eveniet voluptates voluptatum ad voluptatibus repellat voluptas in. Dicta cum veritatis harum maiores, itaque possimus, voluptas reiciendis ab rem iure vel dolorem aperiam. Voluptatibus, adipisci accusamus. Aspernatur quis repudiandae iusto non eius soluta dicta cumque eos hic, animi tempore temporibus similique cupiditate asperiores optio totam?</div>
    <hr>
    <div class="table-container overflow-x-auto">
            <table>
            <thead>
              <tr>
                <th class="py-6 px-2">Property Id</th>
                <th class="py-6 px-2">Location</th>
                <th class="py-6 px-2">Owner</th>
                <th class="py-6 px-2">price</th>
                <th class="py-6 px-2">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  <td class="py-6 px-2">87757587</td>
                  <td class="py-6 px-2">Kitui</td>
                  <td class="py-6 px-2">Julius Malombe</td>
                  <td class="py-6 px-2">Ksh.83,303</td>
                  <td class="py-6 px-2">Sold</td>
                </tr>
            </tbody>
            </table>
          </div>
    <hr>
    <div class="call-to-action">Want to get yourself a piece of land?</div>
    <div class="call-to-action-details">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Assumenda facere numquam sapiente praesentium maiores ipsum, fugiat consectetur tenetur veniam quam dolor at pariatur vitae cupiditate eligendi ullam quos optio consequatur earum dolores expedita. Repellendus perferendis incidunt quaerat explicabo quia harum distinctio, ad accusamus dolorum tempora vel nostrum ullam. Aliquid, debitis?</div>
    <Link :href="route('client.upcountry')" class="btn">Click here to begin the process</Link>
    <hr>
  </section>
  <Footer/>
</template>
