<template>
    <div class="container">

        <form>
            <div :class="['form-group m-1 p-3', (successful ? 'alert-success' : '')]">
                <span v-if="successful" class="label label-sucess">Published!</span>
            </div>
            <div :class="['form-group m-1 p-3', error ? 'alert-danger' : '']">
            <span v-if="errors.title" class="label label-danger">
              {{ errors.title[0] }}
            </span>
                <span v-if="errors.body" class="label label-danger">
              {{ errors.body[0] }}
            </span>
                <span v-if="errors.image" class="label label-danger">
              {{ errors.image[0] }}
            </span>
                <span v-if="errors.friendlyurl" class="label label-danger">
              {{ errors.friendlyurl[0] }}
            </span>
                <span v-if="errors.status" class="label label-danger">
              {{ errors.status[0] }}
            </span>
                <span v-if="errors.template" class="label label-danger">
              {{ errors.template[0] }}
            </span>
            </div>

            <div class="form-group">
                <input type="text" ref="title" class="form-control" id="title" placeholder="Enter title" required>
            </div>
            <div class="form-group">
                <input type="text" ref="status" class="form-control" id="status" placeholder="Enter status" required>
            </div>
            <div class="form-group">
                <input type="text" ref="friendlyurl" class="form-control" id="friendlyurl" placeholder="Enter friendlyurl" required>
            </div>
            <div class="form-group">
                <vue-editor ref="body" class="editor" v-model="content" required></vue-editor>

            </div>
            <div class="form-group">
                <input type="text" ref="template" class="form-control" id="template" placeholder="Enter template" required>
            </div>
            <div class="custom-file mb-3">
                <input type="file" ref="image" name="image" class="custom-file-input" id="image" required>
                <label class="custom-file-label" >Choose file...</label>
            </div>

            <button type="submit" @click.prevent="create" class="btn btn-primary block">
                Submit
            </button>
        </form>
    </div>
</template>
<style>
.editor{
    background: #fff !important;
}
</style>
<script>
import { VueEditor } from "vue2-editor";

export default {
    components: {
        VueEditor
    },
    props: {
        userId: {
            type: Number,
            required: true
        },
        apiToken: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            error: false,
            successful: false,
            errors: [],
            content: "<h1>Some initial content</h1>"
        };
    },
    methods: {
        create() {
            const formData = new FormData();
            formData.append("title", this.$refs.title.value);
            formData.append("body", this.$refs.body.value);
            formData.append("friendlyurl", this.$refs.friendlyurl.value);
            formData.append("status", this.$refs.status.value);
            formData.append("template", this.$refs.template.value);
            formData.append("user_id", this.userId);
            formData.append("image", this.$refs.image.files[0]);

            axios
                .post("/api/content?api_token="+this.apiToken, formData)
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

            this.$refs.title.value = "";
            this.$refs.body.value = "";
            this.$refs.template.value = "";
            this.$refs.status.value = "";
            this.$refs.friendlyurl.value = "";
            this.$refs.image.value = "";
        }
    }
};
</script>
