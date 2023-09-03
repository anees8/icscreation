import { defineStore } from "pinia";
import axios from "axios";
import moment from "moment";

export const useUsersStore = defineStore("usersStore", {
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
        key: "email",
        label: "Email",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "roles",
        label: "Role",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "created_at",
        label: "Created Date",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "actions",
        label: "Action",
        thClass: "text-center",
        tdClass: "text-center"
      }
    ],
    users: [],
    user: {},
    roles: [],
    selectedRoles:null,
    perPage: 10,
    currentPage: 1,
    isBusy: false,
    rows: null,
    modal: false,
    options: [
      { value: 5, text: "5" },
      { value: 10, text: "10" },
      { value: 50, text: "50" },
      { value: 100, text: "100" }
    ],
    
    errors: {}
  }),
  getters: {
    roleOptions() {
      return this.roles.map((role) => ({
        text: role.name, // Display the role's name as text
        value: role.id, // Use the role's id as the value
      }));
    },
  },
  actions: {
    async getUsers() {
     
      this.isBusy = true;
      try {
        let url = "users";
        if (this.perPage) {
          url += `?perPage=${this.perPage}`;
        }
        if (this.currentPage > 1) {
          url += `${this.perPage ? "&" : "?"}page=${this.currentPage}`;
        }
        const response = await axios.get(url);
        this.isBusy = false;
        this.users = response.data.data.users.data;
        this.currentPage = response.data.data.users.current_page;
        this.rows = response.data.data.users.total;

    
      } catch (error) {
        if (error.response) {
          this.errors = error.response.data.errors;
        }
        this.resetForm();
        this.isBusy = false;
      }
    },
    async editUser(id) {
      
      try {
        let url = "users/";
        const response = await axios.get(url + id);
        this.user = response.data.data.user;
        this.modal = !this.modal;
        this.selectedRoles = this.user.roles[0].id;
      } catch (error) {
        if (error.response) {
          this.errors = error.response.data.errors;
        }
        this.resetForm();
       
      }
    },
    
    async getRoles() {
      
      try {
        let url = "roles";
       
        const response = await axios.get(url);
        this.roles = response.data.data.roles.data;
      
      } catch (error) {
        if (error.response) {
          this.errors = error.response.data.errors;
        }
        this.resetForm();
       
      }
    },

    deleteUser(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "Do you want to Delete this User : " + id,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete",
        cancelButtonText: "No, cancel"
      }).then((result) => {
        if (result.isConfirmed) {
          let url = "users/";

          axios
            .delete(url + id)
            .then((res) => {
              this.getUsers();
              Swal.fire("Deleted!", "User has been deleted.", "success");
            })
            .catch((error) => {
              this.errors = error.response.data.errors;
              this.resetForm();
            });
        }
      });
    },

    dateTime(value) {
      return moment(value).format("D-MMM-Y");
    },

    setPerPage(value) {
      this.perPage = value;
      this.currentPage = 1;
      this.getUsers();
    },

    resetForm() {
      this.errors = {};
     
      this.user = {};
      this.selectedRoles = null;
      this.isBusy = false;
    },
    hideModel() {
      this.modal = !this.modal;
      this.getUsers();
      this.resetForm();
    },

    async uploadData() {
      const formData = new FormData();
      let config = {
        header: { "content-type": "multipart/form-data" }
      };
      this.isBusy = true;
      let url = "users";
      if (this.user.name) {
        formData.append("name", this.user.name);
      }

      if (this.user.email) {
        formData.append("email", this.user.email.toLowerCase());
      }
      if (this.user.password) {
        formData.append("password", this.user.password);
      }
      if (this.user.password_confirmation) {
        formData.append(
          "password_confirmation",
          this.user.password_confirmation
        );
      }

      if (this.selectedRoles) {
        formData.append(
          "role_id",
          this.selectedRoles
        );
      }
  
      
      if (!this.user.id) {
        try {
          const response = await axios.post(url, formData, config);

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
            url + "/" + this.user.id,
            formData,
            config
          );

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