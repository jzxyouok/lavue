<template>
    <div>
        <router-view></router-view>
        <loading :show-loading="showLoading"></loading>
    </div>
</template>

<script>
    import Loading from './components/loading.vue';
    export default {
        ready: function () {
            let self = this;

            Vue.http.interceptors.push((request, next) => {
                self.showLoading = true;

                next(function(response) {
                    self.showLoading = false;
                    return response;
                })
            });
        },
        data: function () {
            return {
                showLoading: false
            }
        },
        components: {
            loading: Loading
        }
    }
</script>