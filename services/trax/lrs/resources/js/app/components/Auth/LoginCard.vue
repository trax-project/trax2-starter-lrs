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
            redirectRouteName: {
                type: String,
                required: true
            }
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
                        this.$router.push({ name: this.redirectRouteName });
                    })
                    .catch(err => {
                        this.error = this.$t('auth.login-error');
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
