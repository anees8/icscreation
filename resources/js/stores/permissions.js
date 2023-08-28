import { defineStore } from "pinia";
import axios from "axios";

export const usePermissionsStore = defineStore("permissionsStore", {
  state: () => ({
    fields: [
      {
        key: "id",
        label: "ID",
        thClass: "text-center",
        tdClass: "text-center "
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
        key: "actions",
        label: "Action",
        thClass: "text-center",
        tdClass: "text-center"
      }
    ],
    permissions: [],
    permission: {},
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

  actions: {
    async getPermissions() {
      this.isBusy = true;
      try {
        let url = "permissions";
        if (this.perPage) {
          url += `?perPage=${this.perPage}`;
        }
        if (this.currentPage > 1) {
          url += `${this.perPage ? "&" : "?"}page=${this.currentPage}`;
        }
        const response = await axios.get(url);
        this.permissions = response.data.data.permissions.data;
        this.currentPage = response.data.data.permissions.current_page;
        this.rows = response.data.data.permissions.total;

        this.isBusy = false;
      } catch (error) {
        if (error.response) {
          this.errors = error.response.data.errors;
        }
        this.isBusy = false;
      }
    },

    editPermission(id) {
      this.permission = this.permissions.find((permission) => permission.id == id);
      this.modal = !this.modal;
    },

    deletePermission(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "Do you want to Delete this Permission : " + id,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete",
        cancelButtonText: "No, cancel"
      }).then((result) => {
        if (result.isConfirmed) {
          let url = "permissions/";

          axios
            .delete(url + id)
            .then((res) => {
              this.getPermissions();
              Swal.fire("Deleted!", "Permission has been deleted.", "success");
            })
            .catch((error) => {
              this.errors = error.response.data.errors;
            });
        }
      });
    },

  

    setPerPage(value) {
      this.perPage = value;
      this.currentPage = 1;
      this.getPermissions();
    },

    resetForm() {
      this.errors = {};

      this.permission = {};
      this.isBusy = false;
    },
    hideModel() {
      this.modal = !this.modal;
      this.getPermissions();
      this.resetForm();
    },

    async uploadData() {
      const formData = new FormData();
      let config = {
        header: { "content-type": "multipart/form-data" }
      };
      this.isBusy = true;
      let url = "permissions";
      if (this.permission.name) {
        formData.append("name", this.permission.name);
      }
      
      if (!this.permission.id) {
        try {
          const response = await axios.post(url, formData, config);

          this.hideModel();
        } catch (error) {
          if (error.response) {
            this.errors = error.response.data.errors;
          }
          this.isBusy = false;
        }
      } else {
        formData.append("_method", "put");
        try {
          const response = await axios.post(
            url + "/" + this.permission.id,
            formData,
            config
          );

          this.hideModel();
        } catch (error) {
          if (error.response) {
            this.errors = error.response.data.errors;
          }
          this.isBusy = false;
        }
      }
    }
  }
});