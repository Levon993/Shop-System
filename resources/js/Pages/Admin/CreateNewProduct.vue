<template>
    <div>
        <div class="modal_button">
            <vs-button
                @click="modalShow = !modalShow"
                color="rgb(59,222,200)"
                gradient

            >
                Добавить Товар
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
                                Бренд
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
                                {{prd.brand ?  prd.brand.title : ''}}
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
                                {{ prd.status == 1  ? 'В наличии' : 'Нет в наличии' }}
                            </vs-td>
                            <vs-td>
                                {{ prd.hit == 1 ? "Да" : 'Нет' }}
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
            <Create v-if="modalShow"></Create>
        </div>

    </div>

</template>
<script>

    import Index from "../../Layouts/index";
    import VueToastr from '@deveodk/vue-toastr'
    import '@deveodk/vue-toastr/dist/@deveodk/vue-toastr.css'
    Vue.use(VueToastr)
    import moment from 'moment'
    import Create from '../../components/popups/CreateProduct'
    export default
    {
        name:"CreateNewProduct",
        components: {Index,Create},
        // mixins:[Vuelidate()],
        data:(()=>{
            return{
                modalShow:false,
                product:{
                    category_id: '',
                    title:'',
                    alias:'',
                    price:'',
                    brand_id:'',
                    keywords:'',
                    description:'',
                },
                categories: [],
                brands:[],
                products: []
            }
        }),


        mounted() {
            this.getProducts()


        },
        methods:{
            validDate(date)
            {
                return  moment(date).format("MMM Do YYYY");
            },

            async getProducts()
            {
                await this.$store.dispatch('PRODUCTS_ACTION');
                const res = await this.$store.getters.PRODUCTS_GETTER;
                this.products = res.data
            },



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
