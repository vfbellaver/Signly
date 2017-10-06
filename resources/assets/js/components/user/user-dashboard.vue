<template>
    <div>
        <ul>
            <li>
                <button @click.native="show('hi')">Profile</button>
            </li>
            <li>
                <button @click.native="show('hello')">Page 1</button>
            </li>
        </ul>

        <div v-if="(pages.profile)">
            <div style="padding-bottom: 30px"></div>
            <user-form2></user-form2>
        </div>

        <div v-if="(pages.page1)">
            <div style="padding-bottom: 30px"></div>
            <h1>Page 1</h1>
        </div>

    </div>
</template>


<script>

    import UserForm2 from './user-form2';

    export default {
        data() {
            return {
                pages: {
                    profile: true,
                    page1: false,
                }
            }
        },

        components: {
            UserForm2,
        },


        methods: {
            show: function (page) {
                const  self = this;
                for(let p = 0; p < self.pages.length; p++) {
                    debugger;
                    if(self.pages.p != self.pages[page]){
                        self.pages[p] = false;
                    } else {
                        if(!self.pages[page]){
                            self.pages[page] = true;
                        };
                    }
                }
            },

        }
    }
</script>