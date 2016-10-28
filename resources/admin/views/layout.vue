<template>
    <div id="wrapper" style="background-color: #ecf0f5;">

        <app-header></app-header>
        <app-menu></app-menu>

        <div class="gray-bg content-wrapper" id="page-wrapper" style="height: 100%;">
            <div class="content-wrapper" style="min-height: 1000px;margin-left: 0;">
                <div class=" wrapper wrapper-content animated fadeInRight">

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <router-view></router-view>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
</template>

<script>
    import menu from './layouts/menu.vue';
    import header from './layouts/header.vue';
    export default {

        components: {
            appHeader: header,
            appMenu: menu
        }

    }
</script>