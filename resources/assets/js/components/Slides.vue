<template>
    <div class="slides">
        <div v-for="(record, index) in records" v-if="step === (index+1)">
            <a :href="'/about/#' + record.id" class="btn btn-link slide-link">{{ record.name }}</a>
            <ul class="list-inline mb-0 d-flex justify-content-around" v-if="record.images.length > 0">
                <li class="list-inline-item">
                    <div class="image-wrap"><a :href="image = randomImage(record.images)" data-toggle="lightbox"><div :style="'background-image:url(' + image + ')'" class="img-thumbnail"></div></a></div>
                </li>
            </ul>
            <div class="d-flex">
                <div v-if="step > 1"><a @click="handlePrev" class="btn btn-link">{{ $t('app.buttons.back') }}</a></div>
                <div class="ml-auto" v-if="step < records.length"><a @click="handleNext" class="btn btn-link">{{ $t('app.buttons.more') }}</a></div>
            </div>
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
            handleNext: function() {
                this.step += 1;
                if (this.step > this.records.length) {
                   this.step = 1;
                }
            },
            handlePrev: function() {
                this.step -= 1;
                if (this.step < 1) {
                   this.step = 1;
                }
            },
            randomImage: function(images) {
                const idx = Math.floor(Math.random() * images.length);
                return images[idx];
            }
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
            text-decoration: dashed underline;
            font-size: 1.3rem;
            &:hover {
                text-decoration: none;
                font-weight: normal;
            }
        }
        ul {
            li {
                position: relative;
                width: 50%;
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