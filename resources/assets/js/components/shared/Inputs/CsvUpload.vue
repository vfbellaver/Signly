<template>
    <input class="csv-upload" ref="file" type="file" @change="onFileChange" :multiple="multiple"/>
</template>


<script>
    import * as Slc from "../../../vue/http";

    export default {
        props: {
            multiple: {required: false, 'default': false},
            maxSize: {required: false},
            allowedTypes: {required: false},


        },
        mixins: [require('../Mixins/Model')],
        data() {
            return {
                internalAllowedTypes: [],
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
                const uri = laroute.route('api.csv.upload');
                Slc.upload(uri, allowedFiles).then((response) => {
                    console.log('Uploaded Csv:',response);
                    this.internalValue=response.data;
                    this.$emit('postcsv');
                });
            },
        }
    }
</script>
