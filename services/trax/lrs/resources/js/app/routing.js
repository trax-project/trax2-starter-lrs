import RouterFactory from '@trax/classes/RouterFactory'

// Layout.
import FullPageLayout from './layout/FullPageLayout.vue';
import SideMenuLayout from './layout/SideMenuLayout.vue';

// Views.
import LoginPage from './pages/LoginPage.vue';
import StatementsPage from './pages/StatementsPage.vue';
import ClientsPage from './pages/ClientsPage.vue';
import SettingsPage from './pages/SettingsPage.vue';
import NotFoundPage from './pages/NotFoundPage.vue';


function getRoutes(auth) {
    return [
        {
            path: "/lrs",
            redirect: "/lrs/login",
            component: FullPageLayout,
            children: [
                {
                    path: "login",
                    name: "login",
                    beforeEnter: auth.ifNotAuthenticated,
                    component: LoginPage
                },
            ]
        },
        {
            path: "/lrs",
            component: SideMenuLayout,
            children: [
                {
                    path: "home",
                    name: "home",
                    beforeEnter: auth.ifAuthenticated,
                    component: StatementsPage
                },
                {
                    path: "clients",
                    name: "clients",
                    beforeEnter: auth.ifAuthenticated,
                    component: ClientsPage
                },
                {
                    path: "settings",
                    name: "settings",
                    beforeEnter: auth.ifAuthenticated,
                    component: SettingsPage
                },
                {
                    path: "*",
                    name: "unknown",
                    component: NotFoundPage
                },
            ]
        },
    ]
}

export default {

    routes() {
        return getRoutes(Vue.prototype.$auth)
    },

    router() {
        return RouterFactory.make(this.routes())
    },
}

