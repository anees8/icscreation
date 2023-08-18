<script setup>
import { storeToRefs } from "pinia";
import { useLoginStore } from "@/stores/login.js";
const { user, errors, loading } = storeToRefs(useLoginStore());
const { login, resetForm } = useLoginStore();
</script>
<template>
    <BContainer fluid>
        <BRow class="align-items-center justify-content-center vh-100">
            <BCol cols="12" lg="4" md="6">
                <BCard class="shadow">
                    <BCol cols="12" class="text-center d-flex align-items-end  justify-content-center ">
                     <img :src="'/logo/logo6.png'"  height="80" />
                     <span class="h1 fw-bold logo">Creations</span>

                    </BCol>
                    <BCol  v-if="errors && errors.error"  cols="12" class="text-center">
                        <span  class="text-danger">{{ errors.error }}</span>
                    </BCol>
                    <BCol cols="12">
                        <BForm @submit="login" @reset="resetForm">
                            <BFormGroup class="mt-2" id="input-group-1" label="Email address:" label-for="input-1"
                              >
                                <BFormInput  id="input-1" v-model="user.email" :class="errors && errors.email ? 'is-invalid' : ''" :disabled="!loading ? false : true" type="email" placeholder="Enter email"
                                     />
                                     <BFormInvalidFeedback v-if="errors && errors.email">{{ errors.email[0] }}</BFormInvalidFeedback>

                            </BFormGroup>
                            <BFormGroup class="my-2" id="input-group-2" label="Password:" label-for="input-2">
                            <BFormInput type="password" id="input-2" v-model="user.password" :class="errors && errors.password ? 'is-invalid' : ''" :disabled="!loading ? false : true"  placeholder="Enter Password" />
                            <BFormInvalidFeedback v-if="errors && errors.password">{{ errors.password[0] }}</BFormInvalidFeedback>
                            </BFormGroup>
                            
                            <BButton  class="me-2 mt-2"  type="submit" variant="primary">
                                 <span v-if="!loading">Login</span>
                                 <FontAwesomeIcon v-if="!loading" class="ms-2" icon="arrow-right" />
                                 <BSpinner class="me-1" v-if="loading" small></BSpinner>
                              <span v-if="loading">Login...</span></BButton>
                            <BButton class="mt-2"  type="reset" variant="outline-danger">   <FontAwesomeIcon class="me-2" icon="arrows-rotate" />Reset</BButton>
                        </BForm>
                    </BCol>
                </BCard>
            </BCol>
        </BRow>
    </BContainer>
</template>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Righteous&family=Rowdies:wght@300;400;700&display=swap');

.logo{
   color: #27374D;
  font-family: Righteous;
}
</style>