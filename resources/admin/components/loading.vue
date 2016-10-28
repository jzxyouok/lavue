<style>
    .mask {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 2000;
        background-color: rgba(200,200,200,.5);
    }
    .loader {
        position: absolute;
        left: 50%;
        top: 50%;
        margin-left: -60px;
        margin-top: -12px;
        z-index: 2001;
    }
    .dot {
        float: left;
        margin: 0 8px;
        width: 24px;
        height: 24px;
        border-radius: 12px;
        background: black;
    }
</style>

<template>
    <div v-show="showLoading">
        <div class="mask"></div>
        <div class="loader">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>
</template>

<script>
    import Dynamics from 'dynamics.js';
    export default {
        props: {
            showLoading: {
                required: false,
                type: Boolean,
                default: false
            }
        },
        ready: function() {
            var dots = document.querySelectorAll('.dot')
            var colors = ['#007EFF', '#FF3700', '#92FF00']
            function animateDots() {
                for(var i=0; i<dots.length; i++) {
                    Dynamics.animate(dots[i], {
                        translateY: -70,
                        backgroundColor: colors[i]
                    }, {
                        type: Dynamics.forceWithGravity,
                        bounciness: 800,
                        elasticity: 200,
                        duration: 2000,
                        delay: i * 450
                    })
                }

                Dynamics.setTimeout(animateDots, 2500)
            }

            animateDots()
        }
    }
</script>