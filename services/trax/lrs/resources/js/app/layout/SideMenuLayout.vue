<template>
    <div class="wrapper">
        <side-menu></side-menu>
        <div class="main-panel">
            <top-navbar></top-navbar>
            <page-content @click.native="toggleNavbars"></page-content>
            <content-footer></content-footer>
        </div>
    </div>
</template>

<script>
    import SideMenu from './parts/SideMenu';
    import TopNavbar from './parts/TopNavbar';
    import PageContent from './parts/Content';
    import ContentFooter from './parts/ContentFooter';

    export default {
        
        components: {
            SideMenu, TopNavbar, PageContent, ContentFooter
        },

        methods: {
            toggleNavbars() {
                if (this.$sidebar.showSidebar) {
                    this.$sidebar.displaySidebar(false);
                }
                this.$topbar.hide();
            }
        }
    };
</script>
