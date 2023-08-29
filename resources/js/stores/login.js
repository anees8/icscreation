import { defineStore } from "pinia";
import axios from "axios";
import router from "../router/index";

export const useLoginStore = defineStore("loginStore", {
  state: () => ({
    user: {
      email: "admin@yopmail.com",
      password: "admin@123"
    },
    loading: false,
    permissions:[],
    accessToken: localStorage.getItem("token"),
    errors: {}
  }),

  getters: {
    getAccessToken: (state) => state.accessToken,
    checkPermission:(state)=>(permission) =>state.permissions.includes(permission),
  },
  mutations: {},

  actions: {
    async login() {
      this.loading = true;
      try {
        const response = await axios.post("login", this.user);
        this.setToken(response.data.data.token);

        if (response.data.data.token) {
          axios.defaults.headers.common["Authorization"] =
            "Bearer " + response.data.data.token;
        }
      } catch (error) {
        if (error.response) {
          this.errors = error.response.data.errors;
        }

        this.loading = false;
      }
    },
    async logout() {
      try {
        const response = await axios.post("logout");
      } catch (error) {
        if (error.response) {
          this.errors = error.response.data.errors;
        }
      }
    },
    async getPermissions(){
      try {
        const response = await axios.get("users/permissions");
        this.permissions=response.data.data.permissions;
      } catch (error) {
        if (error.response) {
          this.errors = error.response.data.errors;
        }
      }
    },
   
    setToken: function (token) {
      this.accessToken = token;
      localStorage.setItem("token", token);
      this.errors = {};
      this.user.email = null;
      this.user.password = null;
      this.loading = false;
      router.push({ name: "Dashboard" });
    },
    removeToken: function () {
      this.logout();
      this.accessToken = null;
      localStorage.removeItem("token");
      router.push({ name: "Login" });
    },
    resetForm: function () {
      this.errors = {};
      this.user.email = null;
      this.user.password = null;
      this.loading = false;
    }
  }
});