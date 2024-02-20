<template>
    <modal class="primary short center"
        :title="definedTitle"
        :value="value"
        @input="canceled"
    >
        <slot></slot>
        <div slot="footer">
            <button type="button" class="btn btn-link" data-dismiss="modal">{{ $t('common.cancel') }}</button>
            <button type="button" class="btn btn-link" @click="confirmed">{{ $t('common.confirm') }}</button>
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

<style scoped>

    .primary >>> .modal-header h1 {
        text-transform: uppercase;
        font-weight: 600 !important;
        font-size: 1.2rem;
        margin-top: 20px;
    }
    .primary >>> .modal-body p {
        color: rgba(255, 255, 255, 0.8);
        font-weight: 400;
    }
    .primary >>> .modal-footer {
        margin-top: 10px;
    }
    .primary >>> .modal-footer button {
        opacity: .8;
        color: #fff;
        text-transform: uppercase;
    }
    .primary >>> .modal-footer button:hover {
        opacity: 1;
    }
    .primary >>> .modal-footer button:first-child {
        opacity: .4;
        margin-right: 20px;
    }
    .primary >>> .modal-footer button:first-child:hover {
        opacity: .6;
    }
    
</style>
