<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <button class="btn btn-success mx-2" @click="syncProducts()">Sync products</button>
                <button v-if="products.length" class="btn btn-danger mx-2" @click="deleteProducts()">Delete all products</button>
            </div>
        </div>
        <div class="row no-gutters my-5">
            <div v-for="(product, index) in products" :key="index" class="col-lg-3 col-md-4 col-sm-6">
                <div class="card mx-2 my-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ product.name }}</h5>
                        <p class="card-text">{{ product.description }}</p>
                        <p><b>Price: </b>{{ product.price }}</p>
                        <p><b>Amount: </b>{{ product.amount }}</p>
                        <button class="btn btn-primary" @click="updateAmount(product)">Update amount</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductList",
        data: () => ({
            products: [],
        }),
        created() {
            this.getProducts();
        },
        methods: {
            getProducts() {
                axios
                    .get('api/products')
                    .then(response => {
                        this.products = response.data;
                    });
            },
            syncProducts() {
                axios
                    .get('api/products/sync')
                    .then(response => {
                        this.products = response.data;
                    });
            },
            deleteProducts() {
                axios
                    .delete('api/products')
                    .then(response => {
                        alert(response.data.message);
                        this.products = [];
                    });
            },
            updateAmount(product) {
                axios
                    .put(`api/products/${product.id}/amount`)
                    .then(response => {
                        if (response.data.amount) {
                            product.amount = response.data.amount;
                        }

                        alert(response.data.message);
                    })
                    .catch(err => {
                        alert(err.response.data.message);
                    });
            }
        }
    }
</script>
