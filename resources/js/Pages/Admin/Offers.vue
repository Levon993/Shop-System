<template>
    <div>
        <div class="modal_button">
            <vs-button
                @click="modalShow = !modalShow"
                color="rgb(59,222,200)"
                v-if="!modalShow"
                gradient

            >
                Добавить Предложение
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
                                Описание
                            </vs-th>
                            <vs-th>
                                Статус
                            </vs-th>
                            <vs-th>
                                Было Добавлено
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
                            v-for="(ofr, i) in offers"
                            :data="ofr"
                        >
                            <vs-td>
                                {{ ofr.title }}
                            </vs-td>
                            <vs-td>
                                {{ ofr.description}}
                            </vs-td>
                            <vs-td>
                                {{ ofr.status == 1  ? 'Активно' : 'Не Активно' }}
                            </vs-td>
                            <vs-td>
                                {{ validDate(ofr.created_at)}}
                            </vs-td>
                            <vs-td>
                                <vs-button

                                    danger
                                    border
                                    @click="destroyOffer(ofr.id)"
                                >
                                    Удалить
                                </vs-button
                                >
                            </vs-td>
                            <vs-td>

                                <vs-button
                                    @click="edidModal(ofr)"
                                >
                                    Редактировать
                                </vs-button>
                            </vs-td>
                        </vs-tr>
                    </template>
                </vs-table>
            </div>
            <Create v-if="modalShow"></Create>
            <Edit v-if="active" :offerData="editableData"></Edit>
        </div>

    </div>

</template>
<script>


    import VueToastr from '@deveodk/vue-toastr'
    import '@deveodk/vue-toastr/dist/@deveodk/vue-toastr.css'
    Vue.use(VueToastr)
    import moment from 'moment'
    import Create from '../../components/popups/CreateOffer'
    import Edit from '../../components/popups/editOffer'
    export default
    {
        name:"CreateNewProduct",
        components: {Create,Edit},
        // mixins:[Vuelidate()],
        data:(()=>{
            return{
                modalShow:false,

                offers: [],
                brands:[],
                products: [],
                active:false,
                editableData:{}
            }
        }),


        mounted() {
            this.getOffers()
        },
        methods:{
            validDate(date)
            {
                return  moment(date).format("MMM Do YYYY");
            },
            edidModal(ofr){
                this.editableData = ofr
                this.active = true
            },

            async getOffers()
            {
                await this.$store.dispatch('OFFERS_ACTION');
                const res = await this.$store.getters.OFFERS_GETTER;
                this.offers = res
                console.log(res)
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
        position: static;
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
        height: 500px;
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
        flex-direction: column;
        max-height: 150px;
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
