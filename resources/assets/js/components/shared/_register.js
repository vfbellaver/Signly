require('./Inspinia/_register');

// ------------------------------------------------------------------------
// Others
Vue.component('icon', require('./Icon'));
Vue.component('notification', require('./Notification'));
Vue.component('spinner', require('./Spinner'));
Vue.component('row', require('./Row'));
Vue.component('column', require('./Col'));

// ------------------------------------------------------------------------
// Modals
Vue.component('modal', require('./Modals/Modal'));
Vue.component('modal-header', require('./Modals/ModalHeader'));
Vue.component('modal-body', require('./Modals/ModalBody'));
Vue.component('modal-footer', require('./Modals/ModalFooter'));

// ------------------------------------------------------------------------
// Buttons
Vue.component('btn-submit', require('./Buttons/Submit'));
Vue.component('btn-danger', require('./Buttons/Danger'));
Vue.component('btn-success', require('./Buttons/Success'));
Vue.component('btn-default', require('./Buttons/Default'));
Vue.component('btn-cancel', require('./Buttons/Cancel'));


// ------------------------------------------------------------------------
// Forms
Vue.component('form-group', require('./Forms/FormGroup'));
Vue.component('form-submit', require('./Forms/FormSubmit'));

// ------------------------------------------------------------------------
// Inputs
Vue.component('input-label', require('./Inputs/InputLabel'));
Vue.component('input-text', require('./Inputs/InputText'));
Vue.component('input-password', require('./Inputs/InputPassword'));
Vue.component('input-number', require('./Inputs/InputNumber'));
Vue.component('input-url', require('./Inputs/InputUrl'));
Vue.component('input-email', require('./Inputs/InputEmail'));
Vue.component('text-area', require('./Inputs/TextArea'));
Vue.component('image-upload', require('./Inputs/ImageUpload'));
Vue.component('input-time', require('./Inputs/InputTime'));

// ------------------------------------------------------------------------
// Boxes
Vue.component('box', require('./Boxes/Box'));
Vue.component('box-title', require('./Boxes/BoxTitle'));
Vue.component('box-tools', require('./Boxes/BoxTools'));
Vue.component('box-tool', require('./Boxes/BoxTool'));
Vue.component('box-content', require('./Boxes/BoxContent'));
Vue.component('box-body', require('./Boxes/BoxBody'));
Vue.component('box-footer', require('./Boxes/BoxFooter'));

// ------------------------------------------------------------------------
//TABS
Vue.component('Tabs', require('./Tabs/Tabs'));
Vue.component('Tab', require('./Tabs/Tab'));
