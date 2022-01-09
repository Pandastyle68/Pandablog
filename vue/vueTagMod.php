<div class="container-form-modtags">
<h2>Modification des tags</h2>
    <form action="?page=tags&id=<?=$_GET['id']?>" method="post">
        <div class="form-group">
            <label for="selectedTags[]">Select tags</label>
            <select multiple class="form-control" name="selectedTags[]" id="selectedTags[]">
                <?php foreach ($lesTags as $unTag) {  ?>
                    <option value=<?= $unTag['label'] ?>><?= $unTag['label'] ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary center btn-pandabooru">Submit</button>
    </form>
</div>
<div class="container-form-modtags">
<h2>Suppression de tags</h2>
<form action="?page=tags&id=<?=$_GET['id']?>" method="post">
    <?php foreach($postTags as $unTag){ ?>
        <button id="remTags" name="remTags" type="submit" class="btn btn-secondary btn-sm" value = "<?= $unTag['id']?>">-<?= $unTag['label']?></button></a>
        <?php }?>
    </form>
</div>