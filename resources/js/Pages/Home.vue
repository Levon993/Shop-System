<template>
    <div class="container">
   <vs-card type="4">
        <template #title>
            <h3>Pot with a plant</h3>
        </template>
        <template #img>
            <img src="../aseets/foto2.jpg" alt="">
        </template>
        <template #text>
            <p>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
            </p>
        </template>
        <template #interactions>
            <vs-button danger icon>
                <i class='bx bx-heart'></i>
            </vs-button>
            <vs-button class="btn-chat" shadow primary>
                <i class='bx bx-chat' ></i>
                <span class="span">
          54
        </span>
            </vs-button>
        </template>
       </vs-card>
    </div>
</template>
<script>
    export default {
        mounted() {
            console.log('hello from Home')
        }
    }
</script>
<style>
    .container{
        /*width: 350px;*/
        /*height: 400px;*/
        margin-top: 25px;
        margin: 15px;
        padding: 15px;
        display: flex;
        /*flex-direction: column;*/
        justify-content: center;
        align-items: center;
        flex-wrap:wrap ;
    }
</style>
