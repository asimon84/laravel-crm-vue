<script setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';

DataTable.use(DataTablesCore);

const data = [
  ['1', 'String', 'Text', '{}', '1', '10', '123.456', ''],
];
</script>

<template>
  <DataTable :data="data" class="display">
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
  </DataTable>
</template>

