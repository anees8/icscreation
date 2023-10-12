import { defineStore } from "pinia";
import axios from "axios";


export const useProductsStore = defineStore("productsStore", {
  state: () => ({
    product: [],
    search:null,
    fields: [
        {
          key: "id",
          label: "ID",
          thClass: "text-center",
          tdClass: "text-center "
        },
        {
          key: "name",
          label: "Product Name",
          thClass: "text-center",
          tdClass: "text-center"
        },
        {
          key: "actions",
          label: "Actions",
          thClass: "text-center",
          tdClass: "text-center"
        }
      ],
    product: {},
    perPage: 10,
    currentPage: 1,
    isBusy: false,
    rows: null,
    options: [
        { value: 5, text: "5" },
        { value: 10, text: "10" },
        { value: 50, text: "50" },
        { value: 100, text: "100" }
      ],
  }),

  getters: {

  },
  mutations: {},

  actions: {
    async getProducts() {
     
        this.isBusy = true;
        try {
          let url = "products";
          if (this.perPage) {
            url += `?perPage=${this.perPage}`;
          }
          if (this.currentPage > 1) {
            url += `${this.perPage ? "&" : "?"}page=${this.currentPage}`;
          }
          if(this.search){
            url += `${this.perPage ? "&" : "?"}search=${this.search}`;
          }

          const response = await axios.get(url);
          this.products = response.data.data.products.data;
          this.currentPage = response.data.data.products.current_page;
          this.rows = response.data.data.products.total;
          this.isBusy = false;
        } catch (error) {
          if (error.response) {
            this.errors = error.response.data.errors;
          }
          this.isBusy = false;
        }
      },
      setPerPage(value) {
        this.perPage = value;
        this.currentPage = 1;
        this.getProducts();
      },
  }
});