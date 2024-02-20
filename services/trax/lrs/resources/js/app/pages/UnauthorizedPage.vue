<template>
    <centered>
        <div class="row">
            <div class="col text-center pt-5">
                <h2>{{ $t('common.unauthorized') }}</h2>
                <router-link :to="backUrl">
                    <base-button type="primary">{{ $t('common.go-back-home') }}</base-button>
                </router-link>
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
        }
    }
</script>
