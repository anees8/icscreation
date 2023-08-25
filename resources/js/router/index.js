import { createWebHistory, createRouter } from "vue-router";
import { useLoginStore } from "@/stores/login.js";
const routes = [
    {
        path: "/",
        name: "Login",
        component: ()=>import('../pages/Login.vue'),
        meta: {
            requireAuth: false,    
          
        },
    },
    {
        path: "/dashboard",
        name: "Dashboard",
        component: ()=>import('../pages/Dashboard.vue'),
        meta: {
            requireAuth: true,    
          
        },
        
    },
    {
        path: "/users",
        name: "Users",
        component: ()=>import('../pages/Users/index.vue'),
        meta: {
            requireAuth: true,    
          
        },
        
    },
    {
        path: "/roles",
        name: "Roles",
        component: ()=>import('../pages/Roles.vue'),
        meta: {
            requireAuth: true,    
          
        },
        
    },
    {
        path: "/permissions",
        name: "Permissions",
        component: ()=>import('../pages/Permissions.vue'),
        meta: {
            requireAuth: true,    
          
        },
        
    },
    
    {
        path: '/logout',
        name: 'Logout',
        component: () => import('../pages/Logout.vue'),
        meta: {
          requireAuth: true,
      },
      },
      {
        path: '/:catchAll(.*)',
        name: 'notfound',
        component: () => import('../components/NotFound.vue'),
        meta: {
          requireAuth: false,
      },
      },

    

        
];

const router = createRouter({
    scrollBehavior(to, from, savedPosition) {
        // always scroll to top
        return { top: 0 };
    },
    history: createWebHistory(),
    routes: routes
  });


  router.beforeEach((to, from, next) => {
    const { getAccessToken } = useLoginStore();
    if (to.meta.requireAuth && getAccessToken === null) {
        next({ name: "Login" });
    }
    if (
        to.name === "Login" &&
        !to.meta.requireAuth &&
        getAccessToken !== null
    ) {
        next({ name: "Dashboard" });
    }
    next();
  });
  
   



export default router;