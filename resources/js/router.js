import { createWebHistory, createRouter } from 'vue-router'
import store from './store/userStore';
/* Guest Component */
const LoginPage = () => import('@/components/Auth/login.vue')
const SignupPage = () => import('@/components/Auth/register.vue')
const DahboardLayout = () => import('@/components/dashboard.vue');
const FeedbackPage = () => import('@/components/feedback/AddEdit.vue');

const routes = [
    {
        name: "login",
        path: "/login",
        component: LoginPage,
        meta: {
            middleware: "guest",
            title: `Login`
        }
    },
    {
        name: "register",
        path: "/register",
        component: SignupPage,
        meta: {
            middleware: "guest",
            title: `Register`
        }
    },
    {
        name: "feedback",
        path: "/feedback",
        component: FeedbackPage,
        meta: {
            middleware: "auth",
            title: `Feedback`,
        },
    },
    {
        name: "dashboard",
        path: "/dashboard",
        component: DahboardLayout,
        meta: {
            middleware: "auth",
            title: `Dashboard`,
        },
    }
]
const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})
router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    if (to.meta.middleware == "guest") {
        if (store.state.app.authenticated) {
            next({ name: "dashboard" })
        }
        next()
    } else {
        if (store.state.app.authenticated) {
            next()
        } else {
            next({ name: "login" })
        }
    }
})
export default router