<template>
    <div id="posts">
        <div class="nav">
            <div class="nav-item">
                <router-link :to="{ name: 'create' }">
                    Create
                </router-link>
            </div>
        </div>
        <p class="border p-3" v-for="post in posts">

            {{ post.title }}
            <router-link :to="{ name: 'update', params: { postId : post.id } }">
                <button type="button" class="p-1 mx-3 float-right btn btn-light">
                    Update
                </button>
            </router-link>
            <button
                type="button"
                @click="deletePost(post.id)"
                class="p-1 mx-3 float-right btn btn-danger"
            >
                Delete
            </button>
        </p>
        <div>
            <button
                v-if="next"
                type="button"
                @click="navigate(next)"
                class="m-3 btn btn-primary"
            >
                Next
            </button>
            <button
                v-if="prev"
                type="button"
                @click="navigate(prev)"
                class="m-3 btn btn-primary"
            >
                Previous
            </button>
        </div>
    </div>
</template>
<script>

export default {

    name: "Read",
    mounted() {
        this.getPosts();

    },
    data() {

        return {
            posts: {},
            next: null,
            prev: null
        };
    },
    props: {
        apiToken: {
            type: String,
            required: true
        }
    },
    methods: {

        getPosts(address) {
            axios.get(address ? address : "/api/posts?api_token="+this.apiToken).then(response => {
                this.posts = response.data.data;
                this.prev = response.data.links.prev;
                this.next = response.data.links.next;
            });
        },
        deletePost(id) {
            axios.delete("/api/posts/" + id + "?api_token="+this.apiToken).then(response => this.getPosts())
        },
        navigate(address) {
            this.getPosts(address)
        }
    }
};
</script>
