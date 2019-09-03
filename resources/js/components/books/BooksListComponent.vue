<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Books</div>

                    <div class="card-body">
                        <ul class="list-group">
                            <book-component v-for="book in books" :book="book" :key="book.id"></book-component>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from "vuex";
    export default {
        name: "BookList",
        mounted () {
            this.$store.dispatch('loadBooks');
        },
        computed: {
            ...mapGetters(["books"]),
        }
    }
</script>
