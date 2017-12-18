<template>
    <div class="slides">
        <div v-for="(record, index) in records" v-if="step === (index+1)">
            <a :href="'/about/#' + record.id" class="btn btn-link slide-link">{{ record.name }}</a>
            <ul class="list-inline mb-0 d-flex justify-content-around">
                <li v-for="(image, ind) in record.images" v-if="ind < 4" class="list-inline-item">
                    <div class="image-wrap"><a :href="image" data-toggle="lightbox" :data-gallery="'gallery-' + index"><div :style="'background-image:url('+image+')'" class="img-thumbnail"></div></a></div>
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
        .slide-link {
            color: #fff !important;
            text-decoration: underline;
            &:hover {
                text-decoration: none;
                font-weight: normal;
            }
        }
        ul {
            li {
                position: relative;
                width: 70%;
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