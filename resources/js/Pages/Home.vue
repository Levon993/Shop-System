<template>
    <div class="container">
        <div class="card">
            <img src="../aseets/foto5.png" alt="Denim Jeans" style="width:100%">
            <h1>Tailored Jeans</h1>
            <p class="price">$19.99</p>
            <p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
            <p><button>Add to Cart</button></p>
        </div>  <div class="card">
            <img src="../aseets/foto5.png" alt="Denim Jeans" style="width:100%">
            <h1>Tailored Jeans</h1>
            <p class="price">$19.99</p>
            <p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
            <p><button>Add to Cart</button></p>
        </div>  <div class="card">
            <img src="../aseets/foto5.png" alt="Denim Jeans" style="width:100%">
            <h1>Tailored Jeans</h1>
            <p class="price">$19.99</p>
            <p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
            <p><button>Add to Cart</button></p>
        </div>  <div class="card">
            <img src="../aseets/foto5.png" alt="Denim Jeans" style="width:100%">
            <h1>Tailored Jeans</h1>
            <p class="price">$19.99</p>
            <p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
            <p><button>Add to Cart</button></p>
        </div>  <div class="card">
            <img src="../aseets/foto5.png" alt="Denim Jeans" style="width:100%">
            <h1>Tailored Jeans</h1>
            <p class="price">$19.99</p>
            <p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
            <p><button>Add to Cart</button></p>
        </div>  <div class="card">
            <img src="../aseets/foto5.png" alt="Denim Jeans" style="width:100%">
            <h1>Tailored Jeans</h1>
            <p class="price">$19.99</p>
            <p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
            <p><button>Add to Cart</button></p>
        </div>  <div class="card">
            <img src="../aseets/foto5.png" alt="Denim Jeans" style="width:100%">
            <h1>Tailored Jeans</h1>
            <p class="price">$19.99</p>
            <p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
            <p><button>Add to Cart</button></p>
        </div>  <div class="card">
            <img src="../aseets/foto5.png" alt="Denim Jeans" style="width:100%">
            <h1>Tailored Jeans</h1>
            <p class="price">$19.99</p>
            <p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
            <p><button>Add to Cart</button></p>
        </div>  <div class="card">
            <img src="../aseets/foto5.png" alt="Denim Jeans" style="width:100%">
            <h1>Tailored Jeans</h1>
            <p class="price">$19.99</p>
            <p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
            <p><button>Add to Cart</button></p>
        </div>  <div class="card">
            <img src="../aseets/foto5.png" alt="Denim Jeans" style="width:100%">
            <h1>Tailored Jeans</h1>
            <p class="price">$19.99</p>
            <p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
            <p><button>Add to Cart</button></p>
        </div>  <div class="card">
            <img src="../aseets/foto5.png" alt="Denim Jeans" style="width:100%">
            <h1>Tailored Jeans</h1>
            <p class="price">$19.99</p>
            <p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
            <p><button>Add to Cart</button></p>
        </div>  <div class="card">
            <img src="../aseets/foto5.png" alt="Denim Jeans" style="width:100%">
            <h1>Tailored Jeans</h1>
            <p class="price">$19.99</p>
            <p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
            <p><button>Add to Cart</button></p>
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
          async  getProducts()
            {
                await this.$store.dispatch('PRODUCTS_ACTION');
                const res = await this.$store.getters.PRODUCTS_GETTER;
                this.products = res
                console.log(this.products)
            }
        }

    }
</script>
<style>
    .container{
        /*width: 350px;*/
        /*height: 400px;*/
        margin-top: 55px;
        margin: 15px;
        padding: 15px;
        display: flex;
        /*flex-direction: column;*/
        justify-content: center;
        align-items: center;
        flex-wrap:wrap ;
    }
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 200px;
        margin: auto;

        /*text-align: center;*/
        font-family: arial;
    }

    .price {
        color: grey;
        font-size: 22px;
    }

    .card button {
        border: none;
        outline: 0;
        padding: 12px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
    }

    .card button:hover {
        opacity: 0.7;
    }
</style>
