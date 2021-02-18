<template>
    <a href="#" class="nav-link" @click="logout">
        <i class="tim-icons icon-button-power"></i>
        <p class="d-lg-none">
            {{ $t('auth.log-out') }}
        </p>
    </a>
</template>

<script>
    export default {

        props: {
            endpoint: {
                type: String,
                default: '/trax/api/auth/logout'
            },
            redirectRouteName: {
                type: String,
                default: 'login'
            }
        },

        methods: {
            logout() {
                this.error = null;
                axios.post(this.endpoint)
                    .then(resp => {
                        this.$router.push({ name: this.redirectRouteName });
                    })
            }
        }
    }
</script>
