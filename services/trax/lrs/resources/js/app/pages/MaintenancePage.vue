<template>
    <centered>
        <div class="row">
            <div class="col text-center pt-5">
                <h2>{{ $t('common.maintenance') }}</h2>
                <base-button type="primary" @click="back">{{ $t('common.retry') }}</base-button>
            </div>
        </div>
    </centered>
</template>

<script>
    import Centered from '../layout/parts/Centered'

    export default {

        components: {
            Centered
        },

        props: {
            backUrl: {
                type: String,
                default: '/lrs/home'
            }
        },

        methods: {

            back() {
                let target = this.$auth.redirect() ? this.$auth.redirect() : this.backUrl
                this.$router.push(target)
            }
        }
    }
</script>
