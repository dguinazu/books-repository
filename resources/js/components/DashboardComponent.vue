<template>
    <section>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand">{{title}}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <form-book-component></form-book-component>
        <books-list-component></books-list-component>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                title: 'Books Repository'
            }
        },
        mounted() {

        }
    }
</script>