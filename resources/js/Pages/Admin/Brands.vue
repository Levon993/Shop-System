<template>
    <div>
        <div class="modal_button">
            <vs-button
                @click="modalShow = !modalShow"
                color="rgb(59,222,200)"
                gradient

            >
                Добавить Бренд
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
                                Алиас
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
                            v-for="(brd, i) in brands"
                            :data="brd"
                        >
                            <vs-td>
                                {{ brd.title }}
                            </vs-td>
                            <vs-td>
                                {{brd.alias}}
                            </vs-td>
                            <vs-td>
                                {{ validDate(brd.created_at)}}
                            </vs-td>
                            <vs-td>
                                <vs-button

                                    danger
                                    border
                                    @click="destroyBrand(brd.id)"
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
                <div class="modal_header">Добавление Бренда</div>
                <div class="form_control">
                    <label for="title">Наименование Бренда</label>
                    <input id="title" v-model="brand.title" type="text" placeholder="Имя Бренда">
                </div>
                <div class="form_control">
                    <label for="alias">Алиас</label>
                    <input type="text" v-model="brand.alias" id="alias" placeholder="Алиас">
                </div>
                <div class="form_control">
                    <textarea type="text" v-model="brand.description" placeholder="Описание товара"></textarea>
                </div>
                <div class="form_control">
                    <input  id="ImageUpload"  class=" btn-success" type="file"/>
                </div>

                <div class="form_control buttons">
                    <vs-button
                        success
                        @click="createNewBrand()"
                        flat>
                        Добавить
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
                modalShow:false,
                brand:{
                    title:'',
                    alias:'',
                    description:'',
                },
                brands: []
            }
        }),
        mounted() {

            this.getBrands()
        },
        methods:{
            validDate(date)
            {
                return  moment(date).format("MMM Do YYYY");
            },
            async getBrands()
            {
                await this.$store.dispatch('BRAND_ACTION');
                const res = await this.$store.getters.BRAND_GETTER;
                this.brands = res
            },

            async  createNewBrand(){
                try {

                    let data = new FormData();
                    data.append('title', this.brand.title)
                    data.append('alias', this.brand.alias)
                    data.append('description', this.brand.description)
                    data.append('image', ImageUpload.files[0]);
                    await this.$store.dispatch('BRAND_CREATE_ACTION', data);
                    const res = await this.$store.getters.PRODUCT_CREATE_GETTER;
                    this.getBrands()
                    this.$toastr('add', {
                        title: 'Успешно',
                        msg: 'Бренд Успешно Сохранен',
                        timeout: 4000,
                        position: 'toast-top-right',
                        type: 'success',
                    })
                }catch (e) {
                    this.$toastr('add', {
                        title: 'Что-то пошло не так',
                        msg: 'Проверте все ли поля заполнены(Возможно отсуствие связи)',
                        timeout: 4000,
                        position: 'toast-top-right',
                        type: 'Error',
                    })
                }
            },
            async destroyBrand(id){
                if(confirm('Вы действитеьно хотите удалить бренд')) {
                    this.brands = this.brands.filter(brd => brd.id !== id)
                    const data = {
                        id: id
                    }
                    await this.$store.dispatch('BRAND_DESTROY_ACTION',data);
                    const res = await this.$store.getters.BRAND_DESTROY_GETTER;

                    this.$toastr('add', {
                        title: 'Информация',
                        msg: res.message,
                        timeout: 6000,
                        position: 'toast-top-right',

                    })


                }
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
