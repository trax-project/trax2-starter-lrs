<template>
    <div class="typo" v-if="info">

        <div class="row mb-3">
            <div class="col-md-2 text-left text-md-right">
                {{ $t('common.protocol') }}
            </div>
            <div class="col-md-10">
                Basic HTTP
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-2 text-left text-md-right">
                {{ $t('common.endpoint') }}
            </div>
            <div class="col-md-10">
                {{ info.endpoint }}
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-2 text-left text-md-right">
                {{ $t('common.username') }}
            </div>
            <div class="col-md-10">
                {{ info.access.credentials.username }}
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-2 text-left text-md-right">
                {{ $t('common.password') }}
            </div>
            <div class="col-md-10">
                {{ info.access.credentials.password }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['info'],
    }
</script>

<style scoped>

    div.col-md-10 {
        color: rgba(255, 255, 255, 0.7);
    }

</style>