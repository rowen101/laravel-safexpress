import {createRouter, createWebHistory } from "vue-router";
import Dashboard from "./pages/Dashboard.vue";
import Setting from "./pages/Setting.vue"

const routes = [
    {
        path: "/",
        name: "dashboard",
        component: Dashboard,
    },
    {
        path: "/setting",
        name: "setting",
        component: Setting,
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

export default router;
