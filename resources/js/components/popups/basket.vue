<template>
    <vs-dialog width="550px" not-center >
        <template #header>
            <h4 class="not-margin">
                Welcome to <b>Vuesax</b>
            </h4>
        </template>


        <div class="con-content">
            <p>
                Vuesax is a relatively new framework with a refreshing design and in the latest trends, vuesax based on vuejs which means that we go hand in hand with one of the most popular javascript frameworks in the world and with a huge community with which you will have all the help and documentation to create and make your project
            </p>
        </div>

        <template #footer>
            <div class="con-footer">
                <vs-button @click="active=false" transparent>
                    Ok
                </vs-button>
            </div>
        </template>
    </vs-dialog>
</template>
