<template>
    <div class="sidebar"
       :data="backgroundColor">

        <div class="sidebar-wrapper">

            <slot></slot>

            <ul class="nav">
                <!--By default vue-router adds an active class to each route link. This way the links are colored when clicked-->
                <slot name="links">
                    <sidebar-link v-for="(link,index) in sidebarLinks"
                        :key="index"
                        :to="link.path"
                        :name="link.name"
                        :icon="link.icon">
                    </sidebar-link>
                </slot>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {

        props: {
            backgroundColor: {
                type: String,
                default: "green"
            },
            sidebarLinks: {
                type: Array,
                default: () => []
            },
            autoClose: {
                type: Boolean,
                default: true
            }
        },

        data() {
            return {
                activeLinkIndex: 0,
                links: []
            };
        },

        mounted() {
            this.$watch("$route", this.findActiveLink, {
                immediate: true
            });
        },

        provide() {
            return {
                autoClose: this.autoClose,
                addLink: this.addLink,
                removeLink: this.removeLink
            };
        },

        methods: {

            findActiveLink() {
                this.links.forEach((link, index) => {
                    if (link.isActive()) {
                        this.activeLinkIndex = index;
                    }
                });
            },

            addLink(link) {
                const index = this.$slots.links.indexOf(link.$vnode);
                this.links.splice(index, 0, link);
            },

            removeLink(link) {
                const index = this.links.indexOf(link);
                if (index > -1) {
                    this.links.splice(index, 1);
                }
            }
        }
    }
</script>
