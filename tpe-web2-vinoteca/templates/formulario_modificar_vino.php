<?php require 'templates/header.phtml' ?>
<h2>Modificar Vino</h2>
<form action="enviarModificarVino/<?= $id ?>" method="POST">

    <p>Nombre</p>
    <input type="text" name="Nombre" placeholder=<?= $vino->Nombre ?>>
    <p>Tipo</p>
    <input type="text" name="Tipo" placeholder=<?= $vino->Tipo ?>>
    <p>Azucar</p>
    <input type="text" name="Azucar" placeholder=<?= $vino->Azucar ?>>

    </select>
    <h3>Cepa</h3>
    <select name="id_cepa" placeholder=<?= $vino->Nombre_cepa ?>>
        <?php foreach ($cepas as $cepa) : ?>
            <option value=<?= $cepa->id_cepa ?>><?= $cepa->Nombre_cepa ?></option>
        <?php endforeach ?>
    </select>


    <button type="submit">Modicar</button>
</form>
<?php require 'templates/footer.phtml' ?>