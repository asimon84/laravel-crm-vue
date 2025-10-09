<script setup>
    import { onMounted, ref } from 'vue';
    import $ from 'jquery';
    import 'datatables.net';

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
</script>

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
</template>

<style>
    @import 'datatables.net-dt';
</style>
