import { defineStore } from "pinia";


export const useGeneralStore = defineStore("genaralStore", {
  state: () => ({

  }),

  getters: {
    formattedAmount: (state)=>(amount) => {
        const formatter = new Intl.NumberFormat('en-IN', {
          style: 'currency',
          currency: 'INR',
          minimumFractionDigits: 2,
          maximumFractionDigits: 2,
          useGrouping: true,
          currencySign: 'accounting',
          currencyDisplay: 'symbol',
        });
        return formatter.format(amount);
      },
  
  },
  mutations: {},

  actions: {
   
  }
});