   
   <script setup>
   import { onMounted } from "vue";
   import { useLoginStore } from "@/stores/login.js";
   
   const { removeToken } = useLoginStore();
   
   onMounted(() => {
     setTimeout(function () {
       removeToken();
     }, 1000);
   });
   </script>
   <template>
    <BContainer fluid>
         <BRow class="align-items-center justify-content-center vh-100 text-center">
             <BCol>
                             <BSpinner> Logouting....</BSpinner>
 
          
         
           </BCol>
         </BRow>
     </BContainer>
   </template>

   