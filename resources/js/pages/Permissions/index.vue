<script setup>
import { storeToRefs } from "pinia";
import { usePermissionsStore } from "@/stores/permissions.js";
import { useLoginStore } from "@/stores/login.js";
const {checkPermission } = useLoginStore();
const {
  permissions,
  permission,
  fields,
  options,
  perPage,
  currentPage,
  modal, 
  rows,
  errors,
  isBusy,
} = storeToRefs(usePermissionsStore());

const { getPermissions, setPerPage ,uploadData,editPermission,deletePermission , hideModel} = usePermissionsStore();

getPermissions();
</script>
<template>
  <b-container fluid>
   <b-row>
     <b-card>
       <b-col>
         <b-row align-v="center">
           <b-col><h5>Permission List</h5></b-col>
           <b-col>
           <b-button
           size="sm"
             @click="modal = !modal"
             class="float-end"
             v-if="checkPermission('permissions','Create')"
             variant="outline-dark"
           >
             <FontAwesomeIcon icon="plus" class="me-1"/>Permission</b-button
           >
           <div>
             <b-modal
               v-model="modal"
               :title="permission.id ? 'Update Permission' : 'Add Permission'"
             
               hide-header-close
               no-close-on-backdrop
             >
                <BFormGroup
                id="input-group-1"
                label="Your Permission Name:"
                label-for="input-1"
                >
                <BFormInput
                id="input-1"
                v-model="permission.name"
                :class="errors && errors.name ? 'is-invalid' : ''"
                :disabled="!isBusy ? false : true"
                type="text"
                placeholder="Enter Permission Name"
                />
                <BFormInvalidFeedback v-if="errors && errors.name">{{
                errors.name[0]
                }}</BFormInvalidFeedback>
                </BFormGroup>
                
               
        


     <template #footer>
                 <div>
                   <button class="btn btn-outline-dark" @click="hideModel">Close</button>
                 </div>
                 <div>
                   <button class="btn btn-outline-primary" @click="uploadData">
                     {{ permission.id ? "Update Permission" : "Add Permission" }}
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
           :items="permissions"
           :fields="fields"
           :busy="isBusy"
           responsive
           show-empty
         >

         <template #cell(slug)="data">
          <span class="badge bg-info text-dark me-1" > {{ data.item.slug }}</span></template>
                 
           <template #cell(actions)="data"> 
             <b-button
             v-if="checkPermission('permissions','Update')"
             size="sm"
             class="circle me-2"
             @click="editPermission(data.item.id)"
             variant="outline-success"
           >
             <FontAwesomeIcon icon="pen" />
           </b-button>

           <b-button
           v-if="checkPermission('permissions','Delete')"
           size="sm"
             class="circle me-2"
             @click="deletePermission(data.item.id)"
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
             v-on:click="getPermissions"
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

 