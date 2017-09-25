<template>
    <div class="container" style="background: white">
        <div class="panel">
            <div class="panel-title">
                Import CSV Billboards
            </div>
            <div class="panel-body">

                <form-submit v-model="form" @submit="save">
                    <div class="form-group">
                        <label for="file"> Select file:</label>
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">
                            <i class="fa fa-upload"></i> Upload
                        </button>
                    </div>
                </form-submit>
            </div>
        </div>
    </div>
</template>
<script>

</script>
