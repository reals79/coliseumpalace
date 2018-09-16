<template>
    <div>
        <h5>{{ $t('account.menu.communal_payments') }}</h5>
        <hr class="m-0">
        <div class="container mt-2">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-2">
                      <label for="inputMonth">Месяц</label>
                      <select id="inputMonth" class="form-control" v-model="sel_month">
                        <option value="0" selected>Выберите...</option>
                        <option v-for="month in periods.months" :value="month">{{ ((month < 10) ? '0' + month : month) }}</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputYear">Год</label>
                      <select id="inputYear" class="form-control" v-model="sel_year">
                        <option value="0" selected>Выберите...</option>
                        <option v-for="year in periods.years" :value="year">{{ year }}</option>
                      </select>
                    </div>
                </div>
            </form>

            <div v-for="doc in documents" class="card mb-3">
                <div class="card-header">
                    <span class="card-title">Блок: {{ doc.block }}</span>
                    <button @click="downloadPDF(doc.document)" class="btn btn-success float-right">Загрузить</button>
                    <button @click="printPDF(doc.id)" class="btn btn-primary float-right mx-1">Печать</button>
                </div>
                <div class="card-body">
                    <pdf :id="doc.id" ref="pdfDocument" :src="'/api/get-pdf?file_name=' + doc.document" style="width: 120%;"></pdf>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    import pdf from 'vue-pdf'

    /* Helper function */
    function download_file(fileURL, fileName) {
        // for non-IE
        if (!window.ActiveXObject) {
            var save = document.createElement('a');
            save.href = fileURL;
            save.target = '_blank';
            var filename = fileURL.substring(fileURL.lastIndexOf('/')+1);
            save.download = fileName || filename;
               if ( navigator.userAgent.toLowerCase().match(/(ipad|iphone|safari)/) && navigator.userAgent.search("Chrome") < 0) {
                    document.location = save.href; 
    // window event not working here
                }else{
                    var evt = new MouseEvent('click', {
                        'view': window,
                        'bubbles': true,
                        'cancelable': false
                    });
                    save.dispatchEvent(evt);
                    (window.URL || window.webkitURL).revokeObjectURL(save.href);
                }   
        }

        // for IE < 11
        else if ( !! window.ActiveXObject && document.execCommand)     {
            var _window = window.open(fileURL, '_blank');
            _window.document.close();
            _window.document.execCommand('SaveAs', true, fileName || fileURL)
            _window.close();
        }
    }

    export default {
        data() {
            return {
                records: null,
                sel_month: 0,
                sel_year: 0,
            }
        },
        computed: {
            periods() {
                var months = [];
                var years = [];
                _.forEach(this.records, function(record, key) {
                    let period = moment(key);
                    months.push(period.month()+1);
                    years.push(period.year());
                })
                months = _.uniqBy(months);
                years = _.uniqBy(years);
                return {months: months, years: years} ;
            },
            documents() {
                var documents = [];
                if (this.sel_month > 0 && this.sel_year > 0) {
                    var that = this;
                    documents = _.filter(this.records, function(value, key) {
                        var period = moment(key);
                        return ((period.month()+1 == that.sel_month) && (period.year() == that.sel_year));
                    });
                }

                return documents[0];
            },
        },
        methods: {
            printPDF(doc_id) {
                var doc = _.find(this.$refs.pdfDocument, function(o) { return (o.$el.id == doc_id) })
                if (doc) {
                    doc.print()
                }
            },
            downloadPDF(doc) {
                var fileName = doc.replace('acc/', '');
                download_file('/api/get-pdf?file_name=' + doc, fileName);
            }
        },
        mounted() {
            axios.get(
                '/api/communal'
            ).then(response => {
                this.records = _.chain(response.data.communals).groupBy('period_at').value();
            }, response => {
                
            })
        },
        components: {
            pdf
        }
    }
</script>
