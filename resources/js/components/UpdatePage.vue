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
                <input type="text" ref="title" class="form-control" id="title" placeholder="Enter title" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" ref="friendlyurl" id="friendlyurl" placeholder="Enter a friendlyurl" rows="8" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" ref="status" id="status" placeholder="Enter a status" rows="8" required>
            </div>
            <div class="form-group">
                <textarea class="form-control editor" ref="body" id="body" placeholder="Enter a body" rows="8" required></textarea>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" ref="template" id="template" placeholder="Enter a template" rows="8" required>
            </div>
            <div class="mb-3">
                <img width="100" ref="imageView"  alt="image" />
            </div>
            <div class="custom-file mb-3">
                <input  type="file" ref="image" name="image" class="custom-file-input" id="image" required>
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
        this.getContent();
    },
    props: {
        pageId: {
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
            formData.append("friendlyurl", this.$refs.friendlyurl.value);
            formData.append("status", this.$refs.status.value);
            formData.append("template", this.$refs.template.value);
            formData.append("image", this.$refs.image.files[0]);


            axios
                .post("/api/content/" + this.pageId + "?api_token="+this.apiToken+"&_method=PUT",  formData )
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
        getContent() {
            axios.get("/api/content/" + this.pageId + "?api_token="+this.apiToken).then(response => {
                this.$refs.title.value = response.data.data.title;
                this.$refs.body.value = response.data.data.body;
                this.$refs.friendlyurl.value = response.data.data.friendlyurl;
                this.$refs.status.value = response.data.data.status;
                this.$refs.template.value = response.data.data.template;
                this.$refs.imageView.src = "/uploads/content/"+response.data.data.image;
            });
        }
    }
};
</script>
