<template>
    <div>
        <h2>Articles</h2>
        <form action="" @submit.prevent="addArticle">
            <div class="form-group">
                <input type="text" name="title" id="title" v-model="article.title" class="form-control" placeholder="Title">
            </div>
            <div class="form-group">
                <textarea name="body" id="body" v-model="article.body" cols="30" rows="4" class="form-control" placeholder="Content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Save</button>
        </form>
        <hr>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.prev_page_url)">Previous</a></li>

                <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>

                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.next_page_url)">Next</a></li>
            </ul>
        </nav>
        <div class="card card-body mb-2" v-for="(article, index) in articles" :key="index">
            <h3>{{ article.title }}</h3>
            <p>{{ article.body }}</p>
            <hr>
            <button @click="deleteArticle(article.id)" class="btn btn-danger">Delete</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                articles: [],
                article: {
                    id: '',
                    title: '',
                    body: ''
                },
                article_id: '',
                pagination: {},
                edit: false
            }
        },

        methods: {
            fetchArticles(page_url) {
                let vm = this;
                page_url = page_url || '/api/article';
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.articles = res.data;
                    vm.createPagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
            },

            addArticle() {
                if (this.edit === false) {
                    fetch('api/article', {
                        method: 'POST',
                        body: JSON.stringify(this.article),
                        headers: {
                            'content-type': 'application/json'
                        }
                    }).then(res => res.json())
                    .then(data => {
                        this.article.title = '';
                        this.article.body = '';
                        alert('Article added');
                        this.fetchArticles();
                    })
                    .catch(err => console.log(err))
                } else {
                    // Update
                }
            },

            deleteArticle(id) {
                if (confirm('Are you sure?')) {
                    fetch(`api/article/${id}`, {
                        method: 'delete'
                    })
                    .then(data => {
                        alert('Article removed');
                        this.fetchArticles();
                    })
                    .catch(err => console.log(err));
                }
            },

            createPagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                }

                this.pagination = pagination;
            }
        },
        created() {
            this.fetchArticles();
        }
    }
</script>
