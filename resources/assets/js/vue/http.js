module.exports = {

    get(uri) {
        return Slc.fetch('get', uri);
    },

    find(uri) {
        return Slc.fetch('find', uri);
    },

    fetch(method, uri) {
        return new Promise((resolve, reject) => {
            axios
                .get(uri)
                .then(response => {

                    if (method === 'find') {
                        resolve(response.data);
                        return;
                    }

                    let items = [];
                    if ('data' in response.data) {
                        for (let index in response.data.data) {
                            response.data.data[index].destroyForm = new SlcForm({});
                        }
                        resolve(response.data);
                    } else {
                        for (let index in response.data) {
                            if (isNaN(index)) continue;
                            let item = response.data[index];
                            item.editForm = new SlcForm({});
                            item.destroyForm = new SlcForm({});
                            items.push(item);
                        }
                        resolve(items);
                    }
                })
                .catch(errors => {
                    Slc.handleErrors(null, errors);
                    reject(errors.data);
                });
        });
    },

    upload(uri, files) {
        const data = new FormData();
        for (let i = 0; i < files.length; i++) {
            let file = files[i];
            data.append(`file[${i}]`, file);
        }

        const config = {
            headers: {'content-type': 'multipart/form-data'}
        };

        return axios.post(uri, data, config);
    },

    post(uri, form) {
        return Slc.sendForm('post', uri, form);
    },

    put(uri, form) {
        return Slc.sendForm('put', uri, form);
    },

    patch(uri, form) {
        return Slc.sendForm('patch', uri, form);
    },

    delete(uri, form) {
        form.hasSwal = true;
        return new Promise((resolve, reject) => {
            swal({
                title: "Are you sure?",
                text: "This operation cannot be undone",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, proceed!",
                showLoaderOnConfirm: true,
                closeOnConfirm: false
            }, () => {
                Slc.sendForm('delete', uri, form)
                    .then(data => {
                        resolve(data);
                    })
                    .catch(error => {
                        Slc.handleErrors(form, error);
                        reject(error);
                    });
            });
        });
    },

    sendForm(method, uri, form) {
        return new Promise((resolve, reject) => {
            form.startProcessing();

            if (method === 'get') {
                axios.get(uri)
                    .then(response => {
                        form.finishProcessing();
                        let data = response.data;
                        if (data.message) {
                            toastr.success('', data.message);
                        }
                        resolve(data);
                    })
                    .catch(errors => {
                        console.log("Ajax Error", errors);
                        Slc.handleErrors(form, errors);
                        if (_.has(errors.response, 'data')) {
                            form.errors.set(errors.response.data.errors);
                        }
                        form.busy = false;
                        reject(errors.data);
                    });
                return;
            }

            axios[method](uri, JSON.parse(JSON.stringify(form)))
                .then(response => {
                    form.finishProcessing();
                    let data = response.data;
                    if (form.hasSwal) {
                        swal('Success!', data.message, "success");
                        resolve(data);
                        return;
                    }
                    if (data.message) {
                        toastr.success('', data.message);
                    }
                    if (_.has(data, 'data')) {
                        data.data.editForm = new SlcForm({});
                        data.data.destroyForm = new SlcForm({});
                    }
                    resolve(data);
                })
                .catch(errors => {
                    console.log("Ajax Error", errors);
                    Slc.handleErrors(form, errors);
                    if (_.has(errors.response, 'data')) {
                        form.errors.set(errors.response.data.errors);
                    }
                    form.busy = false;
                    reject(errors.data);
                });
        });
    },

    handleErrors(form, errors) {
        if (form) {
            form.busy = false;
        }
        if (!errors || !_.has(errors.response, 'status')) {
            window.EventBus.$emit(
                'notify',
                'error',
                'Unknown error. This incident has already been reported. Try again later.'
            );
            return;
        }

        if (errors.response.status === 401) {
            window.location = '/';
            return;
        }

        if (errors.response.status === 500) {
            console.log("Unknown error", errors.response.data.message);
            window.EventBus.$emit(
                'notify',
                'error',
                'Unknown error. This incident has already been reported. Try again later.'
            );
            return;
        }

        if (form && form.hasSwal) {
            swal("Error occurred!", errors.response.data.message, "error");
            return;
        }

        window.EventBus.$emit(
            'notify',
            'error',
            errors.response.data.message
        );
    }
};
