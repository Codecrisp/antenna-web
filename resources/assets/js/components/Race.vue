<template>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">Contestants</div>
                <div class="panel-body">
                  <table class="table table-striped table-borderless">
                    <thead>
                      <tr>
                        <th>Pigeon</th>
                        <th style="width:40%;">Result</th>
                      </tr>
                    </thead>
                    <tbody class="no-border-x">
                      <tr v-for="entry in entries">
                        <td>
                          <h4>
                            <strong>
                            Pigeon '<span v-if="entry.ringnumber">{{ entry.ringnumber }}</span><span v-else>{{ (entry.pigeon.birth_year + "").slice(-2) }}/{{ entry.pigeon.number }}</span>' has been basketed<br>
                            </strong>
                          </h4>
                        </td>
                        <td>
                            <span v-if="entry.timestamp_dec" class="text-success">{{ moment.unix(entry.timestamp_dec).fromNow() }}<br>
                            {{ moment.unix(entry.timestamp_dec).format('MMMM Do YYYY, h:mm:ss a') }}</span>
                            <span v-else class="text-warning">
                                Not arrived yet
                            </span>
                        </td>
                      </tr>
                      <tr v-if="entries.length == 0">
                        <td class="text-center" colspan="2"><h2>No contestants found</h2></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
        </div>
    </div>
</template>

<script>
    import '../Race'
    export default {
        props: ['id'],
        data() {
            return {
                entries: []
            }
        },
        methods: {
            entryIndexById: function (id) {
                for(let i = 0; i < this.entries.length; i++)
                {
                    if(this.entries[i].id == id)
                        return i;
                }
                return -1;
            },

            updateEntries: function () {
                var entries = this.entries
                this.entries = []
                this.entries = entries
                setTimeout(() => {
                    this.updateEntries()
                }, 5000);
            }
        },
        mounted() {
            this.updateEntries()
            this.$http.get('/races/' + this.id + '/json').then((response) => {
                this.entries = response.body.entries
                console.log(this.entries[0].ringnumber)
            })
            window.Echo.private('race.' + this.id)
              .listen('Race.NewEntry', (e) => {
                  var index = this.entryIndexById(e.entry.id)
                  if(index != -1)
                  {
                      $.gritter.add({
                         title:"Duplicate entry",
                         text:e.entry.ringnumber + " has already been entered.",
                         class_name:"color warning",
                         time:"5000"
                       });
                  }
                  else{
                      $.gritter.add({
                         title:"New entry",
                         text:e.entry.ringnumber + " has just been entered.",
                         class_name:"color primary",
                         time:"5000"
                       });
                       this.entries.push(e.entry)
                  }
              })
              .listen('Race.EntryArrived', (e) => {
                  // Find entry in list and replace the timestamp_dec value
                  $.gritter.add({
                     title:"New Arrival",
                     text:e.entry.ringnumber + " has just arrived.",
                     class_name:"color success",
                     time:"5000"
                   });
                   let index = this.entryIndexById(e.entry.id)
                   if(index > -1)
                    {
                        this.entries[index] = e.entry
                    }
              })
        }
    }
</script>
