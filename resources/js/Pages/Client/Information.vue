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
    <section class="information contact">
                  <div class="success-text" id="success-text">
                      successfully
                  </div>
        <form action="">
        <div class="contact-form-title"><span>Personal </span> Details</div>
        <div class="contact-form">
            <div class="form-row">
              <div class="form-input">
                  <label for="name">Enter Your Fullname:</label>
                  <input type="text" name="name" id="name">
                    <p class="text-[#ff0000] text-base sm:text-2xl py-2 w-full">The fullname is required</p>
              </div>
              <div class="form-input">
                  <label for="email">Enter Your Email:</label>
                  <input type="email" name="email" id="email">
              </div>
            </div>
            <div class="form-row">
              <div class="form-input">
                  <label for="birthdate">Enter Your Date of birth:</label>
                  <input type="date" name="birthdate" id="birthdate">
              </div>
              <div class="form-input">
                  <label for="mobilenumber">Enter Your Mobile Number:</label>
                  <input type="number" name="mobilenumber" id="mobilenumber">
              </div>
            </div>
            <div class="form-row">
              <div class="form-input">
                  <label for="gender" class="select-label">Select Your Gender:</label>
                  <select name="gender" id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
              </div>
              <div class="form-input">
                  <label for="occupation">Enter Your Occupation:</label>
                  <input type="text" name="occupation" id="occupation">
              </div>
            </div>
        </div>
        <div class="contact-form-title"><span>Identity </span>Details</div>
        <div class="contact-form">
            <div class="form-row">
              <div class="form-input">
                  <label for="identitydocument" class="select-label">Select the ID type:</label>
                  <select name="identitydocument" id="identitydocument">
                    <option value="nationalID">National ID</option>
                    <option value="passport">Passport</option>
                    <option value="drivinglicence">Driving licence</option>
                  </select>
              </div>
              <div class="form-input">
                  <label for="IDnumber">Enter the ID number:</label>
                  <input type="number" name="IDnumber" id="IDnumber">
              </div>
            </div>
            <div class="form-row">
              <div class="form-input">
                  <label for="issueplace">Enter the county issued:</label>
                  <select name="issueplace" id="issueplace">
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
              <div class="form-input">
                  <label for="expirydate">Enter expiry date(optional):</label>
                  <input type="date" name="expirydate" id="expirydate">
              </div>
            </div>
            <div class="form-row">
              <div class="form-input">
                  <label for="countryissued">Enter the country issued(if non native):</label>
                  <input type="text" name="countryissued" id="countryissued">
              </div>
              <div class="form-input">
                  <label for="issueauthority">Enter the issue authoriry:</label>
                  <input type="text" name="issueauthority" id="issueauthority">
              </div>
            </div>
        </div>
        <div class="contact-form-title"><span>Location </span>information</div>
        <div class="contact-form">
            <div class="form-row">
              <div class="form-input">
                  <label for="county">Select the country of Residence:</label>
                  <select name="county" id="county">
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

              <div class="form-input">
                  <label for="subcounty">Select the sub-county:</label>
                  <select name="subcounty" id="subcounty">
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
            <div class="form-row">
              <div class="form-input">
                  <label for="ward">Select the ward:</label>
                  <select name="ward" id="ward">
                    <option value="Nairobi West">Nairobi West</option>
                    <option value="Mugumoini">Mugumoini</option>
                    <option value="South C">South C</option>
                    <option value="Nyayo Highrise">Nyayo Highrise</option>
                  </select>
              </div>
              <div class="form-input">
                  <label for="zipcode">Enter the zip code:</label>
                  <input type="text" name="zipcode" id="zipcode">
              </div>
            </div>
            <div class="form-row">
              <div class="form-input">
                  <label for="address">Enter Your Address:</label>
                  <input type="text" name="address" id="address">
              </div>
              <div class="form-input">
                  <label for="town">Enter Your City or Town:</label>
                  <input type="text" name="town" id="town">
              </div>
            </div>
            <div class="form-row">
              <div class="form-input">
                  <label for="propertyID">Enter the property ID of the property you want to acquire:</label>
                  <input type="text" name="propertyID" id="propertyID">
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
          <button class="btn">Submit</button>
        </div>
      </form>
      <hr>
      </section>

    <Footer/>
</template>
