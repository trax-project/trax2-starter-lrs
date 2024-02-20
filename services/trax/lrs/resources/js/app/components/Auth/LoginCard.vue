<template>
    <card class="text-center p-3">
        
        <h1 class="card-title mb-4">{{ $t('auth.login') }}</h1>
        
        <form @submit.prevent="login">

            <base-input type="email" required
                addon-left-icon="tim-icons icon-single-02"
                :placeholder="$t('auth.email-placeholder')"
                v-model="form.username"
                class="mb-3">
            </base-input>

            <base-input type="password" required
                addon-left-icon="tim-icons icon-access-key"
                :placeholder="$t('auth.password-placeholder')"
                v-model="form.password"
                class="mb-3">
            </base-input>

            <p class="text-danger mb-3" v-if="error">
                {{ error }}
            </p>

            <base-button class="mt-3"
                native-type="submit"
                type="primary">
                {{ $t('auth.log-in') }}
            </base-button>
        
        </form>

    </card>
</template>

<script>
    export default {

        props: {
            endpoint: {
                type: String,
                default: '/trax/api/auth/login'
            },
        },

        data() {
            return {
                form: {
                    username: null,
                    password: null
                },
                error: null
            }
        },

        methods: {
            login() {
                this.error = null;
                axios.post(this.endpoint, this.form)
                    .then(resp => {
                        this.$topbar.hide();
                        let target = this.$auth.redirect() ? this.$auth.redirect() : { name: 'home' }
                        this.$router.push(target)
                        .catch(err => {
                            // This may happen when we need to do something before accessing to the home page.
                            // And this is normal. Nothing to do.
                        })
                    })
                    .catch(err => {
                        switch(err.response.status) {
                            case 503:
                                this.$router.push({ name: 'maintenance' })
                                break
                            case 401:
                            case 422:
                                this.error = this.$t('auth.login-error')
                                break
                            default:
                                this.error = this.$t('auth.login-unknown-error')
                                break;
                        }
                    });
            }
        }
    }
</script>

<style scoped>

    form >>> .form-group .input-group-prepend .input-group-text,
    form >>> .input-group .input-group-prepend .input-group-text {
        padding: 10px 9px 10px 12px;
    }
    form >>> .form-group .form-control,
    form >>> .input-group .form-control {
        padding-left: 9px;
    }

</style>
