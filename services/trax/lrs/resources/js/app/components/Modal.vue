<template>
    <div class="modal" tabindex="-1" role="dialog" :id="modalId">
        <div class="modal-dialog" :class="'modal-'+size" role="document" v-show="!loading">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" :class="'text-'+titleColor" v-if="title">
                        {{ title }}
                    </h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer">
                    <slot name="footer"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props: {
            id: {
                type: String,
                default: null
            },
            value: {
                type: Object,
                default: null
            },
            title: {
                type: String,
                default: null
            },
            titleColor: {
                type: String,
                default: null
            },
            size: {
                type: String,
                default: 'md'
            },
            loading: {
                type: Boolean,
                default: false
            },
        },

        computed: {

            modalId() {
                if (this.value) {
                    return this.value.id;
                }
                if (this.id) {
                    return this.id;
                }
                return 'modal';
            }
        },

        watch: {
            value(newVal) {
                if (newVal.show) {
                    $('#'+this.modalId).modal()
                } else {
                    $('#'+this.modalId).modal('hide')
                }
            }
        },

        mounted() {
            if (!this.value) {
                return;
            }
            $('#'+this.modalId).on('hidden.bs.modal', e => {
                this.$emit('input', {
                    id: this.modalId,
                    show: false,
                    data: this.value.data
                })
            })
        }
    }
</script>

<style scoped>
    /*
    Styling options
    ===============
    Class 'primary' for pink background (default is black)
    Class 'white' for white background (default is black)
    Class 'center' to center the title, content and buttons
    Class 'short' for short content (Y translation)
    Class 'fullscreen' for border to border modals
    Class 'no-footer' to remove the footer
    */

    /* Default */

    .modal .modal-dialog {
        top: 5vh;
    }
    .modal.show .modal-dialog {
        -webkit-transform: none;
        transform: none;
    }
    .modal .modal-content {
        background-color: #27293d;
        box-shadow: 0px 10px 50px 0px rgba(0, 0, 0, 0.5) !important;
    }
    .modal .modal-body p,
    .modal .modal-header .modal-title {
        color: white;
        font-weight: 100;
    }
    .modal .modal-header button.close > span {
        color: white;
        font-size: 2rem;
        font-weight: 100;
        z-index: 1000;
    }
    .modal .modal-header .close:hover > span {
        color: white;
    }
    .modal .modal-footer {
        padding: 0 24px 16px 24px;
    }


    /* center */

    .modal.center .modal-title {
        width: 100%;
        text-align: center;
        padding-right: 30px;
        padding-left: 30px;
    }
    .modal.center p {
        text-align: center;
    }
    .modal.center .modal-footer {
        text-align: center;
    }
    .modal.center .modal-footer div {
        text-align: center;
        width: 100%;
    }

    /* white */

    .modal.white .modal-content {
        background-color: #fff;
    }
    .modal.white .modal-header .modal-title {
        color: #222a42;
        font-weight: 300;
    }
    .modal.white .modal-body p {
        color: #222a42;
        font-weight: 400;
    }
    .modal.white .modal-header .close > span {
        color: #222a42;
    }
    .modal.white .modal-header .close:hover > span {
        color: #222a42;
    }

    /* pink */

    .modal.primary .modal-content {
        background-color: #e14eca;
    }

    /* fullscreen */

    .modal.fullscreen {
        padding: 0 !important;
    }
    .modal.fullscreen .modal-dialog {
        top: 70px;
        max-width: 95vw;
    }
    .modal.fullscreen .modal-content {
        min-height: 90vh;
    }
    @media (min-width: 576px) {
        .modal-dialog {
            margin-top: 0 !important;
        }
    }
    
    /* short */
    
    .modal.short .modal-dialog {
        top: 15vh;
    }
  
    /* no-footer */

    .modal.no-footer .modal-footer {
        display: none;
    }

</style>
