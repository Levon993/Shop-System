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
             <vs-table  striped>
                 <template #thead>
                     <vs-tr>
                         <vs-th>
                             Имя
                         </vs-th>
                         <vs-th>
                             Алиас
                         </vs-th>
                         <vs-th>
                             Родительская Категория
                         </vs-th>
                         <vs-th>
                             Было Добавлено
                         </vs-th>
                         <vs-th>

                         </vs-th>
                     </vs-tr>
                 </template>
                 <template #tbody>
                     <vs-tr
                         :key="i"
                         v-for="(ctgr, i) in categories"
                         :data="ctgr"
                     >
                         <vs-td>
                             {{ ctgr.title }}
                         </vs-td>
                         <vs-td>
                             {{ ctgr.alias }}
                         </vs-td>
                         <vs-td>
                             {{ ctgr.parent ? ctgr.parent.title : "Нет род. категории" }}
                         </vs-td>
                         <vs-td>
                             {{ validDate(ctgr.created_at)}}
                         </vs-td>
                         <vs-td>
                             <vs-button

                                 danger
                                 border
                                 @click="destroyCategory(ctgr.id,i)"
                             >
                                 Удалить
                             </vs-button
>
                         </vs-td>
                     </vs-tr>
                 </template>
             </vs-table>
         </div>

            </div>
        <div v-if="modalShow" class="modal">
        <div class="modal_body">
       <div class="form_control">
           <label for="title">Имя Категории</label>
           <input id="title" v-model="category.title" type="text" placeholder="Имя Категории">
       </div>
            <div class="form_control">
              <label for="alias">Алиас</label>
           <input type="text" v-model="category.alias" id="alias" placeholder="Алиас">
       </div>
            <div class="form_control">
              <label for="keywords">Ключевое слово</label>
           <input type="text" v-model="category.keywords" id="keywords" placeholder="Ключевое слово">
       </div>
            <div class="form_control">
                <label for="parent">Род Категория</label>
           <select id="parent" v-model="category.parent_id" class="parent_cat">
            <option v-for="(cat,i) in categories" :value="cat.id" :key="i">{{ cat.title  }}</option>
           </select>
       </div>
            <div class="form_control">
                <textarea type="text" v-model="category.description" placeholder="Описание категории"></textarea>
       </div>
            <div class="form_control buttons">
                <vs-button
                    @click="createCategory()"
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
    // import { mapActions } from 'vuex'
    import { mapActions } from 'vuex'
    Vue.use(VueToastr)
 import moment from 'moment'
    export default
    {
        name:"CreateNewProduct",
        components: {Index},
        data:(()=>{
            return{
                modalShow:false,
               category:{
                   title:'',
                   alias:'',
                   parent_id:'',
                   keywords:'',
                   description:'',

               },
                categories: []
            }
        }),
        created() {


        },
        mounted() {
      this.GetCategories()

        },
        methods:{

            validDate(date)
            {
                return  moment(date).format("MMM Do YYYY");
            },
           async destroyCategory(id, i){
                if(confirm('Вы действитеьно хотите удалить категорию')) {
                    this.categories = this.categories.filter(cat => cat.id !== id)
                    const data = {
                        id: id
                    }
                    await this.$store.dispatch('CATEGORY_DESTROY_ACTION',data);
                    const res = await this.$store.getters.CATEGORY_DESTROY_GETTER;

                    this.$toastr('add', {
                        title: 'Информация',
                        msg: res.message,
                        timeout: 6000,
                        position: 'toast-top-right',

                    })


                }

           } ,
             async GetCategories()
            {
               await this.$store.dispatch('CATEGORIES_ACTION');
                const res = await this.$store.getters.CATEGOR_GETTER;
                this.categories = res


            },

         async createCategory()
           {
               try {
                   await this.$store.dispatch('CATEGORY_CREATE_ACTION',this.category);
                   const res = await this.$store.getters.CATEGORY_CREATE_GETTER;
                   this.category.title = ''
                   this.category.alias = ''
                   this.category.parent_id = ''
                   this.category.keywords = ''
                   this.category.description = ''
                   this.$toastr('add', {
                       title: 'Успешно',
                       msg: 'Категория Успешно Сохранена',
                       timeout: 3000,
                       position: 'toast-top-right',
                       type: 'success',
                   })
                   this.GetCategories()
               }catch(e){

                   this.$toastr('add', {
                       title: 'Проблема',
                       msg: 'Возможно проблема с валидацией проверте, правильно ли заполнены поля',
                       timeout: 6000,
                       position: 'toast-top-right',
                       type: 'error',
                   })
               }
           }

        }

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
        height: 450px;
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


</style>
