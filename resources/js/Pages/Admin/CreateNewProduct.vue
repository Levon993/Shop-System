<template>
    <div>
        <div class="modal_button">
            <vs-button
                @click="modalShow = !modalShow"
                color="rgb(59,222,200)"
                gradient

            >
                Добавить Категорию
            </vs-button></div>
        <div class="list">

            <div>
                <vs-table striped>
                    <template #thead>
                        <vs-tr>
                            <vs-th>
                                Имя
                            </vs-th>
                            <vs-th>
                                Категория
                            </vs-th>
                            <vs-th>
                                Алиас
                            </vs-th>
                            <vs-th>
                                Цена
                            </vs-th>
                            <vs-th>
                                Старая Цена
                            </vs-th>
                            <vs-th>
                                Статус
                            </vs-th>
                            <vs-th>
                                Хит продаж
                            </vs-th>
                            <vs-th>
                                Было добавлено
                            </vs-th>
                            <vs-th>

                            </vs-th>
                            <vs-th>

                            </vs-th>
                        </vs-tr>
                    </template>
                    <template #tbody>
                        <vs-tr
                            :key="i"
                            v-for="(prd, i) in products"
                            :data="prd"
                        >
                            <vs-td>
                                {{ prd.title }}
                            </vs-td>
                            <vs-td>
                                {{prd.category ?  prd.category.title : ''}}
                            </vs-td>
                            <vs-td>
                                {{ prd.alias }}
                            </vs-td>
                            <vs-td>
                                {{ prd.price }}
                            </vs-td>
                            <vs-td>
                                {{ prd.old_price }}
                            </vs-td>
                            <vs-td>
                                {{ prd.status }}
                            </vs-td>
                            <vs-td>
                                {{ prd.hit }}
                            </vs-td>
                            <vs-td>
                                {{ validDate(prd.created_at)}}
                            </vs-td>
                            <vs-td>
                                <vs-button

                                    danger
                                    border
                                    @click="destroyCategory(prd.id)"
                                >
                                    Удалить
                                </vs-button
                                >
                            </vs-td>
                            <vs-td>
                                <vs-button
                                >
                                    Редактировать
                                </vs-button>
                            </vs-td>
                        </vs-tr>
                    </template>
                </vs-table>
            </div>

        </div>
        <div v-if="modalShow" class="modal">
            <div class="modal_body">
                <div class="modal_header">Добавление Товара</div>
                <div class="form_control">
                    <label for="title">Наименование Товара</label>
                    <input id="title" v-model="product.title" type="text" placeholder="Имя Товара">
                </div>
                <div class="form_control">
                    <label for="alias">Алиас</label>
                    <input type="text" v-model="product.alias" id="alias" placeholder="Алиас">
                </div>
                <div class="form_control">
                    <label for="keywords">Ключевое слово</label>
                    <input type="text" v-model="product.keywords" id="keywords" placeholder="Ключевое слово">
                </div>
                <div class="form_control">
                    <label for="price">Цена Товара</label>
                    <input type="number" v-model="product.price" id="price" placeholder="Цена">
                </div>
                <div class="form_control">
                    <label for="parent">Категория</label>
                    <select id="parent" v-model="product.category_id" class="parent_cat">
                        <option v-for="(cat,i) in categories" :value="cat.id" :key="i">{{ cat.title  }}</option>
                    </select>
                </div>
                <div class="form_control">
                    <textarea type="text" v-model="product.description" placeholder="Описание товара"></textarea>
                </div>
                <div class="form_control">
                    <input  id="ImageUpload"  class=" btn-success" type="file"/>
                </div>

                <div class="form_control buttons">
                    <vs-button
                        success
                        flat>
                        Сохранить
                    </vs-button>
                    <vs-button
                        @click="modalShow = false"
                        danger
                        border
                    >
                        Отмена
                    </vs-button>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    import axios from 'axios'
    import Index from "../../Layouts/index";
    import VueToastr from '@deveodk/vue-toastr'
    import '@deveodk/vue-toastr/dist/@deveodk/vue-toastr.css'
    Vue.use(VueToastr)
    import moment from 'moment'
    export default
    {
        name:"CreateNewProduct",
        components: {Index},
        data:(()=>{
            return{
                modalShow:true,
                product:{
                    category_id: '',
                    title:'',
                    alias:'',
                    price:'',
                    keywords:'',
                    description:'',
                },
                categories: [],
                products: []
            }
        }),
        mounted() {

            this.GetCategories()
            this.getProducts()
        },
        methods:{
            validDate(date)
            {
                return  moment(date).format("MMM Do YYYY");
            },
            async destroyCategory(id, i){
                if(confirm('Вы действитеьно хотите удалить категорию')) {
                    this.categories = this.categories.filter(cat => cat.id !== id)
                    console.log(this.categories)
                    const data = {
                        id: id
                    }
                    const res = await axios.post('/api/categories/destroy', data)
                    this.$toastr('add', {
                        title: 'Информация',
                        msg: res.data.message,
                        timeout: 6000,
                        position: 'toast-top-right',
                        type: 'info',
                    })


                }

            } ,
            async getProducts()
            {
                await this.$store.dispatch('PRODUCTS_ACTION');
                const res = await this.$store.getters.PRODUCTS_GETTER;
                this.categories = res
                this.products = res.data
            },
            async GetCategories()
            {
                await this.$store.dispatch('CATEGORIES_ACTION');
                const res = await this.$store.getters.CATEGOR_GETTER;
                this.categories = res
                console.log(this.categories)
            },

            CreatePost(){
                let data = new FormData();
                data.append('title', this.title)
                data.append('subject', this.subject)
                data.append('description', this.description)
                data.append('userId', this.currentUser.user.id)
                data.append('image', ImageUpload.files[0]);
                axios.post("/api/post/create", data).then(res=>{
                    console.log(res.data)
                })
            }
        },



    }
</script>
<style>
    .list{
        margin-top: 50px;
        padding: 5px;
        display: flex;
        justify-content: center;
        width: 100%;
        height: auto;
        /*background-color: red;*/
    }
    .modal_button
    {
        position: fixed;
        margin-left:58%;
        top: 45px;
        /*background-color: #a1cbef;*/
    }
    .modal
    {
        position: fixed;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background-color: rgba(0,0,0,0.3);
    }
    .modal_body
    {
        width: 300px;
        height: 546px;
        margin-left: 35%;
        margin-top: 5%;
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: white;
        border-radius: 5px;
    }
    .form_control
    {
        margin:5px;
        padding: 5px;
        display: flex;
        border-bottom: 1px solid rgba(0,0,0,0.3);
    ;
        flex-direction: column;

    }
    .form_control input
    {
        width: 250px;
        height: 22px;
        border-radius: 5px;
    }
    .form_control select
    {
        width: 250px;
        border-radius: 5px;

    }
    .form_control textarea
    {
        width: 250px;
        border-radius: 5px;

    }
    .form_control label
    {
        font-weight: 200;
        color: silver;
    }
    .modal_header
    {
        font-size: 25px;
        border-bottom: 1px solid rgba(0,0,0,0.3);
    }

    #ImageUpload
    {
       color: blue;
       border-radius: 5px;
    }

</style>
