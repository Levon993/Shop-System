<template>
    <vs-card-group>
        <vs-card type="5" v-for="offer in offers" :key="offer.id">
            <template #title>
            </template>
            <template #title>
                <h3>{{offer.title}}</h3>

                <!--                <h3>{{offer.description}}</h3>-->
            </template>
            <template #img>
                <img class="imag" :src="'http://shop.laravel.loc/storage/images/'+offer.img" alt="">
            </template>
            <template #text>
                <p>
                    {{offer.description}}
                </p>
            </template>
            <template #interactions>
                       </template>
        </vs-card>
    </vs-card-group>
</template>
<script>
    export default {
        data: (() => {
            return {
                offers: []
            }
        }),
        mounted() {
            this.getOffers()
        },
        methods: {
            async getOffers()
            {
                await this.$store.dispatch('OFFERS_ACTION');
                const res = await this.$store.getters.OFFERS_GETTER;
                this.offers = res
            },
        }
    }
</script>
<style>
    .imag{
        width: 250px;
        height: 350px;
    }
</style>
