<template>
    <div class="container" :style="'max-width:'+width+'px'">
        <div class="row h-100 align-items-center">
            <div class="col">

                <brand class="mb-5 text-center" v-if="brand"></brand>

                <slot></slot>

                <div class="text-center text-white mt-5" v-if="links">
                    <brand-footer></brand-footer>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props: {
            width: {
                type: Number,
                default: 400
            },
            brand: {
                type: Boolean,
                default: false
            },
            links: {
                type: Boolean,
                default: false
            }
        }
    }
</script>

<style scoped>
    .content {
        height: 100vh;
    }
    .container {
        height: 80vh;
    }
</style>
