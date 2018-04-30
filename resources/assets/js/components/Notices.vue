<template>
    <div>
        <h5>{{ $t('account.menu.notifications') }}</h5>
        <hr class="m-0">
        <div class="container mt-2">
            <table class="table table-sm table-hover table-bordered notices">
                <thead>
                    <tr>
                        <th>{{ $t('account.notices.subject') }}</th>
                        <th width="120" class="text-center">{{ $t('account.notices.at') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(record, index) in records" :key="record.id" @click="getMessage(record.id)">
                        <td>{{ record.subject }}</td>
                        <td class="text-center">{{ record.created_at | formatDateTime }}</td>
                    </tr>
                </tbody>
            </table>
            <!-- Modal -->
            <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalTitle" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="messageModalTitle">{{ subject }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" v-html="message"></div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $t('app.buttons.close') }}</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                records: null,
                message: '',
                subject: '',
                at: ''
            }
        },
        methods: {
            getMessage(id) {
                axios.get(
                    '/api/notice/' + id
                ).then(response => {
                    this.message = response.data[0].message;
                    this.subject = response.data[0].subject;
                    this.at = response.data[0].created_at;
                    $('#messageModal').modal('show')
                }, response => {
                    
                })
            }
        },
        mounted() {
            axios.get(
                '/api/notices'
            ).then(response => {
                this.records = response.data;
            }, response => {
                
            })
        }
    }


</script>
