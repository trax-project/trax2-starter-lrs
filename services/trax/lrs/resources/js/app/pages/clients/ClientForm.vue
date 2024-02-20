<template>
    <form @submit.prevent="submit" @keydown="errors.clear($event.target.name)">

        <base-input class="mb-3"
            :label="$t('common.name')"
            :placeholder="$t('common.name')"
            required
            v-model="value.name"
            name="name"
            :error="errors.get('name')">
        </base-input>

        <base-input class="mb-3"
            :label="$t('common.username')"
            :placeholder="$t('common.username')"
            required
            v-model="value.access.credentials.username"
            name="access.credentials.username"
            :error="errors.get('access.credentials.username')">
        </base-input>

        <base-input class="mb-3"
            :label="$t('common.password')"
            :placeholder="$t('common.password')"
            required
            v-model="value.access.credentials.password"
            name="access.credentials.password"
            :error="errors.get('access.credentials.password')">
        </base-input>

        <div class="category form-category mb-3">* {{ $t('common.required-fields') }}</div>

        <div class="buttons pt-2 text-center">
            <base-button type="primary" native-type="submit" :disabled="errors.any()">
                {{ value.id ? $t('common.update') : $t('common.create') }}
            </base-button>

            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                {{ $t('common.cancel') }}
            </button>
        </div>

    </form>
</template>

<script>
    export default {
        props: ['value', 'errors'],
        methods: {
            submit() {
                this.$emit('input', { ...this.value})
            }
        }
    }
</script>
