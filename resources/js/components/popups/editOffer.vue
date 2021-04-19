<template>
    <div  class="modal" >
        <div class="modal_body">
            <div class="modal_header">Добавление Предложение</div>
            <div class="form_control">
                <label for="title">Название Предложения</label>
                <input id="title" v-model="offerData.title"
                       type="text" placeholder="Название Предложения">
            </div>
            <div class="form_control">
                <label for="category">Продукты</label>
                <select id="category" v-model="offer.products_id" multiple class="parent_cat">
                    <option v-for="(prd,i) in products" :value="prd.id" :key="i">{{ prd.title  }}</option>
                </select>
            </div>
            <div class="form_control">
                <textarea type="text" v-model="offerData.description" placeholder="Текст Предложения"></textarea>
            </div>
            <div class="form_control">
                <input  id="ImageUpload"  class=" btn-success" type="file"/>
            </div>

            <div class="form_control buttons">
                <vs-button
                    success
                    @click.prevent.stop="EditOffer()"
                    flat>
                    Добавить
                </vs-button>
                <vs-button
                    @click="$parent.active = false"
                    danger
                    border
                >
                    Отмена
                </vs-button>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props:['offerData'],
        data:(()=>{

            return{
                offer:{
                    title:'',
                    products_id:[],
                },
                products:{


                },

            }
        }),
        mounted() {
            this.getProducts()


        },

        methods:{
            async  createNewOffer(){
                // try {
                let data = new FormData();
                data.append('title', this.offer.title)
                data.append('products_id', this.offer.products_id)
                data.append('description', this.offer.description)
                data.append('image', ImageUpload.files[0]);
                await this.$store.dispatch('OFFER_CREATE_ACTION', data);
                const res = await this.$store.getters.OFFER_CREATE_GETTER;

                this.offer.title = '',
                    this.offer.products_id = [],
                    this.offer.description = '',

                    this.$toastr('add', {
                        title: 'Успешно',
                        msg: 'Товар успешно сохранен',
                        timeout: 3000,
                        position: 'toast-top-right',
                        type: 'success',
                    })
                // }catch (e) {
                //     this.$toastr('add', {
                //         title: 'Что-то пошло не так',
                //         msg: 'Проверте все ли поля заполнены(Возможно проблема в отсуствии связи)',
                //         timeout: 3000,
                //         position: 'toast-top-right',
                //         type: 'error',
                //     })
                // }
            },
            async getProducts()
            {
                await this.$store.dispatch('PRODUCTS_ACTION',);
                const res = await this.$store.getters.PRODUCTS_GETTER;
                this.products = res.data
                console.log(res)


            },
        }


    }
</script>
