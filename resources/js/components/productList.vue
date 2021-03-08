<template>
    <div>
    <div class="child_1_header">Продукты</div>
    <div class="container">
        <div class="card" v-for="product in products" :key="product.id">
            <vs-card type="3">
                <template #title>
                    <h3>{{product.title}}</h3>
                </template>
                <template #img>
                    <img :src="'http://shop.laravel.loc/storage/images/'+product.img" alt="">
                </template>
                <template #text>
                    <p>
                       {{product.description}}
                    </p>
                </template>
                <template #interactions>
                    <vs-button success icon>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-basket3-fill" viewBox="0 0 16 16">
                            <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426L.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z"/>
                        </svg>
                    </vs-button>
                    <vs-button class="btn-chat" shadow primary>
                        <i class='bx bx-chat'></i>
                        <span class="span">
                            {{product.price}}
                        </span>
                    </vs-button>
                </template>
            </vs-card>
        </div>
    </div>
    </div>
</template>
<script>
    export default {
        data:(()=>{
            return{
                products:[]
            }
        }),
        mounted() {
            this.getProducts()
        },
        methods:{
            async getProducts()
            {
                const data =
                    {
                        perPage:8
                    }
                await this.$store.dispatch('PRODUCTS_ACTION',data);
                const res = await this.$store.getters.PRODUCTS_GETTER;
                this.products = res.data

            },
        }
    }
</script>
<style>
    .container{
        margin-top: 80px;
        margin: 15px;
        padding: 15px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap:wrap ;
    }
     .card
     {
         margin: 7px;
     }

    .product_price
    {
        /*font-weight: 600;*/
        color: green;
    }
    .child_1_header
    {
        display:flex;
         justify-content:center;
         font-size: 45px;
    }
</style>
