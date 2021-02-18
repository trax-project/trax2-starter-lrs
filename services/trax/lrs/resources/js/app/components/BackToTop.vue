<template>
    <base-button type="primary" round :class="{ show: showButton }" @click="scrollToTop">
        <i class="tim-icons icon-up-arrow"></i>
    </base-button>
</template>

<script>
    export default {

        data() {
            return {
                showButton: false
            }
        },

        mounted() {
            $(window).scroll(() => {
                this.showButton = $(window).scrollTop() > 300
            });
        },

        methods: {
            scrollToTop() {
                $('html, body').animate({scrollTop:0}, '300');
            }
        }
    }
</script>

<style scoped>

    button {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition:
            opacity .5s,
            visibility .5s;
        padding: 15px;
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
    }
    button .tim-icons {
        top: -2px !important;
    }
    button.show {
        opacity: 1;
        visibility: visible;
    }

</style>
