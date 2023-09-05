import { defineStore } from "pinia";
import axios from "axios";
import { useLoginStore } from "@/stores/login.js";

export const useRolesStore = defineStore("rolesStore", {
  state: () => ({
    fields: [
      {
        key: "id",
        label: "ID",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "name",
        label: "Name",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "slug",
        label: "Slug",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "permissions",
        label: "Permissions",
        thClass: "text-center",
        tdClass: "text-center mw-30"
      },
      {
        key: "actions",
        label: "Action",
        thClass: "text-center",
        tdClass: "text-center"
      }
    ],
    roles: [],
    role: {},
    permissionsGroup:[],
    selectedpermissions:[],
    perPage: 10,
    currentPage: 1,
    isBusy: false,
    rows: null,
    modal: false,
    errors: {},
    options: [
      { value: 5, text: "5" },
      { value: 10, text: "10" },
      { value: 50, text: "50" },
      { value: 100, text: "100" }
    ],
   
  }),
  getters: {
    groupedPermissions: (state) => (data) => {
    return data.reduce((grouped, permission) => {
      const name = permission.name;
      if (!grouped[name]) {
        grouped[name] = [];
      }
      grouped[name].push(permission);
      return grouped;
    }, {});
  }, },

  actions: {
    async getRoles() {
     
      this.isBusy = true;
      try {
        let url = "roles";
        if (this.perPage) {
          url += `?perPage=${this.perPage}`;
        }
        if (this.currentPage > 1) {
          url += `${this.perPage ? "&" : "?"}page=${this.currentPage}`;
        }
        const response = await axios.get(url);
        this.roles = response.data.data.roles.data;
        this.currentPage = response.data.data.roles.current_page;
        this.rows = response.data.data.roles.total;
        this.permissionsGroup=response.data.data.permissionsgroup;

        this.isBusy = false;
      } catch (error) {
        if (error.response) {
          this.errors = error.response.data.errors;
        }
        this.resetForm();
        this.isBusy = false;
      }
    },

    async editRole(id) {

      try {
        let url = "roles/";
       
        const response = await axios.get(url + id);
        
        this.role = response.data.data.role;
        this.modal = !this.modal;
        this.selectedpermissions=this.role.permissions.map(permission => permission.id);
      } catch (error) {
        if (error.response) {
          this.errors = error.response.data.errors;
        }
        this.resetForm();
       
      }
    },

    deleteRole(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "Do you want to Delete this Role : " + id,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete",
        cancelButtonText: "No, cancel"
      }).then((result) => {
        if (result.isConfirmed) {
          let url = "roles/";

          axios
            .delete(url + id)
            .then((res) => {
              this.getRoles();
              const loginStore = useLoginStore();
              loginStore.getPermissions();
              Swal.fire("Deleted!", "Role has been deleted.", "success");
            })
            .catch((error) => {
              this.errors = error.response.data.errors;
              this.resetForm();
            });
        }
      });
    },    
    setPerPage(value) {
      this.perPage = value;
      this.currentPage = 1;
      this.getRoles();
    },

    resetForm() {
      this.selectedpermissions=[];
      this.role = {};
      this.isBusy = false;
    },
    hideModel() {
      this.modal = !this.modal;
      this.getRoles();
      this.resetForm();
    },

    async uploadData() {
      const formData = new FormData();
      let config = {
        header: { "content-type": "multipart/form-data" }
      };
      this.isBusy = true;
      let url = "roles";
      if (this.role.name) {
        formData.append("name", this.role.name);
      }

      for (let i = 0; i < this.selectedpermissions.length; i++) {
        formData.append(`permission_id[${i}]`, this.selectedpermissions[i]);
      }
    
      
      if (!this.role.id) {
        try {
          const response = await axios.post(url, formData, config);
          const loginStore = useLoginStore();
          loginStore.getPermissions();
          this.hideModel();
        } catch (error) {
         
          if (error.response) {
            this.errors = error.response.data.errors;
          }
          this.resetForm();
          this.isBusy = false;
        }
      } else {
        formData.append("_method", "put");
        try {
          const response = await axios.post(
            url + "/" + this.role.id,
            formData,
            config
          );
          const loginStore = useLoginStore();
          loginStore.getPermissions();
          this.hideModel();
        } catch (error) {
          if (error.response) {
            this.errors = error.response.data.errors;
          }
          this.resetForm();
          this.isBusy = false;
        }
      }
    }
  }
});