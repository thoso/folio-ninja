<?php
/* @var $this DefaultController */
/* @var $user User */
/* @var $projects Project[] */
/* @var $folder Folder */

Project::sortByName($projects);
?>

<?php if (!empty($folder)): ?>
<li class="folder-item">
    <span class="title">
        <?php echo TbHtml::icon(TbHtml::ICON_FOLDER_OPEN) . ' ' . $folder->title; ?>
    </span>
    <ul class="folder-group">
<?php endif; ?>

<?php foreach($projects as $project): ?>
    <li class="project-item">
        <?php if (!empty($project->picture)): ?>
        <span class="thumbnail">
            <img src="<?php echo Yii::app()->baseUrl . $project->picture->getThumbnailFile() ?>"/>
        </span>
        <?php endif; ?>
        <span class="actions">
            <?php echo TbHtml::buttonGroup(array(
                array(
                    'label'=>'View',
                    'url' => array('/'.$user->alias.'/project/'.$project->id),
                ),
            )); ?>
        </span>
        <span class="title"><?php echo $project->name; ?></span>
        <span class="description"><?php echo nl2br(Utilities::limitWords($project->description,20)); ?></span>
        <span class="count">
            <span class="item"><?php echo TbHtml::icon(TbHtml::ICON_PICTURE) . ' ' . count($project->picturesPerProjects); ?></span>
            <span class="item"><?php echo TbHtml::icon(TbHtml::ICON_FILM) . ' ' . count($project->videosPerProjects); ?></span>
            <span class="item"><?php echo TbHtml::icon(TbHtml::ICON_GLOBE) . ' ' . count($project->linksPerProjects); ?></span>
        </span>
    </li>
<?php endforeach; ?>

<?php if (!empty($folder)): ?>
    </ul>
</li>
<?php endif; ?>