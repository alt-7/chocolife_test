<table border="1">
    <thead>
        <tr>
            <th>ID акции</th>
            <th>Название акции</th>
            <th>Дата начала акции</th>
            <th>Дата окончания</th>
            <th>Статус</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?=$item['id'];?></td>
        <td><?=$item['name'];?></td>
        <td><?=date('d-m-Y',$item['start_date']);?></td>
        <td><?=date('d-m-Y',$item['end_date']);?></td>
        <td><?=$item['status'];?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<p>Правила URL</p>

<?php foreach ($items as $item){
    echo $item['id'] .' - '. $item['name']. ' - '.$translate->translate($item['name']).'<br>';
} ?>