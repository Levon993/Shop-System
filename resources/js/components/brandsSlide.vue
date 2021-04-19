<template>
    <vs-card-group>
        <vs-card v-for="brand in brands" :key="brand.id">
            <template #title>
                <h3>{{brand.title}}</h3>
            </template>
            <template #title>
                <h3>{{brand.title}}</h3>
            </template>
            <template #img>
                <img :src="'http://shop.laravel.loc/storage/images/'+brand.img" alt="">
            </template>
            <template #text>
                <p>
                    {{brand.description}}
                </p>
            </template>
            <template #interactions>
<!--                <vs-button danger icon>-->
<!--&lt;!&ndash;                    <i class='bx bx-heart'></i>&ndash;&gt;-->
<!--                </vs-button>-->
<!--                <vs-button class="btn-chat" shadow primary>-->
<!--&lt;!&ndash;                    <i class='bx bx-chat'></i>&ndash;&gt;-->
<!--&lt;!&ndash;                    <span class="span">&ndash;&gt;-->
<!--&lt;!&ndash;            54&ndash;&gt;-->
<!--&lt;!&ndash;          </span>&ndash;&gt;-->
<!--                </vs-button>-->
            </template>
        </vs-card>
    </vs-card-group>
</template>
<script>
    export default {
        data: (() => {
            return {
                brands: []
            }
        }),
        mounted() {
            this.getBrands()
        },
        methods: {
            async getBrands()
            {
                await this.$store.dispatch('BRAND_ACTION');
                const res = await this.$store.getters.BRAND_GETTER;
                this.brands = res
            },
        }
    }
</script>
