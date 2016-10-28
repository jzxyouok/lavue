<template>
    <label class="help-block error" v-show="field">{{ message }}</label>
    <label class="help-block error" v-else>&nbsp;</label>
</template>

<script>
    export default {
        props: {
            field: {
                required: true,
                type: Boolean
            },
            message: {
                require: true,
                type: String
            }
        }
    }
</script>