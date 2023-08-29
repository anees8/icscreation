<script setup>
import { storeToRefs } from "pinia";
import { useRolesStore } from "@/stores/roles.js";
import { useLoginStore } from "@/stores/login.js";
const {checkPermission } = useLoginStore();
const {
  roles,
  role,
  fields,
  options,
  perPage,
  currentPage,
  modal, 
  rows,
  errors,
  isBusy,
  permissionOptions,
  selectedPermissions
} = storeToRefs(useRolesStore());

const { getRoles, setPerPage ,uploadData,editRole,deleteRole , hideModel} = useRolesStore();

getRoles();
</script>
  
<template>
  <b-container fluid>
   <b-row>
     <b-card>
       <b-col>
         <b-row align-v="center">
           <b-col><h5>Roles List</h5></b-col>
           <b-col>
           <b-button
           size="sm"
             @click="modal = !modal"
             class="float-end"
             v-if="checkPermission('role_create')"
             variant="outline-dark"
           >
             <FontAwesomeIcon icon="plus" class="me-1"/>Role</b-button
           >
           <div>
             <b-modal
               v-model="modal"
               :title="role.id ? 'Update Role' : 'Add Role'"
             
               hide-header-close
               no-close-on-backdrop
             >
                <BFormGroup
                id="input-group-1"
                label="Your Role Name:"
                label-for="input-1"
                >
                <BFormInput
                id="input-1"
                v-model="role.name"
                :class="errors && errors.name ? 'is-invalid' : ''"
                :disabled="!isBusy ? false : true"
                type="text"
                placeholder="Enter Role Name"
                />
                <BFormInvalidFeedback v-if="errors && errors.name">{{
                errors.name[0]
                }}</BFormInvalidFeedback>
                </BFormGroup>

                <BFormGroup
                id="input-group-1"
                label="Select Your Permissions:"
                label-for="input-1"
                >
                <BFormSelect v-model="selectedPermissions" multiple :options="permissionOptions"></BFormSelect>
              </BFormGroup>
              

     <template #footer>
                 <div>
                   <button class="btn btn-outline-dark" @click="hideModel">Close</button>
                 </div>
                 <div>
                   <button class="btn btn-outline-primary" @click="uploadData">
                     {{ role.id ? "Update Role" : "Add Role" }}
                   </button>
                 </div>
               </template>

</b-modal></div></b-col>
         </b-row>
       </b-col>
       <b-col
         ><b-table
           striped
           outlined
           empty-filtered-text
           caption-top
           hover
           small
           footClone
           :items="roles"
           :fields="fields"
           :busy="isBusy"
           responsive
           show-empty
         >
                <template #cell(permissions)="data">            

                <span class="badge bg-info text-dark me-1" v-for="permission in   data.item.permissions" :key="permission.id">{{ permission.name }}</span>
                </template> 

           <template #cell(actions)="data"> 
             <b-button
             v-if="checkPermission('role_update')"
             size="sm"
             class="circle me-2"
             @click="editRole(data.item.id)"
             variant="outline-success"
           >
             <FontAwesomeIcon icon="pen" />
           </b-button>

           <b-button
           size="sm"
           v-if="checkPermission('role_delete')"
             class="circle me-2"
             @click="deleteRole(data.item.id)"
             variant="outline-danger"
           >
             <FontAwesomeIcon icon="trash" />
           </b-button>
           
           </template> </b-table
       ></b-col>
       <b-row align-h="end" class="mt-5">
         <b-col xl="1" lg="2" md="2" class="p-2">
           <b-form-select
             v-if="rows > 5"
             v-model="perPage"
             :options="options"
             size="md"
             v-on:change="setPerPage"
             varient="dark"
           ></b-form-select>
         </b-col>
         <b-col xl="5" lg="6" md="8" class="p-2">
           <b-pagination
             v-if="rows / perPage > 1"
             v-on:click="getRoles"
             v-model="currentPage"
             :total-rows="rows"
             :per-page="perPage"
           ></b-pagination>
         </b-col>
       </b-row>
     </b-card>
   </b-row>
 </b-container>
 </template>
