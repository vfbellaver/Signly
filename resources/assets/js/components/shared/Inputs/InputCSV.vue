<template>
    <div class="csv-upload">
        <div>
            <div>
                <div>
                    <input ref="file" type="file" @change="onFileChange" :multiple="multiple"/>
                    <div v-if="internalValue" class="preview"
                         @click="replaceCsv ">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import * as Slc from "../../../vue/http";

    export default {
        props: {
            multiple: {required: false, 'default': false},
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
                this.internalAllowedTypes = ['csv'];
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
                    }
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
            }
        }
    }
</script>
