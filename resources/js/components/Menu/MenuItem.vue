<script setup>
import {RouterLink} from 'vue-router';
import { useLoginStore } from "@/stores/login.js";
const {checkPermission } = useLoginStore();

defineProps({
  label: {
    type: String,
    required: true
  },
  name: {
    type: String,
    required: true
  },
  icon: {
    type: String,
    required: true
  },
  permission: {
    type: String,
    required: true
  },
});
</script>
<template>
    
    <RouterLink
      class="nav-link p-3"
      v-bind:to="{ name: name }"
      v-if='checkPermission(permission,"View Any")||permission==""'
    >
    <div class="fw-bold">
        <div>
          <font-awesome-icon class="mx-4"  v-if="icon" :icon="icon" />

          <span >{{ label }} </span>
        </div>
        </div>
    </RouterLink>
    <hr class="m-0"/>
</template>
<style scoped>
.router-link-exact-active,.nav-link:hover,.nav-link:focus,.nav-link:target  {
cursor: pointer;
background-color: #DDE6ED;
color:#27374D;

}
    
</style>