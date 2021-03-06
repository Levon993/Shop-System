<template>
    <div class="center examplex">
        <vs-navbar center-collapsed v-model="active">
<!--            <template #left>-->
<!--                <img src="/logo2.png" alt="">-->
<!--            </template>-->
            <vs-navbar-group>
                Страницы добавления
                <template #items>
                    <vs-navbar-item  id="guide">
                        <router-link to="/newProduct">Добавить новый товар</router-link>
                    </vs-navbar-item>
                    <vs-navbar-item >

                        <router-link to="/newCategory">Добавить новую категорию</router-link>

                    </vs-navbar-item>
                    <vs-navbar-item :active="active == 'components'" id="components">
                        Components
                    </vs-navbar-item>
                </template>
            </vs-navbar-group>

            <vs-navbar-group>
                Ecosystem

                <template #items>
                    <h5 class="title">
                        Social
                    </h5>

                    <vs-navbar-item :active="active == 'Github'" id="Github">
                        Github
                    </vs-navbar-item>
                    <vs-navbar-item :active="active == 'Discord'" id="Discord">
                        Discord
                    </vs-navbar-item>
                    <vs-navbar-item :active="active == 'Twitter'" id="Twitter">
                        Twitter
                    </vs-navbar-item>
                    <vs-navbar-item :active="active == 'Medium'" id="Medium">
                        Medium
                    </vs-navbar-item>
                </template>
            </vs-navbar-group>

            <vs-navbar-item :active="active == 'License'" id="License">
                License
            </vs-navbar-item>

            <template #right>
                <vs-button flat >Выйти</vs-button>

            </template>
        </vs-navbar>
        <div class="square">
            <div class="child">
                <h5>Наши пользователи</h5>
                <router-view></router-view>

            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data:() => ({
            active: 'guide'
        })
    }
</script>
