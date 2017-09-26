<template>
    <div class="card-container shadow">
        <column size="4">
            <img width="200rem" :src="billboardFace.photo">
        </column>
        <column size="8">
            <div class="card-body">
                <box>
                    <h2>{{billboardFace.code}}</h2>
                    <box-content>
                        <column size="12">
                            <h4>Width: {{billboardFace.width}} &nbsp &nbsp Heigth: {{billboardFace.height}}</h4>
                        </column>
                        <column size="3">
                            <slot></slot>
                        </column>
                    </box-content>
                </box>
            </div>
        </column>
        <div style="clear: both"></div>
    </div>
</template>

<script>
    export default {
        props: {
            billboardFace: {required:true}
        },
    }
</script>