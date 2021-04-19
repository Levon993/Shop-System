<template>
    <div>
    <div class="child_1_header">Продукты</div>
    <div class="container">
        <div class="card" v-for="product in products" :key="product.id">
            <vs-card type="5">
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
                    <vs-button success @click="addToBasket(product.id)" icon>
                        <i class='bx bxs-cart-add'></i>

                    </vs-button>
                    <vs-button class="btn-chat" shadow primary>

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
    import axios from 'axios'
    export default {
        data:(()=>{
            return{
                products:[],
                basket:[],

            }
        }),
        mounted() {
            this.getProducts()

        },
        methods:{
            addToBasket(id){
                let basket =[]
                let item = {}
                let count = 1;
                if(JSON.parse(localStorage.getItem('Basket')))
                {
                     basket = JSON.parse(localStorage.getItem('Basket'))
                }
                //если корзина не пуста
                if(basket){
                    for (let i =0; i < basket.length; i++)
                    {
                        if(basket[i].id == id)
                        {
                            basket[i].count ++
                            localStorage.clear()
                            this.getProductsForBasket(basket)
                            localStorage.setItem('Basket', JSON.stringify(basket))
                            setTimeout(()=>
                            {
                                this.$parent.getBasketformStorage()
                            },1000)
                            return
                        }
                    }
                    item = {
                        id:id,
                        count:count
                    }
                    basket.push(item)
                    localStorage.clear()
                    this.getProductsForBasket(basket)
                    localStorage.setItem('Basket', JSON.stringify(basket));
                    setTimeout(()=>
                    {
                        this.$parent.getBasketformStorage()
                    },1000)
                    return;

                }
                else{
                    //Если корзина пуста, то в localstorage добавляется обьект с id и count
                     item = {
                        id:id,
                        count:count
                    }
                    this.basket.push(item)
                    localStorage.setItem('Basket', JSON.stringify(this.basket));
                     setTimeout(()=>
                     {
                         this.$parent.getBasketformStorage()
                     },1000)

                }

            },
            async getProductsForBasket(data)
            {
               const res = await axios.post('/api/orders/getProductsForBasket',data)
                localStorage.setItem('BasketData', JSON.stringify(res.data))
            },

            async getProducts()
            {
                const data =
                    {
                        perPage:6
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
        /*margin-top: 80px;*/
        /*margin: 15px;*/
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
