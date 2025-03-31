<script setup>
import {Link, useForm } from '@inertiajs/vue3'
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
import {ref, watchEffect } from 'vue'
import InputError from '@/Components/InputError.vue'

const props = defineProps({
    name: String,
    email: String
})

console.log(props.name)


const form = useForm({
    fullName: props.name,
    email: '',
    birthDate: '',
    mobileNumber: '',
    gender:'',
    occupation: '',
    identityDocument: '',
    idNumber: '',
    issueLocation: '',
    expiryDate: '',
    countryIssued: '',
    issueAuthority: '',
    county: '',
    subCounty: '',
    ward: '',
    postalCode: '',
    address: '',
    town: '',
    propertyId: ''
})


watchEffect(() => {
    form.fullName = props.name ?? '',
    form.email = props.email ?? ''
})
const submit = () => {

    form.post(route('client.information.store'), {
        preserveScroll: true
    })
}


</script>

<template>
    <Header/>
    <section class="information py-2 px-[5%]">
                  <div class="success-text" id="success-text">
                      successfully
                  </div>
        <form @submit.prevent="submit">
        <div class="contact-form-title text-lg py-5 font-semibold"><span class="text-[#2DE19D]">Personal </span> Details</div>
        <div class="contact-form bg-[#E8E8E8] py-5 px-[2%]">
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="name" class="text-base block my-2">Enter Your Fullname:</label>
                  <input type="text" v-model="form.fullName"  id="name" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                  <InputError class="mt-1" :message="form.errors.fullname" />
                </div>
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="email" class="text-base block my-2">Enter Your Email:</label>
                  <input type="email" v-model="form.email" id="email" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                  <InputError class="mt-1" :message="form.errors.email" />
                </div>
            </div>
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="birthdate" class="text-base block my-2">Enter Your Date of birth:</label>
                  <input type="date" v-model="form.birthDate" id="birthdate" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                  <InputError class="mt-1" :message="form.errors.birthDate" />
              </div>
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="mobilenumber" class="text-base block my-2">Enter Your Mobile Number:</label>
                  <input type="number" v-model="form.mobileNumber" id="mobilenumber" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                  <InputError class="mt-1" :message="form.errors.mobileNumber" />
              </div>
            </div>
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="gender" class="text-base block my-2">Select Your Gender:</label>
                  <select v-model="form.gender" id="gender" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
                  <InputError class="mt-1" :message="form.errors.gender" />
              </div>
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="occupation" class="text-base block my-2">Enter Your Occupation:</label>
                  <input type="text" v-model="form.occupation" id="occupation" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                  <InputError class="mt-1" :message="form.errors.occupation" />
              </div>
            </div>
        </div>
        <div class="contact-form-title text-lg py-5 font-semibold"><span class="text-[#2DE19D]">Identity </span>Details</div>
        <div class="contact-form bg-[#E8E8E8] py-5 px-[2%]">
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="identitydocument" class="text-base block my-2">Select the ID type:</label>
                  <select v-model="form.identityDocument" id="identitydocument" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                    <option value="nationalID">National ID</option>
                    <option value="passport">Passport</option>
                    <option value="drivinglicence">Driving licence</option>
                  </select>
                  <InputError class="mt-1" :message="form.errors.identityDocument" />
              </div>
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="IDnumber" class="text-base block my-2">Enter the ID number:</label>
                  <input type="number" v-model="form.idNumber" id="IDnumber" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                  <InputError class="mt-1" :message="form.errors.idNumber" />
              </div>
            </div>
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="issueplace" class="text-base block my-2">Enter the county issued:</label>
                  <select v-model="form.issueLocation" id="issueplace" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
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
                  <InputError class="mt-1" :message="form.errors.issueLocation" />
              </div>
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="expirydate" class="text-base block my-2">Enter expiry date(optional):</label>
                  <input type="date" v-model="form.expiryDate" id="expirydate" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                  <InputError class="mt-1" :message="form.errors.expiryDate" />
              </div>
            </div>
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="countryissued" class="text-base block my-2">Enter the country issued(if non native):</label>
                  <input type="text" v-model="form.countryIssued" id="countryissued" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                  <InputError class="mt-1" :message="form.errors.countryIssued" />
              </div>
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="issueauthority" class="text-base block my-2">Enter the issue authoriry:</label>
                  <input type="text" v-model="form.issueAuthority" id="issueauthority" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                  <InputError class="mt-1" :message="form.errors.issueAuthority" />
              </div>
            </div>
        </div>
        <div class="contact-form-title text-lg py-5 font-semibold"><span class="text-[#2DE19D]">Location </span>information</div>
        <div class="contact-form bg-[#E8E8E8] py-5 px-[2%]">
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="county" class="text-base block my-2">Select the country of Residence:</label>
                  <select v-model="form.county" id="county" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
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
                  <InputError class="mt-1" :message="form.errors.county" />
              </div>

              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="subcounty" class="text-base block my-2">Select the sub-county:</label>
                  <select v-model="form.subCounty" id="subcounty" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
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
                  <InputError class="mt-1" :message="form.errors.subCounty" />
              </div>
            </div>
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="ward" class="text-base block my-2">Select the ward:</label>
                  <select v-model="form.ward" id="ward" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                    <option value="Nairobi West">Nairobi West</option>
                    <option value="Mugumoini">Mugumoini</option>
                    <option value="South C">South C</option>
                    <option value="Nyayo Highrise">Nyayo Highrise</option>
                  </select>
                  <InputError class="mt-1" :message="form.errors.ward" />
              </div>
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="postalCode" class="text-base block my-2">Enter the Postal code:</label>
                  <input type="text" v-model="form.postalCode" id="postalCode" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                  <InputError class="mt-1" :message="form.errors.postalCode" />
              </div>
            </div>
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="address" class="text-base block my-2">Enter Your Address:</label>
                  <input type="text" v-model="form.address" id="address" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                  <InputError class="mt-1" :message="form.errors.address" />
              </div>
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="town" class="text-base block my-2">Enter Your City or Town:</label>
                  <input type="text" v-model="form.town" id="town" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                  <InputError class="mt-1" :message="form.errors.town" />
              </div>
            </div>
            <div class="form-row flex justify-between my-1">
              <div class="form-input w-[45%] block my-1 bg-[#E8E8E8] border-none">
                  <label for="propertyID" class="text-base block my-2">Enter the property ID of the property you want to acquire:</label>
                  <input type="text" v-model="form.propertyId" id="propertyID" class="text-base py-2 px-1 outline-none border border-solid border-[#707070] w-full bg-[#E8E8E8] transition-all duration-300 ease-in-out focus:border-[#2DE19D]">
                  <InputError class="mt-1" :message="form.errors.propertyId" />
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
          <button type="submit" class="my-7 w-[300px] block rounded-3xl border-none outline-none bg-[#2DE19D] py-3 px-6 text-center text-base capitalize text-black cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#15f49f]">Submit</button>
        </div>
      </form>
      <hr>
      </section>

    <Footer/>
</template>
