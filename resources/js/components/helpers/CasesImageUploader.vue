<template>
    <div>
        <div v-if="imageData" class="image-input" @click="chooseImage">
            <img :src="imageData" alt="">
            <input class="file-input" ref="fileInput" type="file" @input="onSelectFile" accept="image/*">
        </div>
        <div v-else class="image-input" :style="{ 'background-image': `url(${imageData})` }" @click="chooseImage">
            <span v-if="!imageData" class="placeholder">Choose an Image</span>
            <input class="file-input" ref="fileInput" type="file" @input="onSelectFile" accept="image/*">
        </div>
    </div>
</template>

<script>
export default {
    name: "CasesImageUploader",
    props: {
        cover: {
            type: String,
            required: false
        }
    },
    data() {
        return {
            imageData: this.cover,
        }
    },

    methods: {
        chooseImage() {
            this.$refs.fileInput.click()
            this.$emit('preloadImg', true)
        },

        onSelectFile() {
            const input = this.$refs.fileInput
            const files = input.files
            if (files && files[0]) {
                const reader = new FileReader
                reader.onload = e => {
                    this.imageData = e.target.result
                }
                reader.readAsDataURL(files[0])
                this.$emit('loaded', files[0])
            }
        }
    }
}
</script>

<style scoped>
.image-input {
    display: block;
    width: 100%;
    height: 200px;
    cursor: pointer;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
}

.placeholder {
    background: #f0f0f0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #333;
    font-size: 18px;
    font-family: "ArtegraSoft-Bold", sans-serif;
}

.placeholder:hover {
    background: #e0e0e0;
}

.file-input {
    display: none;
}

</style>