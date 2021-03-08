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
                <vs-button danger icon>
                    <i class='bx bx-heart'></i>
                </vs-button>
                <vs-button class="btn-chat" shadow primary>
                    <i class='bx bx-chat'></i>
                    <span class="span">
            54
          </span>
                </vs-button>
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
