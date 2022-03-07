<br>
<div class="jumbotron center" style="background-color: #292b2e; max-width:100%">
  <form>
    <div class="d-flex justify-content-center form-group row ">
      <div class="col-4" style="background-color:#292b2e">
        <label for="tags" class="col-2 col-form-label text-white">Tags</label>
        <input id="tags" name="tags" placeholder="Search for tags" type="text" required="required" class="form-control">
      </div>
    </div>
    <div class="form-group row">
      <div class="d-flex justify-content-center col-12">
        <button name="submit" type="submit" class="btn btn-primary tag-sub-btn">Submit</button>
      </div>
    </div>
  </form>
</div>
<div class="jumbotron center" style="background-color: #292b2e; max-width:100%">
  <?php if ($listePosts != 0) { ?>
    <div class="container">

      <?php for ($i = 0; $i < count($listePosts); $i++) {
        $leContent = $listePosts[$i]['content'];
        if ($i % 4 == 0) { ?>
    </div>
    <hr>

    <div class="d-flex justify-content-center" style="background-color: #292b2e; height:40%;">


    <?php } ?>
    <div class="card bg-dark h-25" style="width: 620px;">
      <?php if (!(isset($_COOKIE["acceptNsfw"]))) { ?>
        <?php if (strpos($leContent, ".png") | strpos($leContent, ".jpg") | strpos($leContent, ".jpeg")) { $postr = explode("/", $leContent) ?>
          <a href="./?page=post&id=<?= $listePosts[$i]["id"] ?>" type="image/jpeg"><img class="card-img-top img-fluid hover-overlay ripple shadow-1-strong rounded image-blur" src="<?= $postr[0] . '/thumbnail_' . $postr[1] ?>" type="image/jpeg" class="img-fluid img-thumbnail" alt="Image Post" width="50%" height="50%" onerror="this.onerror=null;this.src='<?= $leContent ?>'"></a>
        <?php } else if (strpos($leContent, ".mp3")) {
            $postr = explode("/", $leContent) ?>
          <a href="./?page=post&id=<?= $listePosts[$i]["id"] ?>">🔞♬<?= $listePosts[$i]['label'] ?>♬🔞
            <img class="card-img-top img-fluid hover-overlay ripple shadow-1-strong rounded" src="ressources/play.png" type="image/jpeg" class="img-fluid img-thumbnail" alt="Image Post" width="50%" height="50%"></a>
          </a>
        <?php } else {
            $postr = explode("/", $leContent) ?>
          <a href="./?page=post&id=<?= $listePosts[$i]["id"] ?>" type="image/jpeg"><img class="card-img-top img-fluid hover-overlay ripple shadow-1-strong rounded image-blur" src="<?= $postr[0] . '/thumbnail_' . $postr[1] . '.jpg' ?>" type="image/png" class="img-fluid img-thumbnail" alt="Image Post" width="50%" height="50%" onerror="this.onerror=null;this.src='<?= $leContent ?>'"></a>
        <?php } ?>

    </div>
    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
  <?php } else { ?>
    <?php if (($listePosts[$i]['nsfw'] == 0) | (($_COOKIE["acceptNsfw"] == 1) & $listePosts[$i]['nsfw'] >= 1)) { ?>
      <?php if (strpos($leContent, ".png") | strpos($leContent, ".jpg") | strpos($leContent, ".jpeg")) { 
        $postr = explode("/", $leContent) ?>
        <a href="./?page=post&id=<?= $listePosts[$i]["id"] ?>" type="image/jpeg"><img class="card-img-top img-fluid hover-overlay ripple shadow-1-strong rounded" src="<?= $postr[0] . '/thumbnail_' . $postr[1] ?>" type="image/jpeg" class="img-fluid img-thumbnail" alt="Image Post" width="50%" height="50%" onerror="this.onerror=null;this.src='<?= $leContent ?>'"
></a>
      <?php } else if (strpos($leContent, ".mp3")) {
              $postr = explode("/", $leContent) ?>
        <a href="./?page=post&id=<?= $listePosts[$i]["id"] ?>">♬<?= $listePosts[$i]['label'] ?>♬
          <img class="card-img-top img-fluid hover-overlay ripple shadow-1-strong rounded" src="ressources/play.png" type="image/jpeg" class="img-fluid img-thumbnail" alt="Image Post" width="50%" height="50%"></a>
        </a>
      <?php } else {
              $postr = explode("/", $leContent) ?>
        <a href="./?page=post&id=<?= $listePosts[$i]["id"] ?>" type="image/jpeg"><img class="card-img-top img-fluid hover-overlay ripple shadow-1-strong rounded" src="<?= $postr[0] . '/thumbnail_' . $postr[1] . '.jpg' ?>" type="image/png" class="img-fluid img-thumbnail" alt="Image Post" width="50%" height="50%" onerror="this.onerror=null;this.src='<?= $leContent ?>'"></a>
      <?php } ?>
    </div>
    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
  <?php } else if (($listePosts[$i]['nsfw'] >= 1) & ($_COOKIE["acceptNsfw"] == 0)) { ?>
    <?php if (strpos($leContent, ".png") | strpos($leContent, ".jpg") | strpos($leContent, ".jpeg")) { $postr = explode("/", $leContent) ?>
      <a href="./?page=post&id=<?= $listePosts[$i]["id"] ?>" type="image/jpeg"><img class="card-img-top img-fluid hover-overlay ripple shadow-1-strong rounded image-blur" src="<?= $postr[0] . '/thumbnail_' . $postr[1] ?>" type="image/jpeg" class="img-fluid img-thumbnail" alt="Image Post" width="50%" height="50%"></a>
    <?php } else if (strpos($leContent, ".mp3")) {
              $postr = explode("/", $leContent) ?>
      <a href="./?page=post&id=<?= $listePosts[$i]["id"] ?>">🔞♬<?= $listePosts[$i]['label'] ?>♬🔞
        <img class="card-img-top img-fluid hover-overlay ripple shadow-1-strong rounded" src="ressources/play.png" type="image/jpeg" class="img-fluid img-thumbnail" alt="Image Post" width="50%" height="50%"></a>
      </a>
    <?php } else {
              $postr = explode("/", $leContent) ?>
      <a href="./?page=post&id=<?= $listePosts[$i]["id"] ?>" type="image/jpeg"><img class="card-img-top img-fluid hover-overlay ripple shadow-1-strong rounded image-blur" src="<?= $postr[0] . '/thumbnail_' . $postr[1] . '.jpg' ?>" type="image/png" class="img-fluid img-thumbnail" alt="Image Post" width="50%" height="50%"></a>
    <?php } ?>

</div>
<div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
<?php } ?>
<?php }
      }
?>
</div>
</div>
<br>
<?php } ?>
<div class="d-flex justify-content-center" style="background-color: #292b2e; height:20%;">
  <nav>
    <ul class="pagination">
      <?php if (isset($_GET['tags'])) : ?>
        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
          <a href="./?page=posts&tags=<?= $_GET['tags'] ?>&num=<?= $currentPage - 1 ?>" class="btn-sm page-link tag-sub-btn">Précédente</a>
        </li>
        <?php if ($currentPage > 1) : ?>
          <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
            <a href="./?page=posts&tags=<?= $_GET['tags'] ?>&num=<?= $currentPage - 1 ?>" class="btn-sm page-link tag-sub-btn"><?= $currentPage - 1 ?></a>
          </li>
        <?php endif ?>
        <?php for ($page = $currentPage; $page <= $currentPage + 3; $page++) : ?>
          <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
          <?php if (!($page  > $pages)) : ?>
            <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
              <a href="./?page=posts&tags=<?= $_GET['tags'] ?>&num=<?= $page ?>" class="btn-sm page-link tag-sub-btn"><?= $page ?></a>
            </li>
          <?php endif ?>
        <?php endfor ?>
        <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
        <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
          <a href="./?page=posts&tags=<?= $_GET['tags'] ?>&num=<?= $currentPage + 1 ?>" class="btn-sm page-link tag-sub-btn">Suivante</a>
        </li>
      <?php else : ?>
        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
          <a href="./?page=posts&num=<?= $currentPage - 1 ?>" class="btn-sm page-link tag-sub-btn">Précédente</a>
        </li>
        <?php if ($currentPage > 1) : ?>
          <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
            <a href="./?page=posts&num=<?= $currentPage - 1 ?>" class="btn-sm page-link tag-sub-btn"><?= $currentPage - 1 ?></a>
          </li>
        <?php endif ?>
        <?php for ($page = $currentPage; $page <= $currentPage + 3; $page++) : ?>
          <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
          <?php if (!($page  > $pages)) : ?>
            <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
              <a href="./?page=posts&num=<?= $page ?>" class="btn-sm page-link tag-sub-btn"><?= $page ?></a>
            </li>
          <?php endif ?>
        <?php endfor ?>
        <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
        <?php if (($currentPage + 1 >= $pages)) : ?>
          <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
            <a href="./?page=posts&num=<?= $currentPage + 1 ?>" class="btn-sm page-link tag-sub-btn">Suivante</a>
          </li>
        <?php else : ?>
          <li class="page-item <?= ($currentPage == $pages) ? "active" : "" ?>">
            <a href="./?page=posts&num=<?= $currentPage + 1 ?>" class="btn-sm page-link tag-sub-btn">Suivante</a>
          </li>
        <?php endif ?>
      <?php endif ?>
    </ul>
  </nav>
</div>