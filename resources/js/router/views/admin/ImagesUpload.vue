<template>
    <form class="update-image" @submit="formSubmit" enctype="multipart/form-data">
        <input ref="file" type="file" class="update-image__input" @change="onChange">
        <p v-if="error" class="errors">{{ error }}</p>
        <button class="btn btn-primary btn-block">Отправить</button>
    </form>
</template>

<script>
import Button from "../../../components/helpers/Button";

export default {
    name: "ImagesUpload",
    components: {Button},
    data() {
        return {
            file: '',
            error: ''
        }
    },

    methods: {
        onChange(e) {
            this.file = e.target.files[0]
        },
        formSubmit(e) {
            e.preventDefault()
            let self = this

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            let data = new FormData()
            data.append('file', this.file)
            data.append('category', 'clients')

            axios.post('/api/upload', data, config).then(() => {
                self.file = null
                self.$refs.file.value = ''
                self.$emit('upload')
            }).catch(err => {
                self.error = err.response.data.errors.file[0]
            })
        }
    }
}
</script>

<style scoped>

</style>