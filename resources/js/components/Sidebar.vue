<script setup>
import MenuItem from './Menu/MenuItem.vue';
import logo from '../../../public/logo/logo6.png';
const menuTree = [
{
label: "Dashboard",
icon: "gauge",
name: "Dashboard",
permission: "",
},
{
label: "Users",
icon: "user",  
name: "Users",
permission: "users",
},
{
label: "Roles",
icon: "user-gear",
name: "Roles",
permission: "roles",
},

{
label: "Permissions",
icon: "key",
name: "Permissions",
permission: "permissions",
},
{
label: "Logout",
icon: "right-from-bracket",
name: "Logout",
permission: "",
},


];

</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Righteous&family=Rowdies:wght@300;400;700&display=swap');
aside {
z-index: 1;
min-height: 100vh;
width: 16rem;
background-color: #27374D;
color:#DDE6ED;
transition: all 0.3s ease;

}
.logo{
background-color: #fff;
color: #27374D;
font-family: Righteous;
}
</style>
<template>
   <aside class="border-end border-1 border-secondary">
    <div class="logo border border-light border-start-0  border-end-0 border-top-0 border-bottom-2"> <div class="d-flex align-items-end  justify-content-center h-100"><BImg :src="logo" height="60" class="my-1"/><span class="h2 fw-bold">Creations</span></div> </div>
    <MenuItem v-for="(item, index) in menuTree"
    :key="index"
    :label="item.label"
    :icon="item.icon"
    :name="item.name"
    :permission="item.permission"></MenuItem>
   </aside>
  </template>
