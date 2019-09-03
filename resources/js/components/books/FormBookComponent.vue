<template>
    <section class="container mb-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{title}}</div>

                    <div class="card-body">
                        <inputs-book-component :book="newBook"></inputs-book-component>

                        <button class="btn btn-primary" v-if="isNew" v-on:click="addBook">Create</button>
                        <button class="btn btn-success" v-if="!isNew" v-on:click="updateBook">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import { mapGetters } from "vuex";
    export default {
        name: "NewBook",
        methods: {
            addBook() {
                this.$store.dispatch("addBook", this.newBook);
                this.$store.dispatch('clearNewBook');
            },
            updateBook() {
                this.$store.dispatch("updateBook", this.newBook);
                this.$store.dispatch('clearNewBook');
            }
        },
        computed: {
            title: function(){
               return (this.isNew) ? 'Create book' : 'Update book';
            },
            isNew: function() {
                return (this.newBook.id === undefined);
            },
            ...mapGetters(["newBook"])
        }
    }
</script>
