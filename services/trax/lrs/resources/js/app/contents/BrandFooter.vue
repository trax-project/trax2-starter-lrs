<template>
    <div>
        You <i class="tim-icons icon-heart text-primary"></i> TRAX LRS?
        <a href="http://traxlrs.com" target="_blank" rel="noopener">Support us!</a>
        <span class="version ml-4">{{ version }}</span>
    </div>
</template>

<script>
    export default {
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
