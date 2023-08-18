<script setup>
import {RouterView} from 'vue-router';
import {ref,defineAsyncComponent} from 'vue';
const isLoading = ref(true);


const Sidebar = defineAsyncComponent(() =>
  import('./components/Sidebar.vue')
)
// Simulate page loading
setTimeout(() => {
  isLoading.value = false;
}, 500);

</script>
<template>
        <div v-if="isLoading">
        <BContainer fluid>
        <BRow class="align-items-center justify-content-center vh-100 text-center">
        <BCol>
        <BSpinner></BSpinner>
        </BCol>
        </BRow>
        </BContainer>
        </div>
        <div v-else>
        <div class="sidebar">
        <Sidebar  v-if="!['Login', 'notfound', 'Logout'].includes($route.name)"/>
        <div class="content">
        <RouterView />
        </div>
        </div>
        </div>
        </template>

<style scoped>
.sidebar {
  display: flex;
}

.sidebar .content {
  flex: 1 1 0;
  background: #EEEDE7;
}
</style>