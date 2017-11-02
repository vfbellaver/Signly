<template>
    <div class="image-upload">
        <div>
            <div>
                <div>
                    <input ref="file" type="file" @change="onFileChange" class="hidden"/>
                    <div v-if="internalValue" class="preview"
                         :style="{ 'background-image': 'url(' + internalValue + ')' }"
                         @click="replaceImage">
                    </div>
                    <div v-else class="dropzone" @click="replaceImage"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped="scoped">

    @import "../../../../sass/variables";

    .image-upload {
        overflow: hidden;
        padding-bottom: 100%;
        position: relative;
        background: $white;
        border-radius: 4px;
        border: 1px solid #E3E3E3;

        a {
            position: absolute;
            cursor: pointer;
            top: 4px;
            right: 8px;
            color: black;
            text-decoration: none;
            z-index: 3;
        }

        > div {
            height: 100%;
            position: absolute;
            width: 100%;

            > div {
                display: table;
                height: 100%;
                width: 100%;

                > div {
                    padding: 0px;
                    display: table-cell;
                    text-align: center;
                    vertical-align: middle;

                    .preview {
                        cursor: pointer;
                        background: no-repeat center center;
                        background-size: contain;
                        width: 100%;
                        height: 100%;
                    }

                    .dropzone {
                        cursor: pointer;
                        background: url('/images/fileupload-bg.jpg') no-repeat center;
                        background-size: contain;
                        width: 100%;
                        height: 100%;
                        border: none;
                    }
                }
            }
        }
    }
</style>

<script>
    import * as Slc from "../../../vue/http";

    export default {
        props: {
            maxSize: {required: false},
            allowedTypes: {required: false}
        },
        mixins: [require('../Mixins/Model')],
        data() {
            return {
                internalAllowedTypes: []
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
                    this.internalValue = file.url;
                    this.$emit('uploaded');
                });
            },
            replaceImage() {
                $(this.$refs.file).trigger('click');
            },
            remove() {
                const self = this;

                swal({
                    title: 'Are you sure?',
                    text: 'This operation cannot be undone',
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: 'Cancel',
                    confirmButtonText: 'Yes, proceed',
                    closeOnConfirm: false
                }, () => {
                    swal(`Success`, 'Image was successfully removed', "success");
                    self.internalValue = null;
                    self.$refs.file.value = null;
                    self.$emit('removed');
                });
            }
        }
    }
</script>