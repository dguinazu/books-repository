<template>
        <div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text"
                       class="form-control"
                       id="title"
                       name="title"
                       v-model="book.title">
            </div>
            <div class="form-group">
                <label for="isbn">ISBN Number</label>
                <input type="text"
                       class="form-control"
                       id="isbn"
                       name="isbn"
                       v-model="book.isbn">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control"
                          id="description"
                          name="description"
                          v-model="book.description"></textarea>
            </div>
        </div>
</template>

<script>
    export default {
        props: [
            'book'
        ]
    }
</script>
