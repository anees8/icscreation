import { defineStore } from "pinia";


export const useGeneralStore = defineStore("genaralStore", {
  state: () => ({

  }),

  getters: {
    formattedAmount: (state)=>(amount) => {
        const formatter = new Intl.NumberFormat('en-IN', {
          style: 'currency',
          currency: 'INR',
        });
        return formatter.format(amount);
      },
  
  },
  mutations: {},

  actions: {
   
  }
});