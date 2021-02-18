<template>
    <div
        class="form-group"
        :class="{
            'input-group-focus': focused,
            'has-danger': error,
            'has-success': !error && touched && validate,
            'has-label': label,
            'has-icon': hasIcon,
        }"
    >
        <slot name="label">
            <label v-if="label"> {{ label }} {{ required ? '*' : '' }} </label>
        </slot>

        <div class="mb-0" :class="{'input-group': hasIcon}">

            <slot name="addonLeft">
                <span v-if="addonLeftIcon" class="input-group-prepend">
                    <div class="input-group-text"><i :class="addonLeftIcon"></i></div>
                </span>
            </slot>

            <slot>
                <input
                    :value="value"
                    v-bind="$attrs"
                    v-on="listeners"
                    class="form-control"
                    aria-describedby="addon-right addon-left"
                />
            </slot>

            <slot name="addonRight">
                <span v-if="addonRightIcon" class="input-group-append">
                    <div class="input-group-text"><i :class="addonRightIcon"></i></div>
                </span>
            </slot>

        </div>

        <slot name="error" v-if="error || $slots.error">
            <label class="error">{{ error }}</label>
        </slot>

        <slot name="helperText"></slot>
    </div>
</template>

<script>
export default {

    inheritAttrs: false,
    
    model: {
        prop: 'value',
        event: 'input'
    },
    
    props: {
        required: {
            type: Boolean
        },
        label: {
            type: String
        },
        error: {
            type: String,
            default: ''
        },
        validate: {
            type: Boolean,
            default: false
        },
        value: {
            type: [String, Number]
        },
        addonRightIcon: {
            type: String
        },
        addonLeftIcon: {
            type: String
        }
    },

    data() {
        return {
            focused: false,
            touched: false
        }
    },

    computed: {
        hasIcon() {
            return this.hasLeftAddon || this.hasRightAddon
        },
        hasLeftAddon() {
            const { addonLeft } = this.$slots
            return (
                addonLeft !== undefined ||
                this.addonLeftIcon !== undefined
            )
        },
        hasRightAddon() {
            const { addonRight } = this.$slots
            return (
                addonRight !== undefined ||
                this.addonRightIcon !== undefined
            )
        },
        listeners() {
            return {
                ...this.$listeners,
                input: this.onInput,
                blur: this.onBlur,
                focus: this.onFocus
            }
        }
    },

    methods: {
        onInput(evt) {
            if (!this.touched) {
                this.touched = true
            }
            this.$emit('input', evt.target.value)
        },
        onFocus(evt) {
            this.focused = true
            this.$emit('focus', evt)
        },
        onBlur(evt) {
            this.focused = false
            this.$emit('blur', evt)
        }
    }
}
</script>

<style scoped>

    .modal label.error {
        font-weight: 600;
    }
    .has-danger:after {
        content: "";
    }

</style>