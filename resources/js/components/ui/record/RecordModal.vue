<template>

</template>

<script setup>
    import { Modal } from "bootstrap";
    import { onMounted, ref } from "vue";
    import $ from 'jquery';
    import axios from 'axios';
    import 'datatables.net';
    import 'datatables.net-dt';

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
            //const response = await axios.delete('/record/'+id, data);

            $('#recordTable').DataTable().row(tr).remove().draw();

            //console.log('Record deleted successfully:', response.data);
        } catch (error) {
            console.error('Error deleting record:', error);
        }
    }
</script>

<style>
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