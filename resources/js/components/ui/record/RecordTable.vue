<template>
  <table ref="recordTable" class="display">
    <thead>
      <tr>
        <th>ID</th>
        <th>String</th>
        <th>Text</th>
        <th>JSON</th>
        <th>Boolean</th>
        <th>Integer</th>
        <th>Float</th>
        <th width="100px">Action</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>ID</th>
        <th>String</th>
        <th>Text</th>
        <th>JSON</th>
        <th>Boolean</th>
        <th>Integer</th>
        <th>Float</th>
        <th width="100px">Action</th>
      </tr>
    </tfoot>
  </table>

  <div ref="recordModalElement" class="modal fade" id="recordModal" tabindex="-1" aria-labelledby="recordModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
              <div class="modal-content">
                  <div class="modal-header">
                      <h1 class="modal-title fs-5" id="recordModalLabel">Record Modal</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <table id="record-modal">
                          <tbody>
                          <tr>
                              <td class="bold">ID:</td>
                              <td>
                                  <input type="text" id="record-modal-id" name="record-modal-id" disabled value=""/>
                              </td>
                          </tr>
                          <tr>
                              <td class="bold">String:</td>
                              <td>
                                  <input type="text" id="record-modal-string" name="record-modal-string" disabled value=""/>
                              </td>
                          </tr>
                          <tr>
                              <td class="bold">Text:</td>
                              <td>
                                  <textarea type="text" id="record-modal-text" name="record-modal-text" disabled>
                                      &nbsp;
                                  </textarea>
                              </td>
                          </tr>
                          <tr>
                              <td class="bold">JSON:</td>
                              <td>
                                  <input type="text" id="record-modal-json" name="record-modal-json" disabled value=""/>
                              </td>
                          </tr>
                          <tr>
                              <td class="bold">Boolean:</td>
                              <td>
                                  <input type="text" id="record-modal-boolean" name="record-modal-boolean" disabled  value=""/>
                              </td>
                          </tr>
                          <tr>
                              <td class="bold">Integer:</td>
                              <td>
                                  <input type="text" id="record-modal-integer" name="record-modal-integer" disabled value=""/>
                              </td>
                          </tr>
                          <tr>
                              <td class="bold">Float:</td>
                              <td>
                                  <input type="text" id="record-modal-float" name="record-modal-float" disabled value=""/>
                              </td>
                          </tr>
                          </tbody>
                      </table>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" id="save-button">Save</button>
                  </div>
              </div>
          </div>
      </div>
</template>

<style>
    @import 'datatables.net-dt';

    .truncate-text {
        max-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #record-modal {
        width: 100%;
    }

    #record-modal tbody tr {
        padding: 10px;
        border: 1px solid grey;
    }

    #record-modal tbody tr td {
        padding: 10px;
        border: 1px solid grey;
    }
</style>

<script setup>
    import { Modal } from "bootstrap";
    import { onMounted, ref } from 'vue';
    import $ from 'jquery';
    import 'datatables.net';
    import 'datatables.net-dt';
    import 'bootstrap/dist/css/bootstrap.min.css';
    import 'bootstrap/dist/js/bootstrap.bundle.min.js';
    import 'bootstrap-icons/font/bootstrap-icons.css';
    import axios from 'axios';

    const recordTable = ref(null);

    onMounted(() => {
        $(recordTable.value).DataTable({
            processing: true,
            serverSide: true,
            ajax: '/records',
            columns: [
                {data: 'id', name: 'id', searchable: true},
                {data: 'string', name: 'string', className: 'truncate-text', searchable: true},
                {data: 'text', name: 'text', className: 'truncate-text', searchable: true},
                {data: 'json', name: 'json', className: 'truncate-text', searchable: true},
                {data: 'boolean', name: 'boolean', searchable: true},
                {data: 'integer', name: 'integer', searchable: true},
                {data: 'float', name: 'float', searchable: true},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });
    });

    axios.defaults.withCredentials = true;

        async function getCsrfToken() {
            try {
                await axios.get('/sanctum/csrf-cookie');
                console.log('CSRF cookie successfully fetched.');
            } catch (error) {
                console.error('Error fetching CSRF cookie:', error);
            }
        }

        const recordModalElement = ref(null);
        let recordModal = null;

        onMounted(() => {
          recordModal = new Modal(recordModalElement.value);
        });

        const showModal = () => {
          recordModal.show();
        };

        $.callModal = function (id, disabled) {
            var modalId = $('#record-modal-id');
            var modalString = $('#record-modal-string');
            var modalText = $('#record-modal-text');
            var modalJson = $('#record-modal-json');
            var modalBoolean = $('#record-modal-boolean');
            var modalInteger = $('#record-modal-integer');
            var modalFloat = $('#record-modal-float');

            modalString.prop('disabled', disabled);
            modalText.prop('disabled', disabled);
            modalJson.prop('disabled', disabled);
            modalBoolean.prop('disabled', disabled);
            modalInteger.prop('disabled', disabled);
            modalFloat.prop('disabled', disabled);

            modalId.val('');
            modalString.val('');
            modalText.html('');
            modalJson.val('');
            modalBoolean.val('');
            modalInteger.val('');
            modalFloat.val('');

            $.ajax({
                url: '/record/' + id,
                type: "GET",
                dataType: 'json',
                success: function (data) {
                    // console.log('Data received:', data);
                    modalId.val(data.id);
                    modalString.val(data.string);
                    modalText.html(data.text);
                    modalJson.val(data.json);
                    modalBoolean.val(data.boolean.toString());
                    modalInteger.val(data.integer);
                    modalFloat.val(data.float);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                }
            });
        };

        $.editRecord = function () {
            $.ajax({
                url: '/record/' + $('#record-modal-id').val(),
                type: "POST",
                dataType: 'json',
                data: {
                    string: $('#record-modal-string').val(),
                    text: $('#record-modal-text').html(),
                    json: $('#record-modal-json').val(),
                    boolean: $('#record-modal-boolean').val(),
                    integer: $('#record-modal-integer').val(),
                    float: $('#record-modal-float').val()
                },
                success: function (data) {
                    // console.log('Data received:', data);
                    $('#recordModal').modal('hide');
                    $('#recordTable').DataTable().draw();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                }
            });
        };

        $.deleteRecord = function (id, table, tr) {
            getCsrfToken();

            $.ajax({
                url: '/record/' + id,
                type: "DELETE",
                dataType: 'json',
                success: function (data) {
                    // console.log('Data received:', data);
                    table.DataTable().row(tr).remove().draw();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                }
            });
        };

        $(document).on('click', '.view-record', function () {
            $('#save-button').hide();
            $.callModal($(this).data('id'), true);
        });

        $(document).on('click', '.edit-record', function () {
            $('#save-button').show();
            $.callModal($(this).data('id'), false);
        });

        $(document).on('click', '#save-button', function () {
            $.editRecord();
        });

        $(document).on('click', '.delete-record', function () {
            deleteRecord($(this).data('id'), $('#recordTable'), $(this).closest('tr'));
        });

        async function deleteRecord(id, table, tr) {
            let data = [];

            try {
                console.log('test');
                const response = await axios.delete('/record/'+id, data);

                recordTable.draw();

                //console.log('Record deleted successfully:', response.data);
            } catch (error) {
                console.error('Error deleting record:', error);
            }
        }
</script>