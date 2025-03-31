<script setup>
import {Link, useForm } from '@inertiajs/vue3'
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
import {ref } from 'vue'


const form = useForm({
    agree: ''
})

const submit = () => {

    form.post(route('client.conditions.check'), {
        onFinish: () => form.reset('agree')
    })
}


</script>

<template>
    <Header/>
    <section class="information py-2 px-[5%]">
                  <div class="success-text" id="success-text">
                      successfully
                  </div>
        <form action="">
        <div class="contact-form-title text-lg py-5 font-semibold"><span class="text-[#2DE19D]">Personal </span> Details</div>
        <div class="contact-form bg-[#E8E8E8] py-5 px-[2%]">
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="name" class="text-base block my-2">Enter Your Fullname:</label>
                  <input type="text" name="name" id="name" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                    <p class="text-[#ff0000] text-base  py-2 w-full">The full name is required</p>
              </div>
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="email" class="text-base block my-2">Enter Your Email:</label>
                  <input type="email" name="email" id="email" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
              </div>
            </div>
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="birthdate" class="text-base block my-2">Enter Your Date of birth:</label>
                  <input type="date"  name="birthdate" id="birthdate" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
              </div>
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="mobilenumber" class="text-base block my-2">Enter Your Mobile Number:</label>
                  <input type="number" name="mobilenumber" id="mobilenumber" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
              </div>
            </div>
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="gender" class="text-base block my-2">Select Your Gender:</label>
                  <select name="gender" id="gender" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
              </div>
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="occupation" class="text-base block my-2">Enter Your Occupation:</label>
                  <input type="text" name="occupation" id="occupation" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
              </div>
            </div>
        </div>
        <div class="contact-form-title text-lg py-5 font-semibold"><span class="text-[#2DE19D]">Identity </span>Details</div>
        <div class="contact-form bg-[#E8E8E8] py-5 px-[2%]">
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="identitydocument" class="text-base block my-2">Select the ID type:</label>
                  <select name="identitydocument" id="identitydocument" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                    <option value="nationalID">National ID</option>
                    <option value="passport">Passport</option>
                    <option value="drivinglicence">Driving licence</option>
                  </select>
              </div>
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="IDnumber" class="text-base block my-2">Enter the ID number:</label>
                  <input type="number" name="IDnumber" id="IDnumber" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
              </div>
            </div>
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="issueplace" class="text-base block my-2">Enter the county issued:</label>
                  <select name="issueplace" id="issueplace" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                    <option value="Mombasa">Mombasa</option>
                    <option value="Taita/Taveta">Taita/Taveta</option>
                    <option value="gGarissa">Garissa</option>
                    <option value="Wajir">Wajir</option>
                    <option value="Mandera">Mandera</option>
                    <option value="Marsabit">Marsabit</option>
                    <option value="Isiolo">Isiolo</option>
                    <option value="West Pokot">West Pokot</option>
                    <option value="Nairobi City">Nairobi City</option>
                  </select>
              </div>
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="expirydate" class="text-base block my-2">Enter expiry date(optional):</label>
                  <input type="date" name="expirydate" id="expirydate" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
              </div>
            </div>
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="countryissued" class="text-base block my-2">Enter the country issued(if non native):</label>
                  <input type="text" name="countryissued" id="countryissued" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
              </div>
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="issueauthority" class="text-base block my-2">Enter the issue authoriry:</label>
                  <input type="text" name="issueauthority" id="issueauthority" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
              </div>
            </div>
        </div>
        <div class="contact-form-title text-lg py-5 font-semibold"><span class="text-[#2DE19D]">Location </span>information</div>
        <div class="contact-form bg-[#E8E8E8] py-5 px-[2%]">
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="county" class="text-base block my-2">Select the country of Residence:</label>
                  <select name="county" id="county" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                    <option value="Mombasa">Mombasa</option>
                    <option value="Taita/Taveta">Taita/Taveta</option>
                    <option value="gGarissa">Garissa</option>
                    <option value="Wajir">Wajir</option>
                    <option value="Mandera">Mandera</option>
                    <option value="Marsabit">Marsabit</option>
                    <option value="Isiolo">Isiolo</option>
                    <option value="West Pokot">West Pokot</option>
                    <option value="Nairobi City">Nairobi City</option>
                  </select>
              </div>

              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="subcounty" class="text-base block my-2">Select the sub-county:</label>
                  <select name="subcounty" id="subcounty" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                    <option value="Westlands">Westlands</option>
                    <option value="Dagoretti North">Dagoretti North</option>
                    <option value="Dagoretti South">Dagoretti South</option>
                    <option value="Langata">Langata</option>
                    <option value="Kibra">Kibra</option>
                    <option value="Roysambu">Roysambu</option>
                    <option value="Kasarani">Kasarani</option>
                    <option value="Ruaraka">Ruaraka</option>
                    <option value="Embakasi South">Embakasi South</option>
                  </select>
              </div>
            </div>
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="ward" class="text-base block my-2">Select the ward:</label>
                  <select name="ward" id="ward" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                    <option value="Nairobi West">Nairobi West</option>
                    <option value="Mugumoini">Mugumoini</option>
                    <option value="South C">South C</option>
                    <option value="Nyayo Highrise">Nyayo Highrise</option>
                  </select>
              </div>
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="zipcode" class="text-base block my-2">Enter the Postal code:</label>
                  <input type="text" name="zipcode" id="zipcode" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
              </div>
            </div>
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="address" class="text-base block my-2">Enter Your Address:</label>
                  <input type="text" name="address" id="address" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
              </div>
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="town" class="text-base block my-2">Enter Your City or Town:</label>
                  <input type="text" name="town" id="town" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
              </div>
            </div>
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="propertyID" class="text-base block my-2">Enter the property ID of the property you want to acquire:</label>
                  <input type="text" name="propertyID" id="propertyID" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
              </div>
            </div>
        </div>
        <!-- <div class="contact-form-title"><span>Documents</span> to attach</div>
        <div class="contact-form">
            <div class="form-row">
              <div class="form-input">
                <input type="file" name="idcopy" id="idcopy" required>
                <label for="idcopy">Attach Original copy of ID:</label>
              </div>
              <div class="form-input">
                <input type="file" name="passport" id="passport" required>
                <label for="passport">Attach a passport photo:</label>
              </div>
            </div>
        </div> -->
        <div class="submit-btn">
          <button class="my-7 w-[300px] block rounded-3xl border-none outline-none bg-[#2DE19D] py-3 px-6 text-center text-base capitalize text-black cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#15f49f]">Submit</button>
        </div>
      </form>
      <hr>
      </section>

    <Footer/>
</template>
