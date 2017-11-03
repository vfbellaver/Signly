<template>
    <div class="col-md-3">
        <div class="thumbnail">
            <div class="image view view-first">
                <input ref="file" type="file" @change="onFileChange" class="hidden"/>
                <div v-if="internalValue" class="mask preview"
                     :style="{ 'background-image': 'url(' + internalValue + ')' }">
                    <div class="tools tools-bottom">
                        <a @click="replaceImage"  title="Change Photo"><i class="fa fa-pencil"></i></a>
                        <a @click="remove" v-if="internalValue" title="Remove Image"><i class="fa fa-remove"></i></a>
                    </div>
                </div>
                <div v-else="internalValue" class="mask preview"
                     :style="{ 'background-image': 'url(/images/fileupload-bg.jpg)' }">
                    <div class="tools tools-bottom">
                        <a @click="remove" v-if="internalValue" title="Remove Image"><i class="fa fa-remove"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a class="btn btn-primary btn-block">Update Photo</a>
        </div>
    </div>
</template>

<style lang="scss" scoped="scped">

    @import "../../../../sass/variables";
    .thumbnail .image {
        height: 100%;
        width: 100%;
        overflow: hidden;
    }
    .thumbnail {
        height: 250px;
        overflow: hidden;
        padding: 0;
        border: none;
    }
    .view {
        overflow: hidden;
        position: relative;
        text-align: center;
        box-shadow: 1px 1px 2px #e6e6e6;
        cursor: default;
    }
    .view .mask, .view .content {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        top: 0;
        left: 0;
    }
    .view img {
        display: block;
        position: relative
    }
    .view .tools {
        text-transform: uppercase;
        color: #fff;
        text-align: center;
        position: relative;
        font-size: 17px;
        padding: 3px;
        background: rgba(0, 0, 0, 0.35);
        margin: 210px 0 0 0;
    }
    .mask.no-caption .tools {
        margin: 90px 0 0 0;
    }
    .view .tools a {
        display: inline-block;
        color: #FFF;
        font-size: 18px;
        font-weight: 400;
        padding: 0 4px;

    }
    .view p {
        font-family: Georgia, serif;
        font-style: italic;
        font-size: 12px;
        position: relative;
        color: #fff;
        padding: 10px 20px 20px;
        text-align: center
    }
    .view a.info {
        display: inline-block;
        text-decoration: none;
        padding: 7px 14px;
        background: #000;
        color: #fff;
        text-transform: uppercase;
        box-shadow: 0 0 1px #000
    }
    .view-first img {
        transition: all 0.2s linear;
    }
    .view-first .mask {

        transition: all 0.4s ease-in-out;
    }
    .view-first .tools {
        width: 225px;
        margin-right: auto;
        margin-left: auto;
        transform: translateY(-100px);
        opacity: 0;
        transition: all 0.4s ease-in-out;
    }
    .view-first p {
        transform: translateY(100px);
        opacity: 0;
        transition: all 0.2s linear;
    }
    .view-first:hover img {
        transform: scale(1.1);
    }
    .view-first:hover .mask {
        opacity: 1;
    }
    .view-first:hover .tools, .view-first:hover p {
        opacity: 1;
        transform: translateY(0px);
    }
    .view-first:hover p {
        transition-delay: 0.1s;
    },
    .preview {
        cursor: pointer;
        background: no-repeat center center;
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