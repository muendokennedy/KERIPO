<script setup>
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
import { Link } from '@inertiajs/vue3'

</script>

<template>
    <Header/>
    <section class="contact urban py-2 px-[5%]">
    <div class="contact-title text-lg py-5 font-semibold border-b border-solid border-black w-[200px]">Talk to <span class="text-[#2DE19D]">us</span></div>
    <div class="contact-welcome-text my-5">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Inventore, saepe. Quisquam nihil ipsa itaque laboriosam voluptates fugit animi reiciendis odio, magni tenetur alias illum repellendus soluta eos labore, impedit deserunt mollitia? Reiciendis nihil aut sunt sit, neque quis expedita voluptas consequuntur deserunt laboriosam obcaecati facere. Magni provident nostrum iusto eaque dignissimos expedita et assumenda, iste eveniet voluptates voluptatum ad voluptatibus repellat voluptas in. Dicta cum veritatis harum maiores, itaque possimus, voluptas reiciendis ab rem iure vel dolorem aperiam. Voluptatibus, adipisci accusamus. Aspernatur quis repudiandae iusto non eius soluta dicta cumque eos hic, animi tempore temporibus similique cupiditate asperiores optio totam?</div>
    <hr>
    <div class="contact-form-title text-lg py-5 font-semibold">Contact</div>
    <div class="contact-form bg-[#E8E8E8] py-5 px-[2%]">
      <form action="FORM/contact.php" method="POST">
        <div class="form-row flex justify-between my-1">
          <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
            <input type="text" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]" name="fname" id="fname">
            <label for="fname" class="text-base block my-2">Enter first name:</label>
          </div>
          <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
            <input type="text" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]" name="lname" id="lname">
            <label for="lname" class="text-base block my-2">Enter second name:</label>
          </div>
        </div>
        <div class="form-row flex justify-between my-1">
          <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
            <input type="text" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]" name="email" id="email">
            <label for="email" class="text-base block my-2">Enter email:</label>
          </div>
          <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
            <input type="text" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]" name="subject" id="subject">
            <label for="subject" class="text-base block my-2">Enter subject:</label>
          </div>
        </div>
        <div class="form-row">
          <div class="form-input textarea w-full bg-[#E8E8E8] border-none">
            <textarea name="message" class="text-base resize-none py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8]" id="message" cols="10" rows="5"></textarea>
            <label for="message" class="text-base block my-2">Enter your message:</label>
          </div>
        </div>
        <div class="submit-btn">
          <button type="submit" class="my-7 block rounded-3xl border-none outline-none bg-[#2DE19D] py-3 px-6 text-center text-base capitalize text-black cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#15f49f] w-[200px] font-semibold">Send</button>
        </div>
      </form>
    </div>
    <div class="map">
      <div class="map-title text-lg py-5 font-semibold">Location of our main <span class="text-[#2DE19D]">offices</span></div>
      <iframe class="w-full h-[500px] mt-5 mb-10" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8308746654557!2d36.77897851514728!3d-1.2747547359742113!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f19fd9b65c0ef%3A0xbac0db1b9cbf73e!2sArchives%20Tower%2C%20Nairobi!5e0!3m2!1sen!2ske!4v1680009140682!5m2!1sen!2ske" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <hr>
  </section>
    <Footer/>
</template>
