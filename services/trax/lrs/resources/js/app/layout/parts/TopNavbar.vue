<template>
    <nav class="navbar navbar-expand-lg navbar-absolute"
        :class="{'bg-white': showMenu, 'navbar-transparent': !showMenu}">

        <div class="container-fluid">

            <div class="navbar-wrapper">
                <div class="navbar-toggle d-inline" :class="{toggled: $sidebar.showSidebar}">
                    <button type="button"
                            class="navbar-toggler"
                            aria-label="Navbar toggle button"
                            @click="toggleSidebar">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </button>
                </div>
                <div class="navbar-brand">
                    <span style="font-size:1.2rem">TRAX LRS</span>
                    <span style="font-size:0.8rem" class="text-primary">2.1</span>
                </div>
            </div>

            <button class="navbar-toggler" type="button"
                    @click="toggleTopbar"
                    data-toggle="collapse"
                    data-target="#navigation"
                    aria-controls="navigation-index"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-bar navbar-kebab"></span>
                <span class="navbar-toggler-bar navbar-kebab"></span>
                <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>

            <div class="collapse navbar-collapse show" v-show="showMenu">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <logout-button></logout-button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import LogoutButton from '../../components/Auth/LogoutButton';

    export default {

        components: {
            LogoutButton
        },
        data() {
            return {
                activeNotifications: false,
                searchModalVisible: false,
                searchQuery: ''
            };
        },
        computed: {
            routeName() {
                const { name } = this.$route;
                return name == 'home' ? 'statements' : name;

                return this.capitalizeFirstLetter(name);
            },
            isRTL() {
                return false;
            },
            showMenu() {
                return this.$topbar.visible;
            }
        },
        methods: {
            capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            },
            toggleNotificationDropDown() {
                this.activeNotifications = !this.activeNotifications;
            },
            closeDropDown() {
                this.activeNotifications = false;
            },
            toggleSidebar() {
                this.$sidebar.displaySidebar(!this.$sidebar.showSidebar);
            },
            toggleTopbar() {
                this.$topbar.toggle();
            },
            hideTopbar() {
                this.$topbar.hide();
            }
        }
    };
</script>
