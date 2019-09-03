import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        books: [],
        loading: true,
        isLoggedIn: !!localStorage.getItem('books-app'),
        newBook: {
            title: '',
            isbn: '',
            description: ''
        }
    },
    getters: {
        books: state => state.books,
        newBook: state => state.newBook
    },
    mutations: {
        USER_LOGUED (state) {
            state.isLoggedIn = true
        },
        LOGOUT (state) {
            state.isLoggedIn = false
        },
        SET_LOADING (state, flag) {
            state.loading = flag
        },
        SET_BOOKS (state, books) {
            state.books = books
        },
        ADD_BOOK (state, bookObject) {
            state.books.push(bookObject)
        },
        DELETE_BOOK (state, book) {
            var books = state.books;
            books.splice(books.indexOf(book), 1)
        },
        UPDATE_BOOK (state, book) {
            state.books.forEach((element, index) => {
                if(element.id === book.id) {
                    Object.assign(element, book);
                }
            });
        },
        CLEAR_NEW_BOOK (state) {
            state.newBook = {
                title: '',
                isbn: '',
                description: ''
            }
        },
        EDIT_BOOK (state, book) {
            state.newBook = book;
        }
    },
    actions: {
        login ({ commit }, user) {
            commit('SET_LOADING', true);

            return new Promise((resolve, reject) => {
                axios.post('login', user).then(response => {
                        commit('USER_LOGUED');
                        localStorage.setItem('books-app', JSON.stringify(response));
                        resolve(response.data);
                    })
                    .catch(err => {
                        this.dispatch('logout');
                        reject(err);
                    }).finally(()=>{
                        commit('SET_LOADING', false);
                    });
            })
        },

        logout ({ commit }) {
            commit('LOGOUT');
            localStorage.removeItem('books-app');
        },

        loadBooks ({ commit }) {
            commit('SET_LOADING', true);

            axios.get('books')
                .then(r => r.data)
                .then(response => {
                    commit('SET_BOOKS', response);
                    commit('SET_LOADING', false);
                })
        },

        addBook ({commit }, bookItem ) {
            if (!bookItem) {
                return
            }

            axios.post('books', bookItem).then((r) => {
                commit('ADD_BOOK', r.data);
            })
        },

        deleteBook ({ commit }, book) {
            axios.delete('books/'+book.id).then(() => {
                commit('DELETE_BOOK', book);
            }).catch(function (error) {
                console.error(error);
            });
        },

        editBook({ commit }, book){
            const updatedBook = Object.assign({}, book);
            commit('EDIT_BOOK', updatedBook);
        },

        updateBook({ commit }, book){
            axios.put('books/'+book.id, book).then((r) => {
                commit('UPDATE_BOOK', r.data);
            })
        },

        clearNewBook ({ commit }) {
            commit('CLEAR_NEW_BOOK')
        }
    }
});