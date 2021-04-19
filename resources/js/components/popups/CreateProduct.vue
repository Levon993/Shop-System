<template>
    <div  class="modal">
        <div class="modal_body">
            <div class="modal_header">Добавление Товара</div>
            <div class="form_control">
                <label for="title">Наименование Товара</label>
                <input id="title" v-model="product.title"

                       type="text" placeholder="Имя Товара">
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
                <label for="category">Категория</label>
                <select id="category" v-model="product.category_id" class="parent_cat">
                    <option v-for="(cat,i) in categories" :value="cat.id" :key="i">{{ cat.title  }}</option>
                </select>
            </div>
            <div class="form_control">
                <label for="brand">Бренд</label>
                <select id="brand" v-model="product.brand_id" class="parent_cat">
                    <option v-for="(brd,i) in brands" :value="brd.id" :key="i">{{ brd.title  }}</option>
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
                    @click.prevent.stop="createNewProduct()"
                    flat>
                    Добавить
                </vs-button>
                <vs-button
                    @click="$parent.modalShow = false"
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
        data:(()=>{
            return{
                product:{
                    category_id: '',
                    title:'',
                    alias:'',
                    price:'',
                    brand_id:'',
                    keywords:'',
                    description:'',
                },
                categories:[],
                brands:[]
            }
        }),
        mounted() {
            this.GetCategories()
            this.getBrands()

        },

        methods:{
            async  createNewProduct(){
                try {
                    let data = new FormData();
                    data.append('title', this.product.title)
                    data.append('category_id', this.product.category_id)
                    data.append('brand_id', this.product.brand_id)
                    data.append('alias', this.product.alias)
                    data.append('price', this.product.price)
                    data.append('keywords', this.product.keywords)
                    data.append('image', ImageUpload.files[0]);
                    await this.$store.dispatch('PRODUCT_CREATE_ACTION', data);
                    const res = await this.$store.getters.PRODUCT_CREATE_GETTER;
                    this.product.title = '',
                        this.product.category_id = '',
                        this.product.brand_id = '',
                        this.product.alias = '',
                        this.product.price = '',
                        this.product.keywords = '',
                        this.$toastr('add', {
                            title: 'Успешно',
                            msg: 'Товар успешно сохранен',
                            timeout: 3000,
                            position: 'toast-top-right',
                            type: 'success',
                        })
                }catch (e) {
                    this.$toastr('add', {
                        title: 'Что-то пошло не так',
                        msg: 'Проверте все ли поля заполнены(Возможно проблема в отсуствии связи)',
                        timeout: 3000,
                        position: 'toast-top-right',
                        type: 'error',
                    })
                }
            },
            async getBrands()
            {
                await this.$store.dispatch('BRAND_ACTION');
                const res = await this.$store.getters.BRAND_GETTER;
                this.brands = res
                console.log(this.brands);
            },
            async GetCategories()
            {
                await this.$store.dispatch('CATEGORIES_ACTION');
                const res = await this.$store.getters.CATEGOR_GETTER;
                this.categories = res

            },
        }


    }
</script>
