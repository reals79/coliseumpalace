<template>
    <div class="slides">
        <div v-for="(record, index) in records" v-if="step === (index+1)">
            {{ record.name }}
            <ul class="list-inline mb-0">
                <li v-for="(image, ind) in record.images" v-if="ind < 3" class="list-inline-item">
                    <div class="image-wrap"><div :style="'background-image:url('+image+')'" class="img-thumbnail"></div></div>
                </li>
            </ul>
            <div class="text-right"><a @click="handleNext" class="btn btn-link">далее...</a></div>
        </div>
    </div>
</template>

<script>

    export default {
        props: {
            records: null
        },
        data() {
            return {
                step: 1
                //records: this.records
            }
        },
        methods: {
            handleNext: function () {
                this.step += 1;
                if (this.step > this.records.length) {
                   this.step = 1;
                }
            },
        },
        mounted() {
            
        }
    }
</script>

<style lang="scss" scoped>
    .slides {
        display: none;
        ul {
            li {
                position: relative;
                width: 150px;
                height: 200px;
                .image-wrap {
                    position:absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    div {
                        width: 100%;
                        height: 100%;
                        overflow: hidden;
                        background-position: center center;
                        background-repeat: no-repeat;
                        background-size: cover;
                    }
                }
                &:not(:last-child) {
                    margin-right: 10px;
                }
            }
        }
    }
</style>