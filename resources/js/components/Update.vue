<template>
    <div class="container">
        <form>
            <div :class="['form-group m-1 p-3', successful ? 'alert-success' : '']">
                <span v-if="successful" class="label label-sucess">Updated!</span>
            </div>

            <div :class="['form-group m-1 p-3', error ? 'alert-danger' : '']">
            <span v-if="errors.title" class="label label-danger">
              {{ errors.title[0] }}
            </span>
                <span v-if="errors.body" class="label label-danger">
              {{ errors.body[0] }}
            </span>
            </div>

            <div class="form-group">
                <input type="title" ref="title" class="form-control" id="title" placeholder="Enter title" required>
            </div>

            <div class="form-group">
                <textarea class="form-control" ref="body" id="body" placeholder="Enter a body" rows="8" required></textarea>
            </div>
            <div class="mb-3">
                <img width="100" ref="imageView"  alt="image" />
            </div>
            <div class="custom-file mb-3">
                <input type="file" ref="image" name="image" class="custom-file-input" id="image" required>
                <label class="custom-file-label" >Choose file...</label>
            </div>

            <button type="submit" @click.prevent="update" class="btn btn-primary block">
                Submit
            </button>
        </form>
    </div>
</template>
<script>
export default {
    mounted() {
        this.getPost();
    },
    props: {
        postId: {
            type: Number,
            required: true
        },
        apiToken:{
            type: String,
            required: true
        }
    },
    data() {
        return {
            error: false,
            successful: false,
            errors: []
        };
    },
    methods: {
        update() {
            const formData = new FormData();
            formData.append("title", this.$refs.title.value);
            formData.append("body", this.$refs.body.value);
            formData.append("image", this.$refs.image.files[0]);
            console.log(formData);
            axios
                .post("/api/posts/" + this.postId + "?api_token="+this.apiToken+"&_method=PUT",  formData )
                .then(response => {
                    this.successful = true;
                    this.error = false;
                    this.errors = [];
                })
                .catch(error => {
                    if (!_.isEmpty(error.response)) {
                        if ((error.response.status = 422)) {
                            this.errors = error.response.data.errors;
                            this.successful = false;
                            this.error = true;
                        }
                    }
                });
        },
        getPost() {
            axios.get("/api/posts/" + this.postId + "?api_token="+this.apiToken).then(response => {
                this.$refs.title.value = response.data.data.title;
                this.$refs.body.value = response.data.data.body;
                this.$refs.imageView.src = "/uploads/posts/"+response.data.data.image;
            });
        }
    }
};
</script>
