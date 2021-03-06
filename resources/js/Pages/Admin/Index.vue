<template>
    <div>
        <div class="content">
            <div class="order">
                <div class="order_item">
                            <div>Номер Заказа</div>
                            <div>Заказчик</div>
                            <div>Просмотеть</div>
                    <button>Просмотеть</button>
                </div>
            </div>
            <div class="user">
                <vs-card>
                    <template #title>
                        <h3>Pot with a plant</h3>
                    </template>
                    <template #img>
                        <img src="../../aseets/foto5.png" alt="Фото Пользователя">
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
        </div>
    </div>
</template>
<script>


</script>
<style>
    .content{
        display: flex;
        justify-content: space-around;
        width: 100%;
        width: auto;
    }
    .order
    {
        padding: 5px;
        width: 300px;


    }
    .user
    {
        width: 300px;
        padding: 5px;
    }
    .order_item{
        display: flex;
        flex-direction: column;
        border: 1px solid silver;
        padding: 5px;
        margin: 5px ;
    }
</style>
