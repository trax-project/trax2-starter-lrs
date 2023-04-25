<template>
    <div>
        You <i class="tim-icons icon-heart text-primary"></i> TRAX LRS?
        <a href="http://traxlrs.com" target="_blank" rel="noopener">Support us!</a>
        <span class="version ml-4" v-if="showVersion">{{ version }}</span>
    </div>
</template>

<script>
    export default {

        props: {
            showVersion: {
                type: Boolean,
                default: false
            }
        },

        computed: {
            version() {
                return 'v' + this.$appVersion
            },
        }
    }
</script>

<style scoped>

    .version {
        color: #525f7f;
    }
    
</style>
