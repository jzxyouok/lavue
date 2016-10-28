<style>
    .modal-backdrop {
        z-index: 10 !important;
    }
</style>

<template>
    <textarea data-role="summernote"></textarea>
</template>
<script>
    require('summernote');
    import 'summernote/dist/summernote.css';
    import '../assets/css/summernote-bs3.css';

    export default {
        props: {
            model: {
                required: true,
                twoWay: true
            },
            language: {
                type: String,
                required: false,
                default: "en-US"
            },
            height: {
                type: Number,
                required: false,
                default: 300
            },
            minHeight: {
                type: Number,
                required: false,
                default: 200
            },
            maxHeight: {
                type: Number,
                required: false,
                default: 800
            },
            toolbar: {
                type: Array,
                required: false,
                default: function () {
                    return [
                        ["font", ["bold", "italic", "underline"]],
                        ["fontsize", ["fontsize"]],
                        ["para", ["ul", "ol", "paragraph"]],
                        ["color", ["color"]],
                        ['table', ['table']],
                        ["insert", ["link", "picture", "hr"]]
                    ];
                }
            }
        },
        data: function () {
            return {
                focus: undefined,
                blur: undefined
            }
        },
        ready: function () {
            var me = this;
            this.control = $(this.$el);
            this.control.summernote({
                lang: this.language,
                height: this.height,
                minHeight: this.minHeight,
                maxHeight: this.maxHeight,
                toolbar: this.toolbar,
                callbacks: {
                    onInit: function() {
                        me.control.summernote('code', me.model);
                    },
                    onFocus: function () {
                        me.focus = true;
                        me.blur = false;
                    },
                    onBlur: function () {
                        me.focus = false;
                        me.blur = true;
                    }
                }
            }).on("summernote.change", function () {
                if (!me.isChanging) {
                    me.isChanging = true;
                    var code = me.control.summernote('code');
                    me.model = (code === null || code.length === 0 ? null : code);
                    me.$nextTick(function () {
                        // DOM更新之后，将状态重置为false
                        me.isChanging = false;
                    });
                }
            });
        },
        watch: {
            focus: function () {
                this.$dispatch('editor-focus', this.focus);
            },
            blur: function () {
                this.$dispatch('editor-blur', this.blur);
            },
            model: function (val, oldVal) {
                if (!this.isChanging) {
                    this.isChanging = true;
                    var code = (val === null ? "" : val);
                    this.control.summernote('code', code);
                }
            }
        }
    }
</script>