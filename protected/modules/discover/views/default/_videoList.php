<?php
/* @var $this DefaultController */
/* @var $video VideosPerProject */
?>
<li>
    <div class="video-thumb">
        <a href="<?php echo $this->createUrl('/'.$video->project->user->alias.'/video/'.$video->id) ?>">
            <img src="<?php echo $video->getThumbnailUrl(); ?>"/>
        </a>
    </div>
    <?php if (!empty($video->title)): ?>
        <span class="title"><?php echo $video->title; ?></span>
    <?php endif; ?>
    <?php if (!empty($video->description)): ?>
        <p class="description"><?php echo Utilities::limitWords(nl2br($video->description),15); ?></p>
    <?php endif; ?>
    <?php if (!empty($video->tagsPlacements)): ?>
        <ul class="tagList">Tags: <?php $this->renderPartial('_existingTags', array('tags'=>$video->tagsPlacements)) ?></ul>
    <?php endif; ?>
</li>