<template>
    <modal size="lg">
        <modal-header>{{title + " TERMS"}}</modal-header>

        <modal-body>
            <div class="ibox">
                <div class="ibox-content">
                    <div class="text-center article-title">
                        <span class="text-muted">{{dateNow}}</span>
                        <h1>
                            {{title}}
                        </h1>
                    </div>
                    <div style="overflow: auto; max-height: 400px">
                        <p>
                            Many desktop publishing packages and web page editors now use <strong>Lorem Ipsum as their default model text</strong>, and a search for 'lorem ipsum' will uncover many web
                        </p>
                        <p>
                            One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What's happened to me?" he thought. It wasn't a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops
                        </p>
                        <p>
                            <i>
                                Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.
                            </i>
                        </p>
                        <p>
                            The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way. When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek,
                        </p>
                        <p>
                            Two driven jocks help fax my big quiz. Quick, Baz, get my woven flax jodhpurs! "Now fax quiz Jack!" my brave ghost pled. Five quacking zephyrs jolt my wax bed. Flummoxed by job, kvetching W. zaps Iraq. Cozy sphinx waves quart jug of bad milk. A very bad quack might jinx zippy fowls. Few quips galvanized the mock jury box. Quick brown dogs jump over the lazy fox. The jay, pig, fox, zebra, and my wolves quack! Blowzy red vixens fight for a quick jump. Joaquin Phoenix was gazed by MTV for luck. A wizard’s job is to vex chumps quickly in fog. Watch "Jeopardy!", Alex Trebek's fun TV quiz game. Woven silk pyjamas exchanged for blue quartz. Brawny gods just
                        </p>
                        <p>
                            Brick quiz whangs jumpy veldt fox. Bright vixens jump; dozy fowl quack. Quick wafting zephyrs vex bold Jim. Quick zephyrs blow, vexing daft Jim. Sex-charged fop blew my junk TV quiz. How quickly daft jumping zebras vex.
                        </p>
                    </div>
                </div>
            </div>
        </modal-body>
        <modal-footer>
            <a v-if="stripeId" @click="updateSubscription" class="btn btn-success">Update</a>
            <a @click="agree" class="btn btn-success" v-else>I Agree</a>
        </modal-footer>

    </modal>
</template>

<script>

    import * as Slc from "../../vue/http";
    import ModalForm from '../shared/Mixins/ModalForm';

    export default {
        props: {
            title: {required: true},
            stripeId: {required: true},
            term: {required: true},
            id: {required: true},
        },

        computed: {
            dateNow(){
                return moment().format('L');
            },

        },

        mixins: [ModalForm],

        components: {},

        data() {
            return {
                form: new SlcForm({})
            }
        },

        mounted(){

        },

        methods: {
            agree() {
                this.form.id = this.id;
                window.location = laroute.route("register.plan", {plan: this.form.id});
            },

            buildForm(plan) {
                return new SlcForm({
                    id: this.id,
                });
            },

            updateSubscription(){
                this.form.id = this.id;
                Slc.get(laroute.route("api.payment.update.subscription", {plan: this.form.id}))
                    .then(response => {
                        console.log(response);
                    });
            }
        }
    }
</script>
