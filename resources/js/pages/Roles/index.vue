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
  isBusy,permissionsGroup,selectedpermissions
} = storeToRefs(useRolesStore());

const { getRoles, setPerPage,uploadData,editRole,deleteRole , groupedPermissions,hideModel} = useRolesStore();

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
             v-if="checkPermission('roles','Create')"
             variant="outline-dark"
           >
             <FontAwesomeIcon icon="plus" class="me-1"/>Role</b-button
           >
           <div>
             <b-modal
             size="lg"
               v-model="modal"
               :title="role.id ? 'Update Role' : 'Add Role'"
             
               hide-header-close
               no-close-on-backdrop
             >
                <BFormGroup
                class="mb-3"
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

          <div class="ps-2">
          <b-form-group
          v-for="(groups,index) in permissionsGroup" :key="index"
          :label="index.charAt(0).toUpperCase() + index.slice(1)"
          v-slot="{ ariaDescribedby }"
          :label-class="'text-info fw-bold'"
          >
          <b-form-checkbox-group
          v-model="selectedpermissions"
          :aria-describedby="ariaDescribedby"
         
          >
          <b-form-checkbox
          v-for="(group, index) in groups"
          :key="group.id"
          :value="group.id"
          :id="group.id"
        >
          {{ group.action }}
        </b-form-checkbox>
        
        </b-form-checkbox-group>
        <hr class="p-0 m-0"/>
          </b-form-group>
        </div>
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
                  
            <div v-for="(items, group) in groupedPermissions(data.item.permissions)" :key="group">
            <span class="fw-bold">{{ group}}: </span><span class="fw-normal badge bg-info text-dark me-1" v-for="item in items" :key="item.id">{{ item.action}}</span>   
            </div>
                </template> 

           <template #cell(actions)="data"> 
             <b-button
             v-if="checkPermission('roles','Update')"
             size="sm"
             class="circle me-2"
             @click="editRole(data.item.id)"
             variant="outline-success"
           >
             <FontAwesomeIcon icon="pen" />
           </b-button>

           <b-button
           size="sm"
           v-if="checkPermission('roles','Delete')"
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
