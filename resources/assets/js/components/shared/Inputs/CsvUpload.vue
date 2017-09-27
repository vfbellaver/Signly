<template>
    <div class="csv-upload">
        <div>
            <row>
                <column size="12">
                        <div>
                            <input ref="file" type="file" @change="onFileChange" :multiple="multiple"/>
                            <div v-if="internalValue" class="preview"
                                 @click="replaceCsv ">
                            </div>
                            <div v-else  @click="replaceCsv"></div>
                        </div>
                </column>

                <column size="12">
                        <div v-if="internalValue">
                            <p class="text-center">List Billboards from Csv File</p>
                            <table  class="table table-responsive table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 50px"></th>
                                    <th style="width: 300px">Name</th>
                                    <th style="width: 600px" class="hidden-sm">Address</th>
                                    <th>Driveby</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="( billboard,index ) in billboardsArrayCsv">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ billboard.name }}</td>
                                    <td class="hidden-sm">{{ billboard.address }}</td>
                                    <td>{{ billboard.digital_driveby }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else class="text-center"> <p>Select your Csv File and check for any errors.
                            If there is an error, correct and resubmit the file.</p></div>
                </column>
            </row>
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
                internalAllowedTypes: [],
                billboardsArrayCsv: [],
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
                    this.internalValue=true;
                    this.billboardsArrayCsv = response.data;
                    this.$emit('uploaded');
                });
            },
            replaceCsv() {
                this.billboardsArrayCsv = [];
                $(this.$refs.file).trigger('click');
            }
        }
    }
</script>
