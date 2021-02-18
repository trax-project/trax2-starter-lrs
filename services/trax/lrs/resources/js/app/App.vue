<template>
    <div>
        <notifications></notifications>
        <router-view :key="$route.fullPath"></router-view>
        <portal-target name="modals" multiple></portal-target>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.$watch('$sidebar.showSidebar', this.toggleNavOpen)
        },
        methods: {
            toggleNavOpen() {
                let root = document.getElementsByTagName('html')[0];
                root.classList.toggle('nav-open');
            }
        }
    };
</script>
