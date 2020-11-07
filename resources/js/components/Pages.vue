<template>
    <div id="pages">
        <div class="nav">
            <div class="nav-item">
                <router-link :to="{ name: 'create-page' }">
                    Create
                </router-link>
            </div>
        </div>
        <p class="border p-3" v-for="page in pages">

            {{ page.title }}
            <router-link :to="{ name: 'update-page', params: { pageId : page.id } }">
                <button type="button" class="p-1 mx-3 float-right btn btn-light">
                    Update
                </button>
            </router-link>
            <button
                type="button"
                @click="deletePost(page.id)"
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

    name: "Pages",
    mounted() {
        this.getContent();

    },
    data() {

        return {
            pages: {},
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

        getContent(address) {
            axios.get(address ? address : "/api/content?api_token="+this.apiToken).then(response => {
                this.pages = response.data.data;
                this.prev = response.data.links.prev;
                this.next = response.data.links.next;
            });
        },
        deletePost(id) {
            axios.delete("/api/content/" + id + "?api_token="+this.apiToken).then(response => this.getContent())
        },
        navigate(address) {
            this.getPosts(address)
        }
    }
};
</script>
