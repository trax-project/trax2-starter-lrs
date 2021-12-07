<template>
    <div>
        You <i class="tim-icons icon-heart text-primary"></i> TRAX LRS?
        <a href="http://traxlrs.com" target="_blank" rel="noopener">Support us!</a>
        <p class="version mt-1">{{ version }}</p>
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
