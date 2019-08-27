<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <ul class="list-group" id="online-user">                
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
             console.log('example mounted.')
            // Echo.join(`chat`)
            //     .here((users) => {
            //         console.log(users);
            //     })
            //     .joining((user) => {
            //         console.log(`${user.name} joined`);
            //     })
            //     .leaving((user) => {
            //         console.log(`${user.name} leaved`);
            //     });
        }
    }
</script>
