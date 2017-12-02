<template>
    <div class="image-upload">
        <input ref="file" type="file" @change="onFileChange" class="hidden"/>
        <div class="preview" :style="style"></div>
        <div class="overlay">
            <div class="btn-group">
                <a class="btn btn-default" @click="replaceImage" title="Replace Image">
                    <i class="fa fa-camera" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</template>

<style lang="scss">

    @import "../../../../sass/variables";

    .image-upload {
        position: relative;
        background: $white;
        border-radius: 4px;
        border: 1px solid #E3E3E3;
        width: 256px;
        height: 256px;

        a {
            position: absolute;
            cursor: pointer;
            top: 4px;
            right: 8px;
            color: black;
            text-decoration: none;
            z-index: 3;
        }

        .preview {
            cursor: pointer;
            background: no-repeat center center;
            background-size: contain;
            width: 100%;
            height: 100%;
        }
        .overlay {
            display: none;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.3);
            .btn-group {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
        }

        &:hover {
            .overlay {
                display: block;
            }
        }
    }
</style>

<script>
    import * as Slc from "../../../vue/http";

    export default {
        props: {
            maxSize     : {required: false},
            allowedTypes: {required: false}
        },

        data() {
            return {
                internalAllowedTypes: [],
                photoUrl            : null,
            }
        },

        computed: {
            style() {
                return this.photoUrl ? {'background-image': `url(${this.photoUrl})`} : '';
            }
        },

        mounted() {
            if (!this.allowedTypes) {
                this.internalAllowedTypes = ['jpg', 'jpeg', 'png'];
                return;
            }
            let types = this.allowedTypes.split(',');
            types.forEach(t => {
                this.internalAllowedTypes.push(t.trim().toLowerCase());
            });
        },

        methods: {
            onFileChange(e) {
                const files = e.target.files || e.dataTransfer.files;
                if (!files.length) {
                    return;
                }

                let hasInvalid = false;
                const allowedFiles = [];
                for (let i = 0; i < files.length; i++) {
                    let f = files.item(i);
                    console.log('File', f);
                    const extension = f.name.split('.').pop().toLowerCase();
                    let valid = false;
                    for (let t of this.internalAllowedTypes) {
                        if (t === extension) {
                            valid = true;
                            break;
                        }
                    }
                    if (valid) {
                        allowedFiles.push(f);
                    } else {
                        hasInvalid = true;
                    }
                }

                this.$refs.file.value = null;

                if (hasInvalid) {
                    EventBus.$emit(
                        'notify',
                        'error',
                        'Invalid file type. Choose a valid image file (png, jpg or gif) and try again.'
                    );
                }

                if (!allowedFiles.length) {
                    return;
                }
                this.$emit('uploading');
                const uri = laroute.route('api.image.upload');
                Slc.upload(uri, allowedFiles).then((response) => {
                    console.log("Uploaded image", response);
                    const file = response.data[0];
                    this.photoUrl = file.url;
                    this.$emit('uploaded');
                    this.$emit('input', this.photoUrl);
                });
            },
            replaceImage() {
                $(this.$refs.file).trigger('click');
            },
        }
    }
</script>