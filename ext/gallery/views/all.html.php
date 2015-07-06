<?php foreach($images as $img): ?>

<div class="gallery-cell">
    <img src="<?='/ext/gallery/media/img/gallery/thumbnails/' . $img['file_name']?>" alt="<?=$img['description']?>" title="<?=$img['title']?>" class="thumbnail">
</div>

<?php endforeach; ?>