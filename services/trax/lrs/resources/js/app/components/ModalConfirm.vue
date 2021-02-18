<template>
    <modal class="white short center" :title="definedTitle" :value="value" @input="canceled">
        <slot></slot>
        <div slot="footer">
            <button type="button" class="btn btn-danger" @click="confirmed">{{ $t('common.confirm') }}</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $t('common.cancel') }}</button>
        </div>
    </modal>
</template>

<script>
    export default {
        
        props: {
            value: {
                type: Object,
                required: true
            },
            title: {
                type: String,
                default: null
            },
        },
        computed: {

            definedTitle() {
                return this.title || this.$t('common.confirm-question')
            }
        },
        methods: {

            confirmed() {
                $('#'+this.value.id).modal('hide')
                this.$emit('input', {
                    id: this.value.id,
                    show: false,
                    confirmed: true,
                    data: this.value.data
                })
            },

            canceled() {
                this.$emit('input', {
                    id: this.value.id,
                    show: false,
                    confirmed: false,
                    data: this.value.data
                })
            }
        }
    }
</script>