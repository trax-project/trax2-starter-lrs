<template>
    <card class="spaced typo">

        <h2 class="text-white">
            {{ $t('xapi.management.clear-all.title') }}
        </h2>
        <p>
            {{ $t('xapi.management.clear-all.description') }}
        </p>

        <base-button type="primary mt-2" :loading="deleting" @click="clearAll">
            {{ $t('xapi.management.clear-all.button') }}
        </base-button>

        <div class="text-danger pt-2" v-if="error">
            {{ $t('xapi.management.clear-all.error') }}
        </div>

        <portal to="modals">
            <modal-confirm v-model="modals.confirmClearAll">
                <p>{{ $t('xapi.management.clear-all.confirm') }}</p>
            </modal-confirm>
        </portal>

    </card>
</template>

<script>
    import ModalsController from '@trax/classes/ModalsController'

    export default {

        data() {
            return {
                modals: new ModalsController('confirmClearAll'),
                deleting: false,
                error: false
            }
        },

        created() {
            this.modals.watch(this, 'modals')
        },

        methods: {

            clearAll() {
                this.error = false
                this.modals.open('confirmClearAll').then(resp => {
                    if (resp.confirmed) {
                        this.deleting = true
                        axios.post(
                            '/trax/api/front/xapi/ext/stores/clear',
                        )
                        .then(response => {
                            this.deleting = false
                        })
                        .catch(error => {
                            this.deleting = false
                            this.error = true
                            this.$auth.handleErrorVm(error, this)
                        })
                    }
                })
            }
        }
    }
</script>
