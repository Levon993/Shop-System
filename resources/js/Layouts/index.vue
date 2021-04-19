
    <template>
<div>

        <div class="hidden">
            <vs-sidebar
                fixed
                reduce
                v-model="active"
                open
            >
                <template #logo>
                    <!-- ...img logo -->
                </template>
                <vs-sidebar-item id="home">
                    <template #icon>
                        <i class='bx bx-home'></i>
                    </template>
                    Home
                </vs-sidebar-item>
                <vs-sidebar-item id="market">
                    <template #icon>
                        <i class='bx bx-grid-alt'></i>
                    </template>
                    Market Overview
                </vs-sidebar-item>
                <vs-sidebar-item id="Music">
                    <template #icon>
                        <i class='bx bxs-music'></i>
                    </template>
                    Music
                </vs-sidebar-item>
                <vs-sidebar-group>
                    <template #header>
                        <vs-sidebar-item arrow>
                            <template #icon>
                                <i class='bx bx-group'></i>
                            </template>
                            Social media
                        </vs-sidebar-item>
                    </template>

                    <vs-sidebar-item id="Instagram">
                        <template #icon>
                            <i class='bx bxl-instagram'></i>
                        </template>
                        Instagram
                    </vs-sidebar-item>
                    <vs-sidebar-item id="twitter">
                        <template #icon>
                            <i class='bx bxl-twitter' ></i>
                        </template>
                        Twitter
                    </vs-sidebar-item>
                    <vs-sidebar-item id="Facebook">
                        <template #icon>
                            <i class='bx bxl-facebook' ></i>
                        </template>
                        Facebook
                    </vs-sidebar-item>
                </vs-sidebar-group>
                <vs-sidebar-group>
                    <template #header>
                        <vs-sidebar-item arrow>
                            <template #icon>
                                <i class='bx bx-code-alt' ></i>
                            </template>
                            Coding
                        </vs-sidebar-item>
                    </template>

                    <vs-sidebar-item id="github">
                        <template #icon>
                            <i class='bx bxl-github' ></i>
                        </template>
                        Github
                    </vs-sidebar-item>
                    <vs-sidebar-item id="codepen">
                        <template #icon>
                            <i class='bx bxl-codepen'></i>
                        </template>
                        Codepen
                    </vs-sidebar-item>
                    <vs-sidebar-item id="discord">
                        <template #icon>
                            <i class='bx bxl-discord'></i>
                        </template>
                        Discord
                    </vs-sidebar-item>
                    <vs-sidebar-item id="Javascript">
                        <template #icon>
                            <i class='bx bxl-javascript' ></i>
                        </template>
                        Javascript
                    </vs-sidebar-item>
                    <vs-sidebar-item id="git">
                        <template #icon>
                            <i class='bx bxl-git' ></i>
                        </template>
                        Git
                    </vs-sidebar-item>
                </vs-sidebar-group>
                <vs-sidebar-item id="donate">
                    <template #icon>
                        <i class='bx bxs-donate-heart' ></i>
                    </template>
                    Donate
                </vs-sidebar-item>
                <vs-sidebar-item id="drink">
                    <template #icon>
                        <i class='bx bx-drink'></i>
                    </template>
                    Drink
                </vs-sidebar-item>
                <vs-sidebar-item id="shopping">
                    <template #icon>
                        <i class='bx bxs-shopping-bags'></i>
                    </template>
                    Shopping
                </vs-sidebar-item>
                <vs-sidebar-item   id="chat">
                    <template #icon>
                        <i class='bx bxs-cart-add' @click="basket =! basket" ></i>

                    </template>
                    Карзина
                </vs-sidebar-item>
                <vs-sidebar-item id="chat">
                    <i class='bx bxs-cart-add'></i>

                    <template #badge>
                        {{basketData.length}}
                    </template>
                </vs-sidebar-item>
                <template @click="basket =! basket" #footer>
                    <vs-row justify="space-between" >
                        <vs-avatar badge-color="danger"  badge-position="top-right">

                        </vs-avatar>

<!--                        <vs-avatar>-->
<!--                            <img src="/avatars/avatar-5.png" alt="">-->
<!--                        </vs-avatar>-->
                    </vs-row>
                </template>
            </vs-sidebar>

    </div>
    <vs-dialog width="550px" not-center v-model="basket">
        <template #header>
            <h4 class="not-margin">
                Welcome to <b>Vuesax</b>
            </h4>
        </template>


        <div class="con-content">
        <div class="basket_item" v-for="product in basketData" :key="product.id">
            <img :src="'http://shop.laravel.loc/storage/images/'+product.img" alt="">
            <p>{{product.title}}</p>
            <vs-button
                square
                icon
                danger
                flat
                :active="active == 1" @click="active = 1"
            >
                -
            </vs-button>
            <vs-button class="btn-chat" shadow primary>

                        <span class="span">
                            {{product.count}}
                        </span>
            </vs-button>
            <vs-button
                square
                icon
                success
                flat
                :active="active == 1" @click="active = 1"
            >
                +
            </vs-button>
            <vs-button class="btn-chat" shadow primary>
                        <span class="span">
                            {{product.price}}
                        </span>
            </vs-button>
        </div>
        </div>

        <template #footer>
            <div class="con-footer">
                <vs-button @click="active=false" transparent>
                    Ok
                </vs-button>
            </div>
        </template>
    </vs-dialog>
        <div class="center example-nav">
            <vs-navbar not-line center-collapsed v-model="active">
                <template #left>
                    <img src="../aseets/logo.png" alt="">
                </template>
                <vs-navbar-item :active="active == 'guide'" id="guide">
                    <div class="center content-inputs">
                        <vs-input
                            placeholder="Найти Макароны"
                        />
                    </div>
                </vs-navbar-item>
                <vs-navbar-item :active="active == 'docs'" id="docs">
                    О Нас
                </vs-navbar-item>
                <vs-navbar-item :active="active == 'components'" id="components">
                    Что-то там
                </vs-navbar-item>
                <vs-navbar-item :active="active == 'license'" id="license">
                   И Что-то там еще
                </vs-navbar-item>
                <template #right>
                    <vs-button flat >Войти</vs-button>
                </template>
            </vs-navbar>
            <div class="square">
                <div class="child">
                    <offerList />
                </div>
                <div class="child_1">
                    <productList></productList>
                </div>
                <div class="child">
                    <brandsList />
                </div>
                <div class="child">

                </div>
            </div>
        </div>
</div>
    </template>

<script>
 import productList from '../components/productList'
 import offerList from '../components/OffersList'
 import brandsList from '../components/brandsSlide'
 import basket from '../components/popups/basket'
 import axios from 'axios'

    export default {
     components:{
         productList,
         brandsList,
         offerList,
         basket
     },
        data:() => ({
            active: 'home',
            basket:false,
            basketData:[]
        }),
        mounted() {

            this.getBasketformStorage()
            this.huynya()
        },



        methods:{
        async huynya(){
        const res = fetch('https://www.amalgama-lab.com/songs/d/depeche_mode/enjoy_the_silence.html',
            {
                method:'GET',
                headers:
                    {
                        'Access-Control-Allow-Origin': '*',
                        'Access-Control-Allow-Origin': 'origin',
                        'Access-Control-Allow-Origin': 'null'
                    }
            })
            console.log(res)
         },

            baskedShow(data){
                let basket =JSON.parse(localStorage.getItem('Basket'))
                let item = {
                    id:'',
                    name:'',
                    count:''
                }
                let order = {
                    basket:basket,
                    product:data,
                }
                console.log(order)
                // let product = basket.map(b=>{ }).
                // console.log(product)
            },


      async getBasketformStorage(){
          this.basketData = []
           let products = await JSON.parse(localStorage.getItem('BasketData'))
           let basket =await JSON.parse(localStorage.getItem('Basket'))
           let item = {
               title:'',
               category: '',
               count:'',
               brand: '',
               description:''
           }
           if(basket && products) {
               basket.map(b => {
                   products.map(p => {
                       if (p.id === b.id) {
                           // console.log(p.title)
                           item = {
                               id: p.id,
                               title: p.title,
                               count: b.count,
                               description: p.description,
                               img: p.img,
                               price: p.price


                           }
                           this.basketData.push(item)
                           {
                               return 'lkdkfdlkfl'
                           }
                       }
                   })
               })
           }

          console.log(this.basketData)
       }
        }
    }
</script>
<style>
.hidden
{
    margin-bottom: 150px;
}
.nav{
    margin: 15px;
    padding: 15px;
}
.search{
    display: flex;

    /*width: 300px;*/
}
.child_1{
    display: flex;
    /*margin-top:250px;*/

}
.child_1_header
{

}
    .child::-webkit-scrollbar {
        width: 0;
    }
.basket_count
{
    display: flex;
    flex-direction: column;
    width: 100%;
    height: auto;
}
    .basket_item
    {
        display: flex;
        justify-content:space-around;
        border: 1px solid silver;
        paddig: 5px;
        margin:5px;
        border-radius: 15px;
    }
    .basket_item img
    {
        width: 80px;
        margin-top: 10px;
        height: 80px;
        border-radius: 5px;
    }
    .basket_item p
    {
        width:80px;
        text-overflow:clip;
    }
    .basket_item button
    {
        height: 20px;
        top: 40px;

    }




</style>
