<template>
    <div>
        <h2>Articles</h2>
        <div class="card card-body mb-2" v-for="(article, index) in articles" :key="index">
            <h3>{{ article.title }}</h3>
            <p>{{ article.body }}</p>
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
            fetchArticles() {
                fetch('api/article')
                .then(res => res.json())
                .then(res => {
                    this.articles = res.data;
                })
            }
        },
        created() {
            this.fetchArticles();
        }
    }
</script>
