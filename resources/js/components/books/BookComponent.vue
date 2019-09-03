<template>
    <li class="list-group-item">
        <h4>{{book.title}}</h4>
        <small><b>ISBN:</b> {{book.isbn}}</small>
        <p>{{book.description}}</p>
        <small><i>Author: {{book.user.name}}</i></small>
        <div>
            <button type="button" class="btn btn-sm btn-success" v-on:click="editBook">Edit</button>
            <button type="button" class="btn btn-sm btn-danger" v-on:click="deleteBook">Delete</button>
        </div>
    </li>
</template>

<script>
    export default {
        props: [
            'book'
        ],
        methods: {
            deleteBook() {
                this.$store.dispatch("deleteBook", this.book);
            },
            editBook() {
                window.scrollTo(0, 0);
                this.$store.dispatch("editBook", this.book);
            }
        },
    }
</script>
