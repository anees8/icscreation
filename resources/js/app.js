import './bootstrap';
import { createApp } from "vue";
import { createPinia } from "pinia";
import App from "./App.vue";
import router from "./router/index";
import axios from "axios";
import VueAxios from "vue-axios";
import  { BootstrapVueNext }  from "bootstrap-vue-next";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
  faArrowRight,faArrowsRotate,faGauge, faKey, faRightFromBracket, faUserGear,faUser, faPlus, faPen, faTrash
} from "@fortawesome/free-solid-svg-icons";
import {  } from "@fortawesome/free-regular-svg-icons";

import {
  FontAwesomeIcon,
  FontAwesomeLayers,
  FontAwesomeLayersText
} from "@fortawesome/vue-fontawesome";
library.add(
    faArrowRight,
    faUser,
    faArrowsRotate, faGauge, faRightFromBracket,faUserGear,faKey,faPlus,faPen,faTrash
  );

import Swal from 'sweetalert2';
window.Swal=Swal;

import '../css/App.css'
  

axios.defaults.baseURL = "http://192.168.5.17:8000/api/";

axios.defaults.headers.common["Authorization"] ="Bearer " + localStorage.getItem("token");
axios.defaults.headers.common["Access-Control-Allow-Origin"] = "*";



      
 
const app = createApp(App);
app.use(VueAxios, axios);
app.use(BootstrapVueNext);
app.use(createPinia());
app.component("FontAwesomeIcon", FontAwesomeIcon);
app.component("FontAwesomeLayers", FontAwesomeLayers);
app.component("FontAwesomeLayersText", FontAwesomeLayersText);
app.use(router);
app.mount("#app");